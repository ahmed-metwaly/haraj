@extends('web.master')

@section('content')


            <p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="#">العضوية المميزة</a></p>
            <div class="contact-us best-member">
                <h3><i class="fa fa-circle" aria-hidden="true"></i> عضوية معارض السيارات و مكاتب العقار <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <!-- <span>لقد أخترت الاشتراك في : </span>
                <br> 
                <span class="span-pages">العرض الأول: اشتراك لمدة 6 شهور بسعر 1490 ريال. </span>
                <br> -->
                <span>طريقة الاشتراك : </span>
                <br>
                <span class="span-pages">الخطوة الأولى: قم بتحويل مبلغ الاشتراك على حساباتنا البنكية الموضحة في صفحة حساب العمولة. </span>
                <br>
                <span>الخطوة الثانية: بعد تحويل مبلغ الاشتراك، يجب تعبئة النموذج التالي: </span>
                <br>
                <form action="{{route('do-add-subscribe-transfer')}}" method="POST" role="form">
                	{{ csrf_field() }}
                    <legend>نموذج تحويل العمولة</legend>
                    <div class="form-group">
                        <!-- <label for="">إسم المستخدم</label>
                        <input type="text" name="" class="form-control" id=""> -->
                        <label for="">إسم المحول</label>
                        <input type="text" name="transfered_by" class="form-control" id="">
                        <label for="">رقم الجوال</label>
                        <input type="text" name="phone" class="form-control" id="">
                        <label for="">مبلغ العمولة</label>
                        <input type="number" name="amount" class="form-control" id="">
                        <label for="">البنك الذى تم التحويل إليه</label>
                        <select name="bank_name" id="input" class="form-control">
                        @if(count($BankData) > 0)
            				@foreach($BankData as $bank)
                            <option selected="" disabled="" value="">البنك</option>
                            <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                        @endforeach
                        @endif
                        </select>
                        <label for="">متى تم التحويل</label>
                        <input type="text" name="transfered_at" class="form-control" id="">
                        <!-- <select name="" id="input" class="form-control" required="required">
                            <option selected="" disabled="" value="">يوم</option>
                            <option value="">يوم</option>
                            <option value="">3 ايام</option>
                            <option value="">اسبوع</option>
                        </select> -->
                        <label for="">البريد الإلكترونى</label>
                        <input name="email" type="email" class="form-control" id="">
                        <!-- <label for="">رقم الاعلان</label>
                        <input name="ad_id" type="number" class="form-control" id=""> -->
                        <!-- <span class="span-small">نرجو حذف الإعلان بعد الإنتهاء منه</span> -->
                        <!-- <label for="">رقم التحقق</label>
                        <input name="verification_code" type="number" class="form-control" id="">
                        <span class="span-small">أكتب الرقم الموجود في الصوره بالحقل المخصص. <small>12548</small></span> -->
                        <br/>
                        <label for="">ملاحظات</label>
                        <input name="notes" type="text" class="form-control" id="">
                        <span> نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه</span>

                    </div>

                    <button type="submit" class="btn btn-primary hvr-shutter-out-vertical">إرسال</button>
                </form>
            </div>

@endsection