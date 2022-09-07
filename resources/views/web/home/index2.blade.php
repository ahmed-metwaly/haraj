@extends('web.master')

@section('content')
    @include('web.template.sidebar')
     <div class="col-md-9 col-xs-12 content">
                <div class="col-md-12 wow pulse" data-wow-delay="5s" data-wow-iteration="2" data-wow-duration="3s">
                    <div id="owl-demo" class="owl-carousel">
                    @foreach(categories() as $category)
			@if($category->photo !='')
                        <div>
                        <a href="{{ route('get-cat' , ['id' => $category->id]) }}">
                            <img src="{{ url('public/categories/' . $category->photo ) }}" alt="$category->name_ar">
                        </a>

                        </div>
                        @endif
                    @endforeach
                        
                    </div>
                </div>
                <div class="select-content col-md-12 wow shake" data-wow-delay="7s" data-wow-duration="3s">
                 <form action="{{ route('search-ads') }}" method="get" role="form">
<input type="text" name="title" id="input" class="form-control" value="" title="" placeholder="إبحث عن ما تريد ..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'إبحث عن ما تريد ...'">
                    <select name="category" id="input" class="col-md-3 col-xs-6 col-sm-6 cat" >
                        <option selected="" disabled="" value="">التصنيف</option>
                        @foreach(categories() as $category)
                        
                        <option {{ old('cat') == $category->id ? 'selected' : ''  }} value="{{ $category->id }}"> {{ $category['name'] }} </option>
                    @endforeach
                    </select>
                    <select name="subcat" id="input" class="col-md-3 col-xs-6 col-sm-6 subcat">
                        <option selected="" disabled="disabled" value="">النوع</option>
                    </select>
                    <select name="city" id="input" class="col-md-3 col-xs-6 col-sm-6">
                        <option selected="" disabled="" value="">المدينة</option>
                        @foreach(cities() as $oneCity)
                        <option value="{{ $oneCity->id }}">{{ $oneCity->name }}</option>
                    @endforeach
                    </select>
                        <button type="submit" class=" col-md-3 col-xs-6 col-sm-6 hvr-shrink btn btn-primary">بحث</button>
                    </form>
                </div>

                <div class="col-md-12 tabs ">
                    <div class="row">
                        <div class="tabpanel" role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a class="hvr-pop" href="#home" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ url('public/web') }}/images/tabs2.png" alt=""></a>
                                </li>
                                <li role="presentation" class="active">
                                    <a class="hvr-pop" href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><img src="{{ url('public/web') }}/images/tabs1.png" alt=""></a>
                                </li>
                            </ul>
                            <p><span class="wow flash" data-wow-delay="5s" data-wow-iteration="2" data-wow-duration="3s"><i class="fa fa-eye" aria-hidden="true"></i> الأحدث</span></p>
                            <!-- Tab panes -->
                            <div class="tab-content ">

                                <div role="tabpanel" class="tab-pane box" id="home">
                                @foreach($newAds as $newAd)
                                @if($newAd->is_pro==1)
                                    <div class="col-md-6 col-lg-4 col-xs-12 col-sm-6">
                                        <div>
                                            <div>
                                                <a href="{{ route('ad-view', ['id' => $newAd->id]) }}">
                                                    <img src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
                                                     alt="{{ $newAd->photo }}">
                                                </a>
                                            </div>
                                            <h4><a href="#"> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </a></h4>

                                            <p>{{ $newAd->desc }}</p>
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $newAd->city_id }}</span>
                                            <span class="box-left">{{$newAd->price}} ريال</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach

                                    @foreach($newAds as $newAd)
                                @if($newAd->is_pro==0)
                                    <div class="col-md-6 col-lg-4 col-xs-12 col-sm-6">
                                        <div>
                                            <div>
                                                <a href="{{ route('ad-view', ['id' => $newAd->id]) }}">
                                                    <img src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
                                                     alt="{{ $newAd->photo }}">
                                                </a>
                                            </div>
                                            <h4><a href="#"> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </a></h4>

                                            <p>{{ $newAd->desc }}</p>
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $newAd->city_id }}</span>
                                            <span class="box-left">{{$newAd->price}} ريال</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <div style="text-align: left">
                                        {{  $newAds->links('web.pagination') }}
                                    </div>

                                    <div class="clearfix"></div>
                                    <div style="margin-bottom: 40px" class=" text-center col-md-12">
                                        <!-- <div class="row"> -->
                                            
                                            <p style="top: 10px"><span class="wow flash text-center" style="display: block;width: 100%"><i class="fa fa-eye" aria-hidden="true"></i> الأكثر مشاهدة</span></p>
                                      <!--   </div> -->
                                </div>
                                    @foreach($viewsAds as $newAd)
                                
                                    <div class="col-md-6 col-lg-4 col-xs-12 col-sm-6">
                                        <div>
                                            <div>
                                                <a href="{{ route('ad-view', ['id' => $newAd->id]) }}">
                                                    <img src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
                                                     alt="{{ $newAd->photo }}">
                                                </a>
                                            </div>
                                            <h4><a href="#"> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </a></h4>

                                            <p>{{ $newAd->desc }}</p>
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $newAd->city_id }}</span>
                                            <span class="box-left">{{$newAd->price}} ريال</span>
                                        </div>
                                    </div>
                                   
                                    @endforeach
        
                                    <div style="text-align: left">
                                        {{  $newAds->links('web.pagination') }}
                                    </div>

                                    <div class="clearfix"></div>


                            
                                </div>

                                <div role="tabpanel" class="tab-pane active table-content" id="tab">
                                <div class="table-responsive">
                                    <table class="table table-hover wow slideInUp">
                                        <thead>
                                            <tr>
                                                <th>العروض</th>
                                                <th>المدينة</th>
                                                <th class="hidden-xs">المعلن</th>
                                                <th>قبل</th>
                                                <th class="hidden-xs"><i class="fa fa-camera" aria-hidden="true"></i></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($newAds as $nAdd)
                                        @if($nAdd->is_pro==1)
                                            <tr>
                                                <td><a href="{{ route('ad-view', ['id' => $nAdd->id]) }}">{{$nAdd->title }}</a></td>
                                                <td><a href="#">{{ $nAdd->city_id }}</a></td>
                                                <td class="hidden-xs"><a href="{{route('public-profile',['id'=>$nAdd->created_by])}}">{{ $nAdd->created_by }}</a></td>
                                                <td><a href="#">{{ $nAdd->created_at->diffForHumans() }}</a></td>
                                                <td class="hidden-xs">
                                                    <a class="fancybox" rel="group"
                                               href="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"><img
                                                        src="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"
                                                        alt=""/></a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                             @foreach($newAds as $nAdd)
                                        @if($nAdd->is_pro==0)
                                            <tr>
                                                <td><a href="{{ route('ad-view', ['id' => $nAdd->id]) }}">{{$nAdd->title }}</a></td>
                                                <td><a href="#">{{ $nAdd->city_id }}</a></td>
                                                <td class="hidden-xs"><a href="{{route('public-profile',['id'=>$nAdd->created_by])}}"> username </a></td>
                                                <td><a href="#">{{ $nAdd->created_at->diffForHumans() }}</a></td>
                                                <td class="hidden-xs">
                                                    <a class="fancybox" rel="group"
                                               href="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"><img
                                                        src="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"
                                                        alt=""/></a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    <div style="text-align: left">
                                {{  $newAds->links('web.pagination') }}
                            </div>
                                

                                <div style="margin-bottom: 40px" class=" title-tabel col-md-12">
                                        <div class="row">
                                            <hr>
                                            <p style="top: 10px"><span class="wow flash"><i class="fa fa-eye" aria-hidden="true"></i> الأكثر مشاهدة</span></p>
                                        </div>
                                </div>
                                <div class="table-responsive">
                                <table class="table table-hover wow slideInUp">
                                        <thead>
                                            <tr>
                                                <th>العروض</th>
                                                <th>المدينة</th>
                                                <th class="hidden-xs">المعلن</th>
                                                <th>قبل</th>
                                                <th class="hidden-xs"><i class="fa fa-camera" aria-hidden="true"></i></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                            @if(count($viewsAds)>0)
                                            @foreach($viewsAds as $vAdd)
                                                <td><a href="{{ route('ad-view', ['id' => $vAdd->id]) }}"> {{ $vAdd->title }} </a></td>
                                                <td><a href="#"> {{ $vAdd->city_id }} </a></td>
                                        <td class="hidden-xs"><a href="{{route('public-profile',['id'=>$vAdd->created_by])}}">user </a></td>
                                        <td><a href="#">{{  $vAdd->created_at->diffForHumans() }}</a></td>
                                        <td class="hidden-xs">
                                            <a class="fancybox" rel="group"
                                               href="{{ url('public/ads_262x249/' . $vAdd->photo ) }}"><img
                                                        src="{{ url('public/ads_262x249/' . $vAdd->photo ) }}" alt=""/></a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                        </tbody>
                                    </table> 
                                    </div>
                                    <div class="col-md-12">
                                {{  $viewsAds->links('web.pagination') }}
                            </div>
                            @endif
  
                                  
                                </div>  

                        </div>
                    </div>
                </div>        
</div>
</div>

        


@endsection

@section('loading')
    <!--start-loading-page
    <section class="over-lay">
        <div class='loading-page'>
            <div class='loading-overlay'></div>
            <div class="spinner"></div>
        </div>
    </section>
    <!--end-loading-page -->
@endsection

@section('script')

    <script>


        $(window).load(function() {
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