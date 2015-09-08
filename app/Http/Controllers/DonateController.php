<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use App\Models\PaymentsStripe;
use App\Models\CardsStripe;
use App\Models\Donation;
use App\Models\DonationSplit;
use App\Models\Cause;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\WedonateFund;

use Omnipay\Omnipay;

use Webpatser\Uuid\Uuid;

use DB;

class DonateController extends BaseController {

	protected function calcDonationSplit($amount) {

		$amount = (double)$amount;

		$weDonate_keeps_perc = 0.14285714285714286;
		$iDonate_perc = 0.14285714285714286;
		$uDonate_perc = 0.28571428571428573;
		$weDonate_perc = 0.42857142857142854;

		$weDonate_keeps = $weDonate_keeps_perc * $amount;
		$iDonate = $iDonate_perc * $amount;
		$uDonate = $uDonate_perc * $amount;
		$uDonate_referrer = $uDonate / 2;
		$uDonate_referree = $uDonate - $uDonate_referrer;
		$weDonate = $weDonate_perc * $amount;

		$amounts = new \stdClass();
		$amounts->weDonate_keeps = $weDonate_keeps;
		$amounts->iDonate = $iDonate;
		$amounts->uDonate = $uDonate;
		$amounts->uDonate_referrer = $uDonate_referrer;
		$amounts->uDonate_referree = $uDonate_referree;
		$amounts->weDonate = $weDonate;

		return $amounts;

	}

	public function getStripe() {

		return view('donate.stripe');

	}

	public function ajaxPostStripe(Request $request) {

		// start getting inputs
		$payment = new PaymentsStripe;
		$payment->uuid = str_random(80);
		$payment->token_id = $request->input('id');
		$payment->email = $request->input('email');
		$payment->user_uuid = Auth::user()->uuid;
		$payment->cause_uuid = $request->input('cause');
		$payment->amount = $request->input('amount');

		
		// if ($payment->amount<6) {
			
			// //return error
			// return [
			// 'success' => '0',
			// 'messages' => 'Donation is less than 7 dollars'
		// ];
		// }
		// else {
		return [
			'success' => '1',
			'results' => $request->input('email'),
			'messages' => 'Donate.'
		];
		//}
	}

