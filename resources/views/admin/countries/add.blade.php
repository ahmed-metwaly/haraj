@extends('admin.master')



@section('title')

    {{ trans('admin.countryAdd') }}

@endsection



@section('sectionName')

    <a href="{{ route('countries') }}"> {{ trans('admin.sideCountriesTitle') }} </a>

@endsection



@section('pageName')

    {{ trans('admin.countryAdd') }}

@endsection



@section('content')



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="{{ route('country-do-add') }}" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{ trans('admin.countryAdd') }} </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.countryName') }} </label>

                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"

                                       placeholder=" {{ trans('admin.countryName') }} ">

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







