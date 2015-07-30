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

use Hash;

class AdminWedonateController extends Controller {

	public function getCause(Request $request, $uuid) {

		$cause = cause::where('uuid', $uuid)->first();

		return view('admin.wedonate.cause')
			->with('cause', $cause);

	}

	public function postCause(Request $request, $uuid) {

		$cause = Cause::where('uuid', $uuid)->first();

		$cause->name = $request->input('name');
		$cause->description = $request->input('description');
		if ($request->has('DGR')) {
			$cause->DGR = $request->input('DGR');
		}
		else {
			$cause->DGR = 0;
		}
		if ($request->has('active')) {
			$cause->active = $request->input('active');
		}
		else {
			$cause->active = 0;
		}
		$cause->save();

		return redirect(route('getCause', ['uuid' => $cause->uuid]));

	}

	public function getCauses(Request $request) {

		$causes = Cause::all();

		return view('admin.wedonate.causes')
			->with('causes', $causes);

	}

	public function getCausesCreate(Request $request) {

		return view('admin.wedonate.causes_create');

	}

	public function postCausesCreate(Request $request) {

		$cause = new Cause;
		$cause->uuid = Uuid::generate(4);
		$cause->name = $request->input('name');
		$cause->description = $request->input('description');
		if ($request->has('DGR')) {
			$cause->DGR = $request->input('DGR');
		}
		else {
			$cause->DGR = 0;
		}
		if ($request->has('active')) {
			$cause->active = $request->input('active');
		}
		else {
			$cause->active = 0;
		}
		$cause->save();

		return redirect(route('getCausesCreate'))
			->with('messages', 'Causes created.');

	}

	public function getUsers(Request $request) {

		$users = User::all();

		return view('admin.wedonate.users')
			->with('users', $users);

	}

	public function getUser(Request $request, $uuid) {

		$user = User::where('uuid', '=', $uuid)->first();

		return view('admin.wedonate.user')
			->with('user', $user);

	}

	public function getUserCreate(Request $request) {

		$roles = Role::all();

		return view('admin.wedonate.user_create')
			->with('roles', $roles);

	}


	public function postUserCreate(Request $request) {

		// TODO: create a globa function to create a user

		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$username = $request->input('email');
		$password = $request->input('password');

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
		if ($request->has('referrer_code')) {
			$referrer = User::where('referrer_code', '=', $request->has('referrer_code'))->first();
			$profile->referrer_id = $referrer->id;
		}
		else {
			$profile->referrer_id = 1;
		}
		$profile->ranking = (int)(User::all()->count());
		$profile->save();

		$role = Role::where('id', '=', $request->input('role'))->first();
		$user->attachRole($role);

		return redirect(route('getUserCreate'))
			->with('messages', 'User created.');

	}

	public function getRoles(Request $request) {

		return view('admin.wedonate.roles');

	}
	public function getPermissions(Request $request) {

		return view('admin.wedonate.permissions');

	}

	public function getFunds(Request $request) {

		$funds_single = WedonateFund::where('type', '=', 'single')->first();
		$funds_subs = WedonateFund::where('type', '=', 'subscription')->first();

		return view('admin.wedonate.funds')
			->with('funds_single', $funds_single)
			->with('funds_subs', $funds_subs);

	}

}