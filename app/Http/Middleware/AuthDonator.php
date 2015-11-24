<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class AuthDonator {

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) {

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('getLogin'));
            }
        }
				else {
					$user = Auth::user();
					if (!$user->hasRole('donator')) {
						return redirect()->guest(route('getLogin'));
					}
				}

        return $next($request);

    }
}
