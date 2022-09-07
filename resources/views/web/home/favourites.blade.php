@extends('web.master')

@section('content')
	<div class="col-xs-12 col-md-12 col-sm-12 containt-left fave">
                <div class="">
                    <h2 style="text-align: center; color: #888"><i class="fa fa-heart"></i> المفضلة</h2>
                    <table class="table table-hover">
                        <tbody>
                            @foreach($data as $ad)
                            <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="{{ route('ad-view', ['id' => $ad->id]) }}">{{ (strlen($ad->title) > 50) ? (mb_substr($ad->title, 0, 50) . ' ... ')  : (mb_substr($ad->title, 0, 50)) }}</a>
                                    <i class="fa fa-star"></i>
                                    <a href="{{ route('delete-favorite',['id'=>$ad->id])}}" >حذف من المفضلة</a>

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
                </div>
            </div>
@endsection