@extends('web.master')

@section('content')

	@include('web.template.sidebar')
	<div class="col-md-9 col-xs-12 content">
		<div class="col-md-12 tabs ">
			<div class="row">
			<table>
				@if(count($data) > 0)
				@foreach($data as $subcat)
				<tr>									
					<td><a href="{{ route('search-ads', ['subcat' => $subcat->id]) }}"><img src="{{ url('public/categories/' . $subcat->img)}}" alt="dawood" style="width:100px; height:100px;"></a></td>
		<td><h4><a href="{{ route('search-ads', ['subcat' => $subcat->id]) }}"> {{$subcat->name  }} </a></h4></td
				</tr>
				@endforeach
				@else
					<div class="col-md-12 text-center bg-block  wow animate fadeInUp"
					     data-wow-duration="1.5s">
	
						<div class="alert alert-danger">
							لا يوجد نتائج لهذا البحث
						</div>
	
					</div>
				@endif
			</table>
			</div>
		</div>
	</div>
@endsection

