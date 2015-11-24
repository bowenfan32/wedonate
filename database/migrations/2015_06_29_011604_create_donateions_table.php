<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonateionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('donations', function($table) {

        $table->increments('id');
        $table->string('uuid', 100);

        $table->string('type', 100)->default('single');

        $table->integer('user_id');
        $table->integer('recipient_id')->nullable();
        $table->integer('cause_id');
        $table->integer('DGR')->nullable();

        $table->double('amount')->nullable();

        $table->string('status')->default('pending');

        $table->integer('payment_id');
        $table->string('processor');

        $table->timestamps();

      });

      Schema::create('donation_splits', function($table) {

        $table->increments('id');
        $table->string('uuid', 100);

        // idondte, wedonate, udonate
        $table->string('type', 100);

        $table->integer('user_id');
        $table->integer('recipient_id')->nullable();
        $table->integer('cause_id')->nullable();

        $table->double('amount')->nullable();

        $table->integer('status')->default('0');

        $table->integer('donation_id')->unsigned();
        $table->foreign('donation_id')->references('id')->on('donations');;

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
        Schema::drop('donations');
    }
}
