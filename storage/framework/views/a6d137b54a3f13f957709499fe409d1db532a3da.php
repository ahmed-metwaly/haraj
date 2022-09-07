

<?php $__env->startSection('title'); ?>
	<?php echo e(trans('admin.adminNewLevelTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
	<a href="<?php echo e(route('levels')); ?>"> <?php echo e(trans('admin.sideLevelsTitle')); ?> </a>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
	<?php echo e(trans('admin.adminNewLevelTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

	<style>

		.holder {
			margin: 0 0 0.75em 0;
			display: table;
			float: right;
			margin-left: 60px;

		}

		.holder input[type="radio"] {
			display: none;
		}

		.holder input[type="radio"] + label {
			color: #808080;
			font: 14px droid;
		}

		.holder input[type="radio"] + label span {
			display: inline-block;
			width: 19px;
			height: 19px;
			padding: 3px;
			margin: -1px 4px 0 0;
			vertical-align: middle;
			cursor: pointer;
			-moz-border-radius: 50%;
			border-radius: 50%;
			margin-left: 7px;
		}

		.holder input[type="radio"] + label span {
			background-color: #fff;
			border: 3px solid #00acc1;
		}

		.holder input[type="radio"]:checked + label span {
			background-color: #00acc1;
		}

		.holder input[type="radio"] + label span,
		.holder input[type="radio"]:checked + label span {
			-webkit-transition: background-color 0.4s linear;
			-o-transition: background-color 0.4s linear;
			-moz-transition: background-color 0.4s linear;
			transition: background-color 0.4s linear;
		}

		.asd {
			border-bottom: 1px dashed #ddd;
			margin-bottom: 20px;
		}

	</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="col-md-12">

		<!-- Advanced legend -->
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"> <?php echo e(trans('admin.adminNewLevelTitle')); ?> </h5>
			</div>


			<div class="panel-body">
				<fieldset>
					<div class="collapse in" id="demo1">
						<div class="form-group">
							<label> <?php echo e(trans('admin.levelName')); ?> </label>
							<input disabled type="text" value="<?php echo e($data->name); ?>" class="form-control"
							       placeholder=" <?php echo e(trans('admin.levelName')); ?> ">
						</div>
						<div class="col-md-2"></div>

						<div class="col-md-8">

							<?php $menu = menu(); ?>

							<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

								<h3 class="block"><?php echo e($items['title']); ?></h3>

								<?php

								$arrCount = count( $items['route'] );

								$myLevels = json_decode( $data->items );

								$countLevels = count( $myLevels );


								?>

								<?php $__currentLoopData = $items['route']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $title): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

									<div class="col-md-<?php echo e(12 / $arrCount); ?> asd">

										<div class="form-group">

											<label class=""> <?php echo e($title); ?> </label>
											<?php $input = '<input type="checkbox"'; ?>


											<?php if($countLevels > 0): ?>

												<?php $__currentLoopData = $myLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myLevel => $vv): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

													<?php if($myLevel == $route): ?>

														<?php $input .= ' checked '; ?>

													<?php endif; ?>

												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

											<?php endif; ?>

											<?php $input .= 'name="items[' . $route . '] " disabled> '; ?>

											<?php echo $input; ?>


										</div>
									</div>

									<?php

									?>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>



							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</div>

					</div>
				</fieldset>
			</div>
		</div>
		<!-- /a legend -->

	</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>