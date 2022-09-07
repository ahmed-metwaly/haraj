<?php

namespace App\Http\Controllers\Admin;

use App\Pages;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller {

	public function getIndex() {

		$data = Pages::join('users', 'pages.created_by' , '=', 'users.id' )->orderBy( 'pages.id', 'DESC' )->select('pages.*','users.id as user_id','users.name as username')->get();

		return view( 'admin.pages.showAll', [ 'data' => $data ] );
	}

	public function getAdd() {

		return view( 'admin.pages.add' );

	}


	public function postAdd( Request $request ) {

		$rules = [
			'name'    => 'required|min:3|max:255',
			'title'   => 'required|min:3|max:255',
			'content' => 'required|min:3',
			'status'     => 'required'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'page-add' )->withErrors( $validator )->withInput();

		}

		$newPage             = new Pages();
		$newPage->name    = $request->name;
		$newPage->title   = $request->title;
		$newPage->content = $request->content;
		$newPage->status     = $request->status;
		$newPage->type       = $request->type;
		$newPage->created_by = Auth::user()->id;

		return $newPage->save() ? redirect()->route( 'pages' )->with( 'mOk', trans( 'messages.addOK' ) ) : redirect()->route( 'pages' )->with( 'mNo', trans( 'messages.addNo' ) )->withInput();

	}


	public function getEdit( $id ) {

		$data = Pages::where( 'id', $id )->firstOrFail();

		return view( 'admin.pages.edit', [ 'data' => $data ] );

	}


	public function postEdit( Request $request, $id ) {


		$rules = [
			'name'    => 'required|min:3|max:255',
			'title'   => 'required|min:3|max:255',
			'content' => 'required|min:3',
			'status'     => 'required'
		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'page-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}


		$data = Pages::find( $id );


		$data->name    = $request->name;
		$data->title   = $request->title;
		$data->content = $request->content;
		$data->status     = $request->status;
		$data->type       = $request->type;

		return $data->save() ? redirect()->route( 'page-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'page-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


	}


	public function getDetails( $id ) {

		$data = Pages::where( 'id', $id )->firstOrFail();
		$user = User::find($data->created_by);

		return view( 'admin.pages.details', [ 'data' => $data ,'user'=>$user] );

	}


	public function getDelete( $id ) {

		return Pages::destroy( $id ) ? redirect()->route( 'pages' )->with( 'mOk', trans( 'admin.deleteOK' ) ) : redirect()->route( 'pages' )->with( 'mNo', trans( 'admin.deleteNo' ) );


	}

}
