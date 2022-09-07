<?php


Route::get('/ajax-data/{id}/{col}', function ($id, $col) {

    return getAjaxCity($id, $col);
});


Route::get('/ajax-hay-data/{id}/{col}', function ($id, $col) {

    return getAjaxHay2($id, $col);
});

Route::get('/ajax-group-data', function () {

    return getAjaxGroup();
});

Route::get('/ajax-model-data/{id}/{col}', function ($id, $col) {

    
    return getAjaxModel($id, $col);
});


Route::get( '/add-like/{id}', 'web\UserController@addlike' );

// remove like
Route::get( '/remove-like/{id}', 'web\UserController@Remove_like' );

Route::get( 'register', [
	'uses' => 'web\UserController@getRegister',
	'as'   => 'register'
] );

Route::get( 'login', [
	'uses' => 'web\UserController@getLogin',
	'as'   => 'login'
] );

Route::post( 'register-user', [
	'uses' => 'web\UserController@postAddUser',
	'as'   => 'register-user'
] );

Route::post( 'login-user', [
	'uses' => 'web\UserController@postLogin',
	'as'   => 'login-user'
] );

Route::get( 'logout', [
	'uses' => 'web\UserController@getLogout',
	'as'   => 'logout'
] );


Route::get( '/', [
	'uses' => 'web\HomeController@getIndex',
	'as'   => 'home'
] );

Route::get( '/contact-us', [
	'uses' => 'web\HomeController@getContact',
	'as'   => 'contact-us'
] );


Route::post( '/contact-do-us', [
	'uses' => 'web\HomeController@postContact',
	'as'   => 'contact-do-us'
] );

Route::get( '/page/{id}', [
	'uses' => 'web\HomeController@getPage',
	'as'   => 'page'
] );


Route::get( '/blackList', [
	'uses' => 'web\HomeController@getBlackList',
	'as'   => 'black-list'
] );

Route::post( '/do-blackList', [
	'uses' => 'web\HomeController@postBlackList',
	'as'   => 'do-black-list'
] );


Route::get( '/Blacklisted', [
	'uses' => 'web\HomeController@getBlacklisted',
	'as'   => 'Blacklisted'
] );

Route::get( '/ActivateUser/{active}', [
	'uses' => 'web\UserController@getActiveEmail',
	'as'   => 'ActiveEmail'
] );

Route::get( '/ActivateAdmin/{active}', [
	'uses' => 'Admin\AdminController@getActiveEmail',
	'as'   => 'AdminActiveEmail'
] );


Route::group( [ 'prefix' => 'messages' ], function() {

	Route::get( '', [
		'uses' => 'web\MessagesController@getMessage',
		'as'   => 'add-message'
	] );
	
	Route::post( '/add', [
		'uses' => 'web\MessagesController@postAdd',
		'as'   => 'do-add-message'
	] );

	Route::get( '/send-msg/{id}', [
		'uses' => 'web\MessagesController@getMsg',
		'as'   => 'send-msg'
	] );

	Route::get( '/sent', [
		'uses' => 'web\MessagesController@getSentMessage',
		'as'   => 'sent-messages'
	] );

	Route::get( '/received', [
		'uses' => 'web\MessagesController@getReceivedMessage',
		'as'   => 'received-messages'
	] );


} );

