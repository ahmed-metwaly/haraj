<?php

namespace App\Http\Controllers\web;

use App\Admin_messages;
use App\Ads;
use App\Block_list;
use App\Categories;
use App\sub_cts;
use App\Marks;
use App\Pages;
use App\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
//use Carbon\Carbon ;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller {


	public function soon() {

		return view( 'web.template.soon' );
	}

	public function getIndex() {
	/*	return Hash::make(123456);
		die();*/
		$catsData = Categories::where( 'status', 1 )->orderBy( 'id', 'DESC' )->limit( 8 )->select( 'id', 'photo', 'name' )->get();

		$Ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

		$newAds   = Ads::where( 'status', 1 )->orderBy( 'id', 'DESC' )->limit( 6 )->paginate( 4 );
		$viewsAds = Ads::where( 'status', 1 )->orderBy( 'views', 'DESC' )->limit( 6 )->paginate( 4 );

		

	/*	$current = Carbon\Carbon::now();
		$mytime = Carbon\Carbon::now();
echo $mytime->toDateTimeString();*/

/*		$ads=[];
		foreach ($newAds as $value) {
			# code...
			if ($current - $value->created_at <3) {
				# code...
				$ads=$value;
			}

		}*/
		//return $ads;
		//return Hash::make(trim('R2truThE7e'));

		return view( 'web.home.index', [
			'catsData' => $catsData,
			//'newAds'   => $newAds,
			//'viewsAds' => $viewsAds,
			'ads'      =>$Ads,
		] );
	}


