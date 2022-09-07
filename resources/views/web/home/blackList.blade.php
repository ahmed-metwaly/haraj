@extends('web.master')

@section('content')
	
	<div class="col-xs-12 omola">
        <h2>البحث في القائمة السوداء</h2>
        <p>القائمة السوداء هي قائمة بإرقام حسابات وأرقام جوالات من يقومون بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو مخالفة قوانين الموقع </p>
        <form action="{{ route('do-black-list') }}" method="POST" role="form">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="">أدخل رقم الحسب أو رقم الجوال :</label>
                <input type="text" name="search" class="form-control" id="">
            </div>
            <button type="submit" class="hvr-shutter-out-horizontal">فحص</button>
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

@endsection