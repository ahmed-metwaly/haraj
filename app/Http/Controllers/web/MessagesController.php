<?php

namespace App\Http\Controllers\web;

use App\Messages;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller {


	public function getMessage() {

		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}


		//$id = (int) $id;

		//$data = Messages::where( 'to_id', $id )->where( 'form_id', Auth::user()->id )->get();


		return view( 'web.home.chat' );
	}

	public function getSentMessage() {

		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}


	//	$id = (int) $id;

		$data = Messages::where( 'form_id', Auth::user()->id )->get();


		return view( 'web.home.chat', [ 'data' => $data, 'id' => $id ] );
	}

	public function getReceivedMessage() {

		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}


	//	$id = (int) $id;

		$data = Messages::where( 'to_id', Auth::user()->id )->get();


		return view( 'web.home.chat', [ 'data' => $data] );
	}


	public function postAdd( Request $request ) {

		//$id = (int) $id;

		$rules = [

			'message' => 'required|min:3',
			'email'   => 'required',

		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'add-message' )->withErrors( $validator )->withInput();

		}
		$user=User::where( 'email', $request->email )->select( 'id' )->first();
		$id = (int) $user->id;
		$newMessage = new Messages();

		$newMessage->form_id = Auth::user()->id;
		$newMessage->to_id   = $id;
		$newMessage->message = $request->message;

		return $newMessage->save() ? redirect()->back()->with( 'mOk', 'تم الارسال بنجاح' ) : redirect()->back()->with( 'mNo', 'لم يتم الارسال  حاول مرة اخرى' );

		/*return $newMessage->save() ? redirect()->route( 'add-message', [ 'id' => $id ] )->with( 'mOk', 'تم الارسال بنجاح' ) : redirect()->route( 'mNo', 'لم يتم الارسال  حاول مرة اخرى' );*/

	}

	public function getMsg($ad_id) {

		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$ad = \App\Ads::find($ad_id);
		$email = \App\User::find($ad->created_by)->email;

		return view( 'web.home.message' ,compact('email'));
	}


}