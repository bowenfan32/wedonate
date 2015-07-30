<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

      Schema::create('causes', function($table) {

        $table->increments('id');
        $table->string('uuid', 100);

        $table->string('name', 100);
        $table->text('description')->nullable();

        $table->integer('DGR')->default('0');

        $table->integer('active')->default('0');
        $table->timestamps();

      });

      Schema::create('cause_metas', function($table) {

        $table->increments('id');

        $table->integer('cause_id')->unsigned();
        $table->foreign('cause_id')->references('id')->on('causes');

        $table->dateTime('last_cause_of_month')->nullable();
        $table->integer('cause_of_month_count')->default('0');

        $table->string('featured_image')->nullable();
        $table->double('total_donations', 10)->default('0');

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

      Schema::drop('causes');
    }
}
