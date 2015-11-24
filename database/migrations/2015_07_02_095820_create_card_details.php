<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cards_stripe', function($table) {

        $table->increments('id');
        $table->string('uuid', 100);

        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('customer_id', 200);
        $table->string('last4', 200);
        $table->string('brand', 200);
        $table->string('exp_month', 200);
        $table->string('exp_year', 200);

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
        Schema::drop('cards_stripe');
    }
}
