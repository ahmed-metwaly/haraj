<!DOCTYPE html>
<html lang="ar">

<head>
    <!--start Head-->
    <!-- for Language -->
    <meta charset="utf-8">
    <!-- for internet ex -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for Google Search -->
    <meta name="description" content="◢ تــكـــت ◣">
    <!-- for Google Search -->
    <meta name="keywords" content="aait, اوامر الشبكة, css3, html5, html, css, bootstrap, hover, animate, responsive, mswsm, تكت, حراج">
    <!-- Html author -->
    <meta name="author" content="AAIT - UI.Developer - Ahmed Kotb">
    <!-- for Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Site Tittle -->
	<title> {{ settings()['site_name_'.App::getLocale()] }} </title>
	<!-- Site Icons -->
	<link rel="icon" type="image/png" href="{{ url('public/web') }}/images/site-logo.png">
	<!--Styel.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/style.css">
	<link rel="stylesheet" href="{{ url('public/web') }}/css/white-brown-color.css">
	<!--bootstrap.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/bootstrap.min.css">
	<!--font-awesome.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/font-awesome.min.css">
	<!--hover.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/hover-min.css">
	<!--animate.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/animate.css">
	<!--image-hover-->
	<link rel="stylesheet" type="text/css" href="{{ url('public/web') }}/css/imagehover.min.css"/>
	<!--fancy-box.css-->
	<link rel="stylesheet" href="{{ url('public/web') }}/css/jquery.fancybox.css">
	<link rel="stylesheet" href="{{ url('public/web') }}/css/jquery.fancybox-thumbs.css">
	<link rel="stylesheet" href="{{ url('public/web') }}/css/jquery.fancybox-buttons.css">
	<!--owl.css-->
	<link rel="stylesheet" type="text/css" href="{{ url('public/web') }}/css/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('public/web') }}/css/owl.theme.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('public/web') }}/css/owl.transitions.css"/>
	
@yield('style')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	@yield('top-script')
</head>
<!--End Head -->


<body><!-- Start Body -->


@include('web.template.menu')

<!-- Start Section Header And content -->



<div class="container">
@if(count($errors) > 0)
	<div class=" alert alert-danger">
		<!-- <div class="erorr-msg"> -->
		<button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
  			<span aria-hidden="true">&times;</span>
		</button>
		<ul>
			@foreach($errors->all() as $error)

				<!-- <i class="fa fa-times" aria-hidden="true"></i> -->
		<li>{{ $error }}</li>

			@endforeach
		</ul>
		

		<!-- </div> -->
	</div>
	@endif
	
	@if(Session::has('mOk'))
	<!--<div class="s-erorr" style="background-color: #36cd6f">
		<div class="erorr-msg"> -->
		<div class="alert alert-success" role="alert">
		{{ Session::get('mOk') }}
			<!-- <i class="fa fa-times" aria-hidden="true"></i> 
			<h3 class=""></h3>-->

		</div>
	<!-- </div> -->

@endif

@if(Session::has('mNo'))
	<!-- <div class="s-erorr">
		<div class="erorr-msg">
			<i class="fa fa-times" aria-hidden="true"></i>
			<h3 class=""></h3> -->
			<div class="alert alert-danger" role="alert">
			{{ Session::get('mNo') }}
		</div>
	<!-- </div> -->
@endif
</div>




<!--===========Start-content===========-->
<div class="col-md-12 page-content">
	<div class="container">
		@yield('content')
	</div>
</div>
<!--===========End-content===========-->


<!--===========Start-Footer===========-->
    <footer class="col-md-12">
        <div class="row">
            <div class="col-md-12 top-footer">
                <div class="row">
                    <div class="col-md-4 col-xs-12 right-footer">
                        <div class="row">
                        <a href="index.html"><img class="wow zoomIn" data-wow-duration="3s" src="{{ url('public/web') }}/images/site-logo.png" alt="تكت"></a>

                            <h5>حمل  تطبيقات الجوال</h5>
                            <ul>
                                <li><a href="#" target="_blank"><i class="fa fa-apple" aria-hidden="true"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-android" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-6 center-footer">
                        <div class="row">
                            <span>روابط مهمة</span>
                            <ul>
                            <li>
								<a href="{{ route('add-commission-transfer') }}">حساب عمولة الموقع</a>
							</li>
							<li>
								<a href="{{ route('add-subscribe-transfer') }}">عضوية معارض السيارات و مكاتب العقار</a>
							</li>
							@foreach(pages(2) as $page)
								<li><a href="{{ route('page', ['id' => $page->id]) }}"> {{ $page->name_ar }} </a></li>
							@endforeach
						</ul>
					</div>
				</div>
                    <div class="col-md-4 col-xs-12 col-sm-6 left-footer center-footer">
                        <div class="row">
                            <span>إختصارات</span>
                            <ul>
							<li>
								<a href="{{ route('contact-us') }}">اتصل بنا</a>
							</li>
							<li>
								<a href="{{ route('black-list') }}">القائمة السوداء</a>
							</li>
							<li>
								<a href="{{ route('Blacklisted') }}">قائمة السلع والإعلانات الممنوعة</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 bottom-footer">
                <div class="row">
                    <p>جميع الحقوق محفوظة &copy; 2017</p>
                </div>
            </div>
	</div>
</footer>
<!--===========End-Footer===========-->

@yield('loading')

    <!--start-loading-page-->
    <section class="over-lay">
        <div class='loading-page'>
            <div class='loading-overlay'></div>
            <div class='loading-anim'>
                <div class='border out'></div>
                <div class='border in'></div>
                <div class='border mid'></div>
            </div>
        </div>
    </section>
    <!--end-loading-page
    .
    .
    -->
    <!--start-scroll-top-->
    <div class="scroll-top hvr-bounce-in">
        <!--start scroll-->
        <a><i class="fa fa-arrow-up"></i></a>
    </div>
    <!--end-scroll-top
    .
    .
    -->

<!--jquery-->
<script src="{{ url('public/web') }}/js/jquery-1.12.0.min.js"></script>
<!--bootstrap-->
<script src="{{ url('public/web') }}/js/bootstrap.min.js"></script>
<!--Plugins-->
<script src="{{ url('public/web') }}/js/plugins.js"></script>
<script src="{{ url('public/web') }}/js/script.js"></script>
<!--wow-->
<script src="{{ url('public/web') }}/js/wow.min.js"></script>
<!--fancybox-->
<script src="{{ url('public/web') }}/js/jquery.fancybox.js"></script>
<script src="{{ url('public/web') }}/js/jquery.fancybox.pack.js"></script>
<script src="{{ url('public/web') }}/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script src="{{ url('public/web') }}/js/jquery.fancybox-buttons.js"></script>
<script src="{{ url('public/web') }}/js/jquery.fancybox-media.js"></script>
<script src="{{ url('public/web') }}/js/jquery.fancybox-thumbs.js"></script>
<!--owl-->
<script type="text/javascript" src="{{ url('public/web') }}/js/owl.carousel.min.js"></script>
<script>
	$(document).ready(function () {


		$(".erorr-msg i").click(function () {

			$(".erorr-msg").remove();


		});

		$(".erorr-msg").hide(100000, function () {
		});


		$(".notification i").click(function () {

			$(".notification").remove();


		});

		$(".notification").hide(100000, function () {
		});


		@if(isset(auth()->user()->id) && auth()->user()->id != '')

		getAjaxData('#count', '#city', '{{ baseUrl('/ajax-data') }}', 'country_id');

		@endif


	});


</script>


@yield('script')


</body>


</html>
