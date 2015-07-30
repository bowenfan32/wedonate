<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableToDonationSplit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('donation_splits', function ($table) {
        $table->string('recipient_type', 100)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('donation_splits', function ($table) {
        $table->dropColumn('recipient_type');
      });
    }
}
