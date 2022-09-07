@extends('web.master')


@section('content')

	<p class="header-pages"><a href="{{ url('') }}">الرئيسية</a> / <a href="black-menu.html">القائمة السوداء</a></p>
	<div class="contact-us add-e3lan">
		<h3><i class="fa fa-circle" aria-hidden="true"></i> القائمة السوداء <i class="fa fa-circle" aria-hidden="true"></i></h3>
		<span> البحث في القائمة السوداء </span>
		<br>
		<span class="span-pages">القائمة السوداء هي قائمة بإرقام حسابات وأرقام جوالات من يقومون بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو مخالفة قوانين الموقع</span>
		<form action="{{ route('do-black-list') }}" method="POST" role="form">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" name="search" class="form-control" id="search_id" placeholder="أدخل رقم الحساب و الجوال هنا" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أدخل رقم الحساب و الجوال هنا'">
				<span><small>*</small> أرقام فقط بدون حروف</span>
			</div>
			<button type="submit" class="btn btn-primary hvr-shutter-out-vertical">فحص</button>
		</form>
		@if(isset($data) && $data != '')
			<br>
			<br>
			<table class="table">

				<tr>
					<th>الاسم</th>
					<th> الدولة</th>
					<th> الحالة</th>
				</tr>

				<tr>
					<td> {{ $data->name }} </td>
					<th> {{ $data->name_ar }} </th>
					<th> حظر</th>
				</tr>

			</table>
		@endif
	</div>
	</div>
	</div>

@endsection
