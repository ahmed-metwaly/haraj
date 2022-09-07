@extends('admin.master')



@section('title')

	{{ trans('admin.categoryEdit') }}

@endsection



@section('sectionName')

	<a href="{{ route('categories') }}"> {{ trans('admin.categoriesTitle') }} </a>

@endsection



@section('pageName')

	{{ trans('admin.categoryEdit') }}

@endsection

@section('content')



	<div class="col-md-12">


		<!-- Advanced legend -->

		<form action="{{ route('category-do-edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">

			<div class="panel panel-flat">

				<div class="panel-heading">

					<h5 class="panel-title"> {{ trans('admin.categoryData') }} </h5>

				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">

								<label> {{ trans('admin.catName') }} </label>

								<input type="text" name="name" value="{{ $data->name }}" class="form-control"
								       placeholder=" {{ trans('admin.catName') }} ">

							</div>


							<div class="form-group">

								<label> {{ trans('admin.catImg') }} </label>

								<input type="file" name="photo" class="form-control">

							</div>


							<div class="form-group">

								<img class="img-preview"
								     src="{{ isset($data->photo) && $data->photo != '' ? url('public/categories_250x250/' . $data->photo) : url('public/categories/cat-empty.png') }}"
								     alt="...">

							</div>

							<div class="form-group">

								<label> النوع</label>

								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

								        class="select">

									<option value="1" {{ $data->type == 1 ? 'selected' : '' }}> سيارات</option>
									<option value="2" {{ $data->type == 2 ? 'selected' : '' }}> عقارات</option>
									<option value="3" {{ $data->type == 3 ? 'selected' : '' }}> أجهزة</option>
									<option value="4" {{ $data->type == 4 ? 'selected' : '' }}> حيوانات</option>
									<option value="0" {{ $data->type == 0 ? 'selected' : '' }}> أخرى</option>

								</select>

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







