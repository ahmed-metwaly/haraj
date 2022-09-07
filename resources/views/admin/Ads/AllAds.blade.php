@extends('admin.master')

@section('title')
	{{ trans('admin.sideAdssShow') }}
@endsection

@section('sectionName')
	{{ trans('admin.sideAdssShow') }}
@endsection

@section('pageName')
	{{ trans('admin.sideAdssShow') }}
@endsection


@section('content')

	@if($Ads->count() > 0)
		<!-- Highlighting rows and columns -->
		<div class="panel panel-flat">
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>#</th>
					<th>{{ trans('admin.adsTitle') }}</th>
					<th>{{ trans('admin.addedBy') }}</th>
					<th>{{ trans('admin.adminsADDate') }}</th>
					<th>{{ trans('admin.show') }}</th>
					<th>{{ trans('admin.edit') }}</th>
					<th>{{ trans('admin.delete') }}</th>


				</tr>
				</thead>
				<tbody>

				@foreach($Ads as $value)

					<tr>
						<td>{{ $value->id }}</td>
						<td><a target="_blank"
						       href="{{ route('ad-view', ['id' => $value->id]) }}">{{ $value->title }}</a>
						</td>
						<td>{{ $value->username }}</td>
						<td>{{ $value->created_at->diffForHumans() }}</td>
						<td><a target="_blank" href="{{ route('ad-view', ['id' => $value->id]) }}"><i class="icon-tv"
						                                                                              aria-hidden="true"></i></a>
						</td>
						<td><a target="_blank" href="{{ route('add-edit', ['id' => $value->id]) }}"><i
										class="icon-pencil"
										aria-hidden="true"></i></a>
						</td>
						<td><a class="do-delete"
						       href="{{ Auth()->user()->id == $value->id ?  '#' : route('delete-ad', ['id' => $value->id]) }}"><i
										class="{{ Auth()->user()->id == $value->id ?  '' : 'icon-database-remove' }}"></i></a>
						</td>
					</tr>

				@endforeach
				</tbody>
			</table>
		</div>
		<div style="text-align: left">
			{{ $Ads->links('admin.pagination') }}
		</div>

	@else
		<div class="alert alert-warning no-border" style="text-align: center">
			لا يوجد إعلانات غير مفعلة
		</div>
	@endif


@endsection
