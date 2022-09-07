<?php $__env->startSection('title'); ?>

	<?php echo e(trans('admin.dashboardTitle')); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>



	<div class="row">
		<div class="col-lg-4">

			<!-- Members online -->
			<div class="panel bg-teal-400">
				<div class="panel-body">
					<div class="heading-elements">

					</div>
					<h3 class="no-margin"><?php echo e(\App\Ads::count()); ?></h3>
					عدد الاعلانات

				</div>

				<div class="container-fluid">
					<div class="chart" id="members-online"></div>
				</div>
			</div>
			<!-- /members online -->

		</div>

		<div class="col-lg-4">

			<!-- Current server load -->
			<div class="panel bg-pink-400">
				<div class="panel-body">
					<h3 class="no-margin"><?php echo e(\App\User::count()); ?></h3>
					عدد المستخدمين

				</div>

				<div class="chart" id="server-load"></div>
			</div>
			<!-- /current server load -->

		</div>

		<div class="col-lg-4">

			<!-- Today's revenue -->
			<div class="panel bg-blue-400">
				<div class="panel-body">

					<h3 class="no-margin"><?php echo e(\App\Categories::count()); ?></h3>
					عدد الاقسام

				</div>

				<div class="chart" id="today-revenue"></div>
			</div>
			<!-- /today's revenue -->

		</div>
	</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>