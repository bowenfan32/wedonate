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

      $profile = new UserProfile;
			$profile->user_id = $user2->id;
			$profile->display_name = 'Tuan Bui';
			$profile->firstname = 'Tuan';
			$profile->lastname = 'Bui';
			$profile->ranking = 0;
			$profile->save();

      $role = new Role();
      $role->name = 'developer';
      $role->display_name = 'Developer';
      $role->description = 'Developer priveleges. Everything activated.';
      $role->save();

      $role2 = new Role();
      $role2->name = 'donator';
      $role2->display_name = 'Donator';
      $role2->description = 'Donator.';
      $role2->save();

      $user = User::where('email', '=', 'j@wedonate.org')->first();
      $user->attachRole($role2);

      $user = User::where('email', '=', 'ntuanb@gmail.com')->first();
      $user->attachRole($role);

      $permission = new Permission();
      $permission->name = 'developer';
      $permission->display_name = 'Developer';
      $permission->description = 'Developer priveleges. Everything activated.';
      $permission->save();

      $role->attachPermission($permission);
    }

}
