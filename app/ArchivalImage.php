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
        return "http://digital-libraries.saic.edu/cdm/singleitem/collection/mqc/id/{$this->id}";
    }

}