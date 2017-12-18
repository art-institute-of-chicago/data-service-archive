<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define('App\ArchivalImage', function ($faker) {
    $id = $faker->unique()->randomNumber(6) + 999 * pow(10, 6);
    return [
        'id' => $id,
        'title' => ucfirst($faker->words(3, true)),
        'filetype' => 'jpg',
        'digital_file_format' => 'TIFF',
        'date_display' => $faker->year .($faker->boolean ? '-' .$faker->year : ''),
        'date_of_object' => '',
        'creator' => $faker->name,
        'additional_creator' => $faker->name,
        'main_id' => '',
        'pixel_dimensions' => $faker->randomNumber(4) .' x ' .$faker->randomNumber(4),
        'subject_terms' => '',
        'full_res' => '',
        'oclc_id' => '',
        'file_name' => $id .'_2.jpg',
        'source_modified_at' => $faker->date($format = 'Y-m-d'),
    ];
});