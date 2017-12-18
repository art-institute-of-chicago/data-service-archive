<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchivalImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('archival_images', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('filetype')->nullable();
            $table->string('digital_file_format')->nullable();
            $table->string('date_display')->nullable();
            $table->string('date_of_object')->nullable();
            $table->string('creator')->nullable();
            $table->string('additional_creator')->nullable();
            $table->string('main_id')->nullable();
            $table->string('pixel_dimensions')->nullable();
            $table->string('subject_terms')->nullable();
            $table->string('full_res')->nullable();
            $table->string('oclc_id')->nullable();
            $table->string('file_name')->nullable();
            $table->string('source_modified_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('archival_images');

    }
}
