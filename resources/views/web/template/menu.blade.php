    <!--===========Start-Header===========-->
    <header>
        <div class="header-top">
            <ul>
                <li><a class="hvr-push wow zoomIn" data-wow-delay="1.51s" href="{{ url('') }}"><i class="fa fa-home"></i>الرئيسية</a></li>

                <?php $i = -1; ?>
                @foreach(categories() as $cat)
                <?php $i++; ?>
                @if($i<6)
                        <li><a class="hvr-push wow zoomIn" data-wow-delay="1.53s" href="{{ route('get-cat' , ['id' => $cat->id]) }}"><i
                                        aria-hidden="true"></i>{{ $cat->name }}</a></li>
                    @endif
                    @endforeach

                
                <!-- <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.53s" href="cars.html"><i class="fa fa-car"></i>حراج سيارات</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.56s" href="mobiles.html"><i class="fa fa-mobile"></i>أجهزة</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.59s" href="building.html"><i class="fa fa-university" aria-hidden="true"></i>عقارات</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.62s" href="animals.html"><i class="fa fa-paw" aria-hidden="true"></i>مواشي و حيوانات و طيور</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.65s" href="furniture.html"><i class="fa fa-cubes" aria-hidden="true"></i>اثاث</a>
                </li>
                
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.71s" href="service.html"><i class="fa fa-shield" aria-hidden="true"></i>خدمات</a>
                </li> -->

                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.68s" href="{{route('search')}}"><i class="fa fa-search"></i>البحث</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.73s" href="more-section.html"><i class="fa fa-spinner fa-pulse fa-fw"></i>أقسام أكثر ...</a>
                </li>

            </ul>
        </div>
        <div class="header-bottom wow  zoomIn" data-wow-delay="1.5s">
            <div id="particles-background" class="vertical-centered-box"></div>
            <div id="particles-foreground" class="vertical-centered-box"></div>
            <div class="vertical-centered-box">
            </div>
            <a href="{{ url('') }}"><img src="{{ url('public/web') }}/images/haraj-logo.png" alt="site-logo"></a>
            <ul>
                @if(! auth()->check())

                
                
                <li>
                    <a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>تسجيل الدخول</a>
                </li>
                
                @else

                    @if(auth()->user()->is_admin)
                        <li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
                    @endif
                
                <li>
                    <a href="{{ route('user-profile') }}"><i class="fa fa-user"></i>{{Auth::user()->name}}</a>
                </li>
                <li>
               <!--  message.html -->
                    <a href="{{route('received-messages')}}"><span>1</span><i class="fa fa-envelope"></i>الرسائل</a>
                </li>
                <li>
               <!--  notification.html -->
                    <a href="{{ route('all-notifs') }}">@if(getNotifs() >0)<span>{{getNotifs()}}</span>@endif<i class="fa fa-bell"></i>الإشعارات</a>
                </li>
                <li>
                    <a href="{{ route('all-favorites') }}"><i class="fa fa-heart"></i>المفضلة</a>
                </li>
                <li>
                    <!-- followers.html -->
                    <a href="{{ route('all-followings') }}"><i class="fa fa-rss" aria-hidden="true"></i>المتابعة</a>
                </li>

                <li>
                    <!-- followers.html -->
                    <a href="{{ route('logout') }}"><i class="fa fa-rss" aria-hidden="true"></i>تسجيل الخروج</a>
                </li>
                
                @endif
            </ul>
        </div>
    </header>
    <!--===========End-Header===========
.
.
-->