<?php

namespace App\Http\Controllers\Admin;

use App\Akars;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Categories ;
use App\sub_cts ;

class AkarController extends Controller
{
    public function getIndex() {

        $data = Akars::join('users', 'akars.created_by' , '=', 'users.id' )->orderBy('akars.id')->select('akars.*','users.id as user_id' ,'users.name as username')->get();

        return view('admin.akar.showAll', ['data' => $data]);
    }

    public function getAdd() {

        return view('admin.akar.add');

    }


    public function postAdd(Request $request) {

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required'
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('akar-add')->withErrors($validator)->withInput();

        }

        $newAkar = new Akars();

        $newAkar->name = $request->name;
        $newAkar->status  = $request->status;
        $newAkar->created_by = Auth::user()->id;
        
        $new_sub_cts = new sub_cts();

        /*if ( isset( $request->photo) && $request->photo != '') {
            $new_sub_cts->img = uploading( $request->file( 'photo' ), 'categories', [
                '50x50',
                '150x150',
                '250x250'
            ] );*/
        //} else {
            $new_sub_cts->img = '';
        //}


        $new_sub_cts->name       = $request->name;
        $new_sub_cts->status     = $request->status;
        $new_sub_cts->cat_id     = $request->cat_id;
        $new_sub_cts->created_by = Auth::user()->id;
        $new_sub_cts->save();
        
        $newAkar->subcat_id=$new_sub_cts->id;

        return $newAkar->save() ?  redirect()->route('akars')->with('mOk', trans('messages.addOK')) :
            redirect()->route('akars')->with('mNo', trans('messages.addNo'))->withInput();

    }



    public function getEdit($id) {

        $data = Akars::where('id', $id)->firstOrFail();
        $subCat=sub_cts::find($data->subcat_id);


        return view('admin.akar.edit', ['data' => $data , 'subcat'=>$subCat]);

    }



    public function postEdit(Request $request, $id) {


        $rules = [
            'name' => 'required|max:255',
            'status' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('akar-edit', ['id' => $id])->withErrors($validator)->withInput();

        }


        $data = Akars::find($id);
        $subCat=sub_cts::find($data->subcat_id);


        $data->name = $request->name;
        $data->status  = $request->status;

	$subCat->name=$request->name;
	$subCat->status  = $request->status;
	$subCat->cat_id     = $request->cat_id;
	$subCat->save();

        return $data->save() ?  redirect()->route('akar-edit', ['id' => $id])->with('mOk', trans('admin.editOK')) :
            redirect()->route('akar-edit', ['id' => $id])->with('mNo', trans('admin.editNo'))->withInput();


    }


    public function getDetails($id) {

        $data = Akars::where('id', $id)->firstOrFail();
        $user = User::find($data->created_by);

        return view('admin.akar.details', ['data' => $data ,'user'=>$user]);

    }


    public function getDelete($id) {
	$data = Akars::find($id);
	sub_cts::destroy($data->subcat_id);
        return Akars::destroy($id) ? redirect()->route('akars')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('akars')->with('mNo', trans('admin.deleteNo'))->withInput();


    }
}
