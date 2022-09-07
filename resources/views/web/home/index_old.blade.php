@extends('web.master')



@section('top-script')

	<script type="text/javascript">var switchTo5x = true;</script>

	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

	<script type="text/javascript">stLight.options({

			publisher: "179a76b0-32a2-41dc-a1cb-3ffd9b340ede",

			doNotHash: false,

			doNotCopy: false,

			hashAddressBar: false

		});</script>

@endsection



@section('content')



	<div class="col-md-5">


		<div class="ads-slide wow animate bounce" data-wow-duration="2.5s">


			<div id="sync1" class="owl-carousel">


				<div class="item"><img src="{{ url('public/ads_435x490/' . $data->photo)}}"/></div>


				@foreach($photos as $photo)
					<div class="item"><img src="{{ url('public/ads_435x490/' . $photo->img)}}"/></div>
				@endforeach


			</div>

			<div class="clearfix"></div>

			<div class="items-bg-2">

				<div id="sync2" class="owl-carousel">


					<div class="item"><img src="{{ url('public/ads_74x84/' . $data->photo)}}"/></div>


					@foreach($photos as $photo)



						<div class="item"><img src="{{ url('public/ads_74x84/' . $photo->img)}}"/></div>



					@endforeach


				</div>

			</div>


		</div>

		<div class="info-owner">

			<div class="title-owner">


				<h2>بيانات عن صاحب الأعلان</h2>


			</div>

			<div class="p-owner">


				<div class="single-owner-info"><p>الاسم : <a href=""> {{ $data->byUser()->first()->name }} </a></p>

				</div>

				<div class="single-owner-info"><p>الهاتف : {{ $data->phone }}</p></div>


				<div class="single-owner-info"><p> العنوان

						: {{ ($data->byUser()->first()->country()->first()->name_ar) }}

						- {{ $data->byUser()->first()->city()->first()->name_ar }}  </p></div>

				<div class="single-owner-info"><p> تاريخ التسجيل بالموقع

						: {{ date_format($data->byUser()->first()->created_at, 'Y-m-d') }} </p></div>


				<div class="single-owner-info text-center"><p><a
								href="{{ route('add-message', ['id' => $data->created_by]) }}"
								class="btn btn-md btn-info center-block ">راسل

							المعلن</a></p></div>

			</div>


		</div>


	</div>

	<div class="col-md-7">

		<div class="bg-content-ratting wow animate fadeIn" data-wow-duration="2.0s">


			<div class="content-ads">


				<div class="title-ads">


					<h3>

						@if(auth()->check())

							@if(auth()->user()->id == $data->created_by)

								<a href="{{ route('add-delete', ['id' => $data->id]) }}"

								   class="do-delete pull-right"> <span> حذف الاعلا ن  </span> </a>

								<br>



								<a href="{{ route('add-edit', ['id' => $data->id]) }}"

								   class="pull-right"> <span>  تعديل الاعلان  </span> </a>





								<br>

							@endif

						@endif

						<a href="#"> {{ $data->title }} </a>

						<span> {{ $data->created_at->diffForHumans() }} </span>

					</h3>


				</div>

				<div class="rating clearfix">


				</div>

				<div class="money-ads">


					<h3> {{ $data->price }} ريال</h3>


				</div>

				<div class="discription-ads">


					<p> {{ $data->desc }} </p>


				</div>

				<div class="area-ads">


					<h3><i class="fa fa-pie-chart" aria-hidden="true"></i> نوع الاعلان

						: {{ $data->type == 'rent' ? 'ايجار' : 'بيع' }} </h3>

				</div>

				<div class="border-rat wow animate fadeInUp" data-wow-duration="2.0s">

					<div class="col-md-6"></div>


					<div class="atri-ads col-md-6">


						<div class="single-icon col-md-3 col-sm-3 col-xs-3">

							<p id="likes-count"><i class="fa fa-heart"
							                       @if($userLike != '' && $userLike > 0)
							                       style="color:red;"
							                       @endif
							                       aria-hidden="true" data-id="{{ $data->id }}" id="like"></i>
								<span id="count-likes" data-val="{{ $countLikes }}"> {{ $countLikes }} </span>
							</p>

						</div>

						<div class="single-icon col-md-3 col-sm-3 col-xs-3">

							<p><a class="fa fa-commenting" aria-hidden="true" href="#comment"></a> {{ $countComments }}

							</p>

						</div>

						<div class="single-icon col-md-3 col-sm-3 col-xs-3">

							<p><i class="fa fa-eye" aria-hidden="true"></i> {{ $data->views }} </p>

						</div>


					</div>


				</div>

				<div class="marker-ads border-rat">

					<h3><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $data->city()->first()->name_ar }}

						- {{ $data->hay()->first()->name_ar }} </h3>


					@if(isset($akarData->map_lat) && $akarData->map_lat != '')

					@endif


				</div>

				<div class="icons-so-ads border-rat">


					<span class='st_facebook_large' displayText='Facebook'></span>

					<span class='st_twitter_large' displayText='Tweet'></span>

					<span class='st_whatsapp_large' displayText='WhatsApp'></span>

					<span class='st_pinterest_large' displayText='Pinterest'></span>

					<span class='st_linkedin_large' displayText='LinkedIn'></span>

					<span class='st_googleplus_large' displayText='Google +'></span>

					<span class='st_email_large' displayText='Email'></span>

					<span class='st_sharethis_large' displayText='ShareThis'></span>


				</div>

				{{--<div class="info-ads border-rat">--}}

				{{--<h3><i class="fa fa-user" aria-hidden="true"></i><a href="Ads.html">https://www.info.com</a></h3>--}}

				{{--</div>--}}

				<div class="time-ads">

					<h3><i class="fa fa-clock-o" aria-hidden="true"></i> تم اضافته في

						<span> {{ date_format($data->created_at, 'Y-m-d') }} </span></h3>

					<a href="{{ route('add-report', ['id' => $data->id]) }}">إبلاغ</a>

				</div>


			</div>


		</div>

		<div class="comment-user wow animate fadeInUp" data-wow-duration="2.0s">

			@foreach($comments as $comment)

				<div class="comment-div">


					<div class="img-user col-md-2 col-sm-2">


						<img src="{{ url('public/web/') }}/images/user_male2-512.png"/>


					</div>


					<div class="discrip-owner col-md-10 col-sm-10">


						<div class="name-and-date">


							<h4> {{ $comment->byUser()->first()->name }} <span><i class="fa fa-calendar"

							                                                      aria-hidden="true"></i> {{ date_format($comment->created_at, 'Y/m/d') }} </span>

							</h4>


						</div>

						<div class="content-comment">


							<p> {{ $comment->comment }} </p>


							@if(auth()->check())

								@if(auth()->user()->id == $comment->created_by)

									<a href="{{ route('delete-comment', ['id' => $comment->id]) }}"

									   class="do-delete pull-left">حذف</a>

								@endif

							@endif

						</div>


					</div>


				</div>

			@endforeach



			@if($countComments > 0)
				<div class="more">

					{{ $comments->links() }}


				</div>



			@endif



			@if(auth()->check())

				@if($data->comments_status == 1)

					@if(settings()->site_comments_status == 1)

						<div class="form-comment">

							<form action="{{ route('add-comment') }}" method="post">

								<h1>إضافة تعليق</h1>

								<div class="img-user col-md-2 col-sm-2">


									<img src="{{ url('public/web/') }}/images/user_male2-512.png"/>


								</div>

								<div class="discrip-owner col-md-10 col-sm-10">


									<div class="name-and-date">


										<h4> {{ auth()->user()->name }} </h4>


									</div>

									<div class="textarea-comment" id="comment">

										<textarea name="comment" required placeholder="اضافة تعليق"> </textarea>

									</div>

									<input type="hidden" name="id" value="{{ $data->id }}">

									<input type="hidden" name="scrf">

									<input type="hidden" name="_token" value="{{ csrf_token() }}">


									<div class="submit-comment">


										<input type="submit" name="submit" value="إرسال"/>

									</div>


								</div>


							</form>


						</div>

					@endif

				@endif



			@endif


		</div>


	</div>

	<div class="clearfix"></div>

	<div class="like-bosts ">


		<div class="title-page-ads">

			<h2><span>&#8226;</span>اعلانات مشابهة<span>&#8226;</span></h2>

		</div>

		<div class="block-ads">


			@foreach($samData as $samAds)



				<div class="col-md-4 col-sm-6 col-xs-12 single-block-ads wow animate fadeInUp" data-wow-duration="2.5s">


					<div class="border-block">


						<div class="img-block-ads">


							<a href="{{ route('ad-view', ['id' => $samAds->id]) }}"><img

										src="{{ url('public/ads_262x249/' . $samAds->photo) }}"/></a>


						</div>

						<div class="title-block-ads">

							<h3><a href="{{ route('ad-view', ['id' => $samAds->id]) }}"> {{ $samAds->title }} </a></h3>

							<p> {{ mb_substr($samAds->desc, 0, 100) }} @if(strlen($samAds->desc) > 100) ... @endif </p>

						</div>

						<div class="mark-block">


							<h4><i class="fa fa-map-marker"

							       aria-hidden="true"></i> {{ $samAds->city()->first()->name_ar }} <span>{{ $samAds->price }}

									ريال</span></h4>


						</div>

					</div>

				</div>



			@endforeach


		</div>


	</div>



@endsection



@section('script')



	<script>


		$(document).ready(function () {

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
						url: '/haraj-awamer/add-like/' + id
					}).success(function (data) {
						$('#count-likes').html(count);
						$('#like').css('color', 'red');
					}).error(function (error) {
						console.log(error);
					});
				} else {
					//remove like
					$.ajax({
						method: 'get',
						url: '/haraj-awamer/remove-like/' + id
					}).success(function (data) {
						$('#count-likes').html(count - 1);
						$('#like').removeAttr('style');
					}).error(function (error) {
						console.log(error);
					});
				}
			});
		});


	</script>



@endsection
