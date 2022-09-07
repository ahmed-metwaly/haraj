@extends('admin.master')

@section('title')
{{ trans('admin.bankAccountAdd') }}
@endsection

@section('sectionName')
    <a href="{{ route('bank-accounts') }}"> {{ trans('admin.bankAccount')  }} </a>
@endsection

@section('pageName')
{{ trans('admin.bankAccountAdd') }}
@endsection


@section('content')

	<div class="col-md-12">


		<!-- Advanced legend -->

		<form action="{{ route('bank-do-add') }}" method="post">

			<div class="panel panel-flat">

				<div class="panel-heading">

					<h5 class="panel-title"> {{ trans('admin.bankAccount') }} </h5>

				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">

								<label> اسم صاحب الحساب </label>

								<input type="text" name="account_owner"  class="form-control"

								       placeholder=" اسم صاحب الحساب ">


							</div>

							<div class="form-group">

								<label> اسم البنك </label>

								<input type="text" name="bank_name"  class="form-control"

								       placeholder=" اسم البنك ">


							</div>

							<div class="form-group">

								<label> رقم الحساب </label>

								<input type="text" name="account_number"  class="form-control"

								       placeholder=" رقم الحساب ">


							</div>

							<div class="form-group">

								<label> رقم الحساب الدولي </label>

								<input type="text" name="international_account"  class="form-control"

								       placeholder=" رقم الحساب الدولي ">


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