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
        'collection_name' => ucfirst($faker->words(3, true)) . ' Collection',
        'format' => ucfirst($faker->word),
        'file_format' => 'TIFF',
        'file_size' => $faker->randomNumber(5),
        'pixel_dimensions' => $faker->randomNumber(4) . ' x ' . $faker->randomNumber(4),
        'color' => ucfirst($faker->word),
        'physical_notes' => ucfirst($faker->word),
        'date_display' => $faker->year . ($faker->boolean ? '-' . $faker->year : ''),
        'date_of_view' => 'c. ' . $faker->year,
        'date_of_object' => '',
        'creator' => $faker->name,
        'additional_creator' => $faker->name,
        'main_id' => '',
        'subject_terms' => '',
        'view' => ucfirst($faker->word),
        'image_notes' => ucfirst($faker->word),
        'file_name' => $id . '_2.jpg',
        'source_created_at' => $faker->date($format = 'Y-m-d'),
        'source_modified_at' => $faker->date($format = 'Y-m-d'),
    ];
});
