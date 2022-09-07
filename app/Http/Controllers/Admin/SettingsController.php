<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {

	public function getSettingsData() {

		$data = getById( 1, 'App\Settings' );

		return view( 'admin.settings.showAData', [ 'data' => $data ] );

	}

	public function postSaveSettings( Request $request ) {

		$rules = [
			'site_name'         => 'required|max:255',
			'site_email'           => 'required|max:255',
			'site_phone'           => 'required|max:255',
			//'site_keyword'      => 'required|max:255',
			'site_description'  => 'required|max:255',
			'status'               => 'required',
			'site_fb'              => 'required',
			'site_tw'              => 'required',
			'site_go'              => 'required',
			'site_inst'            => 'required',
			'site_yout'            => 'required',
			//'site_close_messge' => 'required',
			'site_comments_status' => 'required',
			'site_slider_status'   => 'required',
			//'subscribe'            =>'required'

		];

		collValidation( $request, $rules );

		$saveData = Settings::find( 1 );
		if ( ! isset( $saveData ) ) {
			return back()->withErrors( [ 'Err' => 'خطأ فى قاعده البيانات برجاء التواصل مع فريق أوامر الشبكة' ] );
		}

		$saveData->site_name         = $request->site_name;
		$saveData->site_email           = $request->site_email;
		$saveData->site_phone           = $request->site_phone;
		$saveData->site_keyword      = $request->site_keyword;
		$saveData->site_description  = $request->site_description;
		$saveData->last_update_by       = Auth::user()->id;
		$saveData->status               = $request->status;
		$saveData->site_fb              = $request->site_fb;
		$saveData->site_tw              = $request->site_tw;
		$saveData->site_go              = $request->site_go;
		$saveData->site_inst            = $request->site_inst;
		$saveData->site_yout            = $request->site_yout;
		$saveData->site_close_messge = $request->site_close_messge;
		$saveData->site_comments_status = $request->site_comments_status;
		$saveData->commission = $request->commission;
		$saveData->commission_count = $request->commission_count;
		$saveData->site_slider_status   = 0;
		$saveData->subscribe = $request->subscribe ;
		$saveData->black_ads = $request->black_ads ;


		return $saveData->save() ? redirect()->route( 'settings' )->with( 'mOk', trans( 'messages.updateTrue' ) ) : redirect()->route( 'settings' )->with( 'mNo', trans( 'messages.updateFalse' ) );

	}

	public function getDashboard() {

		$data = '';

		return view( 'admin.settings.dashboard', [ 'data' => $data ] );

	}
}
