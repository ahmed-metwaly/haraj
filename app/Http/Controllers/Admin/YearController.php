<?php

namespace App\Http\Controllers\Admin;

use App\Years;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    public function getIndex() {

        $data = Years::join('users', 'years.created_by' , '=', 'users.id' )->orderBy('years.id')->select('years.*','users.id as user_id' , 'users.name as username')->get();

        return view('admin.years.showAll', ['data' => $data]);
    }

    public function getAdd() {


        return view('admin.years.add');

    }


    public function postAdd(Request $request) {

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required'
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('year-add')->withErrors($validator)->withInput();

        }

        //$newCountry = new Years();
        $status=$request->status;
        $data = explode(',', $request->name);
	foreach($data as $name){
	$newCountry = new Years();
        $newCountry->name = $name;
        $newCountry->status  = $status;
        $newCountry->created_by = Auth::user()->id;
        $newCountry->save();
        }
        return redirect()->route('years')->with('mOk', trans('messages.addOK'));

       // return $newCountry->save() ?  redirect()->route('years')->with('mOk', trans('messages.addOK')) :
            redirect()->route('years')->with('mNo', trans('messages.addNo'))->withInput();

    }



    public function getEdit($id) {

        $data = Years::where('id', $id)->firstOrFail();


        return view('admin.years.edit', ['data' => $data]);

    }



    public function postEdit(Request $request, $id) {


        $rules = [
            'name' => 'required|max:255',
            'status' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('year-edit', ['id' => $id])->withErrors($validator)->withInput();

        }


        $data = Years::find($id);


        $data->name = $request->name;
        $data->status  = $request->status;



        return $data->save() ?  redirect()->route('year-edit', ['id' => $id])->with('mOk', trans('admin.editOK')) :
            redirect()->route('year-edit', ['id' => $id])->with('mNo', trans('admin.editNo'))->withInput();


    }


    public function getDetails($id) {

        $data = Years::where('id', $id)->firstOrFail();
        $user = User::find($data->created_by);

        return view('admin.years.details', ['data' => $data ,'user'=>$user]);

    }


    public function getDelete($id) {

        return Years::destroy($id) ? redirect()->route('years')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('years')->with('mNo', trans('admin.deleteNo'))->withInput();


    }
}
