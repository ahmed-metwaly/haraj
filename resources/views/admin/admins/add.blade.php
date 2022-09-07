@extends('admin.master')

@section('title')
	{{ trans('admin.sideAdminsAdd') }}
@endsection

@section('sectionName')
	{{ trans('admin.sideAdminsTitle') }}
@endsection

@section('pageName')
	{{ trans('admin.sideAdminsAdd') }}
@endsection



@section('content')

	<div class="col-md-12">

		<!-- Advanced legend -->
		<form action="{{ route('admin-do-add') }}" method="post" enctype="multipart/form-data">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"> {{ trans('admin.adminNewAdminTitle') }} </h5>

				</div>


				<div class="panel-body">
					<fieldset>
						<div class="collapse in" id="demo1">
							<div class="form-group">
								<label> {{ trans('admin.sideAdminsName') }} </label>
								<input type="text" name="name" value="{{ old('name') }}" class="form-control"
								       placeholder=" {{ trans('admin.sideAdminsName') }} ">
							</div>

							<div class="form-group">
								<label> {{ trans('admin.adminsADEmail') }} </label>
								<input type="email" name="email" value="{{ old('email') }}" class="form-control"
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
								<label> {{ trans('admin.adminsADCount') }} </label>
								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="country_id"
								        id="count" class="select">
									<option value="0">-- {{ trans('admin.SettingsSelect') }} --</option>
									@if(count($countries) > 0)
										@foreach($countries as $country)

											<option value="{{ $country->id }}"> {{ $country->name }} </option>

										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group">
								<label> {{ trans('admin.adminsADCity') }} </label>
								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="city_id"
								        id="city" class="select">

								</select>
							</div>


							<div class="form-group">
								<label> {{ trans('admin.adminsADIsAdmin') }} </label>
								<select id="is-admin" data-placeholder="-- {{ trans('admin.SettingsSelect') }} --"
								        name="is_admin"
								        class="select">
									<option value="0">-- {{ trans('admin.SettingsSelect') }} --</option>
									<option value="1"> {{ trans('admin.sAdmin') }} </option>
									<option value="0"> {{ trans('admin.lAdmin') }} </option>
								</select>
							</div>
							
							<div class="form-group" id="level" style="display:none;">
								<label> مستوى الإدارة </label>
								<select data-placeholder="" name="group_id"
								        id="group_id" class="select">
								        @foreach(Groups() as $group)
								        	<option value="{{$group->id}}">{{$group->name}}</option>
								        @endforeach

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
		 //$(window).load(function() {
		$(document).ready(function () {
		console.log('inasss');
		//getAjaxData('#count', '#city', '{{ baseUrl('/ajax-data') }}', 'country_id');
	
		
		
	//admin level	

    $('#is_admin').change(function(){
    var id = $(this).val();
    if(id==1){
    
    	$('#group_id').html('<option> جارى التحميل ...</option>');
    	$('#group_id').removeAttr('style');
    }
    
    });
    
    
    //city
    
    $('#count').change(function(){
        var id = $(this).val();
        var col='country_id';
        console.log(id);
	var url='{{ baseUrl('/ajax-data2')}}/'+  id + '/' + col + '/';
	console.log(url);
	//var col='country_id';
	$('#city').html('');
            $.ajax({

                method : 'GET',
               // url : url +  id + '/' + col + '/' ,
                url : url ,
                
                cache : false

            }).success(function(data) {

                var json = JSON.parse(data)

                console.log(data);

                $.each(json, function(key, val) {

                    $('#city').append('<option value="' + val.id + '">' + val.name + '</option>');

                });



            }).error(function(data) {

                console.log(data);

            });

        });
        
         });
	</script>
@endsection('script');
