@extends('admin.master')

@section('title')
	@if(Request::url() == route('users'))
		{{ trans('admin.sideUsersShow') }}
	@else

		{{ trans('admin.sideAdminsShow') }}

	@endif

@endsection

@section('sectionName')
	{{ trans('admin.sideAdminsTitle') }}
@endsection

@section('pageName')
	@if(Request::url() == route('users'))
		{{ trans('admin.sideUsersShow') }}
	@else

		{{ trans('admin.sideAdminsShow') }}

	@endif
@endsection


@section('content')


	<!-- Highlighting rows and columns -->
	<div class="panel panel-flat">


		<table class="table table-bordered table-hover datatable-highlight">
			<thead>
			<tr>
				<th>#</th>
				<th>{{ trans('admin.adminsADName') }}</th>
				<th>{{ trans('admin.adminsADEmail') }}</th>
				<th>{{ trans('admin.adminsADDate') }}</th>
				<th>{{ trans('admin.show') }}</th>
				<th>{{ trans('admin.edit') }}</th>
				<th>{{ trans('admin.delete') }}</th>


			</tr>
			</thead>
			<tbody>

			@foreach($data as $value)

				<tr>
					<td>{{ $value->id }}</td>
					<td><a href="{{ route('admin-details', ['id' => $value->id]) }}">{{ $value->name }}</a></td>
					<td> {{ $value->email }} </td>


					<td>{{ $value->created_at }}</td>
					<td><a href="{{ route('admin-details', ['id' => $value->id]) }}"><i class="icon-tv"
					                                                                    aria-hidden="true"></i></a></td>
					<td><a href="{{ route('admin-edit', ['id' => $value->id]) }}"><i class="icon-pencil"
					                                                                 aria-hidden="true"></i></a></td>
					<td><a class="do-delete"
					       href="{{ auth()->user()->id == $value->id ?  '#' : route('admin-delete', ['id' => $value->id]) }}"><i
									class="{{ auth()->user()->id == $value->id ?  '' : 'icon-database-remove' }}"></i></a>
					</td>
				</tr>

			@endforeach
			</tbody>
		</table>
	</div>


@endsection
