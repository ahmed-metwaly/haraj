@extends('web.master')


@section('style')

    <style>

        #akar, #car {
            display: none;
        }

    </style>

@endsection

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="name-page">

            <a href="{{ route('home') }}">الرئيسية</a>
            /
            <a href="{{ route('ad-add') }}"> تعديل الاعلان </a>
        </div>
        <div class="bg-content-page">
            <div class="title-page-content wow animate fadeIn" data-wow-duration="2.0s">
                <h2><span>&#8226;</span> تعديل الاعلان <span>&#8226;</span></h2>
            </div>

            <div class="form-add-ads">

                <form action="{{ route('add-do-edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="_method" value="PUT"> -->

                    <div class="select-inputs-page">
                        <label> القسم </label>
                        <select name="cat" id="cat">

                            <option value="">-- القسم الاعلان --</option>

                            @foreach($categories as $category)

                                <option value="{{ json_encode([$category->id => $category->name]) }}"> {{ $category->name }} </option>


                            @endforeach

                        </select>
                    </div>
                    <br>

                    <label>الفئة</label>
                    <div class="text-inputs-page form-group">
                        <label class="radio-box"><input {{ $data->type == 'sell' ? 'checked' : '' }}  type="radio"
                                                        name="type" value="sell"> بيع </label>
                        <label class="radio-box"><input {{ $data->type == 'rent' ? 'checked' : '' }} type="radio"
                                                        name="type" value="rent"> إيجار </label>
                    </div>
                    <br>
                    <label>العنوان</label>

                    <div class="text-inputs-page">
                        <input type="text" name="title" value="{{ $data->title }}"
                               placeholder="عنوان الاعلان . 'يفضل ان يكون العنوان مميز'">
                    </div>

                    <br/>
                    <div class="text-inputs-page">
                        <label> السعر </label>
                        <input type="text" name="price" value="{{ $data->price }}"
                               placeholder="قيمة الاعلان بالريال السعودى">
                    </div>
                    <br>
                    <div class="file-inputs-page">
                        <label class="pull-right"> الصورة الرئيسية </label>
                        <div class="box">
                            <input type="file" name="photo" id="file-7" class="inputfile inputfile-6"
                                   data-multiple-caption="{count} files selected"/>
                            <label for="file-7">
                                <span></span>
                                <strong>


                                    صورة رئيسية للاعلان
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div>
                    </div>

                    <br>

                    <img src="{{ url('public/ads_262x249/' . $data->photo) }}" alt="...">

                    <br>
                    <div class="file-inputs-page">
                        <label class="pull-right"> الصور الفرعية </label>
                        <div class="box">

                            <input type="file" name="img[]" id="file-8" class="inputfile inputfile-6"
                                   data-multiple-caption="{count} files selected" multiple/>

                            <label for="file-8">
                                <span></span>
                                <strong>
                                    يمكنك تحديد اكثر من صورة
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div>
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

                    <br>
                    <br>
                    <div class="text-inputs-page">
                        <label> رقم الهاتف </label>
                        <input type="tel" name="phone"
                               value="{{ $data->phone }}"
                               placeholder="رقم الجوال">
                    </div>
                    <br>
                    <div class="select-inputs-page">
                        <label> المدينة </label>
                        <select name="city" id="city_id">
                            <option value="">-- يرجى اختيار المدينة --</option>

                            @foreach($cities as $city)

                                <option value="{{ $city->id }}" {{ $data->city ==  $city->id ? 'selected' : ''  }}> {{ $city->name }} </option>

                            @endforeach

                        </select>

                    </div>
                    <br/>

                    <div class="select-inputs-page">
                        <label> الحى </label>
                        <select name="hay" id="hay_id">

                            <option value="">-- يرجى اختيار الحى --</option>

                            @foreach($hay as $oneHay)

                                <option value="{{ $oneHay->id }}" {{ $data->hay == $oneHay->id ? 'selected' : '' }} > {{ $oneHay->name }} </option>

                            @endforeach

                        </select>

                    </div>

                    <br/>

                    <div id="car">
                        <div class="select-inputs-page">
                            <label> الماركة </label>
                            <select name="mark_id" id="mark">
                                <option value="">-- يرجى اختيار ماركة السيارة --</option>

                                @foreach($marks as $mark)

                                    <option <?php

                                            if (isset($carData->mark_id) && $carData->mark_id != '') {
                                                if ($carData->mark_id == $mark->id) {
                                                    echo 'selected';
                                                }
                                            }

                                            ?> value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                @endforeach

                            </select>

                        </div>
                        <br/>
                        <div class="select-inputs-page">
                            <label> الموديل </label>
                            <select name="model_id" id="modal">
                                <option value="">-- يرجى اختيار موديل السيارة --</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}"
                                            @if(isset($carData->model_id) && $carData->model_id !='')
                                            @if($carData->model_id == $model->id)
                                            selected
                                            @endif
                                            @endif > {{ $model->name }} </option>
                                @endforeach


                            </select>

                        </div>
                        <br/>
                        <div class="select-inputs-page">
                            <label> السنة </label>
                            <select name="year_id" id="year">
                                <option value="">-- يرجى اختيار السنة --</option>

                                @foreach($years as $year)

                                    <option value="{{ $year->id }}"

                                            @if(isset($carData->year_id) && $carData->year_id !='')
                                            @if($carData->year_id == $year->id)
                                            selected
                                            @endif
                                            @endif
                                    > {{ $year->name }} </option>

                                @endforeach

                            </select>

                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد الابواب </label>
                            <input type="number"
                                   value="@if(isset($carData->doors) && $carData->doors != '') {{ $carData->doors }} @endif"
                                   placeholder="عدد الابواب" name="doors">

                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> لون السيارة </label>
                            <input type="text"
                                   value="@if(isset($carData->color) && $carData->color != '') {{ $carData->color }} @endif"
                                   placeholder="لون السيارة" name="color">

                        </div>
                        <br/>
                    </div>


                    <div id="akar">
                        <div class="select-inputs-page">
                            <label> فئة العقار </label>
                            <select name="akar_type_id" id="mark">
                                <option value="">-- يرجى اختيار فئة العقار --</option>

                                @foreach($akars as $akar)

                                    <option
                                        @if(isset($akarData->akar_type_id) && $akarData->akar_type_id !='')
                                              @if($akarData->akar_type_id == $akar->id)
                                                selected
                                            @endif
                                        @endif
                                            value="{{ $akar->id }}"> {{ $akar->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> المساحة </label>
                            <input type="text" value="@if(isset($akarData->dest) && $akarData->dest != '') {{ $akarData->dest }} @endif" name="dest" placeholder="مساخة العقار">
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد الفرف </label>
                            <input type="number" value="@if(isset($akarData->rooms) && $akarData->rooms != '') {{ $akarData->rooms }} @endif" name="rooms" placeholder="عدد الغرف">
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد دورات المياة </label>
                            <input type="number" value="@if(isset($akarData->bathrooms) && $akarData->bathrooms != '') {{ $akarData->bathrooms }} @endif" name="bathrooms"
                                   placeholder="عدد ورات المياة">
                        </div>
                        <br/>
                    </div>

                    <div class="text-inputs-page">
                        <label> وصف الاعلان </label>
                        <textarea name="desc" placeholder="وصف الاعلان" rows="8"> @if(isset($data->desc) && $data->desc != '') {{ $data->desc }} @endif </textarea>

                    </div>
                    <br>

                    <div class="submit-form-page">
                        <div class="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" name="submit" value="إرسال"/>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('script')

    <script type="text/javascript">
        $(document).ready(function () {


            $('.delete-img').click(function(e) {

                e.preventDefault();

                var thisClass = $(this);

                var route = $(this).attr('href');

                $.ajax({
                    url : route,
                    method : 'GET',
                    data: ''

                }).success(function(data) {

                    thisClass.closest('div').remove();



                }).error(function(data) {
                    console.log(data);
                });


            });

            getAjaxData('#city_id', '#hay_id', '{{ baseUrl('/ajax-hay-data') }}', 'city_id');
            getAjaxData('#mark', '#modal', '{{ baseUrl('/ajax-model-data') }}', 'mark_id');


            @if(isset($carData->id) && $carData->id != '')

            $('#car').show();
            $('#akar').hide();

            @elseif(isset($akarData->id) && $akarData->id != '')

                $('#akar').show();
                $('#car').hide();


            @endif


        });
    </script>

@endsection