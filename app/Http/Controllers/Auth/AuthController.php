<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends BaseController {

  public function login() {

    switch($this->method()) {

    case 'GET': {

    return view('authentication.login');

    }

    case 'POST': {

    $email = Input::get('email');
    $password = Input::get('password');

    $validator = Validator::make(
    ['email' => 'required|unique:users'],
    ['name' => 'required|min:5']
    );

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
    return redirect()->intended('dashboard');
    }

    }

    default: break;
    }
  }
}
