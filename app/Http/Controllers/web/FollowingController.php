<?php

namespace App\Http\Controllers\web;

use App\Following;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{

    public function __construct()
    {
        //parent::__construct();
    }

    public function getFollowings()
    {

        if (Auth::check()) {

            $data = Following::join('ads','followings.ad_id','=','ads.id')->join('users','followings.following_id','=','users.id')->join('cities','ads.city','=','cities.id')->where('followings.following_id', Auth::user()->id)->select('ads.*' , 'users.name as username' ,'users.id as user_id' ,'cities.id as city_id' ,'cities.name as city_name')->orderBy('followings.id', 'DESC')->get();

            /*foreach ($data as $item) {
                $editSeen = Notifications::where('id', $item->id)->first();
                $editSeen->seen = 1;
                $editSeen->save();
            }
*/
            return view('web.home.following', ['data' => $data]);

        }

        return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');
    }


    public function getDeletefollowingAdd($id)
    {
        if(Auth::check()){
        $data = Following::where('ad_id', $id)->where('following_id', Auth::user()->id)->first();
        return $data->delete() ? redirect()->back()->with('mOK', 'تم الحذف بنجاح') : redirect()->back()->with('mNo', 'لم يتم الحذف');
    }
    return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');

    }

    public function getDeletefollowingUser($id)
    {
        $data = Following::where('follower_id', $id)->where('following_id', Auth::user()->id)->first();
        return $data->delete() ? redirect()->back()->with('mOK', 'تم الحذف بنجاح') : redirect()->back()->with('mNo', 'لم يتم الحذف');

    }

    public function getPostfollowing($f_id,$ad_id)
    {
         
         $data = Following::where('following_id', Auth::user()->id)->where('follower_id', $f_id)->get();
         $data2 = Following::where('following_id', Auth::user()->id)->where('ad_id', $ad_id)->get();
         if(count($data)>0 && count($data2)>0){
            return redirect()->back()->with('mNo', 'تمت المتابعة من قبل') ;
         }

         $follow = new Following();
         $follow->following_id = Auth::user()->id;
         $follow->follower_id = $f_id;
         $follow->ad_id = $ad_id;
         $follow->save();
$f_id=$follow->id;
         //$data = Following::findOrFail($id);
       // return redirect()->back()->with('mOK', 'تمت المتابعة بنجاح')->with('f_id', 5) ;
        return response($f_id) ;
    }


}
