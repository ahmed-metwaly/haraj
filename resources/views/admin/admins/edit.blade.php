@extends('admin.master')

@section('title')
    {{ trans('admin.sideAdminsEdit') }}
@endsection

@section('sectionName')
    {{ trans('admin.sideAdminsTitle') }}
@endsection

@section('pageName')
    {{ trans('admin.sideAdminsEdit') }}
@endsection



@section('content')

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="{{ route('admin-do-edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('admin.adminEditAdminTitle') }} </h5>

                </div>


                <div class="panel-body">
                    <fieldset>
                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> {{ trans('admin.sideAdminsName') }} </label>
                                <input type="text" name="name" value="{{ $data->name }}"  class="form-control"
                                       placeholder=" {{ trans('admin.sideAdminsName') }} ">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADEmail') }} </label>
                                <input type="email" name="email" value="{{ $data->email }}" class="form-control"
                                       placeholder=" {{ trans('admin.adminsADEmail') }} ">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('admin.adminsADPassword') }}</label>
                                <input type="password" name="password" class="form-control" placeholder="****">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('admin.adminsADRePassword') }}</label>
                                <input type="password" name="password_con" class="form-control" placeholder="****">
                            </div>

                            <div class="form-group">
                                <label>{{ trans('admin.adminsADPhoto') }}</label>
                                <input type="file" name="photo" class="form-control">
                            </div>

                            <div class="form-group">
                                <img  class="img-preview img-responsive" src="{{ url('public/users/' . $data->photo) }}">
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADCount') }} </label>
                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="country_id"
                                        id="count" class="select">
                                    @if(count($countries) > 0)
                                        @foreach($countries as $country)

                                            <option value="{{ $country->id }}" {{ $data->country_id ==  $country->id ? 'selected' : '' }}> {{ $country->name }} </option>

                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADCity') }} </label>
                                <select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="city_id"
                                        id="city" class="select">
                                    @if(count($cities) > 0)
                                        @foreach($cities as $city)

                                            <option value="{{ $city->id }}" {{ $data->city_id ==  $city->id ? 'selected' : '' }}> {{ $city->name }} </option>

                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ trans('admin.adminsADIsAdmin') }} </label>
                                <select id="is-admin" data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="is_admin"
                                        class="select">
                                    <option value="0">-- {{ trans('admin.SettingsSelect') }} --</option>
                                    <option value="1" {{ $data->is_admin == 1 ? 'selected' : '' }} > {{ trans('admin.sAdmin') }} </option>
                                    <option value="0" {{ $data->is_admin == 0 ? 'selected' : '' }} > {{ trans('admin.lAdmin') }} </option>
                                </select>
                            </div>
                              <?php $groups = Groups(); ?>

                            <div class="form-group" id="level" style="display:none;">
              								<label> مستوى الإدارة </label>

              								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="group_id" class="select">

              								        @foreach($groups as $group)
              								        	<option value="{{ $group->id }}" {{ $data->group_id == $group->id ? 'selected' : '' }} >{{$group->name}}</option>
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
    <script>

        $(document).ready(function () {
            //getAjaxData('#count', '#city', '{{ url('awamer-sport/ajax-data') }}', 'country_id' );
            getAjaxData('#count', '#city', '{{ baseUrl('/ajax-data2') }}', 'country_id');

     if({{$data->is_admin}}==1) {

    	  $('#level').removeAttr('style');

      }

        });

    </script>
@endsection
