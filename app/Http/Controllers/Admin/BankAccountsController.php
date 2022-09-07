<?php

namespace App\Http\Controllers\Admin;

use App\Bank_account;
use App\Bank_transfer;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankAccountsController extends Controller
{

    public function getIndex() {

        $data = Bank_account::join('users', 'bank_accounts.created_by' , '=', 'users.id' )->orderBy('bank_accounts.id', 'DESC')->select('bank_accounts.*' ,'users.id as user_id' ,'users.name as username')->get();

        return view('admin.bank_account.showAll', ['data' => $data]);
    }

    public function getAdd() {

      //  $data = User::join('block_lists', 'users.id', '!=', 'block_lists.user_id', 'RIGHT')->join('countries', 'users.country_id', '=' , 'countries.id', 'RIGHT')->select('users.id as id', 'users.name as name', 'users.email as email', 'users.created_at as created_at', 'countries.name_ar as country_name')->get();


      //  return view('admin.bank_account.add', ['data' => $data]);
        return view('admin.bank_account.add');

    }

    public function getDoAdd(Request $request) {

        $rules = [
            'account_owner' => 'required|max:255',
            'bank_name'  => 'required',
            'account_number'   => 'required' ,
            'international_account'   => 'required'
        ];


        $validator = Validator::make( $request->all(), $rules );

        if ( $validator->fails() ) {

            return redirect()->route( 'bank-add' )->withErrors( $validator )->withInput();

        }

        $newBank = new Bank_account();
        $newBank->account_owner   = $request->account_owner;
        $newBank->bank_name   = $request->bank_name;
        $newBank->account_number    = $request->account_number;
        $newBank->international_account    = $request->international_account;
        $newBank->created_by = Auth::user()->id;

        return $newBank->save() ?  redirect()->route('bank-add')->with('mOk', trans('messages.addOK')) :
            redirect()->route('bank-add')->with('mNo', trans('messages.addNo'))->withInput();
    }

    public function getEdit( $id ) {

        $data = Bank_account::where( 'id', $id )->firstOrFail();

        return view( 'admin.bank_account.edit', [ 'data' => $data ] );

    }

    public function postEdit( Request $request, $id ) {


        $rules = [
            'account_owner' => 'required|max:255',
            'bank_name'  => 'required',
            'account_number'   => 'required' ,
            'international_account'   => 'required'
        ];


        $validator = Validator::make( $request->all(), $rules );

        if ( $validator->fails() ) {

            return redirect()->route( 'bank-edit', [ 'id' => $id ] )->withErrors( $validator )->withInput();

        }


        $data = Bank_account::find( $id );



        $data->account_owner   = $request->account_owner;
        $data->bank_name   = $request->bank_name;
        $data->account_number    = $request->account_number;
        $data->international_account    = $request->international_account;
       // $data->created_by = Auth::user()->id;


        return $data->save() ? redirect()->route( 'bank-edit', [ 'id' => $id ] )->with( 'mOk', trans( 'admin.editOK' ) ) : redirect()->route( 'bank-edit', [ 'id' => $id ] )->with( 'mNo', trans( 'admin.editNo' ) )->withInput();


    }



    public function getDelete($id) {

        return Bank_account::destroy($id) ? redirect()->route('bank-accounts')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('bank-accounts')->with('mNo', trans('admin.deleteNo'));


    }

    //bank transfers

    public function getTransfers() {

        $TransferData = Bank_transfer::join('users', 'bank_transfers.created_by' , '=', 'users.id' )->join('bank_accounts', 'bank_transfers.bank_name' , '=', 'bank_accounts.id' )->join('ads', 'bank_transfers.ad_id' , '=', 'ads.id' )->where('bank_transfers.type',"commission")->orderBy('id', 'DESC')->select('bank_transfers.*','bank_accounts.id as bank_id','bank_accounts.bank_name as bank_name' ,'users.id as user_id','users.name as username','ads.id as ads_id','ads.title as ads_title','ads.is_pro as ads_is_pro')->get();

         

        return view('admin.bank_account.showTransfers', ['TransferData' => $TransferData]);
    }

    public function getsubscribeTransfers() {


        $TransferData = Bank_transfer::join('users', 'bank_transfers.created_by' , '=', 'users.id' )->join('bank_accounts', 'bank_transfers.bank_name' , '=', 'bank_accounts.id' )->join('ads', 'bank_transfers.ad_id' , '=', 'ads.id' )->where('bank_transfers.type',"subscribe")->orderBy('id', 'DESC')->select('bank_transfers.*','bank_accounts.id as bank_id','bank_accounts.bank_name as bank_name' ,'users.id as user_id','users.name as username','ads.id as ads_id','ads.title as ads_title','ads.is_pro as ads_is_pro')->get();

        return view('admin.bank_account.showsubscribeTransfers', ['TransferData' => $TransferData]);
    }

    
     public function deleteTransfer($id) {

        return Bank_transfer::destroy($id) ? redirect()->route('transfers-list')->with('mOk', trans('admin.deleteOK')) :
            redirect()->route('transfers-list')->with('mNo', trans('admin.deleteNo'));


    }

}
