@extends('web.master')

@section('content')

    <div class="bg-content-page">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="title-page-content wow animate fadeIn" data-wow-duration="2.0s">
                <h2><span>•</span>كافة الاشعارات<span>•</span></h2>
                <br>
            </div>

            <div class="table-text wow animate fadeInUp" data-wow-duration="2.0s">


                <div class="body-table">

                    @foreach($data as $item)
                        <div class="big-body-table">
                            <div class="single-p-table col-md-10 col-sm-3 col-xs-3">

                            @if($item->type == 'like')
                                اعجب
                                @else
                                علق
                                @endif

                               {{ $item->byUser()->first()->name }} على اعلانك<a class="text-info-800" href="{{ route('ad-view', ['id' => $item->getTitle()->first()->id ]) }}"> {{ $item->getTitle()->first()->title  }} </a> {{  $item->created_at->diffForHumans() }}


                            </div>

                            {{--<div class="single-p-table col-md-2 col-sm-6 col-xs-6">--}}

                                {{--<p> <a href="{{ route('delete-notif', ['id' => $item->id]) }}"><i class="fa fa-remove"></i></a></p>--}}

                            {{--</div>--}}

                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>

@endsection