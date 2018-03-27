<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTextColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('archival_images', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('alt_title')->change();
            $table->text('collection_name')->change();
            $table->text('archive_name')->change();
            $table->text('format')->change();
            $table->text('file_format')->change();
            $table->text('pixel_dimensions')->change();
            $table->text('color')->change();
            $table->text('physical_notes')->change();
            $table->text('date_display')->change();
            $table->text('date_of_object')->change();
            $table->text('date_of_view')->change();
            $table->text('creator')->change();
            $table->text('additional_creator')->change();
            $table->text('photographer')->change();
            $table->text('main_id')->change();
            $table->text('legacy_image_id')->change();
            $table->text('subject_terms')->change();
            $table->text('view')->change();
            $table->text('image_notes')->change();
            $table->text('file_name')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('archival_images', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('alt_title')->change();
            $table->string('collection_name')->change();
            $table->string('archive_name')->change();
            $table->string('format')->change();
            $table->string('file_format')->change();
            $table->string('pixel_dimensions')->change();
            $table->string('color')->change();
            $table->string('physical_notes')->change();
            $table->string('date_display')->change();
            $table->string('date_of_object')->change();
            $table->string('date_of_view')->change();
            $table->string('creator')->change();
            $table->string('additional_creator')->change();
            $table->string('photographer')->change();
            $table->string('main_id')->change();
            $table->string('legacy_image_id')->change();
            $table->string('subject_terms')->change();
            $table->string('view')->change();
            $table->string('image_notes')->change();
            $table->string('file_name')->change();
        });

    }
}
