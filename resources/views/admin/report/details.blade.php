@extends('admin.master')

@section('title')
    {!!  trans('admin.reportDet') . ' ' . $data->name_ar  !!}
@endsection

@section('sectionName')
    <a href="{{ route('reports') }}"> {{ trans('admin.reports') }} </a>
@endsection

@section('pageName')
    {!!  trans('admin.reportDet')  . ' : <span class="text-success">' . $ad->title . '</span>' !!}
@endsection



@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title"> {{ trans('admin.reportData') }} </h5>

            </div>


            <div class="panel-body">
                <fieldset>

                    <div class="collapse in" id="demo1">

                        <div class="form-group">
                            <label> {{ trans('admin.reportText') }} </label>
                            <textarea id="editor1" rows="8" readonly name="" class="form-control"
                                      placeholder=""> {{ $data->text }} </textarea>
                        </div>


                        <div class="form-group">
                            <label> {{ trans('admin.addedBy') }} </label>
                            <input type="text" class="form-control" readonly
                                   value="{{ $user->name }}">
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
                    <a href="{{ route('black-do-add', ['id' => $ad->created_by]) }}"
                       class="btn btn-primary"> {{ trans('admin.addToBlackList') }} <i
                                class="icon-arrow-left13 position-right"></i></a>

                </div>
            </div>
        </div>
        <!-- /a legend -->

    </div>


@endsection