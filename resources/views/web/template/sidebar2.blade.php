<div class="col-md-3 col-xs-12 sidebar">
<a class="wow slideInRight hvr-shrink"  href="{{ route('ad-add') }}">أضف أعلانك هنا<span><i class="fa fa-plus" aria-hidden="true"></i></span></a>
                <a class="live wow slideInRight hvr-shrink"  href="{{route('search-ads-cat')}}">مباشر<span><i class="fa fa-wifi" aria-hidden="true"></i></span></a>
                <button class="live wow slideInRight hvr-shrink side-bar-link" style="background: #420000"  href="live.html">بحث شامل<span><i class="fa fa-search" aria-hidden="true"></i></span></button>

	<div class="col-md-12 first wow slideInRight" >
        <!-- <span>ابحث عن سلعة</span>  -->
		<form action="{{ route('search-ads') }}" method="get" role="form">
			<select name="cat" id="input" class="form-control" required="required">
				<option selected="" disabled="" value="">ابحث عن سلعة</option>
				@foreach(categories() as $category)
					<option {{ old('cat') == $category->id ? 'selected' : ''  }} value="{{ $category->id }}"> {{ $category['name'] }} </option>
				@endforeach
			</select>
			<select name="city" id="input" class="form-control" required="required">
				<option selected="" disabled="disabled" value="">المدينة</option>
				@foreach(cities() as $oneCity)
					<option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
				@endforeach
			</select>
			
			<button class="hvr-shrink" type="submit" class="btn btn-primary">بحث</button>
		</form>
	</div>

	<div class="col-md-12 first wow slideInRight">
                    <!-- <span>نوع العقار</span> -->
                    <form action="{{ route('search-ads') }}" method="get" role="form">
                    <select name="subcat" id="input" class="form-control" required="required">
						<option selected="" disabled="disabled" value="">نوع العقار</option>
						@foreach(SubCats( 'cat_id' ,13) as $subcat)
							<option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
						@endforeach
					</select>
                    <select name="type" id="input" class="form-control" required="required">
                        <!-- <option selected="" disabled="" value="">المساحة</option> -->
                        <option selected value="sell">بيع</option>
                        <option value="rent">إيجار</option>
                        <option value="exchange">بدل</option>
                        <option value="waiver">تنازل</option>
                    </select>
                    <select name="city" id="input" class="form-control" required="required">
                        <option selected="" disabled="" value="">المدينة</option>
                        @foreach(cities() as $oneCity)
							<option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
						@endforeach
                    </select>

                        <button class="hvr-shrink" type="submit" class="btn btn-primary">بحث</button>
                    </form>
    </div>
    
    <div class="col-md-12 first wow slideInRight">
                    <!-- <span>السيارات</span> -->
                    <form action="{{ route('search-car') }}" method="get" role="form">
                  {{--  <select name="subcat" id="input" class="form-control" required="required">
						<option selected="" disabled="disabled" value="">نوع السيارة</option>
						@foreach(SubCats( 'cat_id' ,11) as $subcat)
							<option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
						@endforeach
					</select> --}}
                            <select name="mark_id" id="mark">
                                <option value="" disabled="disabled" selected="">ماركة السيارة</option>

                               @foreach(Marks() as $mark)

                                    <option {{ old('mark_id') ==  $mark->id ? 'selected' : ''  }} value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                @endforeach 

                            </select>
                             <select name="model_id" id="modal">
                                <option value="" disabled="disabled" selected="">نوع السيارة</option>

                            </select>
                            
                            <select name="year_id" id="year">
                                <option value="" disabled="disabled" selected=""> موديل السيارة  </option>

                                @foreach(Years() as $year)

                                    <option {{ old('year_id') == $year->id ? 'selected' : ''  }} value="{{ $year->id }}"> {{ $year->name }} </option>

                                @endforeach 

                            </select>
                   

                        <button class="hvr-shrink" type="submit" class="btn btn-primary">بحث</button>
                    </form>
    </div>

    <div class="show">
                    <i class="fa fa-times close-sidebar" aria-hidden="true"></i>
                    <div class="col-md-12 car-brand wow slideInUp">
                        <h5>بحث بنوع السيارة</h5>
                        @foreach(Mark() as $subcat)
	                        <div class="col-md-4 col-sm-3 col-xs-3">
	                            <div class="row">
	                                <a href="{{ route('search-ads', ['subcat' => $subcat->subcat_id]) }}"><img src="{{ url('public/marks/' . $subcat->photo)}}" alt="dawood"></a>
	                            </div>
                        	</div>
                        @endforeach
                        <form action="{{ route('search-mark') }}" method="get" role="form">
                           <!-- <input type="hidden" name="Cat" value="11"> -->
                            <button class="hvr-shrink" type="submit" class="btn btn-primary">ماركات أخرى</button>
                        </form> 
                    </div>
			@if(SubCats( 'cat_id' ,12) !=null &&count(SubCats( 'cat_id' ,12))>0)
                    <div class="col-md-12 car-brand wow slideInUp">
                        <h5>أجهزة</h5>
                        
                        @foreach(SubCats( 'cat_id' ,12) as $subcat)
	                        <div class="col-md-4 col-sm-3 col-xs-3">
	                            <div class="row">
	                                <a href="{{ route('search-ads', ['subcat' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt="dawood"></a>
	                            </div>
                        	</div>
                        @endforeach
                        
                        <form action="{{ route('get-cat',['cat'=>12]) }}" method="get" role="form">
                            <input type="hidden" name="Cat" value="12">
                            <button class="hvr-shrink" type="submit" class="btn btn-primary">أجهزة أخرى</button>
                        </form> 
                    </div>
			@endif
			@if(SubCats( 'cat_id' ,14) !=null &&count(SubCats( 'cat_id' ,14))>0)
                    <div class="col-md-12 car-brand wow slideInUp">
                        <h5>حيوانات</h5>
                        @foreach(SubCats( 'cat_id' ,14) as $subcat)
	                        <div class="col-md-4 col-sm-3 col-xs-3">
	                            <div class="row">
	                                <a href="{{ route('search-ads', ['subcat' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt="dawood"></a>
	                            </div>
                        	</div>
                        @endforeach
                        <form action="{{ route('get-cat',['cat'=>14]) }}" method="get" role="form">
                            <input type="hidden" name="Cat" value="14">
                            <button class="hvr-shrink" type="submit" class="btn btn-primary">حيوانات أخرى</button>
                        </form> 
                    </div>
		@endif
                    <div class="col-md-12 car-brand wow slideInUp">
                        <h5 style="margin-bottom: 20px">أقسام أخرى</h5>
                     
               <?php $i = -1; ?>
                @foreach(categories() as $cat)
                <?php $i++; ?>
                @if($i>3)
              
                       
                        
                        <div class="col-md-6 col-sm-3 col-xs-3">
                            <div class="row">
                                <a class="other" href="{{ route('get-cat' , ['id' => $cat->id]) }}"><i
                                        aria-hidden="true"></i>{{ $cat->name }}</a>
                            </div>
                        </div>
                      @endif      
                    @endforeach
                       

                    </div>
                    
    
</div>


</div>

@section('script')
<script type="">
    
     $(window).load(function() {

            //getAjaxData('#city_id', '#hay_id', '{{ baseUrl('/ajax-hay-data') }}', 'city_id' );
            getAjaxData('#mark', '#modal', '{{ Url('/ajax-model-data') }}', 'mark_id' );
        });
</script>
@endsection('script')