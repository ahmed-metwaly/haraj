@extends('web.master')
@section('style')
<style>
    #akar , #car{
    display:none;
    }  
    </style>
@endsection

@section('content')
    <p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="#">أضف إعلانك</a></p>
    <div class="contact-us add-e3lan">
        <h3><i class="fa fa-circle" aria-hidden="true"></i> أضف إعلانك <i class="fa fa-circle" aria-hidden="true"></i>
        </h3>

                <form action="{{ route('ad-do-add') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                    <div class="select-inputs-page">
                        <label> القسم </label>
                        <select name="cat" id="cat">

                            <option value="">-- القسم الاعلان --</option>

                            @if(count($categories)>0)
                            @foreach($categories as $category)

                            <option value="{{ json_encode([$category->id => $category->name]) }}" data-type="{{$category->type}}"> {{ $category->name }} </option>


                            @endforeach
                            @endif

                        </select>
                    </div>
                    <br>
                    <div id="except_car">
                    <div class="select-inputs-page">
                    <select name="SubCat" disabled class="SubCat_id">
                        <option value="">-- يرجى اختيار النوع --</option>
                    </select>
                </div>
                <br/> 
                </div>
                
                <div id="car">
                        <div class="select-inputs-page">
                            <label> الماركة </label>
                            <select name="mark_id" id="mark">
                                <option value="">-- يرجى اختيار ماركة السيارة --</option>
				@if(count($marks)>0)
                                @foreach($marks as $mark)

                                    <option {{ old('mark_id') ==  $mark->id ? 'selected' : ''  }} value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                @endforeach
                                @endif

                            </select>

                        </div>
                        <br />
                        <div class="select-inputs-page">
                            <label> النوع </label>
                            <select name="model_id" id="modal">
                                <option value="">-- يرجى اختيار نوع السيارة --</option>

                            </select>

                        </div>
                        <br />
                        <div class="select-inputs-page">
                            <label> الموديل </label>
                            <select name="year_id" id="year">
                                <option value="">-- يرجى اختيار الموديل  --</option>
				                @if(count($years)>0)
                                @foreach($years as $year)

                                    <option {{ old('year_id') == $year->id ? 'selected' : ''  }} value="{{ $year->id }}"> {{ $year->name }} </option>

                                @endforeach
                                @endif

                            </select>

                        </div>
                        <br />
                        <div class="text-inputs-page">
                            <label> عدد الابواب </label>
                            <input type="number" value="{{ old('doors') }}" placeholder="عدد الابواب" name="doors">

                        </div>
                        <br />
                        <div class="text-inputs-page">
                            <label> لون السيارة </label>
                            <input type="text" value="{{ old('color') }}" placeholder="لون السيارة" name="color">

                        </div>
                        <br />
                    </div>

                    <label>الفئة</label>
                    <div class="text-inputs-page form-group">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-lg-3">
                                <label class="radio-box"><input {{ old('type') == 'sell' ? 'checked' : '' }}  type="radio" name="type" value="sell"> بيع </label>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-3">
                                <label class="radio-box"><input {{ old('type') == 'rent' ? 'checked' : '' }} type="radio" name="type" value="rent"> إيجار </label>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-3">
                                <label class="radio-box"><input {{ old('type') == 'exchange' ? 'checked' : '' }} type="radio" name="type" value="exchange"> بدل  </label>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-3">
                                <label class="radio-box"><input {{ old('type') == 'waiver' ? 'checked' : '' }} type="radio" name="type" value="waiver"> تنازل  </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <label>العنوان</label>

                    <div class="text-inputs-page">
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="عنوان الاعلان . 'يفضل ان يكون العنوان مميز'">
                    </div>

                    <br />
                    <div class="text-inputs-page">
                        <label> السعر </label>
                        <input type="text" name="price" value="{{ old('price') }}" placeholder="قيمة الاعلان بالريال السعودى">
                    </div>
                    <br>
                    <div class="file-inputs-page">
                        <label> صورة رئيسية للاعلان </label>

                        <input id="uploadFile" placeholder="Choose File" disabled="disabled">
                        <div class="fileUpload btn btn-primary">
                            <span>أضف ملف</span>
                            <input type="file" name="photo" value="{{ old('photo') }}" id="uploadBtn" class="upload" />
                        </div>
                        