	public function postStripe(Request $request) {

		// TODO: batch the updates into one call. Need a redis? or somethign that did it all sequentially.

		$cause = Cause::where('uuid', $request->input('cause'))->first();
		$user = Auth::user();
		$j = User::where('id', '=', 1)->first();

		$payment = new PaymentsStripe;
		$payment->uuid = Uuid::generate(4);
		$payment->status = 'pending';
		$payment->email = $request->input('email');
		$payment->user_uuid = Auth::user()->uuid;
		$payment->cause_uuid = $request->input('cause');
		$payment->amount = $request->input('amount');
		$payment->token_id = $request->input('token_id');
		$payment->save();

		// LETS FREAKING PAY THIS MOOLAH
		$gateway = Omnipay::create('Stripe');
		$gateway->initialize(array(
   	// 	'apiKey' => 'sk_test_C84t7Wx9WghYFcTEBnQ5ReW3', // ntuanb@gmail.com
   		'apiKey' => 'sk_test_4Mw3CFZ7rUwIiJr3cl3ZKlRB', // michael
   	));
		$transaction = $gateway->purchase(['amount' => (float)($payment->amount), 'currency' => 'AUD', 'token' => $payment->token_id]);

		$response = $transaction->send();
	if ($payment->amount<7) {
			// var_dump($response);
			return redirect(route('getDonationAmountFailure', $payment->uuid));
		}
    else if ($response->isSuccessful()) {
			$payment->status = 'paid';
			$payment->charge_id = $response->getTransactionReference();
			$payment->save();

			$donation = new Donation;
			$donation->uuid = Uuid::generate(4);
			$donation->type = 'single';
			$donation->status = 'paid';
			$donation->user_id = Auth::user()->id;
			$donation->cause_id = $cause->id;
			$donation->DGR = $cause->DGR;
			$donation->amount = $payment->amount;
			$donation->processor = 'stripe';
			$donation->payment_id = $payment->id;
			$donation->save();

			$splits = $this->calcDonationSplit($donation->amount);

			// WEDONATE keeps
			$wedonate_funds = WedonateFund::where('type', '=', 'single')->first();
		//	return($wedonate_funds->amount);
			$amount = $wedonate_funds->amount + $splits->weDonate_keeps;
			$wedonate_funds->amount = $amount;
			$wedonate_funds->save();

			// IDONATE
			$split = new DonationSplit;
			$split->uuid = Uuid::generate(4);
			$split->type = 'iDonate';
			$split->user_id = Auth::user()->id;
			$split->cause_id = $cause->id;
			$split->recipient_type = 'cause';
			$split->amount = $splits->iDonate;
			$split->status = 1;
			$split->donation_id = $donation->id;
			$split->save();

			// UDONATE REFERRER
			$split = new DonationSplit;
			$split->uuid = Uuid::generate(4);
			$split->type = 'uDonate_referrer';
			$split->user_id = Auth::user()->id	;

			if ($user->profile->referrer_id) {
				$split->recipient_id = $user->profile->referrer_id;
			}
			else {
				$split->recipient_id = $j->id;
			}

			$split->recipient_type = 'user';
			$split->amount = $splits->uDonate_referrer;
			$split->status = 1;
			$split->donation_id = $donation->id;
			$split->save();

			// Save the udonate refferer
			$ref = UserProfile::where('user_id', $split->recipient_id)->first();
			$ref->iDonate += $splits->uDonate_referrer;
			$ref->save();

			// UDONATE REFERREE
			$split = new DonationSplit;
			$split->uuid = Uuid::generate(4);
			$split->type = 'uDonate_referree';
			$split->user_id = $user->id;
			$split->recipient_id = $user->id;
			$split->recipient_type = 'self';
			$split->amount = $splits->uDonate_referree;
			$split->status = 1;
			$split->donation_id = $donation->id;
			$split->save();
			
			$ref = UserProfile::where('user_id', $split->recipient_id)->first();
			$ref->iDonate += $splits->uDonate_referrer;
			$ref->save();

			// update users amount for future REFERRE
			$user->profile->referrer_amount_forward += $split->amount;
			$user->profile->total_donations += $donation->amount;
			$user->profile->donations_count += 1;
			$user->profile->iDonate += $splits->iDonate;
			$user->profile->uDonate += $splits->uDonate;
			$user->profile->weDonate += $splits->weDonate;
			$user->profile->save();

			// weDONATE
			$split = new DonationSplit;
			$split->uuid = Uuid::generate(4);
			$split->type = 'weDonate';
			$split->user_id = $user->id;
			$split->recipient_type = 'everyone';
			$split->amount = $splits->weDonate;
			$split->status = 1;
			$split->donation_id = $donation->id;
			$split->save();

			// Split the weDonate for each user
			$users_count = User::all()->count();
			$split = (float)($splits->weDonate) / $users_count;
			DB::table('user_profiles')->increment('iDonate', $split);

			// TODO: Do rank
			$ranks = UserProfile::all();
			$ranks = $ranks->sortByDesc('total_donations');

			$count = 1;
			foreach ($ranks as $rank) {
				$rank->ranking = $count;
				$rank->save();
				$count++;
			}

			return redirect(route('getDonationSuccess', $payment->uuid));
		}
		else {
			// var_dump($response);
			return redirect(route('getDonationFailure', $payment->uuid));
		}

	}

	public function getDonationSuccess(Request $request, $uuid) {

		$payment = PaymentsStripe::where('uuid', '=', $uuid)->first();

		return view('donate.success')
			->with('payment', $payment);

	}

	public function getDonationFailure(Request $request, $uuid) {

		$payment = PaymentsStripe::where('uuid', '=', $uuid)->first();

		return view('donate.failure')
			->with('payment', $payment);

	}

	public function getDonationAmountFailure(Request $request, $uuid) {

		$payment = PaymentsStripe::where('uuid', '=', $uuid)->first();

		return view('donate.amountfailure')
			->with('payment', $payment);

	}
}
