<?php

use App\ArchivalImage;

class ArchivalImageSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(ArchivalImage::class, 10)->create();

    }

}
