@extends('web.master')

@section('content')

    <div class="col-xs-12 omola">
    <h2>{{ $data['title']}}</h2>
    
       
	    <p> {!! $data['content'] !!} </p>
	   
    </div>

@endsection
