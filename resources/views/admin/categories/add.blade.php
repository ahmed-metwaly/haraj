@extends('admin.master')



@section('title')

	{{ trans('admin.categoryAdd') }}

@endsection



@section('sectionName')

	<a href="{{ route('categories') }}"> {{ trans('admin.categoriesTitle') }} </a>

@endsection



@section('pageName')

	{{ trans('admin.categoryAdd') }}

@endsection

@section('content')



	<div class="col-md-12">


		<!-- Advanced legend -->

		<form action="{{ route('category-do-add') }}" method="post" enctype="multipart/form-data">

			<div class="panel panel-flat">

				<div class="panel-heading">

					<h5 class="panel-title"> {{ trans('admin.categoryAdd') }} </h5>

				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">

								<label> {{ trans('admin.catName') }} </label>

								<input type="text" name="name_ar" value="{{ old('name') }}" class="form-control"

								       placeholder=" {{ trans('admin.catNameAr') }} ">


							</div>

							<div class="form-group">

								<label> {{ trans('admin.catImg') }} </label>

								<input type="file" name="photo" class="form-control">

							</div>

							<div class="form-group">

								<label> النوع</label>

								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

								        class="select">

									<option value="1"> سيارات</option>
									<option value="2"> عقارات</option>
									<option value="3"> أجهزة</option>
									<option value="4"> حيوانات</option>
									<option value="0"> أخرى</option>

								</select>

							</div>


							<div class="form-group">

								<label> {{ trans('admin.adminsADStatus') }} </label>

								<select data-placeholder="-- {{ trans('admin.SettingsSelect') }} --" name="status"

								        class="select">

									<option value="1"> {{ trans('admin.settingsOpen') }} </option>

									<option value="0"> {{ trans('admin.settingsClose') }} </option>

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







