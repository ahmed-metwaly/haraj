@extends('admin.master')



@section('title')

    {{ trans('admin.pageEdit') }}

@endsection



@section('sectionName')

    <a href="{{ route('pages') }}"> {{ trans('admin.pages') }} </a>

@endsection



@section('pageName')

    {{ trans('admin.pageEdit') }} : {!! '<span class="text-success">' .  $data->name  . '</span>' !!}

@endsection





@section('content')



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="{{ route('page-do-edit', ['id' => $data->id]) }}" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{ trans('admin.pageData') }} </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.cityName') }} </label>

                                <input type="text"  name="name" value="{{ $data->name }}" class="form-control"

                                       placeholder=" {{ trans('admin.cityName') }} ">

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.pageTitle') }} </label>

                                <input type="text" name="title" value="{{ $data->title }}" class="form-control"

                                       placeholder=" {{ trans('admin.pageTitle') }} ">

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.content') }} </label>

                                <textarea id="editor1" rows="8" name="content" class="form-control ckeditor" placeholder="{{ trans('admin.contentAr') }}" value="{{$data->content}}"> {{ $data->content }} </textarea>

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.pos') }} </label>

                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="type"

                                        class="select">

                                    <option value="1" {{ $data->type == 1 ? 'selected' : '' }} > {{ trans('admin.posTop') }} </option>

                                    <option value="2" {{ $data->type == 2 ? 'selected' : '' }} > {{ trans('admin.posBottom') }} </option>

                                </select>

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.adminsADStatus') }} </label>

                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

                                        class="select">

                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }} > {{ trans('admin.settingsOpen') }} </option>

                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }} > {{ trans('admin.settingsClose') }} </option>

                                </select>

                            </div>



                            <div class="col-md-2"></div>

                        </div>

                    </fieldset>

                    <input type="hidden" name="_token" value="{{ Session::token() }}">

                    <div class="text-right">

                        <button type="submit" class="btn btn-primary"> {{ trans('admin.save') }} <i

                                    class="icon-arrow-left13 position-right"></i></button>

                    </div>

                </div>

            </div>

        </form>

        <!-- /a legend -->



    </div>





@endsection

@section('script')
<!-- <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></scrip> -->
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> 
@endsection('script')





