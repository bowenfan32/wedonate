<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DonateErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('payment_errors', function ($table) {

        $table->increments('id');
        $table->string('uuid');

        $table->integer('payment_id')->unsigned();
        $table->foreign('payment_id')->references('id')->on('payments_stripe');

        $table->text('error_message');

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

        Schema::drop('payment_errors');
    }
}
