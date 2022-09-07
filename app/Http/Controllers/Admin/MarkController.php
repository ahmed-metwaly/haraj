<?php

namespace App\Http\Controllers\Admin;


use App\Marks;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Categories ;
use App\sub_cts ;

class MarkController extends Controller
{
    public function getIndex() {
        $data = Marks::join('users', 'marks.created_by' , '=', 'users.id' )->join('sub_cts', 'marks.subcat_id' , '=', 'sub_cts.id' )->orderBy('marks.id')->select('marks.*','users.id as user_id','users.name as username')->get();

        return view('admin.marks.showAll', ['data' => $data]);
    }

    public function getAdd() {


        return view('admin.marks.add');

    }


    public function postAdd(Request $request) {

        $rules = [
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'status' => 'required',
            'photo' => 'mimes:png,jpg,jpeg'
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('mark-add')->withErrors($validator)->withInput();

        }

        $newCountry = new Marks();
	$new_sub_cts = new sub_cts();
	
        $newCountry->name_ar = $request->name_ar;
        $newCountry->name_en = $request->name_en;

        if(isset($request->photo) && $request->photo != '') {
            $newCountry->photo = uploading($request->file('photo'), 'marks', ['90x90']) ;
           // $new_sub_cts->img = uploading( $request->file( 'photo' ), 'categories', ['50x50','150x150','250x250'] );
        } else {
            $newCountry->photo = '';
            //$new_sub_cts->img = '';
        }

        $newCountry->status  = $request->status;
        $newCountry->created_by = Auth::user()->id;
        


        $new_sub_cts->name       = $request->name_ar;
        $new_sub_cts->status     = $request->status;
        $new_sub_cts->cat_id     = $request->cat_id;
        $new_sub_cts->created_by = Auth::user()->id;
        $new_sub_cts->img = '';
        $new_sub_cts->save();
	$newCountry->subcat_id=$new_sub_cts->id;
        return $newCountry->save() ?  redirect()->route('marks')->with('mOk', trans('messages.addOK')) :
            redirect()->route('marks')->with('mNo', trans('messages.addNo'))->withInput();

    }



    public function getEdit($id) {

        $data = Marks::where('id', $id)->firstOrFail();
	$subCat=sub_cts::find($data->subcat_id);
    $cat = Categories::find($subCat->cat_id);

        return view('admin.marks.edit', ['data' => $data , 'subcat'=>$subCat , 'cat'=>$cat]);

    }



    public function postEdit(Request $request, $id) {


        $rules = [
            'name' => 'required|max:255',
            'status' => 'required'
        ];




        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('mark-edit', ['id' => $id])->withErrors($validator)->withInput();

        }


        $data = Marks::find($id);
        $subCat=sub_cts::find($data->subcat_id);

        if(isset($request->photo) && $request->photo != '' && $data->photo != $request->photo) {

            @unlink(public_path('/marks'). $request->photo);
            @unlink(public_path('/marks_90x90'). $request->photo);

            $data->photo = uploading($request->file('photo'), 'marks', ['90x90']) ;

        }

        $data->name = $request->name;
        $data->status  = $request->status;
	
	$subCat->name=$request->name;
	$subCat->status  = $request->status;
	$subCat->cat_id     = $request->cat_id;
	$subCat->save();


        return $data->save() ?  redirect()->route('mark-edit', ['id' => $id])->with('mOk', trans('admin.editOK')) :
            redirect()->route('mark-edit', ['id' => $id])->with('mNo', trans('admin.editNo'))->withInput();


    }


    public function getDetails($id) {

        $data = Marks::where('id', $id)->first();

        $user = User::where('id',$data->created_by)->first();

        return view('admin.marks.details', ['data' => $data ,'user'=>$user]);

    }


    public function getDelete($id) {
    
    	$data = Marks::find($id);
	sub_cts::destroy($data->subcat_id);

        $photo = Marks::where('id', $id)->select('photo')->first();
        @unlink(public_path('/marks'). $photo->photo);
        @unlink(public_path('/marks_90x90'). $photo->photo);

        return Marks::destroy($id) ? redirect()->route('marks')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('marks')->with('mNo', trans('admin.deleteNo'))->withInput();


    }
}
