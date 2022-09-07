@extends('web.master')

@section('content')
	
	<div class="col-xs-12 omola">
        <h3>إشعارات حديثه</h3>
        <ul>

            <li>عميلنا الكريم: <big style="color: red">نرجو الحفاظ على رقمك السري وعدم إرساله لأي شخص يطلبه</big> منك عبر الاتصال أو المراسلة. <big style="color: green">معلومات العضوية هي أمانه في ذمتك و هي تحت مسؤوليتك.</big></li>
        
        @if(count($data)>0)
        @foreach($data as $item)
        	<li>

            	@if($item->type == 'like')
                    يوجد إعجاب جديد بالإعلان:
                    @else
                    يوجد رد جديد على الإعلان:
                @endif
             <a href="{{ route('ad-view', ['id' => $item->ad_id ]) }}">{{$item->ad_title}}</a> بواسطة <a href="{{route('public-profile',['id'=>$item->user_id])}}">{{$item->username}}</a> {{$item->created_at->diffForHumans()}} <a href="{{ route('delete-notif', ['id' => $item->id]) }}"><i class="fa fa-remove"></i></a></li>
        @endforeach
        @endif
        </ul>
        <h3>إشعارات أقدم</h3>
        <ul>

        @if(count($old_data)>0)
        @foreach($old_data as $item)

            <li>

            	@if($item->type == 'like')
                    يوجد إعجاب جديد بالإعلان:
                    @else
                    يوجد رد جديد على الإعلان:
                @endif
             <a href="{{ route('ad-view', ['id' => $item->ad_id ]) }}">{{$item->ad_title}}</a> بواسطة <a href="{{route('public-profile',['id'=>$item->user_id])}}">{{$item->username}}</a> {{$item->created_at->diffForHumans()}} <a href="{{ route('delete-notif', ['id' => $item->id]) }}"><i class="fa fa-remove"></i></a></li>

            <!-- <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>يوجد رد جديد على الإعلان: <a href="single-page.html">مكتب فاخر للتقبيل</a> بواسطة <a href="profile-user.html">وسام السمو</a> قبل 5 شهر و 2 أسبوع</li> -->
        
        @endforeach
        @endif
        </ul>
    </div>
            
@endsection