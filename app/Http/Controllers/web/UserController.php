<?php

namespace App\Http\Controllers\web;

use App\Settings;
use App\User;
use App\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller {

	private $siteEmail, $siteName, $sitePhone;

	public function __construct() {

		$data = Settings::find( 1 );

		$this->siteEmail = $data->site_email;
		$this->siteName = $data->site_name_ . App::getLocale();
		$this->sitePhone = $data->site_phone;


	}

	public function getLogin(){
		return view('web.template.login');
	}

	public function getRegister(){
		return view('web.template.register');
	}

	public function postAddUser( Request $request ) {

		$rules = [
			//'name'         => 'required|min:3|max:255',
			//'email'        => 'required|email|unique:users|min:3:max:255',
			//'password'     => 'required|min:3|max:255',
			//'password_con' => 'same:password',
			'phone' 	   => 'required|min:7|numeric',
			//'photo'        => 'mimes:png,jpg,jpeg',
			//'country_id'   => 'required',
			'city'      => 'required'
		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->back()->withErrors( $validator )->withInput();

		}

		$newUser = new User();

		$newUser->name     = $newUser->name ? $request->name : '';
		$newUser->phone     = $request->phone;
		$newUser->email    = $newUser->email ? trim( $request->email ) : '';
		$newUser->password = $newUser->password? bcrypt( trim( $request->password ) ) : '';

		if ( isset( $request->photo ) && $request->photo != '' ) {
			$newUser->photo = uploading( $request->file( 'photo' ), 'users', [ '50x50', '150x150' ] );
		} else {
			$newUser->photo = '';
		}

		$newUser->country_id          = 1;
		$newUser->city_id             = $request->city;
		$newUser->status              = 0;
		$newUser->is_admin            = 0;
		$newUser->group_id            = 0;
		$newUser->active_email        = 0;
		$newUser->active_mobil        = 0;
		$newUser->active_mobil_number = mb_substr( abs( intval( crc32( rand( 10000, 9999 ) . $request->phone ) ) ), 0, 5, 'utf8' );
		$newUser->remember_token      = csrf_token();


		// send active email

		/*$vars = [
			'from'          => $this->siteEmail,
			'messagesTitle' => trans( 'email.activeTitle' ),
			'to'            => $request->email,
			'fromName'      => $this->siteName,
			'subject'       => trans( 'email.activeSubject' ),
			'token'       => csrf_token(),
			'data'          => [
				'token'    => csrf_token(),
				'siteName' => $this->siteName
			]

		];

		if ( sendEmail( 'admin.emails.active', $vars ) ) {

			if ( $newUser->save() ) {

				return Auth::attempt( [
					'phone'    => $request->phone
					//,'password' => $request->password
				] ) ? redirect()->back()->with( 'mOk', trans( 'messages.addUserOk' ) ) : back()->with( 'mNo', trans( 'messages.loginFalse' ) );
			}

		} else {

			return redirect()->back()->with( 'mNo', trans( 'messages.addUserNo' ) )->withInput();

		}*/

		if ( $newUser->save() ) {

				return Auth::attempt( [
					'phone'    => $request->phone
					//,'password' => $request->password
				] ) ? redirect()->back()->with( 'mOk', trans( 'messages.addUserOk' ) ) : back()->with( 'mNo', trans( 'messages.loginFalse' ) );
			}

	}


	public function postEditUser( Request $request, $id ) {

		$rules = [
			'name'       => 'required|min:3|max:255',
			'email'      => 'required|email|unique:users,id,' . $id . '|min:3:max:255',
			'password'   => 'min:3|max:255',
			'photo'      => 'mimes:png,jpg,jpeg',
			'country_id' => 'required',
			'city_id'    => 'required',
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'admin-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}

		$adminData = User::where( 'id', $id )->firstOrFail();


		$adminData->name = $request->name;

		if ( isset( $request->password ) && $request->password != '' ) {

			$adminData->password = bcrypt( trim( $request->password ) );

		}


		if ( isset( $request->photo ) && $request->photo != '' && $adminData->photo != $request->photo ) {

			@unlink( public_path( '/users' ) . $request->photo );
			@unlink( public_path( '/users_50x50' ) . $request->photo );
			@unlink( public_path( '/users_150x150' ) . $request->photo );

			$adminData->photo = uploading( $request->file( 'photo' ), 'users', [ '50x50', '150x150' ] );

		}


		$adminData->country_id = $request->country_id;
		$adminData->city_id    = $request->city_id;

		$trans = 0;

		if ( $request->email != $adminData->email ) {

			$adminData->email = trim( $request->email );

			// send active email

			$vars = [
				'from'          => $this->siteEmail,
				'messagesTitle' => trans( 'email.activeTitle' ),
				'to'            => $request->email,
				'fromName'      => $this->siteName,
				'subject'       => trans( 'email.activeSubject' ),
				'data'          => [
					'token'    => csrf_token(),
					'siteName' => $this->siteName
				]

			];

			sedEmail( 'admin.emails.activeNew', $vars );

			$adminData->active_email = 0;

			$trans = 1;
		}

		return $adminData->save() ? redirect()->route( 'user-profile' )->with( 'mOk', trans( 'messages.editUserOk' . $trans ) ) : redirect()->route( 'user-profile' )->with( 'mNo', trans( 'messages.editUserNo' ) )->withInput();

	}


	// admin auth


	public function postLogin( Request $request ) {

		if ( $request->ajax() || $request->wantsJson() ) {
			return response( 'Unauthorized.', 401 );
		}

		$rules = [

			'phone'    => 'required|min:7',
			'password' => 'min:3|max:255',

		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->back()->withErrors( $validator )->withInput();

		}

		$remember = $request->has( 'remember_me' ) ? true : false;


		return Auth::attempt( [
			'phone'    => $request->phone,
			'password' => $request->password
		], $remember ) ? redirect()->route('home')->with( 'mOk', trans( 'messages.loginOk' ) ) : back()->with( 'mNo', trans( 'messages.loginFalse' ) );

	}


	public function getLogout() {

		Auth::logout();

		return redirect()->route( 'home' );

	}


	public function getActiveEmail( $active ) {

		$token = User::where( 'remember_token', active )->first();
		if ( isset( $token ) ) {
			if ( $active == $token ) {

				$activeEmail = User::find( Auth::user()->id );

				$activeEmail->active_email = 1;

				$activeEmail->save();

				return redirect()->route( 'home' )->with( 'mOk', trans( 'messages.activeOk' ) );

			}
		}

		return redirect()->route( 'home' )->with( 'mNo', trans( 'messages.activeNo' ) );
	}


	public function getForgetPassword() {

		return view( 'admin.auth.forgetPassword' );
	}

	public function postForgetPassword( Request $request ) {

		$rules = [

			'email' => 'required|email|min:3:max:255',
		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->back()->withErrors( $validator )->withInput();

		}

		$email = User::where( 'email', $request->email )->first()->email;

		if ( isset( $email ) && $email != '' ) {

			// send active email

			$vars = [
				'from'          => $this->siteEmail,
				'messagesTitle' => trans( 'email.forgetTitle' ),
				'to'            => $email,
				'fromName'      => $this->siteName,
				'subject'       => trans( 'email.forgetTitle' ),
				'token'       => csrf_token(),
				'data'          => [
					'token'    => csrf_token(),
					'siteName' => $this->siteName
				]

			];

			sendEmail( 'admin.emails.forgetPassword', $vars );

			$gData        = new ResetPassword;
			$gData->email = $email;
			$gData->token = csrf_token();
			$gData->save();

			return back()->with( 'mOk', trans( 'messages.fPasswordTrue' ) );

		}

		return back()->with( 'mNo', trans( 'messages.fPasswordError' ) );

	}


	public function getRestPassword( $token ) {

		$tokenIsValid = ResetPassword::where( 'token', $token )->count();

		if ( $tokenIsValid != 1 ) {
			return redirect()->route( 'home' )->with( 'mNo', trans( 'messages.tokenNotValid' ) );
		}

		return view( 'admin.auth.restPassword',['token' => $token] );
	}

	public function postRestPassword( Request $request ) {

		$rules = [

			'password'     => 'min:3|max:255',
			'password_con' => 'same:password',

		];
		
		$token=$request->user_token;

		// validation done ^_^
		collValidation( $request, $rules, "route('back()')" );

		$email = ResetPassword::where( 'token', $token )->first()->email;

		if ( isset( $email ) && $email != '' ) {

			$updatePassword = User::where( 'email', $email )->first();

			$updatePassword->password = bcrypt( trim( $request->password ) );

			return $updatePassword->save() ? redirect()->route( 'home' )->with( 'mOk', trans( 'messages.rPasswordOk' ) ) : redirect()->route( 'dashboard' )->with( 'mNo', trans( 'messages.rPasswordNo' ) );

		}

		return redirect()->route( 'home' )->with( 'mNo', trans( 'messages.tokenNotValid' ) );

	}

	public function addlike( Request $request, $id ) {

		if ( $request->ajax() ) {
			if ( auth()->check() ) {

				$newLike             = new \App\likes();
				$newLike->ads_id     = $id;
				$newLike->created_by = auth()->user()->id;
				if ( $newLike->save() ) {

					$toUserData = \App\Ads::where( 'id', $id )->first();

					$newNotif = new \App\Notifications();

					$newNotif->ad_id      = $id;
					$newNotif->by_user    = auth()->user()->id;
					$newNotif->to_user_id = $toUserData->byUser()->first()->id;
					$newNotif->type       = 'like';
					$newNotif->seen       = 0;
					$newNotif->save();

					return response()->json( [], 200 );
				}
			} else {
				return response()->json( [
					'error' => 'Error Not Auth'
				], 401 );
			}
		}
	}

	public function Remove_like( Request $request, $id ) {

		if ( $request->ajax() ) {
			if ( auth()->check() ) {
				$removeLike = \App\likes::where( 'ads_id', $id )->where( 'created_by', auth()->user()->id )->first();

				if ( $removeLike->delete() ) {

					$removeNotif = \App\Notifications::where( 'ad_id', $id )->where( 'by_user', auth()->user()->id )->first();

					$removeNotif->delete();

					return response()->json( [], 200 );

				}

			} else {
				return response()->json( [
					'error' => 'Error Not Auth'
				], 401 );
			}
		}
	}
	
	public function getActiveEmail2( $active ) {

		$User_token = User::where( 'remember_token', $active )->first();
		if ( isset( $User_token ) ) {
			if ( $active == $User_token->remember_token ) {

				$activeEmail = User::find( $User_token->id );
				$activeEmail->active_email = 1;
				$activeEmail->status = 1;
				$activeEmail->save();

				return redirect()->route( 'home' )->with( 'mOk', trans( 'messages.activeOk' ) );

			}
		}

		return redirect()->route( 'home' )->with( 'mNo', trans( 'messages.activeNo' ) );
	}

}
