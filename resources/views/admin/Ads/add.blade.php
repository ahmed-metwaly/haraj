@extends('admin.master')



@section('title')

	{{ trans('admin.addNew') }}

@endsection



@section('sectionName')
	<a href="{{ route('AdminActiveAds') }}"> {{ trans('admin.AdsShow') }} </a>
@endsection



@section('pageName')
	{{ trans('admin.AdAdd') }}
@endsection

@section('content')

	<div class="col-md-12">
		<!-- Advanced legend -->
		<form action="{{ route('ad-do-add') }}" method="post" enctype="multipart/form-data">

			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"> {{ trans('admin.AdAdd') }} </h5>
				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">
								<label> {{ trans('admin.catNameAr') }} </label>
								<select data-placeholder="-- يرجى اختيار الفصيلة  --"
								        name="cat"
								        id="cat_id"
								        class="select">
									<option value=""></option>
									@foreach($categories as $vale)
										<option value="{{ $vale->id }}"> {{ $vale->name }} </option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label> {{ trans('admin.SubcatNameAr') }} </label>
								<select class="select"
								        data-placeholder="-- يرجى اختيار النوع --"
								        name="SubCat"
								        id="SubCat_id">
								</select>
							</div>

							<div class="form-group">
								<label> {{ trans('admin.adsTitle') }} </label>
								<input type="text" name="title" value="{{ old('title') }}" class="form-control"
								       placeholder=" {{ trans('admin.adsTitle') }} ">
							</div>

							<div class="form-group">
								<label>السعر</label>
								<input type="number" name="price" value="{{ old('price') }}" class="form-control"
								       placeholder="السعر">
							</div>

							<div class="form-group">
								<label class="display-block text-semibold">نوع الإعلان</label>
								<label class="radio-inline">
									<input type="radio" name="type" value="sell"
									       class="styled" {{ old('type') == 'sell' ? 'checked' : '' }}>
									بيع
								</label>

								<label class="radio-inline">
									<input type="radio"
									       name="type" value="rent"
									       class="styled"
											{{ old('type') == 'rent' ? 'checked' : '' }} >
									إيجار
								</label>
							</div>


							<hr>

							<div class="form-group">
								<label> صورة رئيسية للاعلان</label>
								<input type="file" name="photo" class="form-control">
							</div>

							<div class="form-group">
								<label>صور فرعية للاعلان</label>
								<input type="file" name="img[]" id="file-8" class="form-control"
								       data-multiple-caption="{count} files selected" multiple/>
							</div>

							<hr>

							<div class="form-group">
								<label> {{ trans('admin.adminsADCity') }} </label>
								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="city"
								        id="city_id" class="select">
									<option value="0">-- {{ trans('admin.SettingsSelect') }} --</option>
									@if(count($cities) > 0)
										@foreach($cities as $city)

											<option value="{{ $city->id }}"> {{ $city->name }} </option>

										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group">
								<label> {{ trans('admin.hayNameAr') }} </label>
								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="hay"
								        id="hay_id" class="select">

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

						<button type="submit" class="btn btn-primary"> {{ trans('admin.add') }} <i

									class="icon-arrow-left13 position-right"></i></button>

					</div>

				</div>

			</div>

		</form>
		<!-- /a legend -->
	</div>

@endsection


@section('script')

	<script type="text/javascript">
		$(document).ready(function () {

			//getAjaxData('#cat_id', '#SubCat_id', '{{ baseUrl('/ajax-subcat-data') }}', 'cat_id');
			getAjaxData('#city_id', '#hay_id', '{{ baseUrl('/ajax-hay-data') }}', 'city_id');
			
			            $('#cat_id').on('change', function(e){
                    var cat = e.target.value;
                    var i=JSON.parse(cat);
                    var cat1=Object.keys(i)[0];
                    console.log(i);
                    console.log(i[Object.keys(i)[0]]);
                    console.log(Object.keys(i)[0]);
                    $.get('{{url("/ajax-subcat-data/cat_id") }}/'+ i , function(data){
                          $('#SubCat_id').empty();
                        obj = JSON.parse(data);
                        //if(obj.length>0){
                            // $('.SubCat_id').removeAttr('disabled');
                             $.each(obj, function(index, subcat){
                                     console.log('subcat',subcat.name);
                                     $('#SubCat_id').append('<option value="'+subcat.id+'">'+subcat.name+'</option>');
                              });
                         // }
                      });   
            });

		});
	</script>
@endsection
