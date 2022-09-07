@extends('admin.master')

@section('title')
    {!! trans($data->is_admin == 0 ? 'admin.sideUserDetails' : 'admin.sideAdminsDetails') . ' ' . $data->name  !!}
@endsection

@section('sectionName')
    {{ trans('admin.sideAdminsTitle') }}
@endsection

@section('pageName')
    {!!  trans($data->is_admin == 0 ? 'admin.sideUserDetails' : 'admin.sideAdminsDetails')  . ' : <span class="text-success">' . $data->name . '</span>' !!}
@endsection



@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="#" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans($data->is_admin == 0 ? 'admin.userDet' : 'admin.adminEditAdminTitle') }} </h5>
                </div>

                <div class="panel-body">
                    <fieldset>


                        <div class="form-group">
                            <img class="img-header  img-preview img-thumbnail pull-right"
                                 src="{{ url('public/users/' . $data->photo) }}">
                        </div>

                        <br>
                        <br>

                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> {{ trans('admin.sideAdminsName') }} </label>
                                <input readonly type="text" name="name" value="{{ $data->name }}" class="form-control"
                                       placeholder=" {{ trans('admin.sideAdminsName') }} ">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADEmail') }} </label>
                                <input readonly type="email" name="email" value="{{ $data->email }}"
                                       class="form-control"
                                       placeholder=" {{ trans('admin.adminsADEmail') }} ">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADCount') }} </label>
                                <input type="text" class="form-control" readonly
                                       value="{{ $data->k_name != '' ? $data->k_name : trans('admin.countryRemoved') }}">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADCity') }} </label>
                                <input type="text" class="form-control" readonly
                                       value="{{  $data->c_name != '' ? $data->c_name : trans('admin.cityRemoved') }}">

                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADLevel') }} </label>
                                <input type="text" class="form-control" readonly
                                       value="<?php

                                       if ($data->is_admin == 0) {

                                           echo trans('admin.lAdmin');

                                       } else {

                                           if ($data->g_name != '') {

                                               echo $data->g_name;

                                           } else {

                                               echo trans('admin.levelRemoved');

                                           }
                                       }

                                       ?>">

                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADStatus') }} </label>
                                <input type="text" class="form-control" readonly
                                       value="{{  $data->status == 1 ?  trans('admin.settingsOpen') : trans('admin.settingsClose')  }}">

                            </div>

                        </div>
                    </fieldset>

                    <div class="text-right">

                    </div>
                </div>
            </div>
        </form>
        <!-- /a legend -->

    </div>


@endsection