@extends('web.master')


@section('content')
	<p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="#">أضف إعلانك</a></p>
	<div class="contact-us add-e3lan">
		<h3><i class="fa fa-circle" aria-hidden="true"></i> تعديل الاعلان <i class="fa fa-circle"
		                                                                     aria-hidden="true"></i>
		</h3>
		<form action="{{ route('add-do-edit', ['id' => $data->id]) }}" method="POST" role="form"
		      enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">

				<div class="select-inputs-page">
					<select name="cat" id="cat_id">
						<option value="">-- فصيلة الصقر --</option>
						@foreach($categories as $category)
							<option {{ $category->id == $data->cat ? 'selected' : ''  }} value="{{ $category->id }}"> {{ $category->name }} </option>
						@endforeach
					</select>
				</div>

				<div class="select-inputs-page">
					<select name="SubCat" id="SubCat_id">
						<option value="">-- يرجى اختيار النوع --</option>
						@foreach($SubCats as $sub) // SubCat
						<option {{ $sub->id == $data->SubCat ? 'selected' : ''  }} value="{{ $sub->id }}"> {{ $sub->name }} </option>
						@endforeach
					</select>
				</div>

				<input type="text" class="form-control" id="" placeholder="عنوان الاعلان . 'يفضل ان يكون العنوان مميز'"
				       onfocus="this.placeholder = ''"
				       onblur="this.placeholder = 'العنوان'"
				       name="title"
				       value="{{ $data->title }}"
				>

				<input type="number" class="form-control" id="" placeholder="السعر" onfocus="this.placeholder = ''"
				       onblur="this.placeholder = 'السعر'"
				       name="price"
				       value="{{ $data->price }}"
				>

				<label for="type">
					نوع الإعلان
					<div>
						<span>بيع</span>
						<input type="radio" {{ $data->type == 'sell' ? 'checked' : '' }}
						name="type" value="sell">

						<span>إيجار</span>
						<input type="radio" {{ $data->type == 'rent' ? 'checked' : '' }} type="radio"
						       name="type" value="rent">
					</div>
				</label>

				<input id="uploadFile" placeholder="صورة رئيسية للاعلان" disabled="disabled"/>
				<div class="fileUpload btn btn-primary">
					<span>الصورة الرئيسية</span>
					<input id="uploadBtn" value="{{ old('photo') }}" type="file" name="photo" class="upload"/>
				</div>

				<input id="uploadFile" placeholder="صور فرعية للاعلان" disabled="disabled"/>
				<div class="fileUpload btn btn-primary">
					<span>الصور الفرعي</span>
					<input type="file" name="img[]" id="file-8" class="upload"
					       data-multiple-caption="{count} files selected" multiple/>
				</div>

				<br>
				@if($photos != '')

					@foreach($photos as $photo)
						<div class="img-edit " style="display: inline-block;">
							<a class="delete-img" href="{{ route('delete-ads-img', ['id' => $photo->id]) }}"><i
										class="fa fa-trash"></i></a>
							<img width="100" height="100" src="{{ url('public/ads_74x84/' . $photo->img) }}" alt="...">
						</div>

						&nbsp;&nbsp;

					@endforeach

				@endif

				<br><br>


				<input type="tel" class="form-control" id="" placeholder=" رقم الهاتف " onfocus="this.placeholder = ''"
				       value="{{ $data->phone }}"
				       onblur="this.placeholder = ' رقم الهاتف '"
				       name="phone"
				>

				<div class="select-inputs-page">
					<label class="sokor"> المدينة </label>
					<select name="city" id="city_id">
						<option value="">-- يرجى اختيار المدينة --</option>

						@foreach($cities as $city)

							<option value="{{ $city->id }}" {{ $data->city ==  $city->id ? 'selected' : ''  }}> {{ $city->name }} </option>

						@endforeach

					</select>

				</div>

				<div class="select-inputs-page">
					<select name="hay" id="hay_id">

						@foreach($hay as $oneHay)

							<option value="{{ $oneHay->id }}" {{ $data->hay == $oneHay->id ? 'selected' : '' }} > {{ $oneHay->name }} </option>

						@endforeach

					</select>

				</div>

				<div class="text-inputs-page">
					<label class="sokor"> وصف الاعلان </label>
					<textarea name="desc" placeholder="وصف الاعلان" rows="8"> {{ $data->desc }} </textarea>

					<input type="hidden" name="fir" value="">
				</div>

			</div>
			<button type="submit" class="btn btn-primary hvr-shutter-out-vertical">حفظ</button>
		</form>
	</div>

@endsection


@section('script')

	<script type="text/javascript">
		$(document).ready(function () {


			$('.delete-img').click(function (e) {

				e.preventDefault();

				var thisClass = $(this);

				var route = $(this).attr('href');

				$.ajax({
					url: route,
					method: 'GET',
					data: ''

				}).success(function (data) {

					thisClass.closest('div').remove();


				}).error(function (data) {
					console.log(data);
				});


			});

			getAjaxData('#cat_id', '#SubCat_id', '{{ baseUrl('/ajax-subcat-data') }}', 'cat_id');
			getAjaxData('#city_id', '#hay_id', '{{ baseUrl('/ajax-hay-data') }}', 'city_id');

		});
	</script>

@endsection
