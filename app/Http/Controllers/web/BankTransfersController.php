<?php

namespace App\Http\Controllers\web;

use App\Bank_transfer;
use App\User;
use Illuminate\Http\Request;
use App\Settings;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Bank_account ;


class BankTransfersController extends Controller {


	public function getTransfer() {

		/*if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}*/

		$BankData=Bank_account::orderBy( 'id', 'DESC' )->get();
		$commissionData=Settings::select('commission', 'commission_count')->first();
		//return $commissionData->commission ;

		return view( 'web.home.commission' ,compact('BankData','commissionData'));
	}



public function getSubscribeTransfer() {

		/*if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}*/

		$BankData=Bank_account::orderBy( 'id', 'DESC' )->get();
		$subscribeData=Settings::select('subscribe')->first();

		return view( 'web.home.subscribe_transfer' ,compact('BankData','subscribeData'));
	}



	public function postTransfer( Request $request ) {

		//$id = (int) $id;

		if ( ! Auth::check() ) {
			return redirect()->back()->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$rules = [

			'amount' => 'required',
			//'bank_name' => 'required',
			'transfered_at' => 'required',
			'transfered_by' => 'required',
			'phone' => 'required|min:3',
			'ad_id' => 'required',
			//'verification_code' =>'required',
			//'email'   => 'required',

		];

		//|same:12548

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {


			return redirect()->route( 'add-commission-transfer' )->withErrors( $validator )->withInput();

		}

		/*if($request->verification_code != 12548 ){
			return redirect()->back()->with( 'mNo', 'رقم التحقق خطأ' );

		}*/
		
		
		$newTransfer = new Bank_transfer();

		$newTransfer->created_by = Auth::user()->id;
		$newTransfer->amount = $request->amount;
		$newTransfer->bank_name = $request->bank_name;
		$newTransfer->transfered_at = $request->transfered_at;
		$newTransfer->transfered_by = $request->transfered_by;
		$newTransfer->email = $request->email ? $request->email : '';
		$newTransfer->phone = $request->phone;
		$newTransfer->ad_id = $request->ad_id;
		$newTransfer->verification_code = $request->verification_code ? $request->verification_code : '';
		$newTransfer->notes = $request->notes ? $request->notes : '';
		$newTransfer->type = 'commission';
		
		return $newTransfer->save() ? redirect()->back()->with( 'mOk', 'تم الارسال بنجاح' ) : redirect()->back()->with( 'mNo', 'لم يتم الارسال  حاول مرة اخرى' );

	}

public function postCommTransfer( Request $request ) {

		//$id = (int) $id;

		if ( ! Auth::check() ) {
			return redirect()->back()->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$rules = [

			'amount' => 'required',
			//'bank_name' => 'required',
			'transfered_at' => 'required',
			'transfered_by' => 'required',
			'phone' => 'required|min:3',
			//'ad_id' => 'required',
			//'verification_code' =>'required',
			'email'   => 'required',

		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'add-subscribe-transfer' )->withErrors( $validator )->withInput();

		}
		
		
		$newTransfer = new Bank_transfer();

		$newTransfer->created_by = Auth::user()->id;
		$newTransfer->amount = $request->amount;
		$newTransfer->bank_name = $request->bank_name;
		$newTransfer->transfered_at = $request->transfered_at;
		$newTransfer->transfered_by = $request->transfered_by;
		$newTransfer->email = $request->email;
		$newTransfer->phone = $request->phone;
		$newTransfer->ad_id = 0;
		$newTransfer->verification_code = 0;
		$newTransfer->notes = $request->notes;
		$newTransfer->type = 'subscribe';
		
		return $newTransfer->save() ? redirect()->route( 'add-subscribe-transfer')->with( 'mOk', 'تم الارسال بنجاح' ) : redirect()->route('add-subscribe-transfer')->with( 'mNo', 'لم يتم الارسال  حاول مرة اخرى' );

	}

	function proUser($id){
		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$user=User::where('id',$id)->first();
		$user->is_pro = 1;
		$user->save();
		return redirect()->back()->with('mOK', 'تمت الموافقة على العضوية');
	}

	function disproUser($id){
		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$user=User::where('id',$id)->first();
		$user->is_pro = 0;
		$user->save();
		return redirect()->back()->with('mOK', 'تم حذف العضوية');
	}

}

		