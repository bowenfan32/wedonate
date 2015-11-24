<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentsStripe extends Model {

	protected $table = 'payments_stripe';

	public function cause() {

    return $this->hasOne('\App\Models\Cause', 'uuid', 'cause_uuid');

  }

}
