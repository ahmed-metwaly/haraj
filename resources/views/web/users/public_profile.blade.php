@extends('web.master')

@section('content')
	<p class="header-pages"><a href="{{ url('/') }}">الرئيسية</a> / <a href="profile.html">الصفحة الشخصية</a></p>
	<div class="contact-us profile follwers">
		<div id="Profile_panel"> 
			<!-- <button id="follow" data-follower_id="{{$userData->id}}" style="color: #a68b6a; float:left ; font-size: 20px ; font-weight: bold;">متابعة</button> -->
				@if(Auth::check())
				@if(count($follow)>0)

					<button id="unfollow"  data-f_id="{{$userData->id}}" style="color: #a68b6a; float:left ; font-size: 20px ; font-weight: bold;">الغاء المتابعة</button>
					<button id="follow" class="hidden" data-ad_id="{{$userData->id}}" style="color: #a68b6a; float:left ; font-size: 20px ; font-weight: bold;">متابعة</button>
					@else
					<button id="follow" data-ad_id="{{$userData->id}}" style="color: #a68b6a; float:left ; font-size: 20px ; font-weight: bold;">متابعة</button>
					<button id="unfollow" class="hidden" data-f_id="{{$userData->id}}" style="color: #a68b6a; float:left ; font-size: 20px ; font-weight: bold;">الغاء المتابعة</button>
					@endif
					@endif

			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">إعلانات المستخدم</a>
					</li>
					<li role="presentation">
						<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">بيانات المستخدم</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="personal">
						<div class="table-width">
							<table class="table table-hover">
								<thead>
								<tr>
									<th>العرض</th>
									<th>المدينة</th>
									<th>قبل</th>
								</tr>
								</thead>
								<tbody>
								@foreach($adsData as $adData)

									<tr>
										<td>
											<a href="{{ route('ad-view', ['id' => $adData->id]) }}">  {{ $adData->title }} </a>
										</td>
										<td><a href="#"> {{ $adData->city()->first()->name_ar }} </a></td>
										<td> {{ $adData->created_at->diffForHumans() }} </td>
									</tr>

								@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="table-width">
							<table class="table table-hover">
								<thead>
								<tr>
									<th>الإسم</th>
									<th>البريد الإلكترونى</th>
									<th>رقم الجوال</th>
								</tr>
								</thead>
								<tbody>
							
									<tr>
										<td>
											<a href="#">{{ $userData->name }} </a>
										</td>
										<td><a href="#"> {{ $userData->email }} </a></td>
										<td><a href="#"> {{ $userData->phone }} </a></td>
										<!-- <td> </td> -->
									</tr>	
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(window).load(function() {
			/*$('#follow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('follower_id');
				$.ajax({
						method: 'get',
						url: '/ticket/followings/save/' + id +'/'+0
					}).success(function (data) {

						console.log('success');
					}).error(function (error) {
						console.log(error);
					});

			});
*/
			///

			// follow
			$('#follow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('ad_id');
				$.ajax({
						method: 'get',
						url: '{{url("/followings/save") }}/' + id +'/'+0
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
						url: '{{url("/followings/deletefollower") }}/' +id
					}).success(function (data) {
						console.log(data);
						$('#unfollow').addClass('hidden');
						$('#follow').removeClass('hidden');
						$('#follow').addClass('visible');
						
						/*$("#count-likes").attr("data-val", count - 1);
						$('#count-likes').html(count - 1);
						$('#like').removeAttr('style');*/
						console.log('success');
					}).error(function (error) {
						console.log(error);
					});

			});
		});
	</script>

@endsection