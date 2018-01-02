<?php

namespace App\Console\Commands;

use GrahamCampbell\Flysystem\Facades\Flysystem;

use App\ArchivalImage;

class ArchivesImport extends AbstractCommand
{

    protected $signature = 'archives:import';

    protected $description = "Import all images from the JSON cache generated by `archives:download`";

    /**
     * Import all images from our JSON cache of CONTENTdm data.
     */
    public function handle()
    {

       // Define the base directory for globbing
        $directory = storage_path('app');

        // List all JSON files in storage/app
        $paths = glob( $directory . '/*.json' );

        // Turn this into a collection
        $paths = collect( $paths );

        // Uncomment for testing
        // $paths = $paths->slice(0,2);

        // Turn the full paths to relative for Flysystem
        $files = $paths->map( function( $path ) use ( $directory ) {

            // +1 to remove the starting forwardslash
            return substr( $path, strlen( $directory ) + 1 );

        });

        // Process each matching file
        $paths->map( [$this, 'processFile'] );

    }


    /**
     * Process a single image metadata file
     *
     * @param string $path  Path to JSON file relative to Flysystem root
     * @return array
     */
    public function processFile( $path )
    {

        $file = basename( $path );
        $contents = Flysystem::read( $file );
        $res = json_decode( $contents );

        $this->info('Working on #' .$res->dmrecord);
        $ai = ArchivalImage::findOrNew($res->dmrecord);

        $ai->id = $this->checkEmpty($res->dmrecord);
        $ai->title = $this->checkEmpty($res->title);
        $ai->alt_title = $this->checkEmpty($res->altern);
        $ai->collection_name = $this->checkEmpty($res->subcol);
        $ai->archive_name = $this->checkEmpty($res->archiv);
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
        $ai->photographer = $this->checkEmpty($res->photog);
        $ai->main_id = $this->checkEmpty($res->collec);
        $ai->legacy_image_id = $this->checkEmpty($res->aicneg);
        $ai->subject_terms = $this->checkEmpty($res->subjea);
        $ai->view = $this->checkEmpty($res->view);
        $ai->image_notes = $this->checkEmpty($res->descri);
        $ai->file_name = $this->checkEmpty($res->find);
        $ai->source_created_at = $this->checkEmpty($res->dmcreated);
        $ai->source_modified_at = $this->checkEmpty($res->dmmodified);
        $ai->save();
        
    }

    private function checkEmpty($value)
    {

        return !empty((array)$value) ? $value : null;

    }

}