<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

      Schema::create('sections', function ($table) {

        $table->increments('id');
        $table->string('title');
        $table->string('slug');

        $table->timestamps();

      });

      Schema::create('section_metas', function ($table) {

        $table->increments('id');

        $table->integer('section_id')->unsigned();
        $table->foreign('section_id')->references('id')->on('sections');

        $table->string('meta_key');
        $table->string('meta_value');
        $table->string('meta_value_2');

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
      Schema::drop('section_metas');
      Schema::drop('sections');
    }
}
