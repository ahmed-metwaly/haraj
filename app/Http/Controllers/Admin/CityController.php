<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Countries;
use App\Hay;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller {

	public function getIndex() {

		$data = Cities::join('users', 'cities.created_by' , '=', 'users.id' )->join('countries', 'cities.country_id' , '=', 'countries.id' )->select('cities.*','users.id as user_id' , 'users.name as username' ,'countries.id as country_id' ,'countries.name as country_name')->orderBy( 'cities.id','DESC' )->get();

		return view( 'admin.cities.showAll', [ 'data' => $data ] );
	}

	public function getAdd() {

		$countries = Countries::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		return view( 'admin.cities.add', [ 'countries' => $countries ] );

	}


	public function postAdd( Request $request ) {

		$rules = [
			'name'    => 'required|min:3|max:255',
			'country_id' => 'required',
			'status'     => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'city-add' )->withErrors( $validator )->withInput();

		}

		$newCity = new Cities();

		$newCity->name    = $request->name;
		$newCity->country_id = $request->country_id;
		$newCity->status     = $request->status;
		$newCity->created_by = Auth::user()->id;

		return $newCity->save() ? redirect()->route( 'cities' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'cities' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}


	public function getEdit( $id ) {

		$data = Cities::where( 'id', $id )->firstOrFail();

		$countries = Countries::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		return view( 'admin.cities.edit', [ 'data' => $data, 'countries' => $countries ] );

	}


	public function postEdit( Request $request, $id ) {


		$rules = [
			'name'    => 'required|min:3|max:255',
			'country_id' => 'required',
			'status'     => 'required'
		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'city-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$data = Cities::find( $id );


		$data->name    = $request->name;
		$data->country_id = $request->country_id;
		$data->status     = $request->status;


		return $data->save() ? redirect()->route( 'city-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'city-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}


	public function getDetails( $id ) {

		$data = Cities::where( 'id', $id )->firstOrFail();
		$user = User::where('id',$data->created_by)->first();
		$country = Countries::where('id',$data->country_id)->first();

		return view( 'admin.cities.details', [ 'data' => $data ,'country'=>$country , 'user'=>$user] );

	}


	public function getDelete( $id ) {

		$HayCount = Hay::where( 'city_id', $id )->get()->count();
		if ( $HayCount > 0 ) {
			return back()->withErrors( [ 'Err' => 'لا يمكن حذف المدينة لوجود أحياء تابعة لها' ] );
		}

		return Cities::destroy( $id ) ? redirect()->route( 'cities' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'cities' )->with( 'mNo', trans( 'admin.deleteNo' ) )->withInput();


	}

}
