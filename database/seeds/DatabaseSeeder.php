<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\WedonateFund;
use App\Role;
use App\Permission;

use Webpatser\Uuid\Uuid;

// use Hash;

class DatabaseSeeder extends Seeder {

    public function run() {

        $this->call('UserTableSeeder');

    }

}


class UserTableSeeder2 extends Seeder {

    public function run() {

      $wedonate_funds = new WedonateFund;
      $wedonate_funds->type = 'single';
      $wedonate_funds->uuid = Uuid::generate(4);
      $wedonate_funds->save();

      $wedonate_funds = new WedonateFund;
      $wedonate_funds->type = 'subscription';
      $wedonate_funds->uuid = Uuid::generate(4);
      $wedonate_funds->save();

    }

}

class UserTableSeeder extends Seeder {

    public function run() {

      //UserID/Email: admin@wedonate.org & password: admin
        $user1 = new User;
        $user1->email = 'admin@wedonate.org';
        $user1->username = 'admin@wedonate.org';
        $user1->registered_provider = 'email';
        $user1->password = Hash::make('admin');
        $user1->uuid = Uuid::generate(4);
        $user1->registered_ip = '127.0.0.1';
        $user1->last_login_ip = null;
        $user1->last_login_datetime = date('Y-m-d H:i:s');
        $user1->referrer_code = Uuid::generate(1, '0123456');
        $user1->save();

        $profile1 = new UserProfile;
        $profile1->user_id = $user1->id;
        $profile1->display_name = 'Admin';
        $profile1->firstname = 'Admin';
        $profile1->lastname = 'WeDonate';
        $profile1->ranking = 0;
        $profile1->save();





      $user = new User;
      $user->email = 'j@wedonate.org';
      $user->username = 'j@wedonate.org';
      $user->registered_provider = 'email';
      $user->password = Hash::make('Widaudtwdm#7');
      $user->uuid = Uuid::generate(4);
			$user->registered_ip = '127.0.0.1';
			$user->last_login_ip = null;
			$user->last_login_datetime = date('Y-m-d H:i:s');
			$user->referrer_code = Uuid::generate(1, '0123456');
      $user->save();

      $profile = new UserProfile;
			$profile->user_id = $user->id;
			$profile->display_name = '#J';
			$profile->firstname = '#J';
			$profile->lastname = '';
			$profile->ranking = 1;
			$profile->save();
      $role = new Role();
        $role->name = 'developer';
        $role->display_name = 'Developer';
        $role->description = 'Developer priveleges. Everything activated.';
        $role->save();


      $user2 = new User;
      $user2->email = 'ntuanb@gmail.com';
      $user2->username = 'ntuanb@gmail.com';
      $user2->registered_provider = 'email';
      $user2->password = Hash::make('cyanacid13');
      $user2->uuid = Uuid::generate(4);
			$user2->registered_ip = '127.0.0.1';
			$user2->last_login_ip = null;
			$user2->last_login_datetime = date('Y-m-d H:i:s');
			$user2->referrer_code = Uuid::generate(1, '0123456');
      $user2->save();

      $profile2 = new UserProfile;
			$profile2->user_id = $user2->id;
			$profile2->display_name = 'Tuan Bui';
			$profile2->firstname = 'Tuan';
			$profile2->lastname = 'Bui';
			$profile2->ranking = 0;
			$profile2->save();

      $role2 = new Role();
      $role2->name = 'donator';
      $role2->display_name = 'Donator';
      $role2->description = 'Donator.';
      $role2->save();

      $user1 = User::where('email', '=', 'admin@wedonate.org')->first();
      $user1->attachRole($role);
      $user2 = User::where('email', '=', 'ntuanb@gmail.com')->first();
      $user2->attachRole($role);
      $user = User::where('email', '=', 'j@wedonate.org')->first();
      $user->attachRole($role2);

      $permission_admin = new Permission();
      $permission_admin->name = 'developer';
      $permission_admin->display_name = 'Developer';
      $permission_admin->description = 'Developer priveleges. Everything activated.';
      $permission_admin->save();

      $permission_donator = new Permission();
      $permission_donator->name = 'donator';
      $permission_donator->display_name = 'Donator';
      $permission_donator->description = 'Donator priveleges. Limit activated.';
      $permission_donator->save();

      $role->attachPermission($permission_admin);
      $role2->attachPermission($permission_donator);
    }

}
