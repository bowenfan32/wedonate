<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

      Schema::create('payments_stripe', function($table) {

        // $table->increments('id');
        // $table->string('uuid', 100);
        //
        // $table->string('token_id', 100);
        //
        // $table->string('email', 100);
        //
        // $table->string('user_uuid', 100);
        // $table->string('cause_uuid', 100);
        //
        // $table->double('amount', 15, 5);
        //
        // $table->string('created', 100)->nullable();
        // $table->string('used', 100)->nullable();
        // $table->string('object', 100);
        // $table->string('token', 100)->nullable();
        // $table->string('card', 100)->nullable();
        // $table->string('card_id', 100)->nullable();
        // $table->string('card_object', 100)->nullable();
        // $table->string('card_last4', 100)->nullable();
        // $table->string('card_brand', 100)->nullable();
        // $table->string('card_funding', 100)->nullable();
        // $table->integer('card_exp_month')->nullable();
        // $table->integer('card_exp_year')->nullable();
        // $table->string('card_country', 100)->nullable();
        // $table->string('card_name', 100)->nullable();
        // $table->string('card_address_line1', 100)->nullable();
        // $table->string('card_address_line2', 100)->nullable();
        // $table->string('card_address_city', 100)->nullable();
        // $table->string('card_address_state', 100)->nullable();
        // $table->string('card_address_zip', 100)->nullable();
        // $table->string('card_address_country', 100)->nullable();
        // $table->string('card_cvc_check', 100)->nullable();
        // $table->string('card_address_line1_check', 100)->nullable();
        // $table->string('card_address_zip_check', 100)->nullable();
        // $table->string('card_tokenization_method', 100)->nullable();
        // $table->string('card_dynamic_last4', 100)->nullable();
        // $table->string('client_ip', 100)->nullable();
        //
        // $table->timestamps();

        $table->increments('id');
        $table->string('uuid', 100);

        $table->string('provider')->default('stripe');
        $table->string('status');
        $table->string('email', 200);

        $table->string('user_uuid', 100);
        $table->string('cause_uuid', 100);

        $table->double('amount', 15, 5);

        $table->string('token_id', 200);

        $table->timestamps();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

      Schema::drop('payments_stripe');

    }
}
