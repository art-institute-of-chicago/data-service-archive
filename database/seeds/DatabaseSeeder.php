<?php

class DatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(ArchivalImageSeeder::class);

    }

    protected static function unseed()
    {

        ArchivalImageSeeder::clean();

    }

}
