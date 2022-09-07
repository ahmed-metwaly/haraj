<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Categories;
use App\sub_cts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SubCatController extends Controller {

	public function getSubCat() {

		
		$data = sub_cts::join('users', 'sub_cts.created_by' , '=', 'users.id' )->join('categories','sub_cts.cat_id','=','categories.id')->select('sub_cts.*','users.id as user_id', 'users.name as user_name','categories.id as cat_id' ,'categories.name as cat_name')->orderBy( 'sub_cts.id','DESC')->get();
		return view( 'admin.categories.subcat.SubCategories', compact( 'data' ) );
	}

	public function getSubAdd() {

		$data = Categories::orderBy( 'id' )->get();

		return view( 'admin.categories.subcat.add', compact( 'data' ) );
	}

	public function postAdd( Request $request ) {

		$rules = [
			'name' => 'required|max:255',
			'cat_id'  => 'required',
			'status'  => 'required',
			'photo'   => 'mimes:png,jpg,jpeg'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {
			return redirect()->route( 'SubCategories' )->withErrors( $validator )->withInput();
		}

		$new_sub_cts = new sub_cts();

		if ( isset( $request->photo ) && $request->photo != '' ) {
			$new_sub_cts->img = uploading( $request->file( 'photo' ), 'categories', [
				'50x50',
				'150x150',
				'250x250'
			] );
		} else {
			$new_sub_cts->img = '';
		}

		$new_sub_cts->name       = $request->name;
		$new_sub_cts->status     = $request->status;
		$new_sub_cts->cat_id     = $request->cat_id;
		$new_sub_cts->created_by = Auth::user()->id;

		return $new_sub_cts->save() ? redirect()->route( 'SubCategories' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'categories' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}

	public function getDelete( $id ) {

		$Check = Ads::find( $id );

		if ( isset( $Check ) ) {
			return back()->withErrors( [ 'Err' => 'هذا النوع غير موجود , لا يمكن حذفه' ] );
		}

		$photo = sub_cts::where( 'id', $id )->select( 'img' )->first();

		@unlink( public_path( '/categories' ) . $photo->photo );
		@unlink( public_path( '/categories_50x50' ) . $photo->photo );
		@unlink( public_path( '/categories_150x150' ) . $photo->photo );
		@unlink( public_path( '/categories_250x250' ) . $photo->photo );

		return sub_cts::destroy( $id ) ? redirect()->route( 'SubCategories' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'SubCategories' )->with( 'mNo', trans( 'admin.deleteNo' ) )->withInput();
	}

	public function SubgetEdit( $id ) {

		$data = sub_cts::where( 'id', $id )->first();
		$user = User::where('id',$data->created_by)->select('id','name')->first();
		if ( ! isset( $data ) ) {
			return redirect()->route( 'SubCategories' )->withErrors( [ 'err' => 'خطأ فى عرض صفحة القسم الفرعى' ] )->withInput();
		}

		return view( 'admin.categories.subcat.edit', [ 'data' => $data ,'user'=>$user] );

	}


	public function SubpostEdit( Request $request, $id ) {


		$rules = [
			'name' => 'required|max:255',
			'cat_id'  => 'required',
			'status'  => 'required',
			'photo'   => 'mimes:png,jpg,jpeg'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'SubCat-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$cato = Categories::where( 'id', $request->cat_id )->first();
		if ( ! isset( $cato ) ) {
			return redirect()->route( 'SubCat-edit' )->withErrors( [ 'err' => 'يرجاء اختيار القسم الرئيسى' ] )->withInput();
		}

		$data = sub_cts::find( $id );


		if ( isset( $request->photo ) && $request->photo != '' && $data->photo != $request->photo ) {

			@unlink( public_path( '/categories' ) . $request->photo );
			@unlink( public_path( '/categories_50x50' ) . $request->photo );
			@unlink( public_path( '/categories_150x150' ) . $request->photo );
			@unlink( public_path( '/categories_250x250' ) . $request->photo );

			$data->img = uploading( $request->file( 'photo' ), 'categories', [ '50x50', '150x150', '250x250' ] );

		}


		$data->name   = $request->name;
		$data->cat_id = $request->cat_id;
		$data->status = $request->status;


		return $data->save() ? redirect()->route( 'SubCat-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'SubCat-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}


	public function getSubDetails( $id ) {

		$data = sub_cts::where( 'id', $id )->first();
		/*$data = sub_cts::where( 'id', $id )->join('users', 'sub_cts.created_by' , '=', 'users.id' )->join('categories','sub_cts.cat_id','=','categories.id')->select('sub_cts.*','users.id as user_id', 'users.name as user_name','categories.id as cat_id' ,'categories.name as cat_name')->first();*/

		$user = User::where('id',$data->created_by)->select('id','name')->first();
		$category = Categories::where('id',$data->cat_id)->select('id','name')->first();
		if ( ! isset( $data ) ) {
			return redirect()->route( 'SubCategories' )->withErrors( [ 'err' => 'خطأ فى عرض صفحة القسم الفرعى' ] )->withInput();

		}

		return view( 'admin.categories.subcat.details', [ 'data' => $data ,'user'=>$user ,'cat'=>$category] );
	}


}
