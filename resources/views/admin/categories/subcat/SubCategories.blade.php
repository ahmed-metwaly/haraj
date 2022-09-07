@extends('admin.master')



@section('title')

	{{ trans('admin.categoryDisplay') }}

@endsection


@section('sectionName')

	{{ trans('admin.SubcategoriesTitle') }}

@endsection




@section('pageName')

	{{ trans('admin.SubcategoryDisplay') }}

@endsection


@section('content')

	<!-- Highlighting rows and columns -->

	<div class="panel panel-flat">


		<table class="table table-bordered table-hover datatable-highlight">

			<thead>

			<tr>

				<th>#</th>

				<th>{{ trans('admin.SubcatImg') }}</th>

				<th>{{ trans('admin.SubcatNameAr') }}</th>

				<th>{{ trans('admin.catNameAr') }}</th>

				<th> {{ trans('admin.addedBy') }} </th>

				<th>{{ trans('admin.AddedDate') }}</th>

				<th>{{ trans('admin.show') }}</th>

				<th>{{ trans('admin.edit') }}</th>

				<th>{{ trans('admin.delete') }}</th>

			</tr>

			</thead>

			<tbody>

			@if(count($data) > 0)

				@foreach($data as $value)

					<tr>

						<td>{{ $value->id }}</td>

						<td><img class="img-preview"
						         src="{{ isset($value->img) && $value->img != '' ? url('public/categories/' . $value->img) : url('public/categories/cat-empty.png') }}"
						         alt="..."></td>

						<td><a href="{{ route('SubCat-details', ['id' => $value->id]) }}">{{ $value->name }}</a></td>
						<td>
							<a href="{{ route('category-details', ['id' => $value->cat_id] ) }}">{{ $value->cat_name }}</a>
						</td>

						<td>
							<a href="{{ route('admin-details', ['id' => $value->user_id ])}}">
								{{ $value->user_name}} </a>
						</td>

						<td>{{ $value->created_at }}</td>

						<td><a href="{{ route('SubCat-details', ['id' => $value->id]) }}"><i class="icon-tv" aria-hidden="true"></i></a>
						</td>

						<td><a href="{{ route('SubCat-edit', ['id' => $value->id]) }}"><i class="icon-pencil" aria-hidden="true"></i></a>
						</td>

						<td><a class="do-delete" href="{{ route('SubCat-delete', ['id' => $value->id]) }}"><i class="icon-database-remove"></i></a>

						</td>

					</tr>



				@endforeach

			@endif

			</tbody>

		</table>

	</div>
@endsection

