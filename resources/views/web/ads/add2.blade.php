@extends('web.master')

@section('content')
	<p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="#">أضف إعلانك</a></p>
	<div class="contact-us add-e3lan">
		<h3><i class="fa fa-circle" aria-hidden="true"></i> أضف إعلانك <i class="fa fa-circle" aria-hidden="true"></i>
		</h3>
		<form action="{{ route('ad-do-add') }}" method="POST" role="form" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">

				<div class="select-inputs-page">
					<select name="cat" id="cat_id">
						<option value="">--- التصنيف ---</option>
						@foreach($categories as $category)
							<option {{ old('cat') == $category->id ? 'selected' : ''  }} value="{{ $category->id }}"> {{ $category['name'] }} </option>
						@endforeach
					</select>
				</div>

				<div class="select-inputs-page">
					<select name="SubCat" disabled class="SubCat_id">
						<option value="">-- يرجى اختيار النوع --</option>
					</select>
				</div>

				<input type="text" class="form-control" id="" placeholder="عنوان الاعلان . 'يفضل ان يكون العنوان مميز'"
				       onfocus="this.placeholder = ''"
				       onblur="this.placeholder = 'العنوان'"
				       name="title">

				<input type="number" class="form-control" id="" placeholder="السعر" onfocus="this.placeholder = ''"
				       onblur="this.placeholder = 'السعر'"
				       name="price">

				<label for="type">
					نوع الإعلان
					<div>
						<span>بيع</span>
						<input type="radio" {{ old('type') == 'sell' ? 'checked' : '' }}
						name="type" value="sell">

						<span>إيجار</span>
						<input type="radio" {{ old('type') == 'rent' ? 'checked' : '' }} type="radio"
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

				<input type="tel" class="form-control" id="" placeholder=" رقم الهاتف " onfocus="this.placeholder = ''"
				       value="{{ isset(auth()->user()->phone) ? auth()->user()['phone'] : '' }}"
				       onblur="this.placeholder = ' رقم الهاتف '"
				       name="phone"
				>

				<div class="select-inputs-page">
					<label> المدينة </label>
					<select name="city" id="city_id">
						<option value="">-- يرجى اختيار المدينة --</option>

						@foreach($cities as $city)

							<option value="{{ $city['id'] }}" {{ old('city') ==  $city['id'] ? 'selected' : ''  }}> {{ $city['name'] }} </option>

						@endforeach

					</select>

				</div>

				<div class="select-inputs-page">
					<select name="hay" disabled id="hay_id">
						<option value="">-- يرجى اختيار المنطقة --</option>
					</select>

				</div>

				<div class="text-inputs-page">
					<label> وصف الاعلان </label>
					<textarea name="desc" placeholder="وصف الاعلان" rows="8"> {{ old('desc') }}</textarea>

					<input type="hidden" name="fir" value="{{ $lastId->id }}">
				</div>

			</div>
			<button type="submit" class="btn btn-primary hvr-shutter-out-vertical">أضف</button>
		</form>
	</div>

@endsection


@section('script')

	<script>


		$(window).load(function() {
			// get subcategory 
			$('#cat_id').on('change', function(e){
                    var cat = e.target.value;
                    $.get('{{url("/ajax-subcat-data/cat_id") }}/'+ cat , function(data){
                         // $('#SubCat_id').empty();
						obj = JSON.parse(data);
						//if(obj.length>0){
                             $('.SubCat_id').removeAttr('disabled');
                             $.each(obj, function(index, subcat){
                                     console.log('subcat',subcat.name);
                                     $('.SubCat_id').append('<option value="'+subcat.id+'">'+subcat.name+'</option>');
                              });
                         // }
                      });
                  
			});

			//get hay
			$('#city_id').on('change', function(e){
                    var city = e.target.value;
                    $.get('{{url("/ajax-hay-data/city_id") }}/'+ city , function(data){
                         // $('#SubCat_id').empty();
						obj = JSON.parse(data);
						//if(obj.length>0){
                             $('#hay_id').removeAttr('disabled');
                             $.each(obj, function(index, hay){
                                   console.log('hay',hay.name);
                                   $('#hay_id').append('<option value="'+hay.id+'">'+hay.name+'</option>');
                              });
                         // }
                      });
                  
			});
		});
	</script> 



@endsection
