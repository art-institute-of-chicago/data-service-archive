<?php

namespace App\Console\Commands;

use GrahamCampbell\Flysystem\Facades\Flysystem;

use App\ArchivalImage;

use Aic\Hub\Foundation\AbstractCommand;

class ArchivesDownload extends AbstractCommand
{

    protected $signature = 'archives:download';

    protected $description = "Download JSON records of all images from the Ryerson & Burnham Image Archive";

    /**
     * Download JSON metadata of all images from CONTENTdm.
     *
     * CONTENTdm's API has a 10,000 record limit on paginated results. So we're unable to use their
     * regular endpoints as a source for all their data. Instead, we take advantage of their numeric,
     * sequential IDs to query for ID in a sequence and import the items that are found.
     */
    public function handle()
    {

        // Get the highest ID value
        $id = $this->queryForMaxId();

        // Step down and import images until we get to 0
        while ($id > 0)
        {

            $res = $this->queryService($id);

            // Unfortunately, errors in CONTENTdm's API return with the status code of 200.
            // So we have to execute an entire call and read the contents to determine if the
            // ID is invalid

            if (property_exists($res, 'code') && $res->code == '-2') // Codes are returned strings
            {
                $this->info('Skipping #' .$id);
                $id--;
                continue;
            }

            $file = $res->dmrecord . '.json';

            if( Flysystem::has( $file ) )
            {
                $this->warn('Found ' . $file);
                $id--;
                continue;
            }

            Flysystem::put( $file, json_encode($res, JSON_PRETTY_PRINT) );

            $this->info('Saved ' . $file);

            $id--;
        }

    }


    private function queryService($id = 0)
    {

        $res = file_get_contents(env('CONTENT_DM_API', 'http://localhost')
                                 . '?q=dmGetItemInfo/mqc/' .$id .'/json'
        );

        return json_decode($res);

    }

    private function queryForMaxId()
    {

        $res = file_get_contents(env('CONTENT_DM_API', 'http://localhost')
                                 . '?q=dmGetRecent/mqc/1/0/0/0/json'
        );

        return json_decode($res)->records[0]->pointer;

    }

}
