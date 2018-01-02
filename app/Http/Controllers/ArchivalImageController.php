<?php

namespace App\Http\Controllers;

use App\ArchivalImage;
use Illuminate\Http\Request;

class ArchivalImageController extends Controller
{

    protected $model = \App\ArchivalImage::class;
    protected $transformer = \App\Http\Transformers\ArchivalImageTransformer::class;

}