<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model {

	protected $table = 'donations';

	public function cause() {

    return $this->hasOne('\App\Models\Cause', 'id', 'cause_id');

  }

}
