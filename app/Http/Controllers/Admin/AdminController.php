<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Cities;
use App\Countries;
use App\Groups;
use App\ResetPassword;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Image;

class AdminController extends Controller
{

    public function getAdmins()
    {

        $data = User::join('countries', 'users.country_id', '=', 'countries.id')
                    ->join('cities', 'users.city_id', '=', 'cities.id')->where('is_admin', 1)
                    ->select('users.id as id', 'users.name as name', 'users.email as email', 'users.created_at as created_at')->get();

        return view('admin.admins.showAll', compact('data'));
    }

    public function getUsers()
    {

        $data = User::join('countries', 'users.country_id', '=', 'countries.id')
                    ->join('cities', 'users.city_id', '=', 'cities.id')->where('is_admin', '!=', 1)
                    ->select('users.id as id', 'users.name as name', 'users.email as email', 'users.created_at as created_at')->get();

        return view('admin.admins.showAll', compact('data'));
    }

    public function getAddAdmin()
    {

        $countries = Countries::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get();

        $groups = Groups::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get();

        return view('admin.admins.add', compact(['countries', 'groups']));

    }


    public function postAddAdmin(Request $request)
    {

        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users|min:3:max:255',
            'password' => 'required|min:3|max:255',
            'password_con' => 'same:passwor3d',
            'photo' => 'mimes:png,jpg,jpeg',
            'country_id' => 'required',
            'city_id' => 'required',
            'group_id' => 'required',
            'status' => 'required',
            'is_admin' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('admin-add')->withErrors($validator)->withInput();

        }

        $newAdmin = new User();

        $newAdmin->name = $request->name;
        $newAdmin->email = trim($request->email);
        $newAdmin->password = bcrypt(trim($request->password));

        if (isset($request->photo) && $request->photo != '') {
            $newAdmin->photo = uploading($request->file('photo'), 'users', ['50x50', '150x150']);
        } else {
            $newAdmin->photo = '';
        }

        $newAdmin->country_id = $request->country_id;
        $newAdmin->city_id = $request->city_id;
        $newAdmin->is_admin = $request->is_admin;
        $newAdmin->status = $request->status;
        $newAdmin->is_pro = 0;


        if (isset($request->group_id) && $request->group_id != '') {
            $newAdmin->group_id = $request->group_id;
        } else {
            $newAdmin->group_id = 0;
        }

        $code = mb_substr(abs(intval(crc32(rand(10000, 9999) . $request->email))), 0, 5, 'utf8');

        $newAdmin->phone = '';
        $newAdmin->active_email = 0;
        $newAdmin->active_mobil = 0;
        $newAdmin->active_mobil_count = 0;
        $newAdmin->active_mobil_number = $code;
        $newAdmin->remember_token = md5(csrf_token());


        // send active email

        $vars = [
            'from' => $this->siteEmail,
            'messagesTitle' => trans('email.activeTitle'),
            'to' => $request->email,
            'fromName' => $this->siteNamel,
            'subject' => trans('email.activeSubject'),
            'token' => md5(csrf_token())
        ];


        $mailed = $request->is_admin == 1 ? sendEmail('admin.emails.AdminActive', $vars) : sendEmail('admin.emails.AdminActive', $vars);

