<?php

namespace App;

use App\BaseModel;

class ArchivalImage extends BaseModel
{

    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * Returns link to the image, rendered in ContentDM's web interface.
     *
     * @return string
     */
    public function getWebUrl()
    {
        return env('CONTENT_DM_RECORD_DETAIL_PREFIX', 'http://localhost/id/') .$this->id;
    }

    /**
     * Returns subject terms as an array
     *
     * @return array
     */
    public function getSubjectTerms()
    {

        if (!$this->subject_terms)
        {

            return [];

        }

        $terms = explode(';', $this->subject_terms);

        $cleanTerms = [];
        foreach ($terms as $t)
        {

            $t = trim($t);
            $t = rtrim($t, '.');

            $cleanTerms[] = $t;

        }

        return $cleanTerms;

    }

}