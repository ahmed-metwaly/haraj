@extends('admin.master')



@section('title')

	{{ trans('admin.categoryEdit') }}

@endsection



@section('sectionName')

	<a href="{{ route('SubCategories') }}"> {{ trans('admin.categoriesTitle') }} </a>

@endsection



@section('pageName')

	{{ trans('admin.categoryEdit') }}

@endsection


@section('content')



	<div class="col-md-12">


		<!-- Advanced legend -->

		<form action="{{ route('SubCat-do-edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">

			<div class="panel panel-flat">

				<div class="panel-heading">

					<h5 class="panel-title"> {{ trans('admin.SubcategoryData') }} </h5>

				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">

								<label> {{ trans('admin.SubcatName') }} </label>

								<input type="text" name="name" value="{{ $data->name }}" class="form-control"
								       placeholder=" {{ trans('admin.SubcatName') }} ">

							</div>

							<div class="form-group">
								<label> اسم الفصيلة </label>
								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="cat_id"
								        class="select">
									@foreach(categories() as $vale)
										<option value="{{ $vale->id }}" {{ $vale->id == $data->cat_id ? 'selected' : '' }}> {{ $vale->name }} </option>
									@endforeach
								</select>
							</div>

							<div class="form-group">

								<label> صورة النوع </label>

								<input type="file" name="photo" class="form-control">

							</div>


							<div class="form-group">

								<img class="img-preview"
								     src="{{ isset($data->img) && $data->img != '' ? url('public/categories_250x250/' . $data->img) : url('public/categories/cat-empty.png') }}"
								     alt="...">

							</div>


							<div class="form-group">

								<label> {{ trans('admin.adminsADStatus') }} </label>

								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

								        class="select">

									<option value="1" {{ $data->status == 1 ? 'selected' : '' }} > {{ trans('admin.settingsOpen') }} </option>

									<option value="0" {{ $data->status == 0 ? 'selected' : '' }} > {{ trans('admin.settingsClose') }} </option>

								</select>

							</div>


							<div class="col-md-2"></div>

						</div>

					</fieldset>

					<input type="hidden" name="_token" value="{{ Session::token() }}">

					<div class="text-right">

						<button type="submit" class="btn btn-primary"> {{ trans('admin.save') }} <i

									class="icon-arrow-left13 position-right"></i></button>

					</div>

				</div>

			</div>

		</form>

		<!-- /a legend -->


	</div>





@endsection







