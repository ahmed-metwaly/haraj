<style type="text/css">

</style>
<div id="myModal" class="modal fade text-right" role="dialog" >
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تسجيل حساب جديد</h4>
            </div>
            <div class="modal-body">
                <form class="form-top-header" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="user-name">
                        <label>الإسم</label>
                        <br />
                        <input type="text" name="name" />
                    </div>

                    <div class="user-name">
                        <label>الجوال</label>
                        <br />
                        <input type="text" name="phone" />
                    </div>

                    <div class="user-name">
                        <label>البريد الإلكتروني</label>
                        <br />
                        <input type="email" name="email"  />
                    </div>
                    <div class="password">
                        <label>كلمة السر</label>
                        <br />
                        <input type="password" name="password" />
                    </div>
                    <div class="password">
                        <label>تأكيد كلمة السر</label>
                        <br />
                        <input type="password" name="password" />
                    </div>
                    <div class="password">
                        <label>الصورة الشخصيةة-</label>
                        <br />

                        <div class="box">
                            <input type="file" name="photo" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" />
                            <label for="file-7">
                                <span></span>
                                <strong>
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div>

                        {{--<input type="file" name="" class="form-control" />--}}
                    </div>
                    
                    <div class="password">
                        <label>المدينة</label>
                        <br />
                        <select name="city_id" id="city" class="form-control">
                            <option>-- يرجى الاختيار --</option>
                            @foreach(cities() as $city)

                                <option value="{{ $city->id }}"> {{ $city->name }} </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="submin-in">

                       

                        <input type="submit" name="submit" value="تسجيل" />

                    </div>


                </form>
            </div>

        </div>

    </div>
</div>


<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">الدخول إلي حسابي</h4>
            </div>
            <div class="modal-body">
                <form class="form-top-header" action="{{ route('login') }}" method="post">
                    <div class="user-name">
                        <label> البريد الإلكتروني</label>
                        <br />
                        <input type="email" name="email" placeholder="مثال :- aait@admin.com" />
                    </div>
                    <div class="password">
                        <label>كلمة السر</label>
                        <br />
                        <input type="password" name="password" value="************" />
                    </div>
                    <div class="chekbox">
                        <label>
                            <input type="checkbox" name="remember_me"/>
                            تذكرني
                        </label>
                        <a href="{{url('/login-user-forget')}}">هل نسيت كلمة المرور</a>
                    </div>
                    <div class="submin-in">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" name="submit" value="دخول" />

                    </div>


                </form>
            </div>

        </div>

    </div>
</div>