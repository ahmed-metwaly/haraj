@extends('admin.master')

@section('title')
    {!!  trans('admin.markDet') . ' ' . $data->name  !!}
@endsection

@section('sectionName')
    <a href="{{ route('marks') }}"> {{ trans('admin.marks') }} </a>
@endsection

@section('pageName')
      {!!  trans('admin.markDet')  . ' : <span class="text-success">' . $data->name . '</span>' !!}
@endsection



@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="#" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('admin.markData') }} </h5>

                </div>


                <div class="panel-body">
                    <fieldset>

                        <div class="form-group">
                            <img  class="img-header  img-preview img-thumbnail pull-right" src="{{ isset($data->photo) && $data->photo != '' ? url('public/marks_90x90/' . $data->photo) : url('public/categories/cat-empty.png') }}">
                        </div>

                        <br>
                        <br>

                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> {{ trans('admin.markName') }} </label>
                                <input readonly type="text" value="{{ $data->name }}"  class="form-control"
                                       placeholder=" {{ trans('admin.markName') }} ">
                            </div>

                           

                            <div class="form-group">
                                <label> {{ trans('admin.addedBy') }} </label>
                                <input type="text" class="form-control" readonly value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADStatus') }} </label>
                                <input type="text" class="form-control" readonly value="{{  $data->status == 1 ?  trans('admin.settingsOpen') : trans('admin.settingsClose')  }}">

                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADDate') }} </label>
                                <input type="text" class="form-control" readonly value="{{  $data->created_at }}">

                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.lastUpdate') }} </label>
                                <input type="text" class="form-control" readonly value="{{  $data->updated_at }}">

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