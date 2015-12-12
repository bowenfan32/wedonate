<?php namespace App\Http\Controllers;

use Auth;
use Request;
use Illuminate\Routing\Controller;

/**
* Load the right dashboard for each user.
*
*/
class DashController extends Controller {

	/**
	* Handle an authentication attempt.
	*
	* @return Response
	*/
	public function getDash(Request $request) {
        try{
            if (Auth::check()) {

                $user = Auth::user();

                if ($user->hasRole('developer')) {
                    return view('admin.dash');
                }
                else if ($user->hasRole('owner')) {
                    return view('admin.dash');
                }
                else if ($user->hasRole('hr')) {
                    return view('admin.dash');
                }
                else if ($user->hasRole('donator')) {
                    return view('donator.dash');
                }

            }
        }catch(Exception $e){throw $e;}

	}

}
