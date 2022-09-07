@extends('web.master')

@section('content')

	@include('web.template.sidebar')
	<div class="col-md-9 col-xs-12 content">
	
	
	
	@if(count($data) > 0)
	    <div class="row">
		@foreach($data as $mark)
		
		    <div class="col-xs-6 col-sm-4 col-md-3">
			<a href="{{ route('search-ads', ['subcat' => $mark->subcat_id]) }}"><img src="{{ url('public/marks/' . $mark->photo)}}" alt="dawood" style="width:100%; height:120px;"></a>
		
		        <div class="dropdown">
			    <button class="btn btn-danger btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="margin: 8px 0 20px">
			        الأنواع <span class="caret" style="margin-right: 5px;"></span>
			    </button>
			@if(count($mark->models()->get())>0)
			    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin: 0;right: 0;text-align: center;">
			    @foreach($mark->models()->get() as $model)
				<li><a href="{{route('search-model',['id'=>$model->id])}}" >{{ $model->name }} </a></li>
			    @endforeach
			    </ul>
			@endif
			</div>
		    </div>
		
		@endforeach
	    </div>
	@else
		<div class="col-md-12 text-center bg-block  wow animate fadeInUp" data-wow-duration="1.5s">
			<div class="alert alert-danger">
				لا يوجد نتائج لهذا البحث
			</div>
		</div>
	@endif
	
	
	
	
		<!--<div class="col-md-12 tabs ">
			<div class="row">
			<table>
			<th>الماركة</th>
			
			<th>الأنواع</th>

			
				@if(count($data) > 0)
				@foreach($data as $mark)
				<tr>									
					<td><a href="{{ route('search-ads', ['subcat' => $mark->subcat_id]) }}"><img src="{{ url('public/marks/' . $mark->photo)}}" alt="dawood" style="width:100px; height:100px;"></a></td>
		{{-- <td><h4><a href="{{ route('search-ads', ['subcat' => $mark->subcat_id]) }}"> {{$mark->name  }} </a></h4></td> --}}
		<td>
@if(count($mark->models()->get())>0)
@foreach($mark->models()->get() as $model)
<a href="{{route('search-model',['id'=>$model->id])}}" >{{ $model->name }} </a><br/>
@endforeach
@endif

</td>
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
		</div>-->
	</div>
@endsection