Route::group( [ 'prefix' => 'ads' ], function() {

	Route::get( '/add', [
		'uses' => 'web\AdsController@getAdsAdd',
		'as'   => 'ad-add'
	] );

	Route::post( 'do-add', [
		'uses' => 'web\AdsController@postAdsAdd',
		'as'   => 'ad-do-add'
	] );

	Route::get( '/add-delete/{id}', [
		'uses' => 'web\AdsController@getDeleteAds',
		'as'   => 'add-delete'
	] );

	Route::get( '/add-edit/{id}', [
		'uses' => 'web\AdsController@getEditAds',
		'as'   => 'add-edit'
	] );

	Route::post( '/add-do-edit/{id}', [
		'uses' => 'web\AdsController@postEditAds',
		'as'   => 'add-do-edit'
	] );

	Route::get( 'delete-img/{id}', [
		'uses' => 'web\AdsController@getDeleteImg',
		'as'   => 'delete-ads-img'
	] );

	Route::get( 'view/{id}', [
		'uses' => 'web\AdsController@getOneAd',
		'as'   => 'ad-view'
	] );

	Route::get( 'next-ad/{id}', [
		'uses' => 'web\AdsController@getNextAd',
		'as'   => 'next-ad'
	] );

	Route::post( 'add-comment', [
		'uses' => 'web\AdsController@postAddComment',
		'as'   => 'add-comment'
	] );

	Route::get( 'delete-comment/{id}', [
		'uses' => 'web\AdsController@getDeleteComment',
		'as'   => 'delete-comment'
	] );

	Route::get( 'report/{id}', [
		'uses' => 'web\AdsController@getReports',
		'as'   => 'add-report'
	] );

	Route::post( 'do-report/{id}', [
		'uses' => 'web\AdsController@postReports',
		'as'   => 'do-add-report'
	] );

	Route::get( 'proAd/{id}', [
		'uses' => 'web\AdsController@proAd',
		'as'   => 'pro-ad'
	] );

	Route::get( 'disproAd/{id}', [
		'uses' => 'web\AdsController@disproAd',
		'as'   => 'dis-pro-ad'
	] );

	Route::get( '/city/{id}', [
		'uses' => 'web\HomeController@getCityById',
		'as'   => 'get-city'
	] );

	Route::get( '/subcat/{id}', [
		'uses' => 'web\HomeController@getSubcatById',
		'as'   => 'get-subcat'
	] );


} );


//bank_transfer

Route::group( [ 'prefix' => 'bank-transfers' ], function() {	
	Route::get( 'transfer', [
			'uses' => 'web\BankTransfersController@getTransfer',
			'as'   => 'add-commission-transfer'
		] );

	Route::get( '/', [
			'uses' => 'web\BankTransfersController@getSubscribeTransfer',
			'as'   => 'add-subscribe-transfer'
		] );

	Route::post( 'do-transfer', [
			'uses' => 'web\BankTransfersController@postTransfer',
			'as'   => 'do-add-transfer'
		] );
	Route::post( 'do-subscribe-transfer', [
			'uses' => 'web\BankTransfersController@postCommTransfer',
			'as'   => 'do-add-subscribe-transfer'
		] );
	Route::get( 'transfer-pro/{id}', [
			'uses' => 'web\BankTransfersController@proUser',
			'as'   => 'transfer-pro'
		] );

	Route::get( 'transfer-dispro/{id}', [
			'uses' => 'web\BankTransfersController@disproUser',
			'as'   => 'transfer-dispro'
		] );

});


Route::group( [ 'prefix' => 'user' ], function() {

	Route::get( '/profile', [
		'uses' => 'web\ProfileController@getProfile',
		'as'   => 'user-profile'
	] );

	Route::post( 'edit/{id}', [
		'uses' => 'web\UserController@postEditUser',
		'as'   => 'user-edit'
	] );

	Route::get( '/user-profile/{id}', [
		'uses' => 'web\ProfileController@getPublicProfile',
		'as'   => 'public-profile'
	] );

} );

Route::group( [ 'prefix' => 'category' ], function() {

	Route::get( '/cat/{id}', [
		'uses' => 'web\HomeController@getCatById',
		'as'   => 'get-cat'
	] );

	Route::get( '/ads', [
		'uses' => 'web\HomeController@getlastadpercat',
		'as'   => 'search-ads-cat'
	] );


} );

Route::group( [ 'prefix' => 'search' ], function() {

	Route::get( '', [
		'uses' => 'web\HomeController@getSearchForm',
		'as'   => 'search'
	] );

	Route::get( '/ads', [
		'uses' => 'web\HomeController@getSearch',
		'as'   => 'search-ads'
	] );

	

	Route::get( '/akar', [
		'uses' => 'web\HomeController@getSearshAkar',
		'as'   => 'search-akar'
	] );
	
	Route::get( '/car', [
		'uses' => 'web\HomeController@getSearchCar',
		'as'   => 'search-car'
	] );

	Route::get( '/cars', [
		'uses' => 'web\HomeController@getSearchCars',
		'as'   => 'search-cars'
	] );
	
	Route::get( '/category', [
		'uses' => 'web\HomeController@getSubCats',
		'as'   => 'search-cat'
	] );
	
	Route::get( '/marks', [
		'uses' => 'web\HomeController@getMarks',
		'as'   => 'search-mark'
	] );
	
	Route::get( '/model/{id}', [
		'uses' => 'web\HomeController@searchModel',
		'as'   => 'search-model'
	] );
	
	


} );


