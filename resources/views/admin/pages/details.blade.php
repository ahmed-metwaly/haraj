@extends('admin.master')



@section('title')

    {!!  trans('admin.pageDet') . ' ' . $data->name  !!}

@endsection



@section('sectionName')

    <a href="{{ route('pages') }}"> {{ trans('admin.pages') }} </a>

@endsection



@section('pageName')

      {!!  trans('admin.pageDet')  . ' : <span class="text-success">' . $data->name . '</span>' !!}

@endsection

@section('content')



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="#" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{$data->name}} </h5>



                </div>

                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.pageName') }} </label>

                                <input readonly type="text" value="{{ $data->name }}"  class="form-control"

                                       placeholder=" {{ trans('admin.pageName') }} ">

                            </div>


                            <div class="form-group">

                                <label> {{ trans('admin.pageTitle') }} </label>

                                <input readonly type="text" value="{{ $data->title }}"  class="form-control"

                                       placeholder=" {{ trans('admin.pageTitle') }} ">

                            </div>


                            <div class="form-group">

                                <label> {{ trans('admin.content') }} </label>

                                <textarea id="editor1" rows="8" readonly name="content" class="form-control" placeholder="{{ trans('admin.content') }}"> {{ $data->content }} </textarea>

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.pos') }} </label>

                                <input type="text" class="form-control" readonly value="{{ $data->type == 1 ? 'الهيدر' : 'الفوتر' }}">

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