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
	<p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="{{ route('get-cat' , ['id' => $data->cat]) }}">{{$cat->name}}</a>/ <a href="#">{{$data->title}}</a></p>
	<div class="contact-us e3lan-info">
		<div class="col-md-4 col-xs-12">
			<div class="row">
				<div class="e3lan-photo">
					<div id="sync1" class="owl-carousel">
						<div class="item">
							<img src="{{ url('public/ads_435x490/' . $data->photo)}}" alt="">
						</div>
						@if(count($photos)>0)
						@foreach($photos as $photo)
							<div class="item"><img src="{{ url('public/ads_435x490/' . $photo->img)}}"/></div>
						@endforeach
						@endif
					</div>
					<div id="sync2" class="owl-carousel">
						<div class="item">
							<img src="{{ url('public/ads_435x490/' . $data->photo)}}" alt="">
						</div>
						@if(count($photos)>0)
						@foreach($photos as $photo)
							<div class="item"><img src="{{ url('public/ads_435x490/' . $photo->img)}}"/></div>
						@endforeach
						@endif
						
					</div>
				</div>
				<div class="person-e3lan">
					<h5>بيانات عن صاحب الإعلان</h5>
					<h6><span>الإسم : </span><a href="{{route('public-profile',['id'=>$user->id])}}"> {{ $user->name }}</a>
					 @if($user->is_pro ==1)
					 <span>*</span>
					 @endif
					

					</h6>
					<h6><span>العنوان : </span>
						{{ \App\Countries::find($user->country_id) !=''?\App\Countries::find($user->country_id)->name :'تم حذف الدولة' }}
						- {{ \App\Cities::find($user->city_id) !=''?\App\Cities::find($user->city_id)->name :'تم حذف المدينة' }}</h6>
					<h6><span>رقم الجوال : </span>{{ $data->phone }}</h6>
					<h6><span>تاريخ انضمامه : </span>{{ date_format($user->created_at, 'Y-m-d') }}
					</h6>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="e3lan-full-info">

					@if(auth()->check())
						@if(auth()->user()->id == $data->created_by || auth()->user()->is_admin)
							<a href="{{ route('add-delete', ['id' => $data->id]) }}"
							   class="do-delete pull-left" style="color: red; float:left"> <span> حذف الاعلا ن  </span>
							</a>
							<a href="{{ route('add-edit', ['id' => $data->id]) }}"
							   class="pull-right" style="color: #a68b6a; float:left"> <span>  تعديل الاعلان  </span>
							</a>
							<br>
						@endif
					@endif

					<h2> {{ $data->title }} <span> {{ $data->created_at->diffForHumans() }} </span></h2>
					<!--
					<div class="lead evaluation">
						<div id="colorstar" class="starrr ratable" style="display: inline-block;"></div>
						<span>( 1 زائر جديد )</span>
					</div>
					-->
					<h6> السعر : {{ $data->price }} ريال</h6>
					<p>وصف الإعلان : {{ $data->desc }} </p>
					<h5><i class="fa fa-pie-chart" aria-hidden="true"></i> نوع الاعلان
						:  
						<?php 
							switch($data->type){
								case 'rent':
									echo 'ايجار';
									break;
								case 'sell':
									echo 'بيع';
									break;
								case 'exchange':
									echo 'بدل';
									break;
								case 'waiver':
									echo 'تنازل';
									break;
								
							}
						?>
						
						</h5>
						<h5><i class="fa fa-pie-chart" aria-hidden="true"></i> رقم الإعلان
						: {{ $data->id }} </h5>

@if($carData != '')

                        <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> <span
                                    class="">@if(App\Marks::find($carData->mark_id)!=''){{ App\Marks::find($carData->mark_id)->name }}@endif</span>
                             @if(App\Models::find($carData->model_id) !='') - {{ App\Models::find($carData->model_id)->name }}@endif - <span
                                    class="">  {{App\Years::find($carData->year_id) !=''?App\Years::find($carData->year_id)->name :'' }}  </span></h3>
                        <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> عدد الابواب : {{ $carData->doors }} </h3>
                        <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> اللون : {{ $carData->color }} </h3>

                    @elseif($akarData != '')

                        <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> نوع العقار
                            : {{ App\Akars::find($akarData->akar_type_id) !=''? App\Akars::find($akarData->akar_type_id)->name : ''}}  </h3>
                        <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> المساحة : {{ $akarData->dest }} متر
                        </h3>
                        @if($akarData->rooms != '')

                            <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> عدد الغرف : {{ $akarData->rooms }}
                            </h3>

                        @endif

                        @if($akarData->bathrooms != '')

                            <h3><i class="fa fa-pie-chart" aria-hidden="true"></i> عدد دوراة المياه
                                : {{ $akarData->bathrooms }}
                            </h3>

                        @endif


                    @endif

					<hr>
					<div class="e3lan-social">
