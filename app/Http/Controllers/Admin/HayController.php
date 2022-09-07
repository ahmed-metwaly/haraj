<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Cities;
use App\Hay;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HayController extends Controller {

	public function getIndex() {

		$data = Hay::join('users', 'hays.created_by' , '=', 'users.id' )->join('cities', 'hays.city_id' , '=', 'cities.id' )->select('hays.*','users.id as user_id' , 'users.name as username' , 'cities.id as city_id' ,'cities.name as city_name')->orderBy( 'hays.id','DESC' )->get();



		return view( 'admin.hay.showAll', [ 'data' => $data ] );
	}

	public function getAdd() {

		$cities = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		return view( 'admin.hay.add', [ 'cities' => $cities ] );

	}


	public function postAdd( Request $request ) {

		$rules = [
			'name' => 'required|min:3|max:255',
			'city_id' => 'required',
			'status'  => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'hay-add' )->withErrors( $validator )->withInput();

		}

		$newHay = new Hay();

		$newHay->name    = $request->name;
		$newHay->city_id    = $request->city_id;
		$newHay->status     = $request->status;
		$newHay->created_by = Auth::user()->id;

		return $newHay->save() ? redirect()->route( 'hay' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'hay' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}


	public function getEdit( $id ) {

		$data = Hay::where( 'id', $id )->firstOrFail();

		$cities = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		return view( 'admin.hay.edit', [ 'data' => $data, 'cities' => $cities ] );

	}


	public function postEdit( Request $request, $id ) {


		$rules = [
			'name' => 'required|min:3|max:255',
			'city_id' => 'required',
			'status'  => 'required'
		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'hay-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$data = Hay::find( $id );

		$data->name = $request->name;
		$data->city_id = $request->city_id;
		$data->status  = $request->status;

		return $data->save() ? redirect()->route( 'city-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'hay-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}


	public function getDetails( $id ) {

		$data = Hay::where( 'id', $id )->firstOrFail();
		$user = User::where('id',$data->created_by)->first();
		$city = Cities::where('id',$data->city_id)->first();

		return view( 'admin.hay.details', [ 'data' => $data ,'user'=>$user ,'city'=>$city] );

	}


	public function getDelete( $id ) {

		$AdsCount = Ads::where( 'hay', $id )->get()->count();
		if ( $AdsCount > 0 ) {
			return back()->withErrors( [ 'Err' => 'لا يمكن حذف الحى لاستخدامة فى احد الاعلانات' ] );
		}

		return Hay::destroy( $id ) ? redirect()->route( 'hay' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'hay' )->with( 'mNo', trans( 'admin.deleteNo' ) )->withInput();
	}

}
