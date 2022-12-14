

<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.bankAccountEdit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <a href="<?php echo e(route('bank-accounts')); ?>"> <?php echo e(trans('admin.bankAccount')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
<?php echo e(trans('admin.bankAccountEdit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



	<div class="col-md-12">


		<!-- Advanced legend -->

		<form action="<?php echo e(route('bank-do-edit', ['id' => $data->id])); ?>" method="post" >

			<div class="panel panel-flat">

				<div class="panel-heading">

					<h5 class="panel-title"> <?php echo e(trans('admin.bankAccount')); ?> </h5>

				</div>


				<div class="panel-body">

					<fieldset>

						<div class="collapse in" id="demo1">

							<div class="form-group">

								<label> اسم صاحب الحساب </label>

								<input type="text" name="account_owner" value="<?php echo e($data->account_owner); ?>" class="form-control"

								       placeholder=" اسم صاحب الحساب " >


							</div>

							<div class="form-group">

								<label> اسم البنك </label>

								<input type="text" name="bank_name"  value="<?php echo e($data->bank_name); ?>" class="form-control"

								       placeholder=" اسم البنك ">


							</div>

							<div class="form-group">

								<label> رقم الحساب </label>

								<input type="text" name="account_number" value="<?php echo e($data->account_number); ?>" class="form-control"

								       placeholder=" رقم الحساب ">


							</div>

							<div class="form-group">

								<label> رقم الحساب الدولي </label>

								<input type="text" name="international_account" value="<?php echo e($data->international_account); ?>"" class="form-control"

								       placeholder=" رقم الحساب الدولي ">


							</div>


							<div class="col-md-2"></div>

						</div>

					</fieldset>

					<input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">

					<div class="text-right">

						<button type="submit" class="btn btn-primary"> <?php echo e(trans('admin.save')); ?> <i

									class="icon-arrow-left13 position-right"></i></button>

					</div>

				</div>

			</div>

		</form>

		<!-- /a legend -->


	</div>





<?php $__env->stopSection(); ?>








<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>