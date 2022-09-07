@extends('web.master')

@section('content')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="name-page">

            <a href="#">الرئيسية</a>
            /
            <a href="#">الرسائل</a>
        </div>
        <div class="bg-content-page">
            <div class="title-page-content">
                <h2 class="wow animate fadeIn" data-wow-duration="2.0s"><span>&#8226;</span>الرسائل<span>&#8226;</span>
                </h2>
            </div>

            <div class="content-page-commission">


            </div>

            <div class="form-test wow animate fadeInUp" data-wow-duration="2.0s">

                <form action="{{ route('do-add-message', ['id' => $id]) }}" method="post">

                    <div class="title-form-page">

                        <h2>رسائل الأعضاء</h2>

                    </div>
                    <div class="clearfix"></div>
                    <div class="big-div-msgs">
                        @foreach($data as $item)

                            @if(auth()->user()->id == $item->from_id)

                                <div class="msg-content">

                                    <div class="col-md-11 col-sm-10 col-xs-8">

                                        <h3><a href="#">{{ $item->getFrom()->first()->name }}</a></h3>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p-msg col-md-12">
                                        <p> {{ $item->message }} </p>
                                    </div>

                                </div>

                            @else


                                <div class="msg-content">

                                    <div class="col-md-11 col-sm-10 col-xs-8">

                                        <h3><a href="#">{{ $item->getTo()->first()->name }}</a></h3>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p-msg col-md-12">
                                        <p> {{ $item->message }} </p>
                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>
                    <div class="form">

                            <div class="text-inputs-page">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>
                                        نص الرسالة

                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message"></textarea>
                                    <small> نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه</small>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="submit-form-page">
                                <div class="col-md-12">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" name="submit" value="إرسال"/>
                                </div>
                            </div>


                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection