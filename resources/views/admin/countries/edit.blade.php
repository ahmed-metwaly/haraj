@extends('admin.master')



@section('title')

    {{ trans('admin.countryEdit') }}

@endsection



@section('sectionName')

    <a href="{{ route('countries') }}"> {{ trans('admin.sideCountriesTitle') }} </a>

@endsection



@section('pageName')

    {{ trans('admin.countryEdit') }}

@endsection





@section('content')



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="{{ route('country-do-edit', ['id' => $data->id]) }}" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{ trans('admin.countryEdit') }} </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.countryName') }} </label>

                                <input type="text"  name="name" value="{{ $data->name }}" class="form-control"

                                       placeholder=" {{ trans('admin.countryName') }} ">

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







