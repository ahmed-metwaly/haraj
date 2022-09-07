@extends('admin.master')

@section('title')
    {!!  trans('admin.adminMDet') . ' ' . $data->name_ar  !!}
@endsection

@section('sectionName')
    <a href="{{ route('reports') }}"> {{ trans('admin.adminMessages') }} </a>
@endsection

@section('pageName')
    {!!  trans('admin.adminMDet')  . ' : <span class="text-success">' . $data->title . '</span>' !!}
@endsection



@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->

        <div class="panel panel-flat">
            <div class="panel-heading">

            </div>


            <div class="panel-body">
                <fieldset>

                    <div class="collapse in" id="demo1">

                        <div class="form-group">
                            <label> {{ trans('admin.userName') }} </label>
                            <input type="text" class="form-control" readonly value="{{  $data->name }}">
                        </div>

                        <div class="form-group">
                            <label> {{ trans('admin.userEmail') }} </label>
                            <input type="text" class="form-control" readonly value="{{  $data->email }}">
                        </div>

                        <div class="form-group">
                            <label> {{ trans('admin.titleMessage') }} </label>
                            <input type="text" class="form-control" readonly value="{{  $data->title }}">
                        </div>


                        <div class="form-group">
                            <label> {{ trans('admin.message') }} </label>
                            <textarea id="editor1" rows="8" readonly name="" class="form-control"
                                      placeholder=""> {{ $data->message }} </textarea>
                        </div>


                        <div class="form-group">
                            <label> {{ trans('admin.adminsADDate') }} </label>
                            <input type="text" class="form-control" readonly value="{{  $data->created_at }}">

                        </div>

                    </div>

                </fieldset>

                <div class="text-right">
                    <a href="mailto:{{ $data->email }}"
                       class="btn btn-primary"> {{ trans('admin.replayToMessage') }} <i
                                class="icon-arrow-left13 position-right"></i></a>

                </div>
            </div>
        </div>
        <!-- /a legend -->

    </div>


@endsection