//	public function ActiveEmail( Request $request ) {
//
//	}

	public function getBlacklisted( Request $request ) {

		
		$black_ads=Settings::select('black_ads')->first();
		return view( 'web.home.blacklisted' ,compact('black_ads'));
	}

	public function getCatById( $id ) {

		$ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where('ads.cat','=',$id)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

		return view( 'web.home.index', [ 'ads'=>$ads ] );

	}

	public function getSubcatById( $id ) {

		$ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where('ads.SubCat','=',$id)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

		return view( 'web.home.index', [ 'ads'=>$ads ] );

	}

	public function getCityById( $id ) {

		$ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where('ads.city','=',$id)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

		return view( 'web.home.index', [ 'ads'=>$ads ] );

	}

	public function getSearchForm() {

		$akars = \App\Akars::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		return view( 'web.home.search-form' , compact('akars'));

	}


	public function getSearch( Request $request ) {

		if ( $request->has( 'city' )&& $request->has( 'title' ) ) {
			$data = Ads::where( 'ads.title', 'LIKE', '"' . $request->title . '"' )->orWhere( 'ads.city', $request->city )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		}elseif ( $request->has( 'title' ) ) {
			$data = Ads::where('ads.title','like','%'.$request->title.'%')->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		} elseif ( $request->has( 'city' ) ) {
			$data = Ads::Where( 'ads.city', $request->city )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		} elseif ( $request->has( 'Cat' ) ) {
			$data = Ads::where( 'ads.cat', $request->Cat )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		}elseif ( $request->has( 'category' )&& $request->has( 'subcat' )&&$request->has( 'city' )) {
			$data = Ads::where( 'ads.cat', $request->category )->where( 'ads.SubCat', $request->subcat )->where( 'ads.city', $request->city )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );
		
		}elseif ( $request->has( 'cat' )&&$request->has( 'city' )) {
			$data = Ads::where( 'ads.cat', $request->cat )->where( 'ads.city', $request->city )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		}elseif ( $request->has( 'subcat' )&& $request->has( 'type' )&&$request->has( 'city' )) {
			$data = Ads::where( 'ads.type', $request->type )->where( 'ads.SubCat', $request->subcat )->where( 'ads.city', $request->city )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );

		}elseif ( $request->has( 'subcat' )) {
			$data = Ads::where( 'ads.SubCat', $request->subcat )->where( 'ads.status', 1 )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->orderBy( 'id', 'DESC' )->paginate( 12 );
		} else {
			$data = [];
		}
		//return $data;

		return view( 'web.home.search', [ 'data' => $data ] );
	}

	public function getSearshAkar( Request $request ) {

		$marks = Marks::where( 'status', 1 )->limit( 10 )->get();

		$data = Ads::where( 'ads.status', 1 )->join( 'ads_akar', 'ads.id', '=', 'ads_akar.ad_id' )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where( 'ads_akar.akar_type_id', $request->akar_type )->orWhere( 'ads.city', $request->city )->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->paginate( 12 );

		return view( 'web.home.search', [ 'data' => $data, 'marks' => $marks ] );
	}
	
	
	public function getSearchCar( Request $request){

			$data2 = Ads::where( 'status', 1 )->join( 'ads_car', 'ads.id', '=', 'ads_car.ad_id' )->where( 'ads_car.mark_id', $request->mark_id )->orWhere( 'ads_car.model_id', $request->model_id )->orWhere( 'ads_car.year_id', $request->year_id )->paginate( 12 );

			$data = Ads::join( 'ads_car', 'ads.id', '=', 'ads_car.ad_id' )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where( 'ads_car.mark_id', $request->mark_id )->orWhere( 'ads_car.model_id', $request->model_id )->orWhere( 'ads_car.year_id', $request->year_id )->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

			return view( 'web.home.search', [ 'data' => $data ] );
	} 


	public function getSearchCars( Request $request){


			$data = Ads::join( 'ads_car', 'ads.id', '=', 'ads_car.ad_id' )->join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where( 'ads_car.mark_id', $request->mark_id )->orWhere( 'ads_car.model_id', $request->model_id )->orWhere( 'ads_car.year','>', $request->from_year)->orWhere( 'ads_car.year','<', $request->to_year)->where('ads.city',$request->city)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );

			return view( 'web.home.search', [ 'data' => $data ] );
	} 


	public function getContact() {

		return view( 'web.home.contactUs' );

	}

	public function postContact( Request $request ) {

		$rules = [
			'name'    => 'required|min:3|max:255',
			'email'   => 'required|email|min:3:max:255',
			'title'   => 'required|min:3|max:255',
			'message' => 'required|min:3',

		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'contact-us' )->withErrors( $validator )->withInput();

		}


		$newMessage = new Admin_messages();

		$newMessage->name    = $request->name;
		$newMessage->email   = $request->email;
		$newMessage->title   = $request->title;
		$newMessage->message = $request->message;
		$newMessage->ip      = $_SERVER['REMOTE_ADDR'];

		return $newMessage->save() ? redirect()->route( 'home' )->with( 'mOk', 'تم ارسالى الرسالة بنجاح . سيتم الرد عليك قريبا' ) : redirect()->route( 'contact-us' )->with( 'mNo', 'عفوا لم يتم الارسال بنجاح' );

	}


	public function getPage( $id ) {

		$data = Pages::where( 'id', $id )->where( 'status', 1 )->first();

		return view( 'web.home.page', [ 'data' => $data ] );
	}

	public function getBlackList() {

		return view( 'web.home.blackList' );

	}


	public function postBlackList( Request $request ) {

		$rules = [
			'search' => 'required|min:1|max:255',

		];

		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'black-list' )->withErrors( $validator )->withInput();

		}

		$data = Block_list::join( 'users', 'block_lists.user_id', '=', 'users.id' )->join( 'countries', 'users.country_id', '=', 'countries.id' )->where( 'users.phone', $request->search )->orWhere( 'users.id', $request->search )->select( 'users.name as name', 'countries.name as name_ar' )->first();

		return view( 'web.home.blackList', [ 'data' => $data ] );

	}

	public function getlastadpercat( Request $request ) {
		$d=[];
		$data= Categories::all();
		foreach ($data as $key => $value) {
			$data2 = Ads::where('cat',$value->id)->where( 'status', 1 )->orderBy('id','desc')->first();
			$d[$key]=$data2;
		}
		$viewsAds = Ads::where( 'status', 1 )->where( 'is_pro', 1 )->orderBy( 'views', 'DESC' )->limit( 6 )->get();

		return view( 'web.home.live', [ 'data' => $d , 'ads'=>$viewsAds] );
	}
	
	public function getSubCats(Request $r){
		$data = sub_cts::where('cat_id',$r->Cat)->where( 'status', 1 )->orderBy('id','desc')->get();
		return view('web.home.subcats' ,['data' => $data]);
	}
	
	function getMarks() {

	$data= \App\Marks::orderBy( 'id', 'Asc' )->select( 'id', 'name_' . \Illuminate\Support\Facades\App::getLocale() . ' as name','photo','subcat_id' )->get();
	//return $data ;
	return view('web.home.marks' ,['data'=>$data]);
	}
	
	function searchModel($id) {

	$data = Ads::where( 'status', 1 )->join( 'ads_car', 'ads.id', '=', 'ads_car.ad_id' )->Where( 'ads_car.model_id', $id )->paginate(12);
	return view( 'web.home.search', [ 'data' => $data ] );

	}

}
