@extends('admin.master')



@section('title')

    {{ trans('admin.hayEdit') }}

@endsection



@section('sectionName')

    <a href="{{ route('hay') }}"> {{ trans('admin.hayTitle') }} </a>

@endsection



@section('pageName')

    {{ trans('admin.hayEdit') }} : {!! '<span class="text-success">' .  $data->name  . '</span>' !!}

@endsection





@section('content')



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="{{ route('hay-do-edit', ['id' => $data->id]) }}" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> {{ trans('admin.hayData') }} </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> {{ trans('admin.hayName') }} </label>

                                <input type="text"  name="name" value="{{ $data->name }}" class="form-control"

                                       placeholder=" {{ trans('admin.hayName') }} ">

                            </div>



                            <div class="form-group">

                                <label> {{ trans('admin.adminsADCity') }} </label>

                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="city_id"

                                        class="select">



                                    @foreach($cities as $city)



                                        <option value="{{ $city->id }}" {{ $data->city_id == $city->id ? 'selected' : '' }} > {{ $city->name }} </option>



                                    @endforeach



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







