<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWedonateKeepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

      Schema::create('wedonate_funds', function($table) {

        $table->increments('id');
        $table->string('uuid', 100);

        $table->string('type', 100);
        $table->double('amount', 10)->default('0');
        $table->integer('count')->default('0');

        $table->timestamps();

      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('wedonate_funds');

    }
}