Route::group( [ 'prefix' => 'notification' ], function() {

	Route::get( '/show', [
		'uses' => 'web\NotificationController@getNotification',
		'as'   => 'all-notif'
	] );

	Route::get( '/delete/{id}', [
		'uses' => 'web\NotificationController@getDeleteNotification',
		'as'   => 'delete-notif'
	] );

	Route::get( '', [
		'uses' => 'web\NotificationController@getNotifications',
		'as'   => 'all-notifs'
	] );

} );

Route::group( [ 'prefix' => 'followings' ], function() {

	Route::get( '/show', [
		'uses' => 'web\FollowingController@getFollowings',
		'as'   => 'all-followings'
	] );

	Route::get( '/delete/{id}', [
		'uses' => 'web\FollowingController@getDeleteFollowingAdd',
		'as'   => 'delete-following'
	] );

	Route::get( '/deletefollower/{id}', [
		'uses' => 'web\FollowingController@getDeleteFollowingUser',
		'as'   => 'delete-follower'
	] );

	Route::get( '/save/{id}/{ad_id}', [
		'uses' => 'web\FollowingController@getPostfollowing',
		'as'   => 'save-following'
	] );

} );

Route::group( [ 'prefix' => 'favourites' ], function() {

	Route::get( '/show', [
		'uses' => 'web\FavouriteController@getFavorites',
		'as'   => 'all-favorites'
	] );

	Route::get( '/remove-favorite/{id}', [
		'uses' => 'web\FavouriteController@Remove_favorite',
		'as'   => 'remove-favorite'
	] );

	Route::get( '/add-favorite/{id}', [
		'uses' => 'web\FavouriteController@addfavorite',
		'as'   => 'add-favorite'
	] );

} );


// dashboard


// admin login

Route::get( '/admin-login', 'Admin\AdminController@getLogin' )->name( 'admin-login' );
Route::post( '/login-admin', 'Admin\AdminController@postLogin' );

Route::get( '/login-admin-forget', 'Admin\AdminController@getForgetPassword' );
Route::post( '/login-admin-do-forget', 'Admin\AdminController@postForgetPassword' );

Route::get( '/login-user-forget', 'web\UserController@getForgetPassword' );

Route::post( '/login-user-do-forget', 'web\UserController@postForgetPassword' );


Route::get( '/ajax-data/{col}/{id}', function( $id, $col ) {

	return getAjaxCity( $col , $id );
} );

Route::get( '/ajax-data2/{id}/{col}', function( $id, $col ) {

	return getAjaxCity( $col , $id );
} );


Route::get( '/ajax-hay-data/{col}/{id}', function( $col , $id ) {

	return getAjaxHay( $col , $id);
} );

Route::get( '/ajax-subcat-data/{col}/{id}', function( $id, $col ) {

	return getAjaxSubCat( $id, $col );
} );

Route::get( '/ajax-model-data/{id}/{col}', function( $id, $col ) {

	return getAjaxModel( $id, $col );
} );

/////////////////

// dashboard

