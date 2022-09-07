@extends('admin.master')



@section('title')

    {{ trans('admin.pageAdd') }}

@endsection



@section('sectionName')

    <a href="{{ route('pages') }}"> {{ trans('admin.pages') }} </a>

@endsection



@section('pageName')

    {{ trans('admin.pageAdd') }}

@endsection


@section('content')



    <div class="col-md-12">

        <!-- Advanced legend -->

        <form action="{{ route('page-do-add') }}" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{ trans('admin.pageData') }} </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.pageName') }} </label>

                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"

                                       placeholder=" {{ trans('admin.pageName') }} ">

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.pageTitle') }} </label>

                                <input type="text" name="title" value="{{ old('name') }}" class="form-control"

                                       placeholder=" {{ trans('admin.pageTitle') }} ">

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.content') }} </label>

                                <textarea id="editor1" rows="8" name="content" class="form-control ckeditor" placeholder="{{ trans('admin.content') }}"> {{ old('content') }} </textarea>

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.pos') }} </label>

                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="type"

                                        class="select">

                                    <option value="1"> {{ trans('admin.posTop') }} </option>

                                    <option value="2"> {{ trans('admin.posBottom') }} </option>

                                </select>

                            </div>





                            <div class="form-group">

                                <label> {{ trans('admin.adminsADStatus') }} </label>

                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

                                        class="select">

                                    <option value="1"> {{ trans('admin.settingsOpen') }} </option>

                                    <option value="0"> {{ trans('admin.settingsClose') }} </option>

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

    <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>


@endsection



