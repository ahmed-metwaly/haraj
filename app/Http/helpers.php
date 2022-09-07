<?php
function baseUrl( $url = '' ) {

	return url( '' . $url );

}

function CheckData( $data ) {

	if ( ! isset( $data ) && count($data) > 0 ) {
		return back()->withErrors( [ 'Err' => 'خطأ فى قاعده البيانات برجاء التواصل مع فريق الدعم' ] );
	} else {
		return true;
	}
}


function menu() {

	return [

		[
			'title' => trans( 'admin.sideDashboard' ),
			'icon'  => 'icon-home4',
			'route' => [
				'dashboard' => trans( 'admin.sideDashboard' )
			]

		],

		[
			'title' => trans( 'admin.sideSettingsTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'settings' => trans( 'admin.settingsTitle' )
			]

		],

		[
			'title' => trans( 'admin.usersTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'admins'    => trans( 'admin.sideAdminsShow' ),
				'users'     => trans( 'admin.sideUsersShow' ),
				'admin-add' => trans( 'admin.sideUsersAdd' ),

			]

		],

		[
			'title' => trans( 'admin.categoriesTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'categories'       => trans( 'admin.sideCategoriesShow' ),
				'category-add'     => trans( 'admin.sideCategoriesAdd' ),
				'SubCategories'    => trans( 'admin.sideSubCategoriesShow' ),
				'sub-category-add' => trans( 'admin.sideSubCategoriesAdd' ),
			]

		],

		[
			'title' => trans( 'admin.Ads' ),
			'icon'  => 'icon-home4',
			'route' => [
				'AdminActiveAds'    => trans( 'admin.AdsShowAct' ),
				'AdminNotActiveAds' => trans( 'admin.AdsShowNotAct' ),
				'AdminAdd-Ad'       => trans( 'admin.AdAdd' ),
			]

		],

		[
			'title' => trans( 'admin.sideLevelsTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'levels'    => trans( 'admin.sideLevelsShow' ),
				'level-add' => trans( 'admin.sideLevelsAdd' )
			]

		],

		[
			'title' => trans( 'admin.sideCountriesTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'countries'   => trans( 'admin.sideCountriesShow' ),
				'country-add' => trans( 'admin.sideCountriesAdd' )
			]

		],

		[
			'title' => trans( 'admin.citiesTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'cities'   => trans( 'admin.sideCitiesShow' ),
				'city-add' => trans( 'admin.sideCitiesAdd' )
			]

		],


		[
			'title' => trans( 'admin.hayTitle' ),
			'icon'  => 'icon-home4',
			'route' => [
				'hay'     => trans( 'admin.sideHayShow' ),
				'hay-add' => trans( 'admin.sideLevelsAdd' )
			]

		],

		 [
			 'title' => trans('admin.marks'),
			 'icon' => 'icon-home4',
			 'route' => [
				 'marks' => trans('admin.sideMarksShow'),
				 'mark-add' => trans('admin.sideLevelsAdd')
			 ]

		 ],

		 [
			 'title' => trans('admin.models'),
			 'icon' => 'icon-home4',
			 'route' => [
				 'models' => trans('admin.sideModelsShow'),
				 'model-add' => trans('admin.sideLevelsAdd')
			 ]

		 ],

		 [
			 'title' => trans('admin.years'),
			 'icon' => 'icon-home4',
			 'route' => [
				 'years' => trans('admin.sideYearsShow'),
				 'year-add' => trans('admin.sideLevelsAdd')
			 ]

		 ],

		 [
			 'title' => trans('admin.akars'),
			 'icon' => 'icon-home4',
			 'route' => [
				 'akars' => trans('admin.sideAkarShow'),
				 'akar-add' => trans('admin.sideLevelsAdd')
			 ]

		 ],

		[
			'title' => trans( 'admin.pages' ),
			'icon'  => 'icon-home4',
			'route' => [
				'pages'    => trans( 'admin.pageShow' ),
				'page-add' => trans( 'admin.sideLevelsAdd' )
			]

		],


		[

			'title' => trans( 'admin.reports' ),
			'icon'  => 'icon-home4',
			'route' => [
				'reports' => trans( 'admin.reportShow' )
			]

		],

		[

			'title' => trans( 'admin.blackList' ),
			'icon'  => 'icon-home4',
			'route' => [
				'black-lists' => trans( 'admin.blackListShow' ),
				'black-add'   => trans( 'admin.sideLevelsAdd' )
			]

		],

		[

			'title' => trans( 'admin.adminMessages' ),
			'icon'  => 'icon-home4',
			'route' => [
				'admin-messages' => trans( 'admin.adminMessageShow' ),
			]

		],

		[

			'title' => trans( 'admin.bankAccount' ),
			'icon'  => 'icon-home4',
			'route' => [
				'bank-accounts' => trans( 'admin.bankAccountShow' ),
				'bank-add' => trans( 'admin.bankAccountAdd' )
			]

		],

		[

			'title' => trans( 'admin.bankTransfers' ),
			'icon'  => 'icon-home4',
			'route' => [
				'transfers-list' => trans( 'admin.bankTransfersCommission' ),
				'subscribe-transfer-list' => trans( 'admin.bankTransfersSubscribe' )

			]

		],

	];

}