Route::group( [ 'middleware' => 'dashboard', 'prefix' => 'dashboard' ], function() {

	// ajax


	// get dashboard
	Route::get( '/', [
		'uses' => 'Admin\SettingsController@getDashboard',
		'as'   => 'dashboard'
	] );

	Route::group( [ 'prefix' => 'settings' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\SettingsController@getSettingsData',
			'as'   => 'settings'
		] );

		Route::post( 'settings-do-edit', [
			'uses' => 'Admin\SettingsController@postSaveSettings',
			'as'   => 'settings-do-edit'
		] );
	} );


	Route::group( [ 'prefix' => 'AdminAds' ], function() {

		Route::get( '/Active', [
			'uses' => 'Admin\AdsController@GetAllActiveAdds',
			'as'   => 'AdminActiveAds'
		] );

		Route::get( '/notActive', [
			'uses' => 'Admin\AdsController@GetAllNotActiveAdds',
			'as'   => 'AdminNotActiveAds'
		] );

		Route::get( '/add', [
			'uses' => 'Admin\AdsController@Add_Ad',
			'as'   => 'AdminAdd-Ad'
		] );
		
		Route::get( '/deleteAd/{id}', [
			'uses' => 'Admin\AdsController@getDeleteAds',
			'as'   => 'delete-ad'
		]);


	} );
	// Admins
	Route::group( [ 'prefix' => 'admins' ], function() {

		// show all admins
		Route::get( '/', [
			'uses' => 'Admin\AdminController@getAdmins',
			'as'   => 'admins'
		] );
		Route::get( '/users', [
			'uses' => 'Admin\AdminController@getUsers',
			'as'   => 'users'
		] );

		// show add form
		Route::get( 'add', [
			'uses' => 'Admin\AdminController@getAddAdmin',
			'as'   => 'admin-add'
		] );

		// send form request
		Route::post( 'do-add', [
			'uses' => 'Admin\AdminController@postAddAdmin',
			'as'   => 'admin-do-add'
		] );

		// show admin details
		Route::get( 'details/{id}', [
			'uses' => 'Admin\AdminController@getAdminDetails',
			'as'   => 'admin-details'
		] );

		// show admin data in edit view
		Route::get( 'edit/{id}', [
			'uses' => 'Admin\AdminController@getEditAdmin',
			'as'   => 'admin-edit'
		] );

		// send new admin data from form request to update
		Route::post( 'do-edit/{id}', [
			'uses' => 'Admin\AdminController@postEditAdmin',
			'as'   => 'admin-do-edit'
		] );

		// delete admin
		Route::get( 'delete/{id}', [
			'uses' => 'Admin\AdminController@getDeleteAdmin',
			'as'   => 'admin-delete'
		] );


	} );

	// groups
	Route::group( [ 'prefix' => 'levels' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\GroupController@getIndex',
			'as'   => 'levels'
		] );

		Route::get( 'level-add', [
			'uses' => 'Admin\GroupController@getAdd',
			'as'   => 'level-add'
		] );

		Route::post( 'level-do-add', [
			'uses' => 'Admin\GroupController@postAdd',
			'as'   => 'level-do-add'
		] );

		Route::get( 'level-edit/{id}', [
			'uses' => 'Admin\GroupController@getEdit',
			'as'   => 'level-edit'
		] );

		Route::post( 'level-do-edit/{id}', [
			'uses' => 'Admin\GroupController@postEdit',
			'as'   => 'level-do-edit'
		] );

		Route::get( 'level-delete/{id}', [
			'uses' => 'Admin\GroupController@getDelete',
			'as'   => 'level-delete'
		] );

		Route::get( 'level-details/{id}', [
			'uses' => 'Admin\GroupController@getDetails',
			'as'   => 'level-details'
		] );

	} );

	// countries
	Route::group( [ 'prefix' => 'countries' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\CountryController@getIndex',
			'as'   => 'countries'
		] );

		Route::get( 'country-add', [
			'uses' => 'Admin\CountryController@getAdd',
			'as'   => 'country-add'
		] );

		Route::post( 'country-do-add', [
			'uses' => 'Admin\CountryController@postAdd',
			'as'   => 'country-do-add'
		] );

		Route::get( 'country-edit/{id}', [
			'uses' => 'Admin\CountryController@getEdit',
			'as'   => 'country-edit'
		] );

		Route::post( 'country-do-edit/{id}', [
			'uses' => 'Admin\CountryController@postEdit',
			'as'   => 'country-do-edit'
		] );

		Route::get( 'country-delete/{id}', [
			'uses' => 'Admin\CountryController@getDelete',
			'as'   => 'country-delete'
		] );

		Route::get( 'country-details/{id}', [
			'uses' => 'Admin\CountryController@getDetails',
			'as'   => 'country-details'
		] );

	} );

	// cities
	Route::group( [ 'prefix' => 'cities' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\CityController@getIndex',
			'as'   => 'cities'
		] );

		Route::get( 'city-add', [
			'uses' => 'Admin\CityController@getAdd',
			'as'   => 'city-add'
		] );

		Route::post( 'city-do-add', [
			'uses' => 'Admin\CityController@postAdd',
			'as'   => 'city-do-add'
		] );

		Route::get( 'city-edit/{id}', [
			'uses' => 'Admin\CityController@getEdit',
			'as'   => 'city-edit'
		] );

		Route::post( 'city-do-edit/{id}', [
			'uses' => 'Admin\CityController@postEdit',
			'as'   => 'city-do-edit'
		] );

		Route::get( 'city-delete/{id}', [
			'uses' => 'Admin\CityController@getDelete',
			'as'   => 'city-delete'
		] );

		Route::get( 'city-details/{id}', [
			'uses' => 'Admin\CityController@getDetails',
			'as'   => 'city-details'
		] );


	} );


	Route::group( [ 'prefix' => 'hay' ], function() {


		Route::get( '/', [
			'uses' => 'Admin\HayController@getIndex',
			'as'   => 'hay'
		] );

		Route::get( 'hay-add', [
			'uses' => 'Admin\HayController@getAdd',
			'as'   => 'hay-add'
		] );

		Route::post( 'hay-do-add', [
			'uses' => 'Admin\HayController@postAdd',
			'as'   => 'hay-do-add'
		] );

		Route::get( 'hay-edit/{id}', [
			'uses' => 'Admin\HayController@getEdit',
			'as'   => 'hay-edit'
		] );

		Route::post( 'hay-do-edit/{id}', [
			'uses' => 'Admin\HayController@postEdit',
			'as'   => 'hay-do-edit'
		] );

		Route::get( 'hay-delete/{id}', [
			'uses' => 'Admin\HayController@getDelete',
			'as'   => 'hay-delete'
		] );

		Route::get( 'hay-details/{id}', [
			'uses' => 'Admin\HayController@getDetails',
			'as'   => 'hay-details'
		] );


	} );

	// categories
	Route::group( [ 'prefix' => 'categories' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\CategoryController@getIndex',
			'as'   => 'categories'
		] );

		Route::get( '/SubCategories', [
			'uses' => 'Admin\SubCatController@getSubCat',
			'as'   => 'SubCategories'
		] );

		Route::get( 'category-add', [
			'uses' => 'Admin\CategoryController@getAdd',
			'as'   => 'category-add'
		] );

		Route::get( 'sub-category-add', [
			'uses' => 'Admin\SubCatController@getSubAdd',
			'as'   => 'sub-category-add'
		] );

		Route::post( 'Subcat-do-add', [
			'uses' => 'Admin\SubCatController@postAdd',
			'as'   => 'Subcat-do-add'
		] );

		Route::post( 'category-do-add', [
			'uses' => 'Admin\CategoryController@postAdd',
			'as'   => 'category-do-add'
		] );

		Route::get( 'category-edit/{id}', [
			'uses' => 'Admin\CategoryController@getEdit',
			'as'   => 'category-edit'
		] );

		Route::post( 'category-do-edit/{id}', [
			'uses' => 'Admin\CategoryController@postEdit',
			'as'   => 'category-do-edit'
		] );

		Route::get( 'category-delete/{id}', [
			'uses' => 'Admin\CategoryController@getDelete',
			'as'   => 'category-delete'
		] );

		Route::get( 'category-details/{id}', [
			'uses' => 'Admin\CategoryController@getDetails',
			'as'   => 'category-details'
		] );


		Route::get( 'SubCat-edit/{id}', [
			'uses' => 'Admin\SubCatController@SubgetEdit',
			'as'   => 'SubCat-edit'
		] );

		Route::post( 'SubCat-do-edit/{id}', [
			'uses' => 'Admin\SubCatController@SubpostEdit',
			'as'   => 'SubCat-do-edit'
		] );

		Route::get( 'SubCat-delete/{id}', [
			'uses' => 'Admin\SubCatController@getDelete',
			'as'   => 'SubCat-delete'
		] );

		Route::get( 'SubCat-details/{id}', [
			'uses' => 'Admin\SubCatController@getSubDetails',
			'as'   => 'SubCat-details'
		] );

	} );


	Route::group( [ 'prefix' => 'marks' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\MarkController@getIndex',
			'as'   => 'marks'
		] );

		Route::get( 'mark-add', [
			'uses' => 'Admin\MarkController@getAdd',
			'as'   => 'mark-add'
		] );

		Route::post( 'mark-do-add', [
			'uses' => 'Admin\MarkController@postAdd',
			'as'   => 'mark-do-add'
		] );

		Route::get( 'mark-edit/{id}', [
			'uses' => 'Admin\MarkController@getEdit',
			'as'   => 'mark-edit'
		] );

		Route::post( 'mark-do-edit/{id}', [
			'uses' => 'Admin\MarkController@postEdit',
			'as'   => 'mark-do-edit'
		] );

		Route::get( 'mark-delete/{id}', [
			'uses' => 'Admin\MarkController@getDelete',
			'as'   => 'mark-delete'
		] );

		Route::get( 'mark-details/{id}', [
			'uses' => 'Admin\MarkController@getDetails',
			'as'   => 'mark-details'
		] );

	} );

	Route::group( [ 'prefix' => 'models' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\ModelController@getIndex',
			'as'   => 'models'
		] );

		Route::get( 'model-add', [
			'uses' => 'Admin\ModelController@getAdd',
			'as'   => 'model-add'
		] );

		Route::post( 'model-do-add', [
			'uses' => 'Admin\ModelController@postAdd',
			'as'   => 'model-do-add'
		] );

		Route::get( 'model-edit/{id}', [
			'uses' => 'Admin\ModelController@getEdit',
			'as'   => 'model-edit'
		] );

		Route::post( 'model-do-edit/{id}', [
			'uses' => 'Admin\ModelController@postEdit',
			'as'   => 'model-do-edit'
		] );

		Route::get( 'model-delete/{id}', [
			'uses' => 'Admin\ModelController@getDelete',
			'as'   => 'model-delete'
		] );

		Route::get( 'model-details/{id}', [
			'uses' => 'Admin\ModelController@getDetails',
			'as'   => 'model-details'
		] );

	} );

	Route::group( [ 'prefix' => 'years' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\YearController@getIndex',
			'as'   => 'years'
		] );

		Route::get( 'year-add', [
			'uses' => 'Admin\YearController@getAdd',
			'as'   => 'year-add'
		] );

		Route::post( 'year-do-add', [
			'uses' => 'Admin\YearController@postAdd',
			'as'   => 'year-do-add'
		] );

		Route::get( 'year-edit/{id}', [
			'uses' => 'Admin\YearController@getEdit',
			'as'   => 'year-edit'
		] );

		Route::post( 'year-do-edit/{id}', [
			'uses' => 'Admin\YearController@postEdit',
			'as'   => 'year-do-edit'
		] );

		Route::get( 'year-delete/{id}', [
			'uses' => 'Admin\YearController@getDelete',
			'as'   => 'year-delete'
		] );

		Route::get( 'year-details/{id}', [
			'uses' => 'Admin\YearController@getDetails',
			'as'   => 'year-details'
		] );

	} );


	//akars
	Route::group( [ 'prefix' => 'akars' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\AkarController@getIndex',
			'as'   => 'akars'
		] );

		Route::get( 'page-add', [
			'uses' => 'Admin\AkarController@getAdd',
			'as'   => 'akar-add'
		] );

		Route::post( 'category-do-add', [
			'uses' => 'Admin\AkarController@postAdd',
			'as'   => 'akar-do-add'
		] );

		Route::get( 'akar-edit/{id}', [
			'uses' => 'Admin\AkarController@getEdit',
			'as'   => 'akar-edit'
		] );

		Route::post( 'akar-do-edit/{id}', [
			'uses' => 'Admin\AkarController@postEdit',
			'as'   => 'akar-do-edit'
		] );

		Route::get( 'akar-delete/{id}', [
			'uses' => 'Admin\AkarController@getDelete',
			'as'   => 'akar-delete'
		] );

		Route::get( 'akar-details/{id}', [
			'uses' => 'Admin\AkarController@getDetails',
			'as'   => 'akar-details'
		] );

	} );

	//pages
	Route::group( [ 'prefix' => 'pages' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\PageController@getIndex',
			'as'   => 'pages'
		] );

		Route::get( 'page-add', [
			'uses' => 'Admin\PageController@getAdd',
			'as'   => 'page-add'
		] );

		Route::post( 'page-do-add', [
			'uses' => 'Admin\PageController@postAdd',
			'as'   => 'page-do-add'
		] );

		Route::get( 'page-edit/{id}', [
			'uses' => 'Admin\PageController@getEdit',
			'as'   => 'page-edit'
		] );

		Route::post( 'page-do-edit/{id}', [
			'uses' => 'Admin\PageController@postEdit',
			'as'   => 'page-do-edit'
		] );

		Route::get( 'page-delete/{id}', [
			'uses' => 'Admin\PageController@getDelete',
			'as'   => 'page-delete'
		] );

		Route::get( 'page-details/{id}', [
			'uses' => 'Admin\PageController@getDetails',
			'as'   => 'page-details'
		] );

	} );

	// reports
	Route::group( [ 'prefix' => 'reports' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\ReportsController@getIndex',
			'as'   => 'reports'
		] );


		Route::get( 'report-delete/{id}', [
			'uses' => 'Admin\ReportsController@getDelete',
			'as'   => 'report-delete'
		] );

		Route::get( 'report-details/{id}', [
			'uses' => 'Admin\ReportsController@getDetails',
			'as'   => 'report-details'
		] );

	} );

	// Transfers
	Route::group( [ 'prefix' => 'transfers' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\BankAccountsController@getTransfers',
			'as'   => 'transfers-list'
		] );

		Route::get( '/members', [
			'uses' => 'Admin\BankAccountsController@getsubscribeTransfers',
			'as'   => 'subscribe-transfer-list'
		] );


		Route::get( 'transfer-delete/{id}', [
			'uses' => 'Admin\BankAccountsController@deleteTransfer',
			'as'   => 'transfer-delete'
		] );

		

	} );

	// block_list
	Route::group( [ 'prefix' => 'black-lists' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\BlockListsController@getIndex',
			'as'   => 'black-lists'
		] );

		Route::get( 'black-add', [
			'uses' => 'Admin\BlockListsController@getAdd',
			'as'   => 'black-add'
		] );

		Route::get( 'black-do-add/{id}', [
			'uses' => 'Admin\BlockListsController@getDoAdd',
			'as'   => 'black-do-add'
		] );


		Route::get( 'black-delete/{id}', [
			'uses' => 'Admin\BlockListsController@getDelete',
			'as'   => 'black-delete'
		] );


	} );


	// bank_accounts
	Route::group( [ 'prefix' => 'bank-accounts' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\BankAccountsController@getIndex',
			'as'   => 'bank-accounts'
		] );

		Route::get( 'bank-add', [
			'uses' => 'Admin\BankAccountsController@getAdd',
			'as'   => 'bank-add'
		] );

		Route::post( 'bank-do-add', [
			'uses' => 'Admin\BankAccountsController@getDoAdd',
			'as'   => 'bank-do-add'
		] );

		Route::get( 'bank-edit/{id}', [
			'uses' => 'Admin\BankAccountsController@getEdit',
			'as'   => 'bank-edit'
		] );

		Route::post( 'bank-do-edit/{id}', [
			'uses' => 'Admin\BankAccountsController@postEdit',
			'as'   => 'bank-do-edit'
		] );

		Route::get( 'bank-delete/{id}', [
			'uses' => 'Admin\BankAccountsController@getDelete',
			'as'   => 'bank-delete'
		] );


	} );


	Route::group( [ 'prefix' => 'admin-messages' ], function() {

		Route::get( '/', [
			'uses' => 'Admin\AdminMessagesController@getIndex',
			'as'   => 'admin-messages'
		] );


		Route::get( 'admin-message-delete/{id}', [
			'uses' => 'Admin\AdminMessagesController@getDelete',
			'as'   => 'admin-message-delete'
		] );


		Route::get( 'admin-message-details/{id}', [
			'uses' => 'Admin\AdminMessagesController@getDetails',
			'as'   => 'admin-message-details'
		] );

	} );

} );


Route::get( '/ActivateUser/{active}', [
	'uses' => 'web\UserController@getActiveEmail2',
	'as'   => 'UserActiveEmail'
] );

Route::get( '/resetPassword/{active}', [
	'uses' => 'web\UserController@getRestPassword',
	'as'   => 'reset-password'
] );

Route::post( '/postRestPassword', [
	'uses' => 'web\UserController@postRestPassword',
	'as'   => 'post-reset-password'
] );
