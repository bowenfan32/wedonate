<?php namespace App\Http\Controllers;

use Auth;
use Request;
use Illuminate\Routing\Controller;

use App\Models\Donation;

/**
* Load the right dashboard for each user.
*
*/
class DashDonationsController extends Controller {

	/**
	* Handle an authentication attempt.
	*
	* @return Response
	*/
	public function getDonations(Request $request) {
        try{
            $user = Auth::user();

            if (Auth::check()) {

                if ($user->hasRole('developer')) {
                    $donations = Donation::all();

                    return view('admin.wedonate.donations')
                        ->with('donations', $donations);
                }
                else if ($user->hasRole('owner')) {
                    $donations = Donation::all();

                    return view('admin.wedonate.donations')
                        ->with('donations', $donations);
                }
                else if ($user->hasRole('hr')) {
                    return view('admin.dash');
                }
                else if ($user->hasRole('donator')) {

                    $donations = Donation::where('user_id', '=', $user->id)->get();

                    return view('donator.donations')
                        ->with('donations', $donations);

                }

            }
        }catch(Exception $e){throw $e;}

	}

}
