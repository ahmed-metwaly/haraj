<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Ads_photos;
use App\Categories;
use App\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller {

	public function GetAllActiveAdds() {

		//$Ads = Ads::Published()->latest()->paginate( 8 );
	$Ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->select('ads.*','users.id as user_id' ,'users.name as username')->latest()->paginate( 8 );

		return view( 'admin.Ads.AllAds', compact( 'Ads' ) );
	}

	public function GetAllNotActiveAdds() {

		//$Ads = Ads::UnPublished()->latest()->paginate( 8 );

		$Ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',0)->select('ads.*','users.id as user_id' ,'users.name as username')->latest()->paginate( 8 );

		return view( 'admin.Ads.AllAds', compact( 'Ads' ) );
	}

	public function Add_Ad( Request $request ) {

		if ( ! Auth::check() ) {
			return back()->with( 'mNo', 'يجب ان تسجل الدخول قبل اضافة الاعلان' );
		}

		$categories = Categories::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		$cities     = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		return view( 'admin.Ads.add', [
			'cities'     => $cities,
			'categories' => $categories,
		] );
	}

	public function getDeleteAds( $id ) {

		if ( Auth::check() ) {
			if ( Auth::user()->is_admin == 1 ) {
				$data = Ads::find( $id );
				@unlink( public_path( 'ads/' . $data->photo ) );
				@unlink( public_path( 'ads_74x84/' . $data->photo ) );
				@unlink( public_path( 'ads_262x249/' . $data->photo ) );
				@unlink( public_path( 'ads_435x490/' . $data->photo ) );

				$imgs = Ads_photos::where( 'ad_id', $id )->get();

				foreach ( $imgs as $img ) {
					@unlink( public_path( 'ads/' . $img->img ) );
					@unlink( public_path( 'ads_74x84/' . $img->img ) );
					@unlink( public_path( 'ads_262x249/' . $img->img ) );
					@unlink( public_path( 'ads_435x490/' . $img->img ) );
				}

				return $data->delete() ? back()->with( 'mOk', 'تم حذف الاعلان بنجاح' ) : redirect()->back()->with( 'mNo', 'عفوا لم يتم الحذف حاول مرة اخرى' );

			}

			return back()->with( 'mNo', 'ليس لديك صلاحية لحذف هذا الاعلان' );
		}

		return back()->with( 'mNo', 'يجب ان تسجل الدخول كى تتمكن من حذف الاعلان' );
	}
}
