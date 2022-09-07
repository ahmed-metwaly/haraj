<?php

namespace App\Http\Controllers\web;

use App\Notifications;
use App\Following;
use App\Ads;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{

    public function __construct()
    {
        //parent::__construct();
       /* $locale = App::getLocale();
        Carbon::setLocale($locale);*/
    }

    public function getNotification()
    {

        if (Auth::check()) {

            $data = Notifications::where('to_user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

            foreach ($data as $item) {
                $editSeen = Notifications::where('id', $item->id)->first();
                $editSeen->seen = 1;
                $editSeen->save();
            }

            return view('web.home.notification', ['data' => $data]);

        }

        return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');
    }

    public function getNotifications()
    {

        if (Auth::check()) {

            $followerData = Ads::join( 'followings', 'ads.created_by', '=', 'followings.follower_id' )->where( 'followings.following_id', Auth::user()->id )->get();

            $adData = Ads::join( 'followings', 'ads.id', '=', 'followings.ad_id' )->where( 'followings.following_id', Auth::user()->id )->join( 'comments', 'ads.id', '=', 'comments.ads_id' )->get();
            
             $data = Notifications::join( 'ads', 'ads.id', '=', 'notifications.ad_id' )->join( 'users', 'users.id', '=', 'notifications.by_user' )->where('notifications.to_user_id', Auth::user()->id)->where('notifications.seen', 0)->select('notifications.id as id','notifications.created_at as created_at','ads.id as ad_id','ads.title as ad_title','users.id as user_id' ,'users.name as username')->orderBy('notifications.id', 'DESC')->get();

             $old_data = Notifications::join( 'ads', 'ads.id', '=', 'notifications.ad_id' )->join( 'users', 'users.id', '=', 'notifications.by_user' )->where('notifications.to_user_id', Auth::user()->id)->where('notifications.seen', 1)->select('notifications.id as id','notifications.created_at as created_at','ads.id as ad_id','ads.title as ad_title','users.id as user_id' ,'users.name as username')->orderBy('notifications.id', 'DESC')->get();

//dd($old_data);
            foreach ($data as $item) {
                $editSeen = Notifications::where('id', $item->id)->first();
                $editSeen->seen = 1;
                $editSeen->save();
            }

            return view('web.home.notifications', ['data'=>$data ,'old_data'=>$old_data]);

        }

        return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');
    }


    public function getDeleteNotification($id)
    {
         $data = Notifications::findOrFail($id);
        return $data->delete() ? redirect()->back()->with('mOK', 'تم الحذف بنجاح') : redirect()->back()->with('mNo', 'لم يتم الحذف');
    }


}
