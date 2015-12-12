<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserProfile;

use App\Role;

use Log;

use Hash;
use Webpatser\Uuid\Uuid;

class AuthController extends Controller {

	public function getLogin(Request $request) {

			return view('auth.login');

	}

	public function postLogin(Request $request) {

		$email = $request->input('email');
		$password = $request->input('password');

		Log::debug('Validating email='.$email);

		if (Auth::attempt(['username' => $email, 'password' => $password])) {
			return redirect(route('getDash'));
		}
		else {
			Log::info('Authentication failed, email='.$email);

			return redirect(route('getLogin'));
		}

	}

	public function postLoginAjax(Request $request) {
			
			$email = $request->input('email');
			$password = $request->input('password');
			$url = $request->input('url');

			Log::debug('[postLoginAjax] url='.$url);

			if (Auth::attempt(['username' => $email, 'password' => $password])) {
				Log::info('User Successfully connected: '.Auth::user()->id);

				return [
					'success' => '1',
					'results' => '',
					'messages' => 'Successfully connected.',
					'redirect' => $url
				];
			}
			else {
				Log::info('Login failed, email='.$email);

				return [
					'success' => '0',
					'results' => '',
					'messages' => 'An errorred occurred.'
				];
			}

	}

	public function postRegisterAjax(Request $request) {

		// try {

			$firstname = $request->input('firstname');
			$lastname = $request->input('lastname');
			$email = $request->input('email');
			$username = $request->input('email');
			$password = $request->input('password');

			try {
				$user = User::where('email', '=', $email)->first();
				if ($user) {
                    return [
                        'success' => '0',
                        'results' => '',
                        'messages' => 'The account already exists in weDonate.',
                        'redirect' => ''
                    ];
                }
			} catch (Exception $e) {
				Log::error($e);
			}

			// TODO: create a globa function to create a user

			$user = new User;
			$user->uuid = Uuid::generate(4);
            $user->registered_ip = $_SERVER['REMOTE_ADDR'];
			$user->registered_provider = 'email';
			$user->last_login_ip = null;
			$user->last_login_datetime = date('Y-m-d H:i:s');
			$user->email = $email;
			$user->username = $email;
			$user->password = Hash::make($password);
			$user->referrer_code = Uuid::generate(1, '0123456');
			$user->save();

			$profile = new UserProfile;
			$profile->user_id = $user->id;
			$profile->firstname = $firstname;
			$profile->lastname = $lastname;
			if ($request->has('referrer')) {
				$profile->referrer_id = User::where('referrer_code', '=', $request->has('referrer_code'))->first();
			}
			$profile->ranking = (int)(User::all()->count());
			$profile->save();

			$role = Role::where('name', '=', 'donator')->first();
			$user->attachRole($role);


			if (Auth::attempt(['username' => $email, 'password' => $password])) {
				Log::info('USer registered, id='.$user->id);

				return [
					'success' => '1',
					'results' => '',
					'messages' => 'Successfully connected.',
					'redirect' => route('getDash')
				];
			}
			else {
				return [
					'success' => '0',
					'results' => '',
					'messages' => 'An errorred occurred.',
					'redirect' => ''
				];
			}

		// } catch (Exception $e) {

			return [
				'success' => '0',
				'results' => '',
				'messages' => 'An errorred occurred.',
				'redirect' => ''
			];

		// }

	}

	public function postLoginWithLinkedin(Request $request) {
		// get data from request
		$code = $request->get('code');

		$linkedinService = \OAuth::consumer('Linkedin');

		if ( ! is_null($code)) {
				// This was a callback request from linkedin, get the token
				$token = $linkedinService->requestAccessToken($code);

				// Send a request with it. Please note that XML is the default format.
				$result = json_decode($linkedinService->request('/people/~?format=json'), true);

				// Show some of the resultant data
				echo 'Your linkedin first name is ' . $result['firstName'] . ' and your last name is ' . $result['lastName'];

				//Var_dump
				//display whole array.
				Log::debug('the code is not null, result='.$result);
				dd($result);

		}
		// if not ask for permission first
		else {
				// get linkedinService authorization
				$url = $linkedinService->getAuthorizationUri(['state'=>'DCEEFWF45453sdffef424']);

				// return to linkedin login url
				return redirect((string)$url);
		}
	}

	public function getLogout(Request $request) {
			Log::info('User Successfully disconnected: '.Auth::user()->id);

			Auth::logout();

			return redirect(route('getHome'));
	}

	public function getForgotPassword(Request $request) {

		return view('auth.forgot_password');

	}

}
