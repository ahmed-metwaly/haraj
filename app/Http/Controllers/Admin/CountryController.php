<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Countries;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller {

	public function getIndex() {

		//$data = Countries::orderBy( 'id' )->get();
		$data = Countries::join('users', 'countries.created_by' , '=', 'users.id' )->select('countries.*','users.id as user_id','users.name as username')->orderBy( 'countries.id','DESC' )->get();

		$menu = menu();

		return view( 'admin.countries.showAll', [ 'data' => $data, 'menu' => $menu ] );
	}

	public function getAdd() {

		$data = menu();

		return view( 'admin.countries.add', [ 'data' => $data ] );

	}


	public function postAdd( Request $request ) {

		$rules = [
			'name' => 'required|max:255',
			'status'  => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'country-add' )->withErrors( $validator )->withInput();

		}

		$newCountry = new Countries();

		$newCountry->name    = $request->name;
		$newCountry->status     = $request->status;
		$newCountry->created_by = Auth::user()->id;

		return $newCountry->save() ? redirect()->route( 'countries' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'levels' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}


	public function getEdit( $id ) {

		$data = Countries::where( 'id', $id )->firstOrFail();


		return view( 'admin.countries.edit', [ 'data' => $data ] );

	}


	public function postEdit( Request $request, $id ) {


		$rules = [
			'name' => 'required|max:255',
			'status'  => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'country-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$data = Countries::find( $id );


		$data->name = $request->name;
		$data->status  = $request->status;


		return $data->save() ? redirect()->route( 'country-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'country-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}


	public function getDetails( $id ) {

		$data = Countries::where( 'id', $id )->first();
		if ( CheckData( $data ) !== true ) {
			return back();
		}
		$user = User::where('id',$data->created_by)->first();

		return view( 'admin.countries.details', [ 'data' => $data ,'user'=>$user] );

	}


	public function getDelete( $id ) {

		$CitiesCount = Cities::where( 'country_id', $id )->get()->count();
		if ( $CitiesCount > 0 ) {
			return back()->withErrors( [ 'Err' => 'لا يمكن حذف الدولة لوجود مدن تابعة لها' ] );
		}

		return Countries::destroy( $id ) ? redirect()->route( 'countries' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'countries' )->with( 'mNo', trans( 'admin.deleteNo' ) )->withInput();


	}
}
