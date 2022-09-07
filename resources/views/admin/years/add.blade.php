@extends('admin.master')

@section('title')
    {{ trans('admin.yearAdd') }}
@endsection

@section('sectionName')
    <a href="{{ route('years') }}"> {{ trans('admin.years') }} </a>
@endsection

@section('pageName')
    {{ trans('admin.yearAdd') }}
@endsection


@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="{{ route('year-do-add') }}" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('admin.yearAdd') }} </h5>
                </div>

                <div class="panel-body">
                    <fieldset>
                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> {{ trans('admin.year') }} </label>
                                {{--<input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                       placeholder=" {{ trans('admin.year') }} "> --}}
                                       <textarea name="name" value="{{ old('name') }}" class="form-control"
                                       placeholder=" {{ trans('admin.year') }} "></textarea>
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



