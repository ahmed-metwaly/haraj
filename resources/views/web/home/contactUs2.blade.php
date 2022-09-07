@extends('web.master')

@section('style')
	<style>
		.contact-us form label {
			float: right
		}

		.contact-us form textarea {
			width: 84%;
			float: right;
			border-radius: 0;
			border: 1px solid #e2e2e2;
		}

		.form-group {
			overflow: auto;
		}

		#map {
			position: relative;
			overflow: hidden;
			width: 100%;
			height: 190px;
		}

		.contact-us h2 i {
			float: right;
		}

		.contact-us h2 {
			font-family: 'Flat-medium';
			text-align: center;
			font-size: 20px;
			margin: 20px 0;
			clear: both;
		}

		.contact-us > div > div > div {
			overflow: hidden;
			height: 200px;
			margin-bottom: 40px;
			padding: 10px;
		}

		.top-footer span {
			display: block;
		}

		.top-footer h6 {
			width: auto;
			display: inline-block;
			margin: 0;
		}

		.top-footer h6 a {
			color: #402d1c;
			padding: 10px;
			margin: 5px;
			background: #a68b6a;
			border-radius: 5px;
			display: inline-block;
		}

		.bottom-footer ul {
			margin: 0;
			list-style: none;
			padding: 10px;
		}

		.bottom-footer ul li {
			display: inline-block;
		}

		.bottom-footer ul li a {
			display: inline-block;
			width: 25px;
			height: 25px;
			background: #a68b6a;
			margin: 0 5px;
			color: #322214;
			border-radius: 50%;
			line-height: 25px;
		}
	</style>
@endsection

@section('content')

	<p class="header-pages"><a href="{{ url('') }}">الرئيسية</a> / <a href="#">اتصل بنا</a></p>
	<div class="contact-us">
		<h3><i class="fa fa-circle" aria-hidden="true"></i> اتصل بنا <i class="fa fa-circle" aria-hidden="true"></i>
		</h3>
		
		<span> <small>*</small> نعتذر عن الإتصال بأرقام الجوالات، وسيلة التواصل لدينا هي البريد الإلكتروني </span>
                <br>
        <span><small>*</small> تأكد من صحة بريدك الإلكتروني حتى يتم الرد عليك</span>
		
		<form action="{{ route('contact-do-us') }}" method="POST" role="form">
			<legend>الإتصال بنا</legend>
			<div class="form-group">
				{{ csrf_field() }}
				<label for="name">الاسم</label>
				<input type="text" name="name" class="form-control" id="name_id" required="required">
				<label for="email">البريد الإلكترونى</label>
				<input type="email" name="email" class="form-control" id="email_id" required="required">
				<label for="title">سبب الإتصال</label>
				<input type="text" name="title" class="form-control" id="title_id" required="required">
				<label for="message">نص الرسالة</label>
				<textarea name="message" class="form-control" id="message_id"
				          required="required" rows="5"></textarea>
			</div>
			<button type="submit" class="btn btn-primary hvr-shutter-out-vertical">إرسال</button>
		</form>
	</div>

@endsection

@section('script')
	 
	<script>
		function initMap() {
			var uluru = {
				lat: 24.774265,
				lng: 46.738586
			};
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 4,
				center: uluru
			});
			var marker = new google.maps.Marker({
				position: uluru,
				map: map
			});
		}
	</script>
	  
	<script async defer
	        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr0wbb6qWaWT1czGXoUD8jHemI5qW-BwY&callback=initMap">
	</script>
@endsection
