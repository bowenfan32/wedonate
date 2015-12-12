<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Webpatser\Uuid\Uuid;

use App\Models\Cause;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Donation;
use App\Models\WedonateFund;
use App\Role;

use Auth;

class DonatorController extends Controller {

	public function getDonatorDonations(Request $request) {
        try{
            $donations = Donation::where('id', Auth::user())->get();

            return view('donator.donations')
                ->with('donations', $donations);
        }catch(Exception $e){
          throw $e;
        }
    }
}


