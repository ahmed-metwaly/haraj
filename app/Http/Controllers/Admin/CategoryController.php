<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

	public function getIndex() {

		$data = Categories::join('users', 'categories.crated_by' , '=', 'users.id' )->select('categories.*','users.id as user_id', 'users.name as user_name')->orderBy( 'categories.id','DESC' )->get();

		return view( 'admin.categories.showAll', [ 'data' => $data ] );
	}


	public function getAdd() {

		$data = menu();

		return view( 'admin.categories.add', [ 'data' => $data ] );

	}


	public function postAdd( Request $request ) {

		$rules = [
			'name' => 'required|max:255',
			'status'  => 'required',
			'photo'   => 'mimes:png,jpg,jpeg',
			'type'    => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'country-add' )->withErrors( $validator )->withInput();

		}

		$newCountry = new Categories();

		if ( isset( $request->photo ) && $request->photo != '' ) {
			$newCountry->photo = uploading( $request->file( 'photo' ), 'categories', [
				'50x50',
				'150x150',
				'250x250',
				'300x200'
			] );
		} else {
			$newCountry->photo = '';
		}

		$newCountry->name   = $request->name;
		$newCountry->type   = $request->type;
		$newCountry->status    = $request->status;
		$newCountry->crated_by = Auth::user()->id;

		return $newCountry->save() ? redirect()->route( 'categories' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'categories' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}


	public function getEdit( $id ) {

		$data = Categories::where( 'id', $id )->firstOrFail();
		$user = User::where('id',$data->crated_by)->select('id','name')->first();

		return view( 'admin.categories.edit', [ 'data' => $data ,'user'=>$user] );

	}

	public function postEdit( Request $request, $id ) {


		$rules = [
			'name' => 'required|max:255',
			'status'  => 'required',
			'photo'   => 'mimes:png,jpg,jpeg'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'category-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$data = Categories::find( $id );


		if ( isset( $request->photo ) && $request->photo != '' && $data->photo != $request->photo ) {

			@unlink( public_path( '/categories' ) . $request->photo );
			@unlink( public_path( '/categories_50x50' ) . $request->photo );
			@unlink( public_path( '/categories_150x150' ) . $request->photo );
			@unlink( public_path( '/categories_250x250' ) . $request->photo );

			$data->photo = uploading( $request->file( 'photo' ), 'categories', [ '50x50', '150x150', '250x250' ] );

		}


		$data->name = $request->name;
		$data->type = $request->type;
		$data->status  = $request->status;


		return $data->save() ? redirect()->route( 'category-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'category-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}

	public function getDetails( $id ) {

		$data = Categories::where( 'id', $id )->first();
		$user = User::where('id',$data->crated_by)->select('id','name')->first();
	
		if ( ! isset( $data ) ) {
			return redirect()->route( 'categories' )->withErrors( [ 'err' => 'هذا القسم غير موجود' ] )->withInput();

		}

		return view( 'admin.categories.details', [ 'data' => $data ,'user'=>$user] );
	}

	public function getDelete( $id ) {

		$check = Categories::find( $id );
		if ( ! isset( $check ) ) {
			return back()->withErrors( [ 'Err' => 'هذه الفصيلة غير موجود' ] );
		}

		$photo = Categories::where( 'id', $id )->select( 'photo' )->first();

		@unlink( public_path( '/categories' ) . $photo->photo );
		@unlink( public_path( '/categories_50x50' ) . $photo->photo );
		@unlink( public_path( '/categories_150x150' ) . $photo->photo );
		@unlink( public_path( '/categories_250x250' ) . $photo->photo );

		return Categories::destroy( $id ) ? redirect()->route( 'categories' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'categories' )->with( 'mNo', trans( 'admin.deleteNo' ) )->withInput();
	}
}
