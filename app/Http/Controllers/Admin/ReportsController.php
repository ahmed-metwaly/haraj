<?php

namespace App\Http\Controllers\Admin;

use App\report;
use App\User;
use App\Ads;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function getIndex() {

        $data = report::join('users', 'reports.created_by' , '=', 'users.id' )->join('ads', 'reports.ad_id' , '=', 'ads.id' )->select('reports.*','ads.id as ad_id' , 'ads.title as ad_title' , 'users.id as user_id' ,'users.name as username')->orderBy('reports.id', 'DESC')->get();


        return view('admin.report.showAll', ['data' => $data]);
    }

    public function getDetails($id) {

        $data = report::where('id', $id)->firstOrFail();
        $ad = Ads::find($data->ad_id);
        $user = User::find($data->created_by);

        return view('admin.report.details', ['data' => $data ,'user'=>$user ,'ad'=>$ad]);

    }


    public function getDelete($id) {

        return report::destroy($id) ? redirect()->route('pages')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('pages')->with('mNo', trans('admin.deleteNo'));


    }

}