        if ($mailed == true) {

            $newAdmin->save();

            return redirect()->route('admin-add')->with('mOk', trans('messages.addAdminOk'));

        } else {

            return redirect()->route('admin-add')->with('mNo', trans('messages.addAdminNo'))->withInput();

        }

    }


    public function getActiveEmail($active)
    {

        $User_token = User::where('remember_token', $active)->first();

        if (isset($User_token) && $User_token->is_admin) {

            if ($active == $User_token->remember_token) {

                $activeEmail = User::find($User_token->id);
                $activeEmail->active_email = 1;
                $activeEmail->save();

                return redirect()->route('admin-login')->with('mOk', trans('messages.activeOk'));

            }
        }

        return redirect()->route('admin-login')->with('mNo', trans('messages.activeNo'));
    }


    public function getEditAdmin($id)
    {

        $data = User::where('id', $id)
                    ->select('id', 'name', 'email', 'photo', 'status', 'is_admin', 'group_id', 'country_id', 'city_id')->first();

        if (CheckData($data) !== true) {
            return back();
        }


        $countries = Countries::orderBy('id', 'DESC')->select('id', 'name')->get();

        $cities = Cities::orderBy('id', 'DESC')->select('id', 'name')->get();


        return view('admin.admins.edit', [
            'data' => $data,
            'countries' => $countries,
            'cities' => $cities
        ]);

    }


    public function postEditAdmin(Request $request, $id)
    {

        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,id,' . $id . '|min:3:max:255',
            'password' => 'min:3|max:255',
            'password_con' => 'same:password',
            'photo' => 'mimes:png,jpg,jpeg',
            'country_id' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'is_admin' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('admin-edit', ['id' => $id])->withErrors($validator)->withInput();

        }

        $adminData = User::where('id', $id)->firstOrFail();


        $adminData->name = $request->name;

        if (isset($request->password) && $request->password != '') {

            $adminData->password = bcrypt(trim($request->password));

        }


        if (isset($request->photo) && $request->photo != '' && $adminData->photo != $request->photo) {

            @unlink(public_path('/users') . $request->photo);
            @unlink(public_path('/users_50x50') . $request->photo);
            @unlink(public_path('/users_150x150') . $request->photo);

            $adminData->photo = uploading($request->file('photo'), 'users', ['50x50', '150x150']);

        }


        $adminData->country_id = $request->country_id;
        $adminData->city_id = $request->city_id;
        $adminData->is_admin = $request->is_admin;
        $adminData->status = $request->status;
        $adminData->group_id = $request->group_id;

        $trans = 0;

        if ($request->email != $adminData->email) {

            $adminData->email = trim($request->email);

            // send active email

            $vars = [
                'from' => settings()->site_email,
                'messagesTitle' => trans('email.activeTitle'),
                'to' => $request->email,
                'fromName' => settings()->site_name,
                'subject' => trans('email.activeSubject'),
                'data' => [
                    'token' => csrf_token(),
                    'siteName' => settings()->site_name
                ]

            ];

            sendEmail('admin.emails.AdminActive', $vars);

            $adminData->active_email = 0;

            $trans = 1;
        }

        return $adminData->save() ? redirect()->route('admin-edit', ['id' => $id])->with('mOk', trans('messages.editAdminOk' . $trans)) : redirect()->route('admin-edit', ['id' => $id])->with('mNo', trans('messages.editAdminNo'))->withInput();

    }


    public function getAdminDetails($id)
    {

        $data = User::where('users.id', $id)->join('countries', 'users.country_id', '=', 'countries.id', 'LEFT')
                                            ->join('cities', 'users.city_id', '=', 'cities.id', 'LEFT')
                                            ->join('groups', 'users.group_id', '=', 'groups.id', 'LEFT')
                                            ->select('users.id as id', 'users.name as name', 'users.email as email',
                                                     'users.photo as photo', 'users.phone as phone', 'users.is_admin as is_admin',
                                                     'users.status as status', 'users.created_at as created_at',
                                                     'countries.id as k_id', 'countries.name as k_name',
                                                     'cities.id as c_id', 'cities.name as c_name',
                                                     'groups.id as g_id', 'groups.name as g_name')->first();

        return view('admin.admins.details', ['data' => $data]);

    }


    public function getDeleteAdmin($id)
    {

        if (Auth::user()->id == $id) {
            return back()->with('mNo', 'لا يمكن حذف العضو الحالى');
        }

//		$AdsCount = Ads::where( 'created_by', $id )->get()->count();
//		if ( $AdsCount > 0 ) {
//			return back()->with( 'mNo', 'لا يمكن حذف العضو لامتلاكه بعض الاعلانات' );
//		}

        $userData = User::where('id', $id)->select('photo')->first();

        if (isset($userData->photo) && $userData->photo != '') {
            @unlink(public_path('users') . DIRECTORY_SEPARATOR . $userData->photo);
            @unlink(public_path('users_50x50') . DIRECTORY_SEPARATOR . $userData->photo);
            @unlink(public_path('users_150x150') . DIRECTORY_SEPARATOR . $userData->photo);


        }
        $userAds = Ads::where('created_by', $id)->update(['status' => 0]);
        return User::where('id', $id)->delete() ? back()->with('mOk', trans('messages.deletedOk')) : back()->with('mNo', trans('messages.deletedNo'));
    }


    // admin auth
    public function getLogin()
    {

        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        $rules = [

            'email' => 'required|email|min:3:max:255',
            'password' => 'min:3|max:255',

        ];

        // validation done ^_^
        collValidation($request, $rules);

        return Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]) ? redirect()->route('dashboard') : back()->with('mNo', trans('messages.loginFalse'));

    }


    public function getLogout()
    {

        Auth::logout();

        return redirect()->route('home');

    }

    public function getForgetPassword()
    {

        return view('admin.auth.forgetPassword');
    }

    public function postForgetPassword(Request $request)
    {

        $rules = [

            'email' => 'required|email|min:3:max:255',
        ];

        // validation done ^_^
        collValidation($request, $rules, "back");

        $email = User::where('email', $request->email)->where('is_admin', 1)->first()->email;

        if (isset($email) && $email != '') {

            // send active email

            $vars = [
                'from' => $this->siteEmail,
                'messagesTitle' => trans('email.forgetTitle'),
                'to' => $email,
                'fromName' => $this->siteName,
                'subject' => trans('email.forgetTitle'),
                'token' => csrf_token(),
                'data' => [
                    'token' => csrf_token(),
                    'siteName' => $this->siteName
                ]

            ];

            sendEmail('admin.emails.forgetPassword', $vars);

            $gData = new ResetPassword;
            $gData->email = $email;
            $gData->token = csrf_token();
            $gData->save();

            return back()->with('mOk', trans('messages.fPasswordTrue'));

        }

        return back()->with('mNo', trans('messages.fPasswordError'));

    }


    public function getRestPassword($token)
    {

        $tokenIsValid = ResetPassword::where('token', $token)->count();

        if ($tokenIsValid != 1) {
            return redirect()->route('home')->with('mNo', trans('messages.tokenNotValid'));
        }

        return view('admin.auth.restPassword');
    }

    public function postRestPassword(Request $request, $token)
    {

        $rules = [

            'password' => 'min:3|max:255',
            'password_con' => 'same:password',

        ];

        // validation done ^_^
        collValidation($request, $rules, "route('back()')");

        $email = ResetPassword::where('token', $token)->first()->email;

        if (isset($email) && $email != '') {

            $updatePassword = User::where('email', $email)->first();

            $updatePassword->password = bcrypt(trim($request->password));

            return $updatePassword->save() ? redirect()->route('dashboard')->with('mOk', trans('messages.rPasswordOk')) : redirect()->route('dashboard')->with('mNo', trans('messages.rPasswordNo'));

        }

        return redirect()->route('home')->with('mNo', trans('messages.tokenNotValid'));

    }


}
