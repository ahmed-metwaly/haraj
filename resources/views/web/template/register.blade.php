@extends('web.master')

@section('content')
	<form action="{{ route('register-user') }}" method="POST" role="form" class="log">
	{{ csrf_field() }}
                <legend>التسجيل بالموقع</legend>
                <div class="form-group">
                    <input required="" type="number" name="phone" class="form-control" id="" placeholder="ادخل رقم جوالك مثلا 0500010008" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ادخل رقم جوالك مثلا 0500010008'">
                </div>
                <div class="form-group">
                    <select name="city" id="input" class="form-control" required="required">
                        @foreach(countries() as $country)
								<option value="{{ $country->id }}">{{ $country->name }}</option>
							@endforeach
                    </select>
                </div>
                <p><i class="fa fa-hand-o-left" aria-hidden="true"></i> التسجيل في حراج يتطلب وجود رقم جوال. جميع معلوماتك لدينا هي أمانة في ذمتنا ونتعهد بالحفاظ عليها. لمزيد من التفاصيل، نرجو زيارة صفحة معاهدة استخدام الموقع.
                </p>
                <button type="submit" class="hvr-shutter-out-horizontal">تسجيل</button>
            </form>
@endsection