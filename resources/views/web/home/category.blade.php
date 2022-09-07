@extends('web.master')

@section('content')

    <section class="header-and-content">

        <div class="container">

            @include('web.template.sidebar')

            <div class="col-md-8 col-sm-12 col-xs-12">

                <div class="section-tab-content">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#contettabs">
                                <i class="fa fa-th no-border" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#contettab">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content">


                        <div id="contettabs" class="tab-pane fade in active">

                            <div class="pac-tabs">
                                <div class="title-content">
                                    <hr/>
                                    <div class="icon">
                                        <a><h1><i class="fa fa-search" aria-hidden="true"></i>  {{ $catName->name_ar }} </h1></a>
                                    </div>
                                </div>

                                @foreach($data as $newAd)
                                @if($newAd->is_pro==1)

                                    <div class="col-md-4 col-sm-6 col-xs-12 bg-block  wow animate fadeInUp"
                                         data-wow-duration="1.5s">
                                        <div class="block">
                                            <a href="{{ route('ad-view', ['id' => $newAd->id]) }}"><img
                                                        src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
                                                        alt="{{ $newAd->photo }}" class="img-responsive"/></a>
                                            <span> {{ $newAd->created_at->diffForHumans() }} </span>
                                            <h2> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </h2>
                                            <div class="p-background">
                                                <p class="col-md-6 col-sm-6 col-xs-6 bg-p"><a href="{{route('public-profile',['id'=>$newAd->byUser()->first()->id])}}">{{ $newAd->byUser()->first()->name }}</a></p>
                                                <p class="col-md-6 col-sm-6 col-xs-6 ">{{ $newAd->city()->first()->name_ar }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                @foreach($data as $newAd)
                                @if($newAd->is_pro==0)
                                    <div class="col-md-4 col-sm-6 col-xs-12 bg-block  wow animate fadeInUp"
                                         data-wow-duration="1.5s">
                                        <div class="block">
                                            <a href="{{ route('ad-view', ['id' => $newAd->id]) }}"><img
                                                        src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
                                                        alt="{{ $newAd->photo }}" class="img-responsive"/></a>
                                            <span> {{ $newAd->created_at->diffForHumans() }} </span>
                                            <h2> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </h2>
                                            <div class="p-background">
                                                <p class="col-md-6 col-sm-6 col-xs-6 bg-p"><a href="{{route('public-profile',['id'=>$newAd->byUser()->first()->id])}}">{{ $newAd->byUser()->first()->name }}</a></p>
                                                <p class="col-md-6 col-sm-6 col-xs-6 ">{{ $newAd->city()->first()->name_ar }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                @endforeach


                                <div class="col-md-12- col-sm-12 col-xs-12  pagination wow animate fadeInUp" data-wow-duration="1.5s">
                                    <ul>
                                        {{ $data->links() }}
                                    </ul>
                                </div>

                                <br>
                                <br>

                            </div>
                            <div class="clearfix"></div>


                        </div>

                        <div id="contettab" class="tab-pane fade">
                            <div class="title-content">
                                <hr/>
                                <div class="icon">
                                    <a><h1><i class="fa fa-search" aria-hidden="true"></i> {{ $catName->name_ar }}</h1></a>
                                </div>
                            </div>
                            <table class="table table-bordered table-inverse wow animate fadeInUp"
                                   data-wow-duration="1.5s">
                                <thead>
                                <tr>
                                    <th>العروض</th>
                                    <th>المدينة</th>
                                    <th>المعلن</th>
                                    <th>قبل</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $nAdd)
                                @if($nAdd->is_pro==1)
                                    <tr>
                                        <td>
                                            <a href="{{ route('ad-view', ['id' => $nAdd->id]) }}"> {{ $nAdd->title }} </a>
                                        </td>
                                        <td><a href="#"> {{ $nAdd->city()->first()->name_ar }} </a></td>
                                        <td><a href="{{route('public-profile',['id'=>$nAdd->byUser()->first()->id])}}"> {{ $nAdd->byUser()->first()->name }} </a></td>
                                        <td>{{  $nAdd->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                @foreach($data as $nAdd)
                                @if($nAdd->is_pro==0)
                                    <tr>
                                        <td>
                                            <a href="{{ route('ad-view', ['id' => $nAdd->id]) }}"> {{ $nAdd->title }} </a>
                                        </td>
                                        <td><a href="#"> {{ $nAdd->city()->first()->name_ar }} </a></td>
                                        <td><a href="{{route('public-profile',['id'=>$nAdd->byUser()->first()->id])}}"> {{ $nAdd->byUser()->first()->name }} </a></td>
                                        <td>{{  $nAdd->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div><!-- End Tabs Mark -->

            </div><!-- End Content -->
        </div><!-- End Container -->
    </section>

@endsection