// save image base 64

function countries() {

	return \App\Countries::orderBy( 'id', 'ASC' )->select( 'id','name' )->get();
}

function categories() {

	return \App\Categories::orderBy( 'id', 'ASC' )->select( 'id', 'name','photo' )->get();
}

function SubCats( $col ,$id) {

	return  \App\sub_cts::where( $col, $id )->select( 'id', 'name','img' )->limit(21)->get() ;
}

function SubCat($id) {

	return \App\sub_cts::join('users', 'sub_cts.created_by' , '=', 'users.id' )->join('categories','sub_cts.cat_id','=','categories.id')->where( 'sub_cts.cat_id', $id )->select('sub_cts.*','users.id as user_id', 'users.name as user_name','categories.id as cat_id' ,'categories.name as cat_name')->orderBy( 'sub_cts.id','ASC')->limit(21)->get();
}

function Marks() {

	return \App\Marks::orderBy( 'id', 'DESC' )->select( 'id', 'name','photo','subcat_id' )->get();
}


function Mark() {

	return \App\Marks::orderBy( 'id', 'Asc' )->select( 'id', 'name','photo','subcat_id' )->get();
}

function Years() {

	return \App\Years::orderBy( 'id', 'ASC' )->select( 'id', 'name' )->get();
}

function getNotifs(){
	return \App\Notifications::join( 'ads', 'ads.id', '=', 'notifications.ad_id' )->join( 'users', 'users.id', '=', 'notifications.by_user' )->where('notifications.to_user_id', Auth::user()->id)->where('notifications.seen', 0)->select('notifications.id as id','notifications.created_at as created_at','ads.id as ad_id','ads.title as ad_title','users.id as user_id' ,'users.name as username')->count();
}

function saveImg( $base64_img, $img_name, $path ) {

	$image_data = base64_decode( $base64_img );
	$source     = imagecreatefromstring( $image_data );
	$angle      = 0;
	$rotate     = imagerotate( $source, $angle, 0 ); // if want to rotate the image
	$imageName  = $img_name . '.png';
	$path       = $path . $imageName;
	$imageSave  = imagejpeg( $rotate, $path, 100 );

	return $imageName;
}


function pages( $type ) {

	return \App\Pages::where( 'type', $type )->orderBy( 'id', 'DESC' )->select( 'id', 'name' )->get();
}


function getById( $id, $eloquentName ) {

	return $eloquentName::findOrFail( $id );

}


// get ajax request
function getAjaxCity( $col ,$id ) {

	return json_encode( \App\Cities::where( $col, $id )->select( 'id', 'name' )->get() );
}



function getAjaxGroup() {

	return json_encode(\App\Groups::orderBy( 'id', 'DESC' )->where( 'status', 1 )->get());
}

function cities() {

	return \App\Cities::orderBy( 'id', 'DESC' )->where( 'status', 1 )->select( 'id', 'name' )->get();
}

function groups() {

	return \App\Groups::orderBy( 'id', 'DESC' )->where( 'status', 1 )->get();
}

function akars() {

	return \App\Akars::orderBy( 'id', 'DESC' )->where( 'status', 1 )->select( 'id', 'name' )->get();
}

function getAjaxHay( $col , $id ) {

	return json_encode( \App\Hay::where( $col, $id )->select( 'id', 'name_' . App::getLocale() . ' as name' )->get() );
}

function getAjaxHay2(  $id,$col  ) {

	return json_encode( \App\Hay::where( $col, $id )->select( 'id', 'name' )->get() );
}

function getAjaxSubCat(  $col , $id ) {

	return json_encode( \App\sub_cts::where( $col, $id )->select( 'id', 'name' )->get() );
}

function getAjaxModel( $id, $col ) {

	return json_encode( \App\Models::where( $col, $id )->select( 'id', 'name' )->get() );
}

function countNotification() {

	if ( auth()->check() ) {

		return \App\Notifications::where( 'to_user_id', auth()->user()->id )->where( 'seen', 0 )->count();

	}
}

function collValidation( $request, $rules = [], $routeBack = 'back', $route = '' ) {


	return false;


}


function uploading2( $inputRequest, $folderNam, $resize = [] ) {

	$imageName = time() . '.' . $inputRequest->getClientOriginalExtension();

	if ( ! empty( $resize ) ) {

		foreach ( $resize as $dimensions ) {

			$destinationPath = public_path( $folderNam . '_' . $dimensions );

			$img = Image::make( $inputRequest->getRealPath() );

			$dimension = explode( 'x', $dimensions );

			$img->resize( $dimension[0], $dimension[1], function( $constraint ) {

				$constraint->aspectRatio();

			} );

			$img->insert( 'public/web/images/haraj-logo.png', 'bottom-right' );

			$img->save( $destinationPath . DIRECTORY_SEPARATOR . $imageName );


		}

	}


	$destinationPath = public_path( '/' . $folderNam );
	$inputRequest->move( $destinationPath, $imageName );

	return $imageName ? $imageName : false;


}



function uploading( $inputRequest, $folderNam, $resize = [] ) {

	$imageName = time() . rand(0, 99) .'.' . $inputRequest->getClientOriginalExtension();

	if ( ! empty( $resize ) ) {

		if(! is_dir(public_path( $folderNam))) {
				mkdir(public_path( $folderNam), 0777);
				chmod(public_path( $folderNam), 0777);
		}

		foreach ( $resize as $dimensions ) {

			$destinationPath = public_path( $folderNam . '_' . $dimensions );

			if( ! is_dir($destinationPath)) {

					mkdir($destinationPath, 0777, true);
					chmod($destinationPath, 0777);

			}
			$img = Image::make( $inputRequest->getRealPath() );

			$dimension = explode( 'x', $dimensions );

			$img->resize( $dimension[0], $dimension[1], function( $constraint ) {

				$constraint->aspectRatio();

			} );

			// $img->insert( 'public/web/images/logo-sm.png', 'bottom-right' );

			$img->save( $destinationPath . DIRECTORY_SEPARATOR . $imageName );


		}

	}


	$destinationPath = public_path( '/' . $folderNam );
	$inputRequest->move( $destinationPath, $imageName );

	return $imageName ? $imageName : false;


}


function settings() {

	return \App\Settings::where( 'id', 1 )->first();
}


function sendEmail( $fileMessagesPath, $vars = [], $attach = '' ) {

	Mail::send( $fileMessagesPath, [
		'title' => $vars['messagesTitle'],
		'token' => $vars['data']['token']
	], function( $message ) use ( $vars ) {

		$message->from( $vars['from'], $vars['messagesTitle'] );
		$message->to( $vars['to'] );
		$message->subject( $vars['subject'] );
	} );

	if ( Mail::failures() ) {
		return false;
	}

	return true;
}


// mobile API

function send_mobile_sms( $numbers, $msg ) {

	include( app_path() . '\Mobily\includeSettings.php' );
//    $mobile = "966503444442";
//    $password = "107025";
	$mobile   = "966563403905";
	$password = "123asd!@#";
	$sender   = "AAIT.SA";
//    $numbers = "966543516201,201008414435";
	$MsgID    = rand( 1, 99999 );
	$send_sms = sendSMS( $mobile, $password, $numbers, $sender, $msg, $MsgID );
	if ( $send_sms ) {
		return true;
	} else {
		return false;
	}
}

function filter_mobile_number( $mob_num ) {

	$first_3_val = substr( $mob_num, 0, 3 );
	$sixth_val   = substr( $mob_num, 0, 6 );
	$first_val   = substr( $mob_num, 0, 1 );
	$mob_number  = 0;
	$val         = 0;
	if ( $sixth_val == "009665" ) {
		$val        = null;
		$mob_number = substr( $mob_num, 2, 12 );
	} elseif ( $first_3_val == "+96" ) {
		$val        = "966";
		$mob_number = substr( $mob_num, 4 );
	} elseif ( $first_3_val == "966" ) {
		$val        = null;
		$mob_number = $mob_num;
	} elseif ( $first_val == "5" ) {
		$val        = "966";
		$mob_number = $mob_num;
	} elseif ( $first_3_val == "009" ) {
		$val        = "9";
		$mob_number = substr( $mob_num, 4 );
	} elseif ( $first_val == "0" ) {
		$val        = "966";
		$mob_number = substr( $mob_num, 1, 9 );
	} else {
		$val        = "966";
		$mob_number = $mob_num;
	}

	$real_mob_number = $val . $mob_number;

	return $real_mob_number;
}

function generate_sms_validation_code() {

	$characters          = '0123456789';
	$charactersLength    = strlen( $characters );
	$sms_validation_code = '';
	$length              = 6;
	for ( $i = 0; $i < $length; $i ++ ) {
		$sms_validation_code .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}

	return $sms_validation_code;
}
