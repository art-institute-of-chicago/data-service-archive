<?php

namespace App;

use App\BaseModel;

class ArchivalImage extends BaseModel
{

    /**
     * Returns link to the image, rendered in ContentDM's web interface.
     *
     * @return string
     */
    public function getWebUrl()
    {
        return env('CONTENT_DM_RECORD_DETAIL_PREFIX', 'http://localhost/id/') .$this->id;
    }

}