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

                <form action="" method="post">

                    <div class="title-form-page">

                        <h2> الرسائل </h2>

                    </div>
                    <div class="clearfix"></div>
                    <div class="big-div-msgs">
                        @foreach($data as $item)

                            @if(auth()->user()->id == $item->form_id)

                                <div class="msg-content">

                                    <div class="col-md-11 col-sm-10 col-xs-8">

                                        <h3><a href="{{ route('add-message', ['id' => $item->to_id ]) }}">{{ auth()->user()->name }}</a></h3>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p-msg col-md-12">
                                        <p> {{ $item->message }} </p>
                                    </div>

                                </div>

                            @else


                                <div class="msg-content">

                                    <div class="col-md-11 col-sm-10 col-xs-8">

                                        <h3><a href="{{ route('add-message', ['id' => $item->getTo()->first()->id ]) }}">{{ $item->getTo()->first()->name }}</a></h3>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="p-msg col-md-12">
                                        <p> {{ $item->message }} </p>
                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection