@extends('web.master')

@section('content')

	<div class="col-xs-12 col-md-9 col-sm-9 containt-left">
                <form action="{{ route('search-ads') }}" method="get" role="form" class="search-sel3a  wow zoomIn" data-wow-delay="1.6s">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" id="input" placeholder="إبحث عن سلعة" onfocus="this.placeholder = ''" onblur="this.placeholder = 'إبحث عن سلعة'">
                    </div>
                    <button type="submit" class="hvr-skew-forward"><i class="fa fa-search"></i></button>
                </form>
                <a href="{{ route('ad-add') }}" class="add-e3lan hvr-wobble-horizontal wow fadeIn" data-wow-delay="1.7s"><i class="fa fa-plus"></i>أضف إعلان</a>
                <div class="links-tags">
                    <a class="hvr-shadow-radial wow zoomIn" data-wow-delay="1.63s">حراج السيارات</a> 
                    <a class="hvr-shadow-radial wow zoomIn" data-wow-delay="1.66s">حراج العقار</a> 
                    <a class="hvr-shadow-radial wow zoomIn" data-wow-delay="1.69s">حراج الأجهزة</a> 
                    <a class="hvr-shadow-radial wow zoomIn" data-wow-delay="1.72s">كل الحراج</a>
                </div>
                <div class="links-tags second">
                    <a class="hvr-shadow-radial">تويوتا</a> <a class="hvr-shadow-radial">فورد</a> 
                    <a class="hvr-shadow-radial">شيفروليه</a> <a class="hvr-shadow-radial">قطع</a> 
                    <a class="hvr-shadow-radial">غيار</a> <a class="hvr-shadow-radial">وملحقات</a> 
                    <a class="hvr-shadow-radial">نيسان</a> <a class="hvr-shadow-radial">هونداي</a> 
                    <a class="hvr-shadow-radial">لكزس</a> <a class="hvr-shadow-radial">جي ام سي</a> 
                    <a class="hvr-shadow-radial">شاحنات</a> <a class="hvr-shadow-radial">ومعدات</a> 
                    <a class="hvr-shadow-radial">ثقيلة</a>
                </div>
                <div class="links-tags third">
                    <a class="hvr-shadow-radial">كابريس </a><a class="hvr-shadow-radial">تاهو </a>
                    <a class="hvr-shadow-radial">سوبربان </a><a class="hvr-shadow-radial">لومينا </a>
                    <a class="hvr-shadow-radial">سلفرادو </a><a class="hvr-shadow-radial">كمارو </a>
                    <a class="hvr-shadow-radial">بليزر </a><a class="hvr-shadow-radial">ابيكا </a>
                    <a class="hvr-shadow-radial">ماليبو </a><a class="hvr-shadow-radial">افيو </a>
                    <a class="hvr-shadow-radial">كروز </a><a class="hvr-shadow-radial">اوبترا </a>
                    <a class="hvr-shadow-radial">تريل </a><a class="hvr-shadow-radial">بليزر </a>
                    <a class="hvr-shadow-radial">افلانش </a><a class="hvr-shadow-radial">كورفيت </a>
                    <a class="hvr-shadow-radial">فان</a>
                </div>
                <form action="{{ route('search-ads') }}" method="get"  role="form" class="search-city wow fadeIn" data-wow-delay="1.7s">
                    <div class="form-group">
                        <select name="city" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر المدينة</option>
                            <option disabled="disabled" value="">كل المدن</option>
                            @foreach(cities() as $oneCity)
								<option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
							@endforeach
                        </select>
                        <button type="submit" class="hvr-pulse-shrink"><i class="fa fa-location-arrow"></i></button>
                    </div>
                </form>
                <div class="">
                    <table class="table table-hover">
                        <tbody>

                        @foreach($ads as $ad)
                            <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="{{ route('ad-view', ['id' => $ad->id]) }}">{{ (strlen($ad->title) > 50) ? (mb_substr($ad->title, 0, 50) . ' ... ')  : (mb_substr($ad->title, 0, 50)) }}</a>
                                    <i class="fa fa-star"></i>
                                    <a class="topic-country" href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$ad->city_name}}</a>
                                </td>
                                <td>
                                    <span class="topic-time ">{{$ad->created_at->diffForHumans()}}</span>
                                    <a class="topic-user" href="profile-user.html"><i class="fa fa-user"></i>{{$ad->username}}</a>
                                </td>
                                <td>
                                <img src="{{ url('public/ads_262x249/' . $ad->photo ) }}">
                                    <a class="topic-img" href="{{ route('ad-view', ['id' => $ad->id]) }}"><img src="{{ url('public/ads_262x249/' . $ad->photo ) }}" alt="image-topic"></a>
                                </td>
                            </tr>
                        @endforeach

                            
                        </tbody>
                    </table>
                    <ul class="pagination">
                        <!-- <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li> -->
                        {{  $ads->links('web.pagination') }}
                    </ul>
                </div>
            </div>

            <div class="col-xs-12 col-md-3 col-sm-3 containt-right">
                <form action="{{ route('search-car') }}" method="get" role="form">
                    <div class="form-group wow fadeInRight" data-wow-delay="1.6s">
                        <select name="mark_id" id="mark" class="form-control black-color" required="required">
                            <option selected="" disabled="disabled" value="">إختر ماركة السيارة</option>

                               @foreach(Marks() as $mark)

                                    <option {{ old('mark_id') ==  $mark->id ? 'selected' : ''  }} value="{{ $mark->id }}"> {{ $mark->name }} </option>

                                @endforeach 
                        </select>
                    </div>

                    <div class="form-group wow fadeInRight" data-wow-delay="1.7s">
                        <select name="model_id" id="modal" class="form-control black-color" required="required">
                            <option selected="" disabled="disabled" value="">إختر نوع السيارة</option>
                           
                        </select>
                    </div>

                    <div class="form-group wow fadeInRight" data-wow-delay="1.8s">
                        <select name="year_id" id="year" class="form-control black-color" required="required">
                            <option selected="" disabled="disabled" value="">الموديل</option>
                            <option value="">كل الموديلات</option>
                           @foreach(Years() as $year)

                                    <option {{ old('year_id') == $year->id ? 'selected' : ''  }} value="{{ $year->id }}"> {{ $year->name }} </option>

                                @endforeach
                        </select>
                    </div>

                    <button type="submit" class="hvr-bounce-out wow fadeInRight" data-wow-delay="1.9s"><i class="fa fa-search"></i></button>

                </form>
                <hr>
                <div class="brands wow fadeInUp" data-wow-delay="2s">
                    <div class="row">
                     <?php $cat = \App\Categories::where('type',1)->first();?>
                @if($cat != '')
                @if(count(SubCats( 'cat_id' ,$cat->id)) >0)
                @foreach(SubCat( $cat->id) as $subcat)
                <div class="col-xs-4">
                    <a href="{{ route('get-subcat' , ['id' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt=""><i class="fa fa-car" aria-hidden="true"></i></a>
                    </div>
                @endforeach
                @endif
                @endif
                        <!-- <div class="col-xs-4">
                            <a href=""><img src="images/bmw-logo.png" alt="bmw-logo"><i class="fa fa-car"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/kia.png" alt="kia-logo"><i class="fa fa-car"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/logo-fiat.png" alt="fiat-logo"><i class="fa fa-car"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/toyota.png" alt="toyota-logo"><i class="fa fa-car"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/Volkswagen.png" alt="Volkswagen-logo"><i class="fa fa-car"></i></a>
                        </div> -->
                    </div>
                </div>
                <hr>
                <div class="brands wow fadeInUp" data-wow-delay="2.2s">
                    <div class="row">

                    <?php $cat = \App\Categories::where('type',3)->first();?>
                @if($cat != '')
                @if(count(SubCats( 'cat_id' ,$cat->id)) >0)
                @foreach(SubCat( $cat->id) as $subcat)
                <div class="col-xs-4">
                    <a href="{{ route('get-subcat' , ['id' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt=""><i class="fa fa-desktop" aria-hidden="true"></i></a>
                    </div>
                @endforeach
                @endif
                @endif
                        <!-- <div class="col-xs-4">
                            <a href=""><img src="images/android.png" alt="android-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/Apple.png" alt="Apple-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/canon.png" alt="canon-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/lg.png" alt="lg-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/nokia.png" alt="nokia-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/samsung-logo.jpg" alt="samsung-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/win.png" alt="windows-logo"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                        </div> -->
                    </div>
                </div>
                <hr>
                <div class="brands wow fadeInUp">
                    <div class="row">
                    <?php $cat = \App\Categories::where('type',4)->first();?>
                @if($cat != '')
                @if(count(SubCats( 'cat_id' ,$cat->id)) >0)
                @foreach(SubCat( $cat->id) as $subcat)
                <div class="col-xs-4">
                    <a href="{{ route('get-subcat' , ['id' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt=""><i class="fa fa-paw" aria-hidden="true"></i></a>
                    </div>
                @endforeach
                @endif
                @endif

                        <!-- <div class="col-xs-4">
                            <a href=""><img src="images/5arof.png" alt="5arof-logo"><i class="fa fa-paw" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/bird.png" alt="bird-logo"><i class="fa fa-paw" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/camel.png" alt="camel-logo"><i class="fa fa-paw" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/cat.png" alt="cat-logo"><i class="fa fa-paw" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <a href=""><img src="images/m3za.png" alt="m3za-logo"><i class="fa fa-paw" aria-hidden="true"></i></a>
                        </div> -->
                    </div>
                </div>
                <hr>
                <div class="links wow fadeInUp">
                <?php $cat = \App\Categories::where('type',2)->first();?>
                @if($cat != '')
                @if(count(SubCats( 'cat_id' ,$cat->id)) >0)
                @foreach(SubCats( 'cat_id' ,$cat->id) as $subcat)
                    <a href="{{ route('get-subcat' , ['id' => $subcat->id]) }}" class="hvr-shadow-radial">{{$subcat->name}}</a>
                @endforeach
                @endif
                @endif
                    <!-- <a href="index.html" class="hvr-shadow-radial">اراضي تجارية للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">شقق للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">شقق للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">فلل للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">فلل للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">عماره للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">محلات للتقبيل</a>
                    <a href="index.html" class="hvr-shadow-radial">محلات للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">مزارع للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">استراحات للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">استراحات للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">بيوت للبيع</a>
                    <a href="index.html" class="hvr-shadow-radial">بيوت للايجار</a>
                    <a href="index.html" class="hvr-shadow-radial">ادوار للايجار</a> -->
                </div>
                <hr>
                <ul class="wow fadeInUp">
                @if(count(cities())>0)
                @foreach(cities() as $city)
                    <li><a href="{{ route('get-city' , ['id' => $city->id]) }}" class="hvr-shrink">حراج {{$city->name}}</a></li>
                @endforeach
                @endif
                    
                </ul>
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