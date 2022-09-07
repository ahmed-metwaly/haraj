@extends('web.master')

@section('content')
 <div class="col-xs-12 omola">
                <h2>عمولة حراج</h2>
                 @if($commissionData != '')
                <p>{!! $commissionData->commission !!}</p>
                <!-- <h3>ملاحظات:</h3>
                <ul>
                    <li>سيارات الإيجار المعروضه للتنازل تكون عمولتها حسب القيمة المدفوعه خلال الاتفاق. مثلا لو اراد شخص التنازل عن سيارته وباقي عليها 20 قسط واتفق مع شخص ان يتنازل عنها له بمبلغ 10 الف ريال فأن عمولة الموقع هي 100 ريال. اذا كان التنازل مجانيا فأن العموله أيضا مجانيه.</li>
                    <li>
                        بالنسبة للسيارات المتبادلة عن طريق الموقع، اذا كان المبادله رأس برأس فالعمولة تعتبر مجانية، وإذا كان هناك مبلغ مدفوع خلال المبادله فان العموله هي على المبلغ المدفوع فقط. مثلا لو اتفق شخصين على مبادلة سياره بسياره أخرى مع دفع 10 الف ريال كزيادة فان العمولة هي 100 ريال فقط يدفعها المعلن.</li>
                    <li>بالنسبه للعمولة على الطلبات: اذا وجد صاحب الاعلان عن الطلب سلعته عن طريق الموقع ولم يسبق لصاحب السلعه الإعلان عنها في الموقع من قبل فأن العمولة هي 1% على صاحب الطلب . اذا كانت السلعه قد سبق الإعلان عنها في الموقع فأن العمولة هي على صاحب السلعه.</li>
                </ul> -->
                <h2>حساب العمولة</h2>
                <p><big>حساب قيمة العمولة:</big> إذا تم بيع السلعة بسعر
                    <input type="number" name="price" id="price" onkeyup="document.getElementById('output').innerHTML = this.value * {{$commissionData->commission_count /100}}" /> ريال فأن العمولة هي: <span id="output"></span> ريال</p>
                @endif
                <h2>دفع العموله</h2>
                <h4>الطريقة الأولى</h4>
                <p>يمكنك استخدام التحويل البنكي لدفع العموله عن طريق إرسال حواله إلى حساباتنا في البنوك المحليه.</p>

                @if(count($BankData) > 0)
                @foreach($BankData as $bank)
                <h5>{{$bank->bank_name}}</h5>
                <h6>{{$bank->account_owner}}</h6>
                <h6><big>رقم الحساب</big> {{$bank->account_number}} </h6>
                <h6><big>الايبان</big> {{$bank->international_account}} </h6>
                <input onclick="this.value='تم الإرسال لجوالك المسجل وهو:{{Auth::user()->phone}}'" type="button" value="إرسال رقم الحساب لجوالك sms" id="myButton1" />
                <hr>
                @endforeach
                @endif

                <!-- <h5>البنك السعودي الفرنسي</h5>
                <h6>يوسف صالح دغيمان البراكي الرشيدي </h6>
                <h6><big>رقم الحساب</big> 521608010066975 </h6>
                <h6><big>الايبان</big> SA46 8000 0521 6080 1006 6975 </h6>
                <input onclick="this.value='تم الإرسال لجوالك المسجل وهو:+966556066597'" type="button" value="إرسال رقم الحساب لجوالك sms" id="myButton1" />
                <hr>
                <h5>مصرف الراجحي</h5>
                <h6>مؤسسة موقع حراج للتجاره</h6>
                <h6><big>رقم الحساب</big> 521608010066975 </h6>
                <h6><big>الايبان</big> SA46 8000 0521 6080 1006 6975 </h6>
                <input onclick="this.value='تم الإرسال لجوالك المسجل وهو:+966556066597'" type="button" value="إرسال رقم الحساب لجوالك sms" id="myButton1" />
                <hr>
                <h5>البنك السعودي الفرنسي</h5>
                <h6>يوسف صالح دغيمان البراكي الرشيدي </h6>
                <h6><big>رقم الحساب</big> 521608010066975 </h6>
                <h6><big>الايبان</big> SA46 8000 0521 6080 1006 6975 </h6>
                <input onclick="this.value='تم الإرسال لجوالك المسجل وهو:+966556066597'" type="button" value="إرسال رقم الحساب لجوالك sms" id="myButton1" /> -->
               
                <br>
                <h4>الطريقة الثانية</h4>
                <p>بإمكانك سداد العمولة عن طريق نظام <a href="sadat-system.html">سداد</a></p>
                <p>بعد إرسال المبلغ،يجب مراسلتنا عبر النموذج التالي لأجل تسجيل العمولة بأسم عضويتك ثم الحصول على مميزات الموقع الخاصة بالعملاء:</p>
                <h4>نموذج تحويل العمولة</h4>
                <form action="{{route('do-add-transfer')}}" method="POST" role="form">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">رقم الجوال :</label>
                        <input type="text" name="phone" class="form-control" id="">
                    </div>

                    <div class="form-group">
                        <label for="">البريد الإلكترونى</label>
                        <input name="email" type="email" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">مبلغ العمولة :</label>
                        <input type="number" name="amount" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">البنك الذي تم التحويل إليه :</label>
                        <select name="bank_name" id="input" class="form-control black-color" required="required">
                            <option value="" disabled="" selected="">إختر إسم البنك</option>
                            @if(count($BankData) > 0)
                            @foreach($BankData as $bank)
                                <option selected="" disabled="" value="">البنك</option>
                                <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">متى تم التحويل؟ :</label>
                        <input name="transfered_at" type="text" class="form-control" id="">
                        <!-- <select name="transfered_at" id="input" class="form-control black-color" required="required">
                            <option value="" disabled="" selected="">تم التحويل اليوم</option>
                            <option value="">تم التحويل اليوم</option>
                            <option value="">تم التحويل امس</option>
                        </select> -->
                    </div>
                    <div class="form-group">
                        <label for="">أسم المحول :</label>
                        <input name="transfered_by" type="text" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">رقم الإعلان :</label>
                        <input type="number" name="ad_id"class="form-control" id="">
                        <span>نرجو حذف الإعلان بعد الإنتهاء منه.</span>
                    </div>
                    <div class="form-group">
                        <label for="">ملاحظات :</label>
                        <textarea name="notes" id="input" class="form-control" rows="3"></textarea>
                    </div>
                    <p>نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه </p>
                    <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
                </form>
            </div>
@endsection
