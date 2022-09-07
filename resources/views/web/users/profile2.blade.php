@extends('web.master')

@section('content')
	<p class="header-pages"><a href="{{ url('/') }}">الرئيسية</a> / <a href="profile.html">الصفحة الشخصية</a></p>
	<div class="contact-us profile follwers">
		<div id="Profile_panel">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#personal" aria-controls="personal" role="tab" data-toggle="tab">إعلاناتي</a>
					</li>
					<li role="presentation">
						<a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">الرسائل المرسلة</a>
					</li>
					<li role="presentation">
						<a href="#received" aria-controls="received" role="tab" data-toggle="tab">الرسائل الواردة</a>
					</li>
					<li role="presentation">
						<a href="#likes" aria-controls="likes" role="tab" data-toggle="tab">إعجاباتي</a>
					</li>	
					<li role="presentation">
						<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">بياناتي</a>
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
					<div role="tabpanel" class="tab-pane" id="sent">
						<div class="table-width">
							<table class="table table-hover">
								<thead style="background: #bc130d">
								<tr>
									<th>الرسالة</th>
									<th>اسم المرسل إليه</th>
									<th>البريد الإلكترونى</th>
									<th>قبل</th>
								</tr>
								</thead>
								<tbody>
								@foreach($sent as $Smsg)

									<tr>
										<td>
											{{$Smsg->message}}
										</td>
										<td><a href="#"> {{ $Smsg->getTo->name}} </a></td>
										<td><a href="#"> {{ $Smsg->getTo->email}} </a></td>
										<td> {{ $Smsg->created_at->diffForHumans() }} </td>
									</tr>

								@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="received">
						<div class="table-width">

							<table class="table table-hover">
								<thead style="background: #bc130d">
								<tr>
									<th>الرسالة</th>
									<th>المرسل</th>
									<th>البريد الإلكترونى للمرسل</th>
									<th>قبل</th>
								</tr>
								</thead>
								<tbody>
								@foreach($received as $Rmsg)

									<tr>
										<td>
											{{$Rmsg->message}}
										</td>
										<td><a href="#"> {{ $Rmsg->getFrom->name }} </a></td>
										<td><a href="#"> {{ $Rmsg->getFrom->email }} </a></td>
										<td> {{ $Rmsg->created_at->diffForHumans() }} </td>
									</tr>

								@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="likes">
						<div class="table-width">
							<table class="table table-hover">
								<thead style="background: #bc130d">
								<tr>
									<th>العرض</th>
									<th>المدينة</th>
									<th>قبل</th>
								</tr>
								</thead>
								<tbody>
								@foreach($adsLikesData as $adLikeData)

									<tr>
										<td>
											<a href="{{ route('ad-view', ['id' => $adLikeData->id]) }}">  {{ $adLikeData->title }} </a>
										</td>
										<td><a href="#"> {{ $adLikeData->city()->first()->name_ar }} </a></td>
										<td> {{ $adLikeData->created_at->diffForHumans() }} </td>
									</tr>

								@endforeach
								</tbody>
							</table>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="profile">
						<div class="table-widt">
							<form action="{{ route('user-edit', ['id' => auth()->user()->id]) }}" method="post"
							      class="form-top-header">
								<br>

								<div class="user-name">
									<label>الاسم</label>
									<input id="first_name" class="textbox" name="name" type="text"
									       value="{{ $userData->name }}" placeholder="* الإسم"/>
								</div>
								<div class="user-name">
									<label>الاميل</label>
									<input id="email" class="textbox" name="email" type="text"
									       value="{{ $userData->email }}" placeholder="* البريد الإلكتروني"/>
								</div>
								<div class="user-name">
									<label>رقم الجوال</label>
									<input id="number" class="textbox" name="phone" type="text"
									       value="{{ $userData->phone }}" placeholder="* رقم الهاتف"/>
								</div>

								<div class="select-inputs-page add-e3lan">
									<select name="country_id" id="count">
										<option disabled>اختر الدولة</option>
										@foreach($countries as $country)

											<option value="{{ $country->id }}" {{ $country->id == $userData->country_id ? 'selected' : '' }} > {{ $country->name_ar }} </option>

										@endforeach

									</select>
								</div>

								<div class="select-inputs-page add-e3lan">
									<select name="city_id" id="city">
										<option disabled>اختر المدينة</option>
										@foreach($cities as $city)

											<option value="{{ $city->id }}" {{ $city->id == $userData->city_id ? 'selected' : '' }} > {{ $city->name_ar }} </option>

										@endforeach

									</select>
								</div>
								<br>
								<div class="password">
									<label>الباسورد</label>
									<input placeholder="*****" name="password" type="password"/>
								</div>
								<div class="submin-in">

									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-default">حفظ التعديلات
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')

	<script>

		$(document).ready(function ($) {
			$("input[name='enable']").click(function () {
				if ($(this).is(':checked')) {
					$('input.textbox:text').attr("disabled", true);
				}
				else if ($(this).not(':checked')) {
					var ok = confirm('åá ÇäÊ ãÊÃßÏ ãä ÇÓÊÑÌÇÚ ÌãíÚ ÈíÇäÇÊß ÇáÞÏíãÉ');
					if (ok) {
						var remove = '';
						$('input.textbox:text').attr('value', remove);
						$('input.textbox:text').attr("disabled", true);
					}
				}
			});
		});

	</script>

@endsection
