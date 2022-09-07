<?php

namespace App\Http\Controllers\web;

use App\Favorites;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function __construct()
    {
        //parent::__construct();
    }

    public function getFavorites()
    {

        if (Auth::check()) {

            $data = Favorites::join('ads','favorites.ads_id','=','ads.id')->join('users','favorites.created_by','=','users.id')->join('cities','ads.city','=','cities.id')->where('favorites.created_by', Auth::user()->id)->select('ads.*' , 'users.name as username' ,'users.id as user_id' ,'cities.id as city_id' ,'cities.name as city_name')->orderBy('favorites.id', 'DESC')->get();

            /*foreach ($data as $item) {
                $editSeen = Notifications::where('id', $item->id)->first();
                $editSeen->seen = 1;
                $editSeen->save();
            }
*/
            return view('web.home.favourites', ['data' => $data]);

        }

        return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');
    }


    public function getDeleteFavoriteAdd($id)
    {
        if(Auth::check()){
        $data = Favorites::where('ads_id', $id)->where('created_by', Auth::user()->id)->first();
        return $data->delete() ? redirect()->back()->with('mOK', 'تم الحذف بنجاح') : redirect()->back()->with('mNo', 'لم يتم الحذف');
    }
    return back()->with('mNo', 'يجب ا تسجل دخولك تتمكن من مشهدة هذة الصفحة');

    }


    public function getPostFavorite($ad_id)
    {
         
         $data = Favorites::where('created_by', Auth::user()->id)->where('ads_id', $ad_id)->get();
         if(count($data)>0){
           // return redirect()->back()->with('mNo', 'تمت الإضافة للمفضلة من قبل') ;
            return response()->json(['error'=>1]) ;
         }

         $favourite = new Favorites();
         $favourite ->created_by = Auth::user()->id;
         $favourite ->ads_id = $ad_id;
         $favourite ->save();

         //$data = Following::findOrFail($id);
       // return redirect()->back()->with('mOK', 'تمت المتابعة بنجاح')->with('f_id', 5) ;
        return response()->json(['error'=>0]) ;
    }

    public function addfavorite( Request $request, $id ) {

        if ( $request->ajax() ) {
            if ( auth()->check() ) {

                $newLike             = new Favorites();
                $newLike->ads_id     = $id;
                $newLike->created_by = auth()->user()->id;
                if ( $newLike->save() ) {

                    $toUserData = \App\Ads::where( 'id', $id )->first();

                    $newNotif = new \App\Notifications();

                    $newNotif->ad_id      = $id;
                    $newNotif->by_user    = auth()->user()->id;
                    $newNotif->to_user_id = $toUserData->created_by;
                    $newNotif->type       = 'favorite';
                    $newNotif->seen       = 0;
                    $newNotif->save();

                    return response()->json( ['error'=>0], 200 );
                }
            } else {
                return response()->json( [
                    'error' => 1 ,'msg'=>'يجب أن تسجل الدخول'
                ]);
            }
        }
    }

    public function Remove_favorite( Request $request, $id ) {

        if ( $request->ajax() ) {
            if ( auth()->check() ) {
                $removeLike = Favorites::where( 'ads_id', $id )->where( 'created_by', auth()->user()->id )->first();

                if ( $removeLike->delete() ) {

                    $removeNotif = \App\Notifications::where( 'ad_id', $id )->where( 'by_user', auth()->user()->id )->where('type','favorite')->first();

                    $removeNotif->delete();

                    return response()->json( [], 200 );

                }

            } else {
                return response()->json( [
                    'error' => 'Error Not Auth'
                ], 401 );
            }
        }
    }

}
