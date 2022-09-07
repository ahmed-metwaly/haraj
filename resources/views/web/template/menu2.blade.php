<!--===========Start-Header===========-->
    <header class="wow slideInDown">
        <div class="container">
            <div class="header">
                <div class="header-top-right col-md-8 col-sm-9 col-xs-12">
                    <div class="clearfix">
                        <ul>

						<li><a href="{{ route('contact-us') }}">اتصل بنا</a></li>

						<?php

						$data = pages( 1 );

						$count = count( $data );

						$oo = 1

						?>
						@if($count > 0)
							@foreach($data as $page)
								<li class="{{ $count == $oo ? 'no-border' : '' }}"><a
											href="{{ route('page', ['id' => $page->id]) }}"> {{ $page->name_ar }} </a>
								</li>
								<?php $oo ++; ?>
							@endforeach
						@endif

						{{-- <li>
							<button data-value="{{ url('public/web') }}/css/white-brown-color.css" href=""
							        class="site-color site-color1" style="background: #a68b6a"></button>
							<button data-value="{{ url('public/web') }}/css/brown-color.css" href=""
							        class="site-color site-color2" style="background: #402d1c"></button>
							<button data-value="{{ url('public/web') }}/css/blue-color.css" href=""
							        class="site-color site-color3" style="background: #bce7f8"></button>
						</li> --}}
					</ul>
				</div>
			</div>

			@if(! auth()->check())
				<div class="header-top-left col-md-3 col-sm-3 col-xs-12">
					<div class="clearfix">
						<ul>
							<li data-toggle="modal" data-target="#myModal"><a href="#">تسجيل</a></li>
							<li class="no-border" data-toggle="modal" data-target="#myModal1"><a href="#">دخول</a></li>
						</ul>
					</div>
					
				</div>
			@else
				<div class="header-top-left col-md-3 col-sm-3 col-xs-12">
					<div class="clearfix">
						<ul>
							<li><a href="{{ route('all-followings') }}">المتابعين</a></li>
							<li><a href="{{ route('all-notifs') }}">الإشعارات</a></li>
						</ul>
					</div>
				</div>
			@endif
		</div>
	</div>
</header>
<!-- Login Modal -->
					@include('web.template.authForms')
<!--===========End-Header===========-->

<!--===========Start-Navbar===========-->
<nav class="navbar navbar-default wow zoomInDown">
        <div class="container-fluid container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navbar-right">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('') }}"><img class="change-img1"
			                                                  src="{{ url('public/web') }}/images/site-logo.png"
			                                                  alt="تكت"></a>
            </div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{ url('') }}">الرئيسية <span class="sr-only">(current)</span></a></li>
				<?php $i = -1; ?>
				@foreach(categories() as $cat)
				<?php $i++; ?>
				@if($i<6)
						<li><a href="{{ route('get-cat' , ['id' => $cat->id]) }}"><i
										aria-hidden="true"></i>{{ $cat->name }}</a></li>
					@endif
					@endforeach
					@if(auth()->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">المزيد <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            
                            	@if(auth()->user()->is_admin)
									<li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
								@endif
							<li><a href="{{ route('user-profile') }}">الصفحة الشخصية</a></li>
							<li><a href="{{ route('logout') }}">تسجيل الخروج</a></li>
								
							{{-- <li><a href="{{ route('all-followings') }}">المتابعين</a></li>
							<li><a href="{{ route('all-notifs') }}">الإشعارات</a></li> --}}
                            <!-- <li><a href="e3lan-info.html">الإعلان</a></li> -->	
                            <!-- <li><a href="box.html">عرض بوكس</a></li> -->
                            <li><a href="{{route('add-message')}}">هل لديك إستفسار</a></li>
                           
                        </ul>
                    </li>
                     @endif
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
<!--===========End-Navbar===========-->
