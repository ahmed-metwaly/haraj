<?php

namespace App\Http\Controllers\web;

use App\Ads;
use App\Cities;
use App\Countries;
use App\likes;
use App\User;
use App\Messages;
use App\Following;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
       // parent::__construct();

    }

    public function getProfile() {

        if(!Auth::check()) {
            return redirect('/')->with('mNo', 'يجب ان تسجل دخولك للدخول لهذة الصفحة');
        }

        $uId = Auth::user()->id;

        $userData = User::where('id', $uId)->first();

        $adsData = Ads::where('created_by', $uId)->select('id', 'title', 'city', 'created_at')->get();

        $likes = likes::where('created_by', Auth::user()->id)->select('ads_id')->get();

        $Ads = Ads::join('users','ads.created_by','=','users.id')->join('categories','ads.cat','=','categories.id')->join('sub_cts','ads.SubCat','=','sub_cts.id')->join('cities','ads.city','=','cities.id')->join('hays','ads.hay','=','hays.id')->where('ads.status','=',1)->where('ads.created_by', $uId)->select('ads.*','users.id as user_id' ,'users.name as username' ,'cities.name as city_name')->latest()->paginate( 15 );


        $adsLikesData = [];

        foreach($likes as $like) {

            $adsLikesData[] = Ads::where('id', $like->ads_id)->select('id', 'title', 'city', 'created_at')->first();

        }

        $countries = Countries::orderBy('id', 'DESC')->select('id', 'name')->get();
        $cities    = Cities::orderBy('id', 'DESC')->select('id', 'name')->get();

        $received = Messages::where( 'to_id', Auth::user()->id )->get();
        $sent = Messages::where( 'form_id', Auth::user()->id )->get();
       // SELECT * FROM `messages` WHERE `form_id`=1


    return view('web.users.profile', ['cities' => $cities, 'countries' => $countries, 'userData' => $userData, 'ads' => $Ads, 'adsLikesData' => $adsLikesData ,'sent' => $sent ,'received' => $received] );
    }


    public function getPublicProfile($id) {

       /* if(!Auth::check()) {
            return redirect('/')->with('mNo', 'يجب ان تسجل دخولك للدخول لهذة الصفحة');
        }*/

        $uId = $id;

        $userData = User::where('id', $uId)->first();

        $adsData = Ads::where('created_by', $uId)->select('id', 'title', 'city', 'created_at')->get();
        //$followingData = Following::where('following_id', Auth::user()->id)->get();

        $countries = Countries::orderBy('id', 'DESC')->select('id', 'name_ar')->get();
        $cities    = Cities::orderBy('id', 'DESC')->select('id', 'name_ar')->get();

      //  $received = Messages::where( 'to_id', Auth::user()->id )->get();
      //  $sent = Messages::where( 'form_id', Auth::user()->id )->get();
       // SELECT * FROM `messages` WHERE `form_id`=1

        //follow
        $follow=[];
        if(Auth::check()) {
        $follow = Following::where( 'following_id', Auth::user()->id )->where( 'follower_id', $uId )->first();
    }
        return view('web.users.public_profile', [ 'userData' => $userData, 'adsData' => $adsData , 'follow' => $follow] );
    }
}
