<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model {

	protected $table = 'causes';

	public function donations() {

    return $this->hasMany('\App\Models\Donation', 'cause_id');

  }

	// public function number_of_donations() {
	//
  //   return $this->hasMany('\App\Models\Donation', 'cause_id')->count();
	//
	// }
	//
	// public function total_donations() {
	//
  //   return $this->hasMany('\App\Models\DonationSplit', 'cause_id')->where('type', '=', 'iDonate')->sum('amount');
	//
  // }

}
