<?php

namespace App\Console\Commands;

use App\ArchivalImage;

class ImportArchives extends AbstractCommand
{

    protected $signature = 'import:archives';

    protected $description = "Import all images from the Ryerson & Burnham Image Archive";

    /**
     * Import all images from CONTENTdm.
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

            $this->info('Working on #' .$res->dmrecord);
            $ai = ArchivalImage::findOrNew($res->dmrecord);

            $ai->id = $this->checkEmpty($res->dmrecord);
            $ai->title = $this->checkEmpty($res->title);
            $ai->format = $this->checkEmpty($res->format);
            $ai->file_format = $this->checkEmpty($res->digff);
            $ai->file_size = $this->checkEmpty($res->cdmfilesize);
            $ai->pixel_dimensions = $this->checkEmpty($res->pixel);
            $ai->color = $this->checkEmpty($res->color);
            $ai->physical_notes = $this->checkEmpty($res->physic);
            $ai->date_display = $this->checkEmpty($res->date);
            $ai->date_of_object = $this->checkEmpty($res->datea);
            $ai->date_of_view = $this->checkEmpty($res->viewdt);
            $ai->creator = $this->checkEmpty($res->creato);
            $ai->additional_creator = $this->checkEmpty($res->additi);
            $ai->main_id = $this->checkEmpty($res->collec);
            $ai->subject_terms = $this->checkEmpty($res->subjea);
            $ai->view = $this->checkEmpty($res->view);
            $ai->image_notes = $this->checkEmpty($res->descri);
            $ai->file_name = $this->checkEmpty($res->find);
            $ai->source_modified_at = $this->checkEmpty($res->dmmodified);
            $ai->save();

            $id--;
        }

    }

    private function checkEmpty($value)
    {

        return !empty((array)$value) ? $value : null;

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