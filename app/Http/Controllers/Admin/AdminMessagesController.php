<?php

namespace App\Http\Controllers\Admin;

use App\Admin_messages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminMessagesController extends Controller
{

    public function getIndex() {

        $data = Admin_messages::orderBy('id', 'DESC')->get();

        return view('admin.admin_messages.showAll', ['data' => $data]);
    }


    public function getDetails($id) {

        $data = Admin_messages::where('id', $id)->firstOrFail();
      //  $data = Admin_messages::where('id', $id)->join('users','admin_messages.','=','users.id')->select('')firstOrFail();

        return view('admin.admin_messages.details', ['data' => $data]);

    }


    public function getDelete($id) {

        return Admin_messages::destroy($id) ? redirect()->route('admin-messages')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('admin-messages')->with('mNo', trans('admin.deleteNo'));


    }



}
