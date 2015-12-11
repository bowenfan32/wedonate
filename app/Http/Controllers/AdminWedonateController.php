<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use Webpatser\Uuid\Uuid;

use App\Models\Cause;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Donation;
use App\Models\WedonateFund;
use App\Models\CauseMeta;
use App\Role;

use Log;

use Hash;
use File;
use Storage;

class AdminWedonateController extends Controller {

	public function getCause(Request $request, $uuid) {

		$cause = Cause::where('uuid', $uuid)->first();

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

		Log::info('Getting list of causes');

		return view('admin.wedonate.causes')
			->with('causes', $causes);

	}
    public function getBreakdown(Request $request) {

        $causes = Cause::all();

        return view('admin.wedonate.breakdown')
            ->with('causes', $causes);

    }


	public function getCausesCreate(Request $request) {

		return view('admin.wedonate.causes_create');

	}

	public function postCausesCreate(Request $request) {

        // create the validation rules ------------------------
        $rules = array(
                'name' => 'Required|Unique:causes',
                'description'     => 'Required'
        );
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $rules);
        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();
            // redirect our user back to the form with the errors from the validator
            return redirect(route('getCausesCreate'))
                ->withErrors($validator);
        } else {

        // validation successful ---------------------------
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
		$cause->total_donations = 0;
		$cause->number_of_donations = 0;
		$cause->save();

		$cause_meta = new CauseMeta;
		$cause_meta->cause_id = $cause->id;
		$cause_meta->save();

		Log::info('Cause created successfully id='.$cause->id);

		return redirect(route('getCausesCreate'))
            ->withFlashMessage('Causes created.');
        }

	}

	public function getCausesEdit(Request $request, $uuid) {

		$cause = Cause::where('uuid', $uuid)->first();

		return view('admin.wedonate.causes_edit')
			->with('cause', $cause);

	}

	public function postCausesEdit(Request $request, $uuid) {

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

		Log::info('Cause edited successfully! id='.$uudi);

		return redirect(route('getCauses'));

	}

	// TDOO: Fix to use AWS, store image properly in db, have multiple sizing. etc.
	public function postCauseImage(Request $request, $uuid) {

		$cause = Cause::where('uuid', $uuid)->first();


		// Local
		// $storage_location = '/public/uploads/ci/';
		// $url_location = '/uploads/ci/';

		$storage_location = '/home/wedonate/public/uploads/ci/';
		$url_location = '/uploads/ci/';

		File::delete(base_path() . $storage_location . $cause->image);

		// Upload it
		$image_name = Uuid::generate(4) . '.' . $request->file('file')->getClientOriginalExtension();
		// $request->file('file')->move(base_path() . $storage_location, $image_name);
		$request->file('file')->move('/home/wedonate/public_html/uploads/ci/', $image_name);

		// Setup our media to be saved
		$cause->image = $image_name;
		$cause->save();

		Log::info('Image cause registered, image_name: '.$image_name);

    return [
			'success' => '1',
			'url', $cause->image
		];

	}

	public function getCauseRemove(Request $request, $uuid) {

		$cause = Cause::where('uuid', $uuid)->delete();

		Log::info('Cause deleted id='.$uudi);

		return redirect(route('getCauses'));

	}
    //USERs
	public function getUsers(Request $request) {

		$users = User::all();

		return view('admin.wedonate.users')
			->with('users', $users);

	}

	public function getUserEdit(Request $request, $uuid) {

		$user = User::where('uuid', '=', $uuid)->first();
        $profile = UserProfile::where('user_id','=',$user->id)->first();

		return view('admin.wedonate.user')
			->with('user', $user)
            ->with('profile',$profile);

	}

	public function getUserCreate(Request $request) {

		$roles = Role::all();

		return view('admin.wedonate.user_create')
			->with('roles', $roles);

	}


	public function postUserCreate(Request $request) {

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
        } catch (Exception $e) {}

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


        $role = Role::where('id', '=', $request->input('role'))->first();
		$user->attachRole($role);

				Log::info('User created, id='.$user->uuid);

        //send email
        $message = $this -> sendEmail($email,$user->id);

		return redirect(route('getUserCreate'))
			->withFlashMessage($message);

	}

    public function sendEmail($email,$user_id){
        //send email to validate
        try {
            $user = User::where('id', '=', $user_id)->first();
            $msg = "Fail to create a user";
            if ($user) {

                $to = $email;
                $subject = "Confirmation from Wedonate to $user->username";
                $headers = 'From: john.wedonate@gmail.com' . "\r\n" .
                    'Reply-To: patuan03@yahoo.com' . "\r\n" .
                    'MIME-Version: 1.0' . "\r\n".
                    'Content-type: text/html; charset=utf-8' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $message = "Dear,". "<br/>";
                $message .= "Please click the link below to verify and activate your account".  "<br/>";
                $message .= "<a href='http://www.wedonate.com/confirm.php?passkey=$user->uuid'>http://www.wedonate.com/confirm.php?passkey=$user->uuid</a>";

                $sentmail = mail($to,$subject,$message,$headers);

								Log::debug('Sending email result='.$sentmail);

                if($sentmail)
                {
                    $msg = "User Created Successfully.Your Confirmation link Has Been Sent To Your Email Address.";
                }
                else
                {
                    $msg = "Cannot send Confirmation link to your e-mail address";
                }
            }
            return $msg;
        } catch (Exception $e) {}

    }

    public function postUserEdit(Request $request, $uuid) {

        $user = User::where('uuid', $uuid)->first();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if($user && $profile){
            $user->email = $request->input('email');
            $profile->firstname = $request->input('firstname');
            $profile->lastname = $request->input('lastname');
            $user->save();
            $profile->save();
        }

        return redirect(route('getUserEdit', $uuid))
            ->withFlashMessage('User Updated Successfully.');

    }


    public function getUserRemove(Request $request, $uuid) {
        try{
        $user = User::where('uuid', $uuid)->first();
        $profile = UserProfile::where('user_id', $user->id)->delete();
        $user = User::where('uuid', $uuid)->delete();
        }catch (Exception $e) {}

        return redirect(route('getUsers'))
            ->withFlashMessage('User Deleted Successfully.');

    }

    //ROLES
	public function getRoles(Request $request) {

		return view('admin.wedonate.roles');

	}
	public function getPermissions(Request $request) {

		return view('admin.wedonate.permissions');

	}

	public function getFunds(Request $request) {
		/* To Be Built.
		$funds_single = WedonateFund::where('type', '=', 'single')->first();
		$funds_subs = WedonateFund::where('type', '=', 'subscription')->first();
		*/
		Log::info('Getting funds. To Be Built.');
		
		return view('admin.wedonate.funds');
			/*->with('funds_single', $funds_single)
			->with('funds_subs', $funds_subs);
			*/
	}

}
