@extends('web.master')

@section('content')

	@include('web.template.sidebar')
	<div class="col-md-9 col-xs-12 content">
		<div class="col-md-12 tabs ">
			<div class="row">
				<div class="tabpanel" role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">
							<a class="hvr-pop" href="#home" aria-controls="home" role="tab" data-toggle="tab"><img
										src="{{ url('public/web') }}/images/tabs2.png" alt=""></a>
						</li>
						<li role="presentation" class="active">
							<a class="hvr-pop" href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><img
										src="{{ url('public/web') }}/images/tabs1.png" alt=""></a>
						</li>
					</ul>
					<p><span class="wow flash" data-wow-delay="5s" data-wow-iteration="2" data-wow-duration="3s"><i
									class="fa fa-search" aria-hidden="true"></i> نتائج البحث </span></p>
					<!-- Tab panes -->
					<div class="tab-content ">
						<div role="tabpanel" class="tab-pane box" id="home">
							@if(count($data) > 0)
								@foreach($data as $newAd)
								@if($newAd->is_pro ==1)

									<div class="col-md-6 col-lg-4 col-xs-12 col-sm-6"> <!-- wow slideInUp -->
										<div>
											<div>
												<a href="{{ route('ad-view', ['id' => $newAd->id]) }}">
													<img class="img-responsive" src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
													     alt="{{ $newAd->photo }}">
												</a>
											</div>
											<h4>
												<a href="#"> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </a>
											</h4>
											<p> {{ $newAd->desc }} </p>
											<span><i class="fa fa-map-marker"
											         aria-hidden="true"></i> {{ $newAd->city()->first()->name_ar }} </span>
											<span class="box-left"> {{ $newAd->price }} ريال</span></div>
									</div>
									@endif
								@endforeach
								@foreach($data as $newAd)
								@if($newAd->is_pro ==0)

									<div class="col-md-6 col-lg-4 col-xs-12 col-sm-6"> <!-- wow slideInUp -->
										<div>
											<div>
												<a href="{{ route('ad-view', ['id' => $newAd->id]) }}">
													<img class="img-responsive" src="{{ url('public/ads_262x249/' . $newAd->photo ) }}"
													     alt="{{ $newAd->photo }}">
												</a>
											</div>
											<h4>
												<a href="#"> {{ (strlen($newAd->title) > 50) ? (mb_substr($newAd->title, 0, 50) . ' ... ')  : (mb_substr($newAd->title, 0, 50)) }} </a>
											</h4>
											<p> {{ $newAd->desc }} </p>
											<span><i class="fa fa-map-marker"
											         aria-hidden="true"></i> {{ $newAd->city()->first()->name_ar }} </span>
											<span class="box-left"> {{ $newAd->price }} ريال</span></div>
									</div>
									@endif
								@endforeach
								{{  $data->links('web.pagination') }}
							@else
								<div class="col-md-12 text-center bg-block  wow animate fadeInUp"
								     data-wow-duration="1.5s">

									<div class="alert alert-danger">
										لا يوجد نتائج لهذا البحث
									</div>

								</div>
							@endif
						</div>
						<div role="tabpanel" class="tab-pane active table-content" id="tab">
							@if(count($data) > 0)
								<table class="table table-hover wow slideInUp">
									<thead>
									<tr>
										<th>العروض</th>
										<th>المدينة</th>
										<th>المعلن</th>
										<th>قبل</th>
										<th><i class="fa fa-camera" aria-hidden="true"></i></th>
									</tr>
									</thead>
									<tbody>
									@foreach($data as $nAdd)
									@if($nAdd->is_pro ==1)
										<tr>
											<td>
												<a href="{{ route('ad-view', ['id' => $nAdd->id]) }}"> {{ $nAdd->title }} </a>
											</td>
											<td><a href="#"> {{ $nAdd->city()->first()->name_ar }} </a></td>
											<td><a href="#"> {{ $nAdd->byUser()->first()->name }} </a></td>
											<td><a href="#"> {{ $nAdd->created_at->diffForHumans() }}</a></td>
											<td>
												<a class="fancybox" rel="group"
												   href="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"><img
															src="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"
															alt=""/></a>
											</td>
										</tr>
										@endif
									@endforeach

									@foreach($data as $nAdd)
									@if($nAdd->is_pro ==0)
										<tr>
											<td>
												<a href="{{ route('ad-view', ['id' => $nAdd->id]) }}"> {{ $nAdd->title }} </a>
											</td>
											<td><a href="#"> {{ $nAdd->city()->first()->name_ar }} </a></td>
											<td><a href="#"> {{ $nAdd->byUser()->first()->name }} </a></td>
											<td><a href="#"> {{ $nAdd->created_at->diffForHumans() }}</a></td>
											<td>
												<a class="fancybox" rel="group"
												   href="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"><img
															src="{{ url('public/ads_262x249/' . $nAdd->photo ) }}"
															alt=""/></a>
											</td>
										</tr>
										@endif
									@endforeach
									</tbody>
								</table>
								{{  $data->links('web.pagination') }}
							@else

								<div class="col-md-12 text-center bg-block  wow animate fadeInUp"
								     data-wow-duration="1.5s">

									<div class="alert alert-danger">
										لا يوجد نتائج لهذا البحث
									</div>

								</div>

							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

