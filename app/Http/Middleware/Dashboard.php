<?php
namespace App\Http\Middleware;

use App\Groups;
use Closure;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests;

class Dashboard {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next, $guard = null ) {

		if ( Auth::check() && Auth::user()->is_admin == 1 ) {

             return $next($request);

		}

		return redirect('/admin-login');
	}
}