{{--                         <div class="box">
                            <input type="file" value="{{ old('photo') }}" name="photo" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                            <label for="file-7">
                                <span></span>
                                <strong>


                                    صورة رئيسية للاعلان
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div> --}}



                    </div>
                    <br>
                    <div class="file-inputs-page">
                        <label> الصور الفرعية </label>

                        <input id="uploadFilee" placeholder="Choose File" disabled="disabled">
                        <div class="fileUploadd btn btn-primary">
                            <span>أضف ملف</span>

                            <input type="file" name="img[]"  class="upload" id="uploadBtnn" class="upload"  multiple/>
                        </div>
                       {{-- <div class="box">
                       

                            <input type="file" name="img[]" id="file-8" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />

                            <label for="file-8">
                                <span></span>
                                <strong>
                                    يمكنك تحديد اكثر من صورة
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div> --}}
                    </div>
                    <br>
                    <div class="text-inputs-page">
                        <label> رقم الهاتف </label>
                        <input type="tel" name="phone" value="{{ isset(auth()->user()->phone) ? auth()->user()->phone : '' }}" placeholder="رقم الجوال">
                    </div>
                    <br>
                    <div class="select-inputs-page">
                        <label> المدينة </label>
                        <select name="city" id="city_id">
                            <option value="">-- يرجى اختيار المدينة --</option>
				@if(count($cities)>0)
                            @foreach($cities as $city)

                                <option value="{{ $city->id }}" {{ old('city') ==  $city->id ? 'selected' : ''  }}> {{ $city->name }} </option>

                            @endforeach
                            @endif

                        </select>

                    </div>
                    <br />

                    <div class="select-inputs-page">
                        <label> الحى  </label>
                        <select name="hay" disabled id="hay_id">

                            <option value="">-- يرجى  اختيار الحى --</option>

                        </select>

                    </div>

                    <br />

                    



                    <div id="akar" >
                        <div class="select-inputs-page">
                            <label> فئة العقار </label>
                            <select name="akar_type_id" id="mark">
                                <option value="">-- يرجى اختيار فئة العقار --</option>
				@if(count($akars)>0)
                                @foreach($akars as $akar)

                                    <option {{ old('akar_type_id') == $akar->id ? 'selected' : ''  }} value="{{ $akar->id }}"> {{ $akar->name }} </option>

                                @endforeach
                                @endif

                            </select>

                        </div>
                        <br />
                        <div class="text-inputs-page">
                            <label> المساحة </label>
                            <input type="text" value="{{ old('dest') }}" name="dest" placeholder="مساخة العقار">
                        </div>
                        <br />
                        <div class="text-inputs-page">
                            <label> عدد  الغرف </label>
                            <input type="number" value="{{ old('rooms') }}" name="rooms" placeholder="عدد الغرف">
                        </div>
                        <br />
                        <div class="text-inputs-page">
                            <label> عدد دورات المياة </label>
                            <input type="number" value="{{ old('bathrooms') }}" name="bathrooms" placeholder="عدد ورات المياة">
                        </div>
                        <br />
                    </div>

                    <div class="text-inputs-page">
                        <label> وصف الاعلان </label>
                        <textarea name="desc" placeholder="وصف الاعلان" rows="8"> {{ old('desc') }}</textarea>
			
			{{--@if($lastId ==0 )
			<input type="hidden" name="fir" value="{{ $lastId }}" >
			@else
                        <input type="hidden" name="fir" value="{{ $lastId->id }}" >
                        @endif --}}
                        
                        <input type="hidden" name="fir" value="{{ $lastId->id }}" >
                    </div>
                    <br>
<!-- 
                    <div class="submit-form-page">
                        <div class="">
                          {{--  <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                            <input type="submit" name="submit" value="إرسال"/>


                        </div>
                    </div> -->
                     <button type="submit" class="btn btn-primary hvr-shutter-out-vertical">أضف</button>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('script')

    <script type="text/javascript">
      //  $(document).ready(function(){
            $(window).load(function() {

            getAjaxData('#city_id', '#hay_id', '{{ baseUrl('/ajax-hay-data') }}', 'city_id' );
            getAjaxData('#mark', '#modal', '{{ baseUrl('/ajax-model-data') }}', 'mark_id' );

            $('#cat').on('change', function(e){
                    var cat = e.target.value;
                    var i=JSON.parse(cat);
                    var cat1=Object.keys(i)[0];
                    var cat_type = $('#cat').find(':selected').data('type');

            console.log('type : ',cat_type);
            if(cat_type == 1){
                $('#akar').hide();
                $('#akar').val(0);
                $('#except_car').hide();
                $('#car').show(1000);
            } else if(cat_type == 2) {
                $('#car').hide();
                $('#car').val(0);
                $('#except_car').hide();
                $('#akar').show(1000);
            }else{
                $('#car').hide();
                $('#except_car').show();
                $('#car').val(0);
                 $('#akar').hide();
                $('#akar').val(0);
            }

                    console.log(i);
                    console.log(i[Object.keys(i)[0]]);
                    console.log(Object.keys(i)[0]);
                    $.get('{{url("/ajax-subcat-data/cat_id") }}/'+ cat1 , function(data){
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
        });
    </script>
@endsection    