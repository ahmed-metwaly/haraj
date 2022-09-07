<?php

namespace App\Http\Controllers\web;

use App\Ads;
use App\Ads_akar;
use App\Ads_car;
use App\Ads_photos;
use App\Akars;
use App\Categories;
use App\Cities;
use App\Comments;
use App\Hay;
use App\likes;
use App\Marks;
use App\Models;
use App\Notifications;
use App\report;
use App\sub_cts;
use App\Years;
use App\Following;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller {



	public function getAdsAdd() {

		if ( ! Auth::check() ) {
			return redirect( '/' )->with( 'mNo', 'يجب ان تسجل الدخول قبل اضافة الاعلان' );
		}


		$lastId     = DB::table( 'ads' )->where( 'id', DB::raw( "(select max(`id`) from ads)" ) )->select( 'id' )->first();
		if($lastId ==''){
		$lastId=0;
		}

		$categories = Categories::orderBy( 'id', 'DESC' )->select( 'id', 'name','type')->get();
		$cities     = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		$marks      = Marks::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		$years = Years::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		$akars      = Akars::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();

		return view( 'web.ads.add', [
			'lastId'     => $lastId,
			'cities'     => $cities,
			'categories' => $categories,
			'marks'      => $marks,
			'years'      => $years,
			'akars'      => $akars
		] );


	}

	public function getDeleteAds( $id ) {

		if ( Auth::check() ) {

			$data = Ads::find( $id );

			if ( Auth::user()->id == $data->created_by || Auth::user()->is_admin ) {

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

				return $data->delete() ? redirect( '/' )->with( 'mOk', 'تم حذف الاعلان بنجاح' ) : redirect()->back()->with( 'mNo', 'عفوا لم يتم الحذف حاول مرة اخرى' );

			}

			return back()->with( 'mNo', 'ليس لديك صلاحية لحذف هذا الاعلان' );
		}

		return back()->with( 'mNo', 'يجب ان تسجل الدخول كى تتمكن من حذف الاعلان' );
	}


	public function getEditAds( $id ) {

		$Ad = Ads::where( 'id', $id )->first();

		if ( ! Auth::check() ) {
			return redirect( '/' )->with( 'mNo', 'يجب ان تسجل الدخول قبل اضافة الاعلان' );
		}
		if ( ! Auth::user()->is_admin == 1 ) {
			if ( $Ad->created_by !== Auth::user()->id ) {
				return redirect( '/' )->with( 'mNo', 'لا تملك صلاحيات للدخول لهذه الصفحة' );
			}
		}

		$data['data']   = $Ad;
		$data['photos'] = Ads_photos::where( 'ad_id', $id )->where( 'status', 1 )->select( 'id', 'img' )->get();


		$data['carData']  = Ads_car::where( 'ad_id', $id )->first();
		
		$data['akarData'] = Ads_akar::where( 'ad_id', $id )->first();

		$data['categories'] = Categories::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		
		$data['SubCats']    = sub_cts::where( 'cat_id', $data['data']->cat )->orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();
		
		$data['cities']     = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		
		$data['hay']        = Hay::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		
		$data['marks']      = Marks::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		
		$data['models']     = Models::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();
		
		$data['years'] = Years::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

		$data['akars']      = Akars::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();

		//	dd( $data );

		return view( 'web.ads.edit', $data );

	}


	public function postEditAds2( Request $request, $id ) {

		if ( ! Auth::check() ) {
			return redirect( '/' )->with( 'mNo', 'يجب ان تسجل الدخول' );
		}

		$rules = [
			'title'  => 'required|min:3|max:255',
			'photo'  => 'mimes:png,jpg,jpeg',
			'desc'   => 'required|min:3',
			'price'  => 'required',
			'city'   => 'required',
			'hay'    => 'required',
			'type'   => 'required',
			'cat'    => 'required',
			'SubCat' => 'required',
			'phone'  => 'required',

		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'add-do-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}

		$basicData = Ads::where( 'id', $id )->first();

		if ( ! Auth::user()->is_admin == 1 ) {
			if ( $basicData->created_by !== Auth::user()->id ) {
				return redirect( '/' )->with( 'mNo', 'لا تملك صلاحيات للدخول لهذه الصفحة' );
			}
		}

		$basicData->title = $request->title;

		if ( isset( $request->photo ) && $request->photo != $basicData->photo && $request->hasFile( 'photo' ) ) {

			@unlink( public_path( 'ads/' . $basicData->photo ) );
			@unlink( public_path( 'ads_262x249/' . $basicData->photo ) );
			@unlink( public_path( 'ads_74x84/' . $basicData->photo ) );
			@unlink( public_path( 'ads_435x490/' . $basicData->photo ) );

			$basicData->photo = uploading( $request->file( 'photo' ), 'ads', [ '262x249', '74x84', '435x490' ] );

		}

		$basicData->desc  = $request->desc;
		$basicData->price = $request->price;
		$basicData->city  = $request->city;		$basicData->hay   = $request->hay;
		$basicData->type  = $request->type;
		$basicData->cat   = $request->cat;
		$basicData->phone = $request->phone;
		// ads photos


		if ( isset( $request->img ) && $request->img != '' && $request->hasFile( 'img' ) ) {

			foreach ( $request->img as $img ) {
				$adsPhotos         = new Ads_photos();
				$adsPhotos->img    = uploading( $img, 'ads', [ '74x84', '435x490' ] );
				$adsPhotos->ad_id  = $id;
				$adsPhotos->status = 1;
				$adsPhotos->save();

			}

		}

		return $basicData->save() ? redirect()->route( 'add-edit', [ 'id' => $id ] )->with( 'mOk', 'تم التعديل بنجاح' ) : redirect()->route( 'add-edit', [ 'id' => $id ] )->with( 'mNo', 'لم يتم التعديل حاول مرة اخرى' );

	}


	public function postAddComment( Request $request ) {

		$id = (int) $request->id;


		if ( Auth::check() ) {

			$rules = [
				'comment' => 'required|min:3|max:255'
			];

			$validator = Validator::make( $request->all(), $rules );

			if ( $validator->fails() ) {

				return redirect()->route( 'ad-view', [ 'id' => $id ] )->withErrors( $validator )->withInput();

			}

			if ( $_POST['scrf'] == '' ) {

				$newComment = new Comments();

				$newComment->ads_id     = $id;
				$newComment->comment    = $request->comment;
				$newComment->created_by = Auth::user()->id;

				$addNotfi = new Notifications();

				$addNotfi->ad_id      = $id;
				$addNotfi->by_user    = Auth::user()->id;
				$addNotfi->to_user_id = Ads::where( 'id', $id )->select( 'created_by' )->first()->created_by;
				$addNotfi->type       = 'comment';
				$addNotfi->seen       = 0;
				$addNotfi->save();

$newComment->save();
return response()
            ->json(['comment' => $newComment->comment , 'username' => Auth::user()->name ,'ad_id'=> $newComment->ads_id ,'object'=>$newComment ,'id'=>$newComment->id] )
            ->withCallback($request->input('callback'));

				//return $newComment->save() ? redirect()->route( 'ad-view', [ 'id' => $id ] )->with( 'mOk', 'تم اضافة التعليق بنجاح' ) : redirect()->route( 'ad-view', [ 'id' => $id ] )->with( 'mNo', 'لم يتم اضافة التعليق حاول مرة اخرى' );

			} else {

				return false;

			}


		}


		return redirect()->route( 'ad-view', [ 'id' => $id ] )->with( 'mNo', 'يجب ان تسجل الدخول لتتمكن من التعليق' );

	}


	public function getDeleteComment( $id ) {

		if ( Auth::check() ) {

			$data = Comments::find( $id );

			if ( Auth::user()->id == $data->created_by || Auth::user()->is_admin == 1 ) {
			
			$removeNotif = \App\Notifications::where( 'ad_id', $data->ads_id )->where( 'by_user', auth()->user()->id )->first();

					$removeNotif->delete();

				return $data->delete() ? redirect()->back()->with( 'mOk', 'تم حذف التعليق بنجاح' ) : redirect()->back()->with( 'mNo', 'عفوا لم يتم الحذف حاول مرة اخرى' );
				//return $data->delete() ? response()->json([ 'success'=>true]): response()->json(['success'=>false ]);

			}

			return back()->with( 'mNo', 'ليس لديك صلاحية لحذف هذا التعليق' );
		}

		return back()->with( 'mNo', 'يجب ان تسجل الدخول كى تتمكن من حذف التعليق' );

	}


	public function getReports( $id ) {

		if ( ! Auth::check() ) {
			return redirect()->back()->with( 'mNo', 'يجب ان تسجل دخولك كى تتمكن من التبلغ عن الاعلان' );
		}

		return view( 'web.ads.report', [ 'id' => $id ] );

	}


	public function postReports( Request $request, $id ) {


		if ( ! Auth::check() ) {
			return redirect()->back()->with( 'mNo', 'يجب ان تسجل دخولك كى تتمكن من التبلغ عن الاعلان' );
		}


		$rules = [
			'text' => 'required|min:3|max:255'
		];


		$validator = Validator::make( $request->all(), $rules );

		if ( $validator->fails() ) {

			return redirect()->route( 'ad-report', [ 'id' => $id ] )->withErrors( $validator )->withInput();

		}

		$newReport = new report();

		$newReport->ad_id      = (int) $id;
		$newReport->text       = $request->text;
		$newReport->created_by = Auth::user()->id;

		return $newReport->save() ? redirect()->route( 'ad-view', [ 'id' => $id ] )->with( 'mOk', 'تم التبليغ عن هذا الاعلان بنجاح' ) : redirect()->route( 'ad-view', [ 'id' => $id ] )->with( 'mNo', 'عفوا حدث خطأ ما لم يتم التبليغ حاول مرة اخؤى' );

	}


	public function getDeleteImg( $id ) {

		if ( ! Auth::check() ) {
			return redirect( '/' );
		}

		$data = Ads_photos::where( 'id', $id )->first();

		$Ad = Ads::where( 'id', $data->ad_id )->first();
		if ( ! Auth::user()->is_admin == 1 ) {
			if ( isset( $Ad ) && $Ad->created_by !== Auth::user()->id ) {
				return redirect( '/' )->with( 'mNo', 'لا تملك صلاحيات للدخول لهذه الصفحة' );
			}
		}


		if ( isset( $data->id ) && $data->id != '' ) {

			@unlink( public_path( 'ads/' . $data->img ) );
			@unlink( public_path( 'ads_262x249/' . $data->img ) );
			@unlink( public_path( 'ads_74x84/' . $data->img ) );
			@unlink( public_path( 'ads_435x490/' . $data->img ) );

			$data->delete();
		}

	}

		public function getAds() {

		if ( ! Auth::check() ) {
			return redirect( '/' )->with( 'mNo', 'يجب ان تسجل الدخول قبل اضافة الاعلان' );
		}


		$lastId     = DB::table( 'ads' )->where( 'id', DB::raw( "(select max(`id`) from ads)" ) )->select( 'id' )->first();
		$categories = Categories::orderBy( 'id', 'DESC' )->select( 'id', 'name')->get();
		$cities     = Cities::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();
//		$marks      = Marks::orderBy( 'id', 'DESC' )->select( 'id', 'name_' . App::getLocale() . ' as name' )->get();
		$years = Years::orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();

//		$akars      = Akars::orderBy( 'id', 'DESC' )->select( 'id', 'name_' . App::getLocale() . ' as name' )->get();

		return view( 'web.ads.add', [
			'lastId'     => $lastId,
			'cities'     => $cities,
			'categories' => $categories,
//			'marks'      => $marks,
			'years'      => $years,
//			'akars'      => $akars
		] );


	}


	    public function postAdsAdd(Request $request)
    {


        // regx same js


        $rules = [
            'title' => 'required|min:3|max:255',
            //'photo' => 'required|mimes:png,jpg,jpeg',
            'desc' => 'required|min:3',
           // 'price' => 'required',
            'city' => 'required',
           // 'hay' => 'required',
            //'type' => 'required',
            'cat' => 'required',
            'phone' => 'required',

        ];


        if (isset($request->cat) && $request->cat != '') {

            $carData = json_decode($request->cat);

            //  stupidity :(
            
            

            foreach ($carData as $key => $value) {
                $catName = $value;
                $catid = $key;
            }
            $catN=trim($catName);
            //var_dump($catName);
            //echo ('<br/>');
           // var_dump($catN);
            //echo ('<br/>');

            //$car = preg_match_all('#\b(السيارات|سيارات)\b#', $catName);

           // $akar = preg_match_all('#\b(العقارات|عقارات)\b#', $catName);
            $car = preg_match_all('/(السيارات|سيارات)/', $catName);
            $akar = preg_match_all('/(العقارات|عقارات)/', $catName);

//echo $car ;
//die();
            if ($akar) {

                $rules2 = [
                    'akar_type_id' => 'required',
//                    'map_lat' => 'required',
//                    'map_long' => 'required',
                    //'dest' => 'required',
                ];

                $rules = array_merge($rules, $rules2);

            } elseif ($car) {

                $rules2 = [
                    'mark_id' => 'required',
                    'model_id' => 'required',
                    'year_id' => 'required',
                ];

                $rules = array_merge($rules, $rules2);
            }

        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('ad-add')->withErrors($validator)->withInput();

        }

        $basicData = new Ads();
        $akarData = new Ads_akar();
        $carData = new Ads_car();
        $basicData->title = $request->title;

        /*if (isset($request->photo) && $request->photo != '') {

            $basicData->photo = uploading($request->file('photo'), 'ads', ['262x249', '74x84', '435x490']);

        } else {

            $basicData->photo = '';

        }
        */

        $basicData->desc = $request->desc;
        $basicData->price = '';
        $basicData->city = $request->city;
        if (isset($request->hay) && $request->hay != ''){
        $basicData->hay = $request->hay;
        }else{
        	$basicData->hay=0;
        }
        $basicData->type = 0;
       $ssid = json_decode($request->cat);

        $basicData->cat = key($ssid);
        $basicData->SubCat = $request->SubCat;
        $basicData->comments_status = 1;

        $basicData->phone = $request->phone;
        $basicData->sort = 0;
        $basicData->views = 0;
        $basicData->status = 1;
        $basicData->created_by = Auth::user()->id;

        $basicData->is_pro = Auth::user()->is_pro;


        // ads photos


        if (isset($request->img) && $request->img != '') {
//dd($request->img[0]);
        	//$basicData->photo = uploading($request->file('photo'), 'ads', ['262x249', '74x84', '435x490']);
        	$basicData->photo = uploading($request->img[0], 'ads', ['262x249', '74x84', '435x490']);
            
            foreach ($request->img as $img) {

                $adsPhotos = new Ads_photos();
                $adsPhotos->img = uploading($img, 'ads', ['74x84', '435x490']);
                $adsPhotos->ad_id = $request->fir + 1; // pleas chick id is exist or no ^_^
                $adsPhotos->status = 1;

                $adsPhotos->save();

            }

        } else {

            $basicData->photo = '';

        }

        if ($akar) {


            $akarData->ad_id = $request->fir + 1;
            $akarData->akar_type_id = $request->akar_type_id;
//            $akarData->map_lat = $request->map_lat;
//            $akarData->map_long = $request->map_long;
            $akarData->dest = $request->dest ? $request->dest : '';
            $akarData->rooms = $request->has('rooms') ? $request->rooms : '';
            $akarData->bathrooms = $request->has('bathrooms') ? $request->bathrooms : '';

            $akarData->save();

        } elseif ($car) {


            $carData->ad_id = $request->fir + 1;
            $carData->mark_id = $request->mark_id;
            $carData->model_id = $request->model_id;
            $carData->year_id = $request->year_id;
            $carData->doors = $request->has('doors') ? $request->doors : '';
            $carData->color = $request->has('color') ? $request->color : '';
            $carData->save();

        }

        return $basicData->save() ? redirect()->route('ad-view', ['id' => $basicData->id])->with('mOk', 'تم اضافة اعلانك بنجاح') :
            redirect()->route('ad-add')->with('mNo', 'لم يتم الاضافة حاول مرة اخرى');

    }

        public function getOneAd($id)
    {


        // views

        $newView = Ads::where('id', $id)->first();

        $view = $newView->views + 1;

        $newView->views = $view;

        $newView->save();

        // get data

        $data = Ads::where('id', $id)->where('status', 1)->first();
        $user = User::find($data->created_by);
        $photos = Ads_photos::where('ad_id', $id)->where('status', 1)->select('img')->get();
        $carData = '';
        $akarData = '';

        // car data
       $catData = json_decode($data->cat);
      
/*
        foreach ($catData as $key => $value) {
            $catName = $value;

        }*/
        $catid=$data->cat;
        $category = Categories::where('id', $catid)->first();
       // echo $category->name_ar ;
        //die();

$catName=$category->name ;
        // $car = preg_match_all('#\b(السيارات|سيارات)\b#', $catName);

       // $akar = preg_match_all('#\b(العقارات|عقارات)\b#', $catName);
        
        $car = preg_match_all('/(السيارات|سيارات)/', $catName);
        $akar = preg_match_all('/(العقارات|عقارات)/', $catName);

        if ($car) {

            $carData = Ads_car::where('ad_id', $id)->first();

        } elseif ($akar) {
            $akarData = Ads_akar::where('ad_id', $id)->first();
        }


        // get likes

		$countLikes = likes::where( 'ads_id', $id )->count();
		$countFavorites = \App\Favorites::where( 'ads_id', $id )->count();

		$userLike   = '';
		$userFavorite = '';

		if ( Auth::check() ) {
			$userLike = likes::where( 'ads_id', $id )->where( 'created_by', Auth::user()->id )->count();
			$userFavorite = \App\Favorites::where( 'ads_id', $id )->where( 'created_by', Auth::user()->id )->count();
		}

        // get likes

        /*$countLikes = likes::orderBy('id')->count();
        $userLike = '';

        if (Auth::check()) {
            $userLike = likes::where('ads_id', $id)->where('created_by', Auth::user()->id)->count();
        }
*/


		//follow
        $follow = [];
		if(Auth::check()) {
		$follow = Following::where( 'following_id', Auth::user()->id )->where('ad_id', $id)->first();
}
        $comments = Comments::where('ads_id', $id)->paginate(10);

        $countComments = count($comments);

        $oId = json_decode($data->cat);

        $cats = Ads::orderBy('id', 'DESC')->limit(12)->get();
        $country = \App\Countries::find($user->country_id);
		$city = \App\Cities::find($data->city) ;

		$sameCat = Ads::where('cat',$data->cat)->orderBy('id', 'DESC')->limit(12)->get();
		$sameAds = Ads::where('cat',$data->cat)->where('city',$data->city)->orderBy('id', 'DESC')->limit(12)->get();

        return view('web.ads.oneAd', ['data' => $data, 'photos' => $photos, 'carData' => $carData, 'akarData' => $akarData, 'userLike' => $userLike, 'countLikes' => $countLikes, 'comments' => $comments,
                                      'countComments' => $countComments, 'follow'=>$follow ,'cat'=>$category ,'user'=>$user ,'country'=>$country , 'city'=>$city ,'sameCat'=>$sameCat ,'sameAds'=>$sameAds ,'userFavorite'=>$userFavorite ,'countFavorites'=>$countFavorites]);


}

	function proAd($id){
		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$ad=Ads::where('id',$id)->first();
		$ad->is_pro = 1;
		$ad->save();
		return redirect()->back()->with('mOk', 'تم التثبيت');
	}

	function disproAd($id){
		if ( ! Auth::check() ) {
			return redirect()->route( 'home' )->with( 'mNo', 'عفوا يجب ان تسجل الدخول' );
		}

		$ad=Ads::where('id',$id)->first();
		$ad->is_pro = 0;
		$ad->save();
		return redirect()->back()->with('mOk', 'تم الغاء التثبيت');
	}
	
	

    public function postEditAds(Request $request, $id) {

        $rules = [
            'title' => 'required|min:3|max:255',
            'photo' => 'mimes:png,jpg,jpeg',
            'desc' => 'required|min:3',
            'price' => 'required',
            'city' => 'required',
            //'hay' => 'required',
            'type' => 'required',
            'cat' => 'required',
            'phone' => 'required',

        ];


        if (isset($request->cat) && $request->cat != '') {

            $carData = json_decode($request->cat);

            //  stupidity :(

            foreach ($carData as $key => $value) {
                $catName = $value;
                $catid = $key;
            }

            $car = preg_match_all('#\b(السيارات|سيارات)\b#', $catName);

            $akar = preg_match_all('#\b(العقارات|عقارات)\b#', $catName);


            if ($akar) {

                $rules2 = [
                    'akar_type_id' => 'required',
//                    'map_lat' => 'required',
//                    'map_long' => 'required',
                    'dest' => 'required',
                ];

                $rules = array_merge($rules, $rules2);

            } elseif ($car) {

                $rules2 = [
                    'mark_id' => 'required',
                    'model_id' => 'required',
                    'year_id' => 'required',
                ];

                $rules = array_merge($rules, $rules2);
            }

        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('add-do-edit', ['id' => $id])->withErrors($validator)->withInput();

        }

        $newAkar = new Ads_akar();
        $newCar = new Ads_car();

        $basicData =  Ads::where('id', $id)->first();
        $akarData =  Ads_akar::where('ad_id', $id)->first();
        $carData = Ads_car::where('ad_id', $id)->first();
        $basicData->title = $request->title;

        if (isset($request->photo) && $request->photo != $basicData->photo && $request->hasFile('photo')) {

            @unlink(public_path('ads/' . $basicData->photo));
            @unlink(public_path('ads_262x249/' . $basicData->photo));
            @unlink(public_path('ads_74x84/' . $basicData->photo));
            @unlink(public_path('ads_435x490/' . $basicData->photo));

            $basicData->photo = uploading($request->file('photo'), 'ads', ['262x249', '74x84', '435x490']);

        }

        $basicData->desc = $request->desc;
        $basicData->price = $request->price;
        $basicData->city = $request->city;
        if(isset($request->hay) &&$request->hay !=''){
        $basicData->hay = $request->hay;
        }
        $basicData->type = $request->type;
        $ssid = json_decode($request->cat);
        $basicData->cat = key($ssid);
       // $basicData->cat = $request->cat;
        $basicData->phone = $request->phone;
        // ads photos




        if (isset($request->img) && $request->img != '' && $request->hasFile('img')) {

            foreach ($request->img as $img) {
                $adsPhotos = new Ads_photos();
                $adsPhotos->img = uploading($img, 'ads', ['74x84', '435x490']);
                $adsPhotos->ad_id = $id;
                $adsPhotos->status = 1;
                $adsPhotos->save();

            }

        }

$basicData->save();

        if ($akar) {

            if(isset($carData->id) && $carData->id != '') {

                $carData->delete();

                $newAkar->ad_id = $basicData->id;
                $newAkar->akar_type_id = $request->akar_type_id;
                $newAkar->dest = $request->dest;
                $newAkar->rooms = $request->has('rooms') ? $request->rooms : '';
                $newAkar->bathrooms = $request->has('bathrooms') ? $request->bathrooms : '';
                $newAkar->map_lat='';
                $newAkar->map_long='';
                $newAkar->save();

            } else {

                $akarData->akar_type_id = $request->akar_type_id;
                $akarData->dest = $request->dest;
                $akarData->rooms = $request->has('rooms') ? $request->rooms : '';
                $akarData->bathrooms = $request->has('bathrooms') ? $request->bathrooms : '';
                $akarData->save();

            }




        } elseif ($car) {

            if(isset($akarData->id) && $akarData->id != '') {
                $akarData->delete();

                $newCar->ad_id = $basicData->id;
                $newCar->mark_id = $request->mark_id;
                $newCar->model_id = $request->model_id;
                $newCar->year_id = $request->year_id;
                $newCar->doors = $request->has('doors') ? $request->doors : '';
                $newCar->color = $request->has('color') ? $request->color : '';
                $newCar->save();


            } else {

                $carData->mark_id = $request->mark_id;
                $carData->model_id = $request->model_id;
                $carData->year_id = $request->year_id;
                $carData->doors = $request->has('doors') ? $request->doors : '';
                $carData->color = $request->has('color') ? $request->color : '';

                $carData->save();

            }



        }
        
        return redirect()->route('ad-view', ['id' => $id])->with('mOk', 'تم التعديل بنجاح');

            redirect()->route('add-edit', ['id' => $id])->with('mNo', 'لم يتم التعديل حاول مرة اخرى');


    }


    public function getNextAd($ad_id){

    	$ad = Ads::where('id','>', $ad_id)->orderBy('id','asc')->first();
    	return redirect()->route('ad-view', ['id' => $ad->id]);

    }

}