@extends('web.master')

@section('content')

    <div class="bg-content-page">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="title-page-content wow animate fadeIn" data-wow-duration="2.0s">
                <h2><span>•</span>المتابعين<span>•</span></h2>
                <br>
            </div> -->

            <div class="table-text wow animate fadeInUp" data-wow-duration="2.0s">


                <div class="body-table">
                    <p class="header-pages"><a href="index.html">الرئيسية</a> / <a href="followers.html">المتابعين</a></p>
            <div class="contact-us follwers">
                <h3><i class="fa fa-circle" aria-hidden="true"></i> متابعة الإعلانات <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <span>سيتم إشعارك عبر الإشعارات عند وجود جديد عن أي إعلان تقوم بمتابعته. </span>
                <br>
                <div class="table-width">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الإعلان</th>
                                <!-- <th>ف مدينة</th>
                                <th>سيتم الحذف</th> -->
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $following)
                            @if($following->ad_id !=null)
                            <tr>
                                <td><a href="{{ route('ad-view', ['id' => $following->ad->id]) }}">{{$following->ad->title}}</a></td>
                                <!-- <td><a href=""></a></td>
                                <td><a href="">3 يوم</a></td> -->
                                <td><a href="{{ route('delete-following',['id'=>$following->id])}}" ><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3><i class="fa fa-circle" aria-hidden="true"></i> متابعة الاعضاء <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <span>سيتم إشعارك عبر الإشعارات عند وجود إعلان جديد لعضو تقوم بمتابعته.</span>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>العضو</th>
                            <th>العنوان</th>
                            <th>تاريخ الإنضمام</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $following_user)
                        @if($following_user->follower_id !=null)
                        <tr>
                            <td><a href="{{route('public-profile',['id'=>$following_user->follower_id])}}">{{$following_user->follower->name}}</a></td>
                            <td><a href="">{{$following_user->follower->city->name_ar}}</a></td>
                            <td><a href="">4/9/2016</a></td>
                            <td><a href="{{ route('delete-following',['id'=>$following->id])}}" ><i class="fa fa-times" aria-hidden="true"></i></a></td>

                        </tr>
                        @endif
                    @endforeach
                        <!-- <tr>
                            <td><a href="">أوامر الشبكة</a></td>
                            <td><a href="">الرياض _ السعوديه _ جده</a></td>
                            <td><a href="">4/9/2016</a></td>
                            <td><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td><a href="">أوامر الشبكة</a></td>
                            <td><a href="">الرياض _ السعوديه _ جده</a></td>
                            <td><a href="">4/9/2016</a></td>
                            <td><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td><a href="">أوامر الشبكة</a></td>
                            <td><a href="">الرياض _ السعوديه _ جده</a></td>
                            <td><a href="">4/9/2016</a></td>
                            <td><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td><a href="">أوامر الشبكة</a></td>
                            <td><a href="">الرياض _ السعوديه _ جده</a></td>
                            <td><a href="">4/9/2016</a></td>
                            <td><i class="fa fa-times" aria-hidden="true"></i></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

                </div>

            </div>

        </div>
    </div>

@endsection