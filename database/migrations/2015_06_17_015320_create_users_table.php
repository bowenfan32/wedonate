<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up() {

    Schema::create('user_statuses', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->string('title', 100);
      $table->string('description', 100);

      $table->timestamps();

    });

    Schema::create('user_types', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->string('title', 100);
      $table->string('description', 100);

      $table->timestamps();

    });

    Schema::create('users', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->string('registered_ip', 50)->nullable();
      $table->string('registered_provider', 50)->nullable();
      $table->string('last_login_ip', 50)->nullable();
      $table->dateTime('last_login_datetime');

      $table->string('username', 100);
      $table->string('email', 100)->unique();
      $table->string('password', 128);

      $table->string('referrer_code', 128);

      $table->integer('active')->default('0');

      $table->rememberToken();
      $table->timestamps();

    });

    Schema::create('assigned_user_x_user_types', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->integer('user_type_id')->unsigned();
      $table->foreign('user_type_id')->references('id')->on('user_types');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

      $table->timestamps();

    });

    Schema::create('user_profiles', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

      $table->string('display_name', 100)->nullable();

      $table->string('firstname', 100);
      $table->string('middlename', 100)->nullable();
      $table->string('lastname', 100);

      $table->string('mobile', 100)->nullable();
      $table->string('phone', 100)->nullable();
      $table->string('website', 100)->nullable();
      $table->string('facebook', 100)->nullable();
      $table->string('twitter', 100)->nullable();
      $table->string('linkedin', 100)->nullable();

      $table->integer('ranking')->default('0');
      $table->integer('donations_count')->default('0');
      $table->double('total_donations', 100)->default('0');
      $table->double('iDonate', 10)->default('0');
      $table->double('uDonate', 10)->default('0');
      $table->double('weDonate', 10)->defaul('0');

      $table->double('amount', 10)->defaul('0');
      $table->double('referrer_amount_forward', 10)->defaul('0');

      $table->integer('referrer_id')->nullable();
      $table->integer('referrals')->default('0');

      $table->string('gender', 5)->nullable();

      $table->timestamps();

    });

    Schema::create('user_metas', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->string('group', 100)->nullable();
      $table->string('key', 100);
      $table->text('value');

      $table->timestamps();

    });

    Schema::create('user_addresses', function($table) {

      $table->increments('id');
      $table->string('uuid', 100);

      $table->string('type', 100)->default('default');

      $table->string('locale')->nullable();
      $table->string('unit_number')->nullable();
      $table->string('street_number');
      $table->string('number_suffix')->nullable();
      $table->string('street_name')->nullable();
      $table->string('street_type')->nullable();
      $table->string('suburb')->nullable();
      $table->string('postcode')->nullable();
      $table->string('state')->nullable();
      $table->string('country')->nullable();

      $table->timestamps();

    });

  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down() {

    Schema::drop('user_statuses');
    Schema::drop('user_types');
    Schema::drop('users');
    Schema::drop('assigned_user_x_user_types');
    Schema::drop('user_profiles');
    Schema::drop('user_metas');
    Schema::drop('user_addresses');

  }
}
