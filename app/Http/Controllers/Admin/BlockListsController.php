<?php

namespace App\Http\Controllers\Admin;

use App\Block_list;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlockListsController extends Controller
{

    public function getIndex() {

        $data = Block_list::join('users', 'block_lists.user_id' , '=', 'users.id' )->select('block_lists.*','users.id as userId' ,'users.name as username','users.email as user_email')->orderBy('block_lists.id', 'DESC')->get();

        return view('admin.block_list.showAll', ['data' => $data]);
    }

    public function getAdd() {

        $data = User::leftJoin('block_lists', 'users.id', '=', 'block_lists.user_id')->where('block_lists.user_id','=',null)->join('countries', 'users.country_id', '=' , 'countries.id')->select('users.id as id', 'users.name as name', 'users.email as email', 'users.created_at as created_at', 'countries.name as country_name')->get();


        return view('admin.block_list.add', ['data' => $data]);

    }


    public function getDoAdd($id) {

        $id = (int) $id;
        $check = Block_list::where('user_id',$id)->first();
        if($check){
            return redirect()->back()->with('mNo','تم إضافة هذا المستخدم للقائمة السوداء من قبل');
        }

        $newBlack = new Block_list();
        $newBlack->user_id    = $id;
        $newBlack->created_by = Auth::user()->id;

        return $newBlack->save() ?  redirect()->back()->with('mOk', trans('messages.addOK')) :
            redirect()->back()->with('mNo', trans('messages.addNo'))->withInput();

    }


    public function getDelete($id) {

        return Block_list::destroy($id) ? redirect()->route('black-lists')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('black-lists')->with('mNo', trans('admin.deleteNo'));


    }

}
