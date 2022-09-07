@extends('web.master')

@section('top-script')

	<script type="text/javascript">var switchTo5x = true;</script>

	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

	<script type="text/javascript">stLight.options({

			publisher: "179a76b0-32a2-41dc-a1cb-3ffd9b340ede",

			doNotHash: false,

			doNotCopy: false,

			hashAddressBar: false

		});
	</script>

@endsection

@section('content')
	
	<div class="col-xs-12 col-md-9 col-sm-8 single-data">
	
                <div class="single-data-info">
                    <h2><i class="fa fa-pencil-square" aria-hidden="true"></i>{{$data->title}}</h2>
                    <h3><a href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$city->name}}<span><a href="profile-user.html"><i class="fa fa-user"></i>{{$user->name}}</span></a></h3>
                    <h5>{{$data->created_at->diffForHumans()}}<span>{{$data->phone}}</span></h5>
                    <a href="single-page.html">التالى <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                </div>
                <p>{{$data->desc}}</p>


                <img src="{{ url('public/ads_435x490/' . $data->photo)}}" alt="topic-image">
                @if(count($photos)>0)
				@foreach($photos as $photo)
					<img src="{{ url('public/ads_435x490/' . $photo->img)}}"/>
				@endforeach
				@endif
                <!-- <img src="images/557.jpeg" alt="topic-image">
                <img src="images/557.jpeg" alt="topic-image">
                <img src="images/557.jpeg" alt="topic-image">
                <img src="images/557.jpeg" alt="topic-image"> -->
                <span>وسيلة الإتصال</span>
                <h6><i class="fa fa-phone"></i> +966555953838</h6>
                <ul>
                    <li><a href=""><i class="fa fa-envelope"></i></a></li>
                    <li><a href=""><i class="fa fa-heart"></i></a></li>
                    <li><a href=""><i class="fa fa-whatsapp"></i></a></li>
                    <li><a href=""><i class="fa fa-flag"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                </ul>
                <div class="omola">
                    <form action="" method="POST" role="form" style="width: 100%; margin: 10px 0 0">
                        <div class="form-group">
                            <label for="">أكتب ردك هنا :</label>
                            <textarea name="" id="input" class="form-control" rows="6" required="required"></textarea>
                        </div>
                        <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-sm-4 single-data-other">
                <div class="single-data-other-data">
                    <a href="index.html"><i class="fa fa-link"></i> مكسيما 2015 في حفر الباطن</a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                </div>
                <div class="single-data-other-data">
                    <a href="index.html"><i class="fa fa-link"></i> مكسيما 2015 في حفر الباطن</a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
     <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                </div>
                <div class="single-data-other-data">
                    <a href="index.html"><i class="fa fa-link"></i> مكسيما 2015 في حفر الباطن</a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                    <a href="single-page.html" class="col-xs-6"><img src="images/557.jpeg" alt="topic-image"></a>
                </div>
            </div>

@endsection

@section('script')

	<script>
		//$(document).ready(function () {
			$(window).load(function() {
			console.log('script');
			// like
			$('#like').click(function (e) {
				e.preventDefault();
				var id = $(this).data('id');
				var count = $('#count-likes').data('val');
				count = parseInt(count);
				if ($('#like').attr('style') == undefined) {

					// add like
					$.ajax({
						method: 'get',
						//url: '/ticket/add-like/' + id
						url: '{{url("/add-like") }}/' +id
					}).success(function (data) {
						$("#count-likes").attr("data-val", count);
						$('#count-likes').html(count + 1);
						$('#like').css('color', 'red');
					}).error(function (error) {
						$("#myModal1").modal('show');
						console.log(error);
					});

				} else {

					//remove like
					$.ajax({
						method: 'get',
						//url: '/ticket/remove-like/' + id
						url: '{{url("/remove-like") }}/' +id
					}).success(function (data) {
						$("#count-likes").attr("data-val", count);
						$('#count-likes').html(count);
						$('#like').removeAttr('style');
					}).error(function (error) {
						console.log(error);
					});

				}
			});

			//comment

			//$('#commentAd').click(function(e){
			$('#commentAd').on('click', function(e){
				e.preventDefault();
				var id = $(this).data('ad_id');
				console.log('ad_id',id)
				var comment =$('textarea#input').val();
				console.log('comment',comment);
				var token = $("input[name=_token]").val();
				console.log(token);
			
			$.ajax({
						method: 'post',
						url: '{{url("/ads/add-comment")}}',
						data: {comment : comment ,
								id :id ,
								_token : token,
								scrf:''}
					}).success(function (response) {
						console.log(response);
						$('textarea').val('');
				var array = [];
				array.push('<div class="'+response['id']+'"><div class="comment-image col-xs-1"><div class="row"><a href=""><img style="border-radius: 5px; width: 100%" src="{{ url('public/web/') }}/images/comment.png" alt=""></a></div></div>');
               array.push('<div class="comment-info col-xs-11">');
               array.push('<h5><span style="float: right">'+response['username']+'</span></h5>');
               
               array.push('<p>'+ response['comment']+' </p>');
              array.push('<a href="{{url("/ads/delete-comment")}}/'+response['id']+'" class="do-delete pull-left" data-comment_id="'+response['id']+'">حذف</a>');
               array.push('</div></div>');		
               $(array.join('')).insertBefore('.more');

					}).error(function (error) {
						console.log(error);
					});
			});
			
			//delete comment
			$('.do-delete').on('click', function(e){
			//$('.do-delete').click(function (e) {
				e.preventDefault();
				var id = $(this).data('comment_id');
				$.ajax({
						method: 'get',
						//url: '{{url("/followings/delete") }}/' +id
						url: '{{url("/ads/delete-comment")}}/'+id
					}).success(function (data) {
						console.log(data);
					$('.comment'+id).remove();
						console.log('success');
					}).error(function (error) {
						console.log(error);
						console.log(id);
					});

			});		

			// follow
			$('#follow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('ad_id');
				$.ajax({
						method: 'get',
						url: '{{url("/followings/save") }}/' + 0 +'/'+id
					}).success(function (data) {
						$('#follow').addClass('hidden');
						$('#unfollow').removeClass('hidden');
						$('#unfollow').addClass('visible');
						$('#unfollow').attr('data-f_id',data);
						console.log('follow');
						console.log(data);
						var follow_id =data;
					}).error(function (error) {
						console.log(error);
					});

			});

			// un follow
			$('#unfollow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('f_id');
				$.ajax({
						method: 'get',
						url: '{{url("/followings/delete") }}/' +id
					}).success(function (data) {
						//console.log(data);
						console.log(id);
						$('#unfollow').addClass('hidden');
						$('#follow').removeClass('hidden');
						$('#follow').addClass('visible');
					
						console.log('success');
					}).error(function (error) {
						console.log(error);
						console.log(id);
					});

			});
		});
	</script>

@endsection