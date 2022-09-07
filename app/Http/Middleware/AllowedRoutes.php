<?php
namespace App\Http\Middleware;

use App\Groups;
use Closure;
use Illuminate\Support\Facades\Auth;

class AllowedRoutes {

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
			//return $next($request);
			$user_group =Auth::User()->group_id ;
		    $allowed_routes=[];
		  if($user_group !=0){
		  	$allowed = json_decode(Auth::User()->groups()->first()->items);
		  	}else{
		  		$allowed = [];
		  	}
		    if(count($allowed) > 0 ){

		        foreach($allowed as $route => $item){
				 	array_push($allowed_routes,$route);
		    	}
			}

				if (in_array(Request::url(), $allowed_routes)){
					return $next($request);
				}

				return redirect()->back()->with('mNo','not allowed');
				}

		//return redirect('/admin-login');
	}
}
//
//			$data = Groups::where( 'id', Auth::user()->group_id )->first();
//			if ( ! isset( $data ) ) {
//				return redirect()->route( 'dashboard' )->withErrors( [ 'Err' => 'لا تملك صلاحيات للدخول لهذه الصفحة' ] );
//			}
//
//			$myLevels    = json_decode( $data->items );
//			$countLevels = count( $myLevels );
//
//			if ( $countLevels <= 0 ) {
//				return redirect()->route( 'dashboard' )->withErrors( [ 'Err' => 'لا تملك صلاحيات للدخول لهذه الصفحة' ] );
//			}
//
//			$route   = $request->route()->getName();
//			$nextout = false;
//
//			foreach ( $myLevels as $myLevel => $vv ) {
//				if ( $myLevel == $route ) {
//					$nextout = true;
//					break;
//				} else {
//					$nextout = false;
//				}
//			}
//
//			if ( $nextout ) {
//				return $next( $request );
//			} else {
//				return redirect()->route( 'dashboard' )->withErrors( [
//					'Err' => 'لا تملك صلاحيات للدخول لهذه الصفحة'
//				] );
//			}
