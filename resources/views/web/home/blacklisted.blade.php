@extends('web.master')

@section('content')
	
	<div class="col-xs-12 omola">
	    <h2>السلع والإعلانات الممنوعة</h2>
	    @if($black_ads != '')
	    {!! $black_ads->black_ads!!}
	    @endif
	</div>

@endsection