<?php

namespace App\Http\Controllers\Admin;

use App\Marks;
use App\Models;
use App\Years;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    public function getIndex() {

        $data = Models::join('users', 'models.created_by' , '=', 'users.id' )->join('marks', 'models.mark_id' , '=', 'marks.id' )->orderBy('models.id')->select('models.*','users.id as user_id' ,'users.name as username','marks.id as mark_id','marks.name as mark_name')->get();

        return view('admin.models.showAll', ['data' => $data]);
    }

    public function getAdd() {

        $marks = Marks::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name_' . App::getLocale() . ' as name')->get();
        $years = Years::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get();

        return view('admin.models.add', ['marks' => $marks, 'years' => $years]);

    }


    public function postAdd(Request $request) {

        $rules = [
            'name' => 'required|max:255',
            'mark_id' => 'required',
          //  'year_id' => 'required',
            'status' => 'required'
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('model-add')->withErrors($validator)->withInput();

        }

        $newCountry = new Models();

        $newCountry->name = $request->name;
        $newCountry->mark_id = $request->mark_id;
        //$newCountry->year_id  = $request->year_id;
        $newCountry->year_id  = 0;
        $newCountry->status  = $request->status;
        $newCountry->created_by = Auth::user()->id;

        return $newCountry->save() ?  redirect()->route('models')->with('mOk', trans('messages.addOK')) :
            redirect()->route('models')->with('mNo', trans('messages.addNo'))->withInput();

    }



    public function getEdit($id) {


        $marks = Marks::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get();
        $years = Years::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get();

        $data = Models::where('id', $id)->firstOrFail();


        return view('admin.models.edit', ['data' => $data, 'marks' => $marks, 'years' => $years]);

    }



    public function postEdit(Request $request, $id) {


        $rules = [
            'name' => 'required|max:255',
            'mark_id' => 'required',
          //  'year_id' => 'required',
            'status' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('model-edit', ['id' => $id])->withErrors($validator)->withInput();

        }


        $data = Models::find($id);


        $data->name = $request->name;
        $data->mark_id = $request->mark_id;
        $data->status  = $request->status;



        return $data->save() ?  redirect()->route('model-edit', ['id' => $id])->with('mOk', trans('admin.editOK')) :
            redirect()->route('model-edit', ['id' => $id])->with('mNo', trans('admin.editNo'))->withInput();


    }


    public function getDetails($id) {

        $data = Models::where('id', $id)->firstOrFail();
        $user = User::find($data->created_by);
        $mark = Marks::find($data->mark_id);

        return view('admin.models.details', ['data' => $data ,'user'=>$user ,'mark'=>$mark]);

    }


    public function getDelete($id) {

        return Models::destroy($id) ? redirect()->route('models')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('models')->with('mNo', trans('admin.deleteNo'))->withInput();


    }
}
