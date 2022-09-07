@extends('web.master')

@section('content')
	
	<div class="col-xs-12 col-md-8 col-sm-8 containt-right search-page">
                <form action="{{ route('search-ads') }}" method="get" role="form">
                    <legend><i class="fa fa-certificate" aria-hidden="true"></i>بحث عن سلعة<i class="fa fa-certificate" aria-hidden="true"></i></legend>
                    <div class="form-group">
                        <input required="" type="text" name="title" class="form-control" id="" placeholder="إبحث عن سلعة" onfocus="this.placeholder = ''" onblur="this.placeholder = 'إبحث عن سلعة'">
                    </div>
                    <button type="submit" class="hvr-bounce-out wow fadeInRight" data-wow-delay="1.9s"><i class="fa fa-search"></i></button>
                </form>

                <form action="{{ route('search-cars') }}" method="get" role="form">
                    <legend><i class="fa fa-certificate" aria-hidden="true"></i>بحث السيارات<i class="fa fa-certificate" aria-hidden="true"></i></legend>
                    <div class="form-group wow fadeInRight" data-wow-delay="1.6s">
                        <select name="mark_id" id="mark" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر ماركة السيارة</option>
                             @foreach(Marks() as $mark)

                                    <option {{ old('mark_id') ==  $mark->id ? 'selected' : ''  }} value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                @endforeach 
                        </select>
                    </div>
                    <div class="form-group wow fadeInRight" data-wow-delay="1.7s">
                        <select name="model_id" id="modal" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر نوع السيارة</option>
                            
                        </select>
                    </div>
                    <div class="form-group wow fadeInRight" data-wow-delay="1.8s">
                        <select name="from_year" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">من سنة ..</option>
                             @foreach(Years() as $year)

                                    <option {{ old('year_id') == $year->id ? 'selected' : ''  }} value="{{ $year->id }}"> {{ $year->name }} </option>

                                @endforeach
                        </select>
                    </div>
                    <div class="form-group wow fadeInRight" data-wow-delay="1.8s">
                        <select name="to_year" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إلى سنة ..</option>
                             @foreach(Years() as $year)

                                    <option {{ old('year_id') == $year->id ? 'selected' : ''  }} value="{{ $year->id }}"> {{ $year->name }} </option>

                                @endforeach
                        </select>
                    </div>
                    <div class="form-group wow fadeInRight" data-wow-delay="1.8s">
                        <select name="city" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر المدينة</option>
                             @foreach(cities() as $oneCity)
								<option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
							@endforeach
                        </select>
                    </div>
                    <button type="submit" class="hvr-bounce-out wow fadeInRight"><i class="fa fa-search"></i></button>
                </form>
                <form action="{{route('search-akar')}}" method="get" role="form">
                    <legend><i class="fa fa-certificate" aria-hidden="true"></i>بحث العقار<i class="fa fa-certificate" aria-hidden="true"></i></legend>
                    <div class="form-group wow fadeInRight">
                        <select name="akar_type" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر نوع العقار</option>
                            @if(count($akars)>0)
                                @foreach($akars as $akar)

                                    <option {{ old('akar_type_id') == $akar->id ? 'selected' : ''  }} value="{{ $akar->id }}"> {{ $akar->name }} </option>

                                @endforeach
                                @endif>
                        </select>
                    </div>
                    <div class="form-group wow fadeInRight">
                        <select name="city" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر المدينة</option>
                             @foreach(cities() as $oneCity)
								<option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
							@endforeach
                        </select>
                    </div>
                    <button type="submit" class="hvr-bounce-out wow fadeInRight"><i class="fa fa-search"></i></button>
                </form>
                <form action="search-result.html" method="POST" role="form">
                    <legend><i class="fa fa-certificate" aria-hidden="true"></i>بحث عن عضو<i class="fa fa-certificate" aria-hidden="true"></i></legend>
                    <div class="form-group">
                        <input required="" type="text" class="form-control" id="" placeholder="إبحث عن عضو" onfocus="this.placeholder = ''" onblur="this.placeholder = 'إبحث عن عضو'">
                    </div>
                    <button type="submit" class="hvr-bounce-out wow fadeInRight"><i class="fa fa-search"></i></button>
                </form>
            </div>

@endsection

@section('script')

    <script>

console.log('out');
        //$(window).load(function() {
        	$(document).ready(function(){
console.log('here');
        	getAjaxData('#mark', '#modal', '{{ Url('/ajax-model-data') }}', 'mark_id' );
            // get subcategory 
            $('.cat').on('change', function(e){
                    var cat = e.target.value;
                    $.get('{{url("/ajax-subcat-data/cat_id") }}/'+ cat , function(data){
                          $('.subcat').empty();
                        obj = JSON.parse(data);
                        //if(obj.length>0){
                             $('.subcat').removeAttr('disabled');
                             $.each(obj, function(index, subcat){
                                     console.log('subcat',subcat.name);
                                     $('.subcat').append('<option value="'+subcat.id+'">'+subcat.name+'</option>');
                              });
                         // }
                      });
                  
            });

            });
    </script> 



@endsection