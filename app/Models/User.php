<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

// Roles and Permisions
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	// Roles and Permisions
	use EntrustUserTrait;

	use Authenticatable, CanResetPassword;

	protected $table = 'users';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['name', 'email', 'password'];

	/**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	protected $hidden = ['password', 'remember_token'];
	protected $guarded = ['id', 'uuid'];

	public function profile() {
    return $this->hasOne('App\Models\UserProfile');
  }


}
