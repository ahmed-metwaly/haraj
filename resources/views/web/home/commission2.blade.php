@extends('web.master')

@section('content')

	<p class="header-pages"><a href="{{ route('home') }}">الرئيسية</a> / <a href="#">عموله صاحب الموقع</a></p>
            <div class="contact-us best-e3lan follwers best-member">
            @if($commissionData != '')
                <h3><i class="fa fa-circle" aria-hidden="true"></i> عموله حراج <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <span class="span-pages">{{$commissionData->commission}}</span>

                <h3><i class="fa fa-circle" aria-hidden="true"></i> حساب العمولة <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <h5 class="number-h5">
                -  إذا تم بيع السلعة بسعر<span class="number-one"><input type="number name="price" id="price"/></span>ريال فأن العمولة هي:<span class="number-two" id="i"></span><span class="number-three">ريال</span> 
                    
                </h5> 
               @endif
                 <!-- <h6><span style="width: auto">ملاحظه</span> نرجو تسجيل الدخول اذا كانت لديك عضوية في الموقع حتى إذا كان لك خصم يتم حسابه لك</h6>  -->
                <h3><i class="fa fa-circle" aria-hidden="true"></i> دفع العموله <i class="fa fa-circle" aria-hidden="true"></i></h3>
                <span class="span-pages" style="text-align: center;">يمكنك استخدام التحويل البنكي لدفع العموله عن طريق إرسال حواله إلى
 <br>حساباتنا في البنوك المحليه.</span>
 
 
 @if(count($BankData) > 0)
    @foreach($BankData as $bank)
        <h4><a href="">{{$bank->account_owner}}<br><br>{{$bank->account_number}}</a></h4>
        <h5><a href="">{{$bank->bank_name}}</a></h5>
        <h5>رقم الحساب:  <i class="text-muted">{{$bank->account_number}}</i></h5>
        <h5>رقم الحساب الدولي:  <i class="text-muted">{{$bank->international_account}}</i></h5>
        
        <button class="btn btn-danger">إرسال رقم الحساب لجوالك  SMS  </button>
        
        <hr style="margin: 20px 0">
    @endforeach
@endif
 
 
                <!--<div class="table-width">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>أسم صاحب الحساب</th>
                                <th>أسم البنك</th>
                                <th>رقم الحساب</th>
                                <th>رقم الحساب الدولي</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($BankData) > 0)
            				@foreach($BankData as $bank)
                            <tr>
                                <td><a href="">{{$bank->account_owner}}<br>{{$bank->account_number}}</a></td>
                                <td><a href="">{{$bank->bank_name}}</a></td>
                                <td><a href="">{{$bank->account_number}}</a></td>
                                <td>{{$bank->international_account}}</td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                </div>-->
                <h5 class="number-h5">بعد إرسال المبلغ،يجب مراسلتنا عبر النموذج التالي لأجل تسجيل العمولة بأسم عضويتك ثم الحصول على مميزات الموقع الخاصة بالعملاء :</h5>
                <form action="{{route('do-add-transfer')}}" method="POST" role="form">
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
                        <select name="bank_name" id="input" class="form-control" >
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
                        <label for="">رقم الاعلان</label>
                        <input name="ad_id" type="number" class="form-control" id="">
                        <span class="span-small">نرجو حذف الإعلان بعد الإنتهاء منه</span>
                        <label for="">رقم التحقق</label>
                        <input name="verification_code" type="number" class="form-control" id="">
                        <span class="span-small">أكتب الرقم الموجود في الصوره بالحقل المخصص. <small>12548</small></span>
                        <label for="">ملاحظات</label>
                        <input name="notes" type="text" class="form-control" id="">
                        <span> نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه</span>

                    </div>

                    <button type="submit" class="btn btn-primary hvr-shutter-out-vertical">إرسال</button>
                </form>
            </div>

@endsection

@section('script')

    <script type="text/javascript">
      //  $(document).ready(function(){
            $(window).load(function() {
		var inputBox = document.getElementById('price');
		inputBox.onkeyup = function(){
			document.getElementById('i').innerHTML = inputBox.value * {{$commissionData->commission_count /100}};
		} 
            });
    </script>
@endsection 