@if(Auth::check())
						<div id="likes-count" style="display: inline-block;">

							<span id="count-likes" style="padding-left: 2px" data-val="{{ $countLikes }}"
							      class="figure"> {{ $countLikes }} </span>
						</div>

						<button id="like" data-id="{{ $data->id }}" type="button">
							<i class="fa fa-heart"
							   @if($userLike != '' && $userLike > 0)
							   style="color:red;"
							   @endif
							   data-id="{{ $data->id }}"
							   aria-hidden=" true" id="like"></i>
						</button>


						
						<span><small style="padding-left: 2px"> {{ $countComments }} </small> <i class="fa fa-comment"
						                                                                         aria-hidden="true"></i></span	>
					@if(count($follow) > 0)

					<button id="unfollow"  data-f_id="{{$data->id}}">الغاء المتابعة</button>
					<button id="follow" class="hidden" data-ad_id="{{$data->id}}">متابعة</button>
					@else
					<button id="follow" data-ad_id="{{$data->id}}">متابعة</button>
					<button id="unfollow" class="hidden" data-f_id="{{$data->id}}">الغاء المتابعة</button>
					@endif
					@endif
					<span><small style="padding-left: 2px"> {{ $data->views }} </small> <i class="fa fa-eye"
						                                                                       aria-hidden="true"></i></span>
					</div>

					<hr>
					<h5><i class="fa fa-map-marker" aria-hidden="true"></i>{{ App\Cities::find($data->city)!=''?App\Cities::find($data->city)->name : 'تم حذف المدينة' }}
						 - {{ App\Hay::find($data->hay)!=''?App\Hay::find($data->hay)->name :'تم حذف الحى'  }}</h5>
					<hr>
					<ul>
						<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
					</ul>
					<hr>
					<h5><i class="fa fa-user" aria-hidden="true"></i> <a
								href="#">{{ $user !=''?$user->email :'تم حذف المستخدم' }}</a></h5>
					<hr>
				
					<h5><i class="fa fa-clock-o" aria-hidden="true"></i> تم أضافه الأعلان <a
								href=""> {{ date_format($data->created_at, 'Y-m-d') }} </a> <a
								href="{{ route('add-report', ['id' => $data->id]) }}"
								style="color: #a68b6a; float:left">بلاغ</a>

								
								
								</h5>
				</div>

				<div class="e3lan-comment">

					@foreach($comments as $comment)
					<div class="comment{{ $comment->id}}">
						<div class="comment-image col-xs-1">
							<div class="row">
								<a href=""><img style="border-radius: 5px; width: 100%"
								                src="{{ url('public/web/') }}/images/comment.png" alt=""></a>
							</div>
						</div>
						<div class="comment-info col-xs-11">
							<h5><span style="float: right"> {{ $comment->byUser()->first()->name }} </span><span
										style="float: left"><i
											class="fa fa-calendar"
											aria-hidden="true"></i> {{ date_format($comment->created_at, 'Y/m/d') }} </span>
							</h5>
							<p> {{ $comment->comment }} </p>
							@if(auth()->check())
								@if(auth()->user()->id == $comment->created_by || auth()->user()->is_admin )
									<a href="{{ route('delete-comment', ['id' => $comment->id]) }}"
									   class="do-delete pull-left" data-comment_id="{{$comment->id}}">حذف</a>
								@endif
							@endif

						</div>
						</div>
					@endforeach
					@if($countComments > 0)
							<div class="more" >
								{{ $comments->links() }}
							</div>
						@endif
						<hr>
					@if(auth()->check())
						@if($data->comments_status == 1)
							@if(settings()->site_comments_status == 1)
							<div id="beforecomment">
								<form action="{{ route('add-comment') }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="scrf">
									<input type="hidden" name="id" value="{{ $data->id }}">

									<div class="comment-image col-xs-1">
										<div class="row">
											<a href=""><img style="border-radius: 5px; width: 100%"
											                src="{{ url('public/web/') }}/images/comment.png"
											                alt=""></a>
										</div>
									</div>

									<div class="comment-info col-xs-11">
										<h5><span style="float: right"> {{ auth()->user()->name }} </span></h5>
										<textarea name="comment" id="input" class="form-control" rows="5"
										          required="required" placeholder="نص التعليق ..." onfocus="this.placeholder = ''"
										          onblur="this.placeholder = 'نص التعليق'"></textarea>
										<button type="submit" class="btn btn-default" id="commentAd" data-ad_id="{{$data->id}}">إرسال
										</button>
									</div>
								</form>
								</div>
							@endif
						@endif
					@endif
				</div>

			</div>
		</div>

		<hr>

		<h3><i class="fa fa-circle" aria-hidden="true"></i>  اعلانات أخرى مشابهة <i class="fa fa-circle"
		                                                                            aria-hidden="true"></i></h3>
		<div class="box">
			@foreach($samData as $samAds)
				<div class="col-md-6 col-lg-4 col-xs-12 col-sm-6 wow slideInUp">
					<div>
						<div>
							<a href="{{ route('ad-view', ['id' => $samAds->id]) }}">
								<img src="{{ url('public/ads_262x249/' . $samAds->photo) }}" alt="عقار">
							</a>
						</div>
						<h4><a href="{{ route('ad-view', ['id' => $samAds->id]) }}"> {{ $samAds->title }} </a></h4>
						<p> {{ mb_substr($samAds->desc, 0, 100) }} @if(strlen($samAds->desc) > 100) ... @endif </p>
						<span><i class="fa fa-map-marker"
						         aria-hidden="true"></i> {{ $samAds->city()->first()->name_ar }} </span>
						<span class="box-left">{{ $samAds->price }} ريال</span>
					</div>
				</div>
			@endforeach
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
