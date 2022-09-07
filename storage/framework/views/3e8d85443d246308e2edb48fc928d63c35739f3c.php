

<?php $__env->startSection('title'); ?>
	<?php if(Request::url() == route('users')): ?>
		<?php echo e(trans('admin.sideUsersShow')); ?>

	<?php else: ?>

		<?php echo e(trans('admin.sideAdminsShow')); ?>


	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
	<?php echo e(trans('admin.sideAdminsTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
	<?php if(Request::url() == route('users')): ?>
		<?php echo e(trans('admin.sideUsersShow')); ?>

	<?php else: ?>

		<?php echo e(trans('admin.sideAdminsShow')); ?>


	<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


	<!-- Highlighting rows and columns -->
	<div class="panel panel-flat">


		<table class="table table-bordered table-hover datatable-highlight">
			<thead>
			<tr>
				<th>#</th>
				<th><?php echo e(trans('admin.adminsADName')); ?></th>
				<th><?php echo e(trans('admin.adminsADEmail')); ?></th>
				<th><?php echo e(trans('admin.adminsADDate')); ?></th>
				<th><?php echo e(trans('admin.show')); ?></th>
				<th><?php echo e(trans('admin.edit')); ?></th>
				<th><?php echo e(trans('admin.delete')); ?></th>


			</tr>
			</thead>
			<tbody>

			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

				<tr>
					<td><?php echo e($value->id); ?></td>
					<td><a href="<?php echo e(route('admin-details', ['id' => $value->id])); ?>"><?php echo e($value->name); ?></a></td>
					<td> <?php echo e($value->email); ?> </td>


					<td><?php echo e($value->created_at); ?></td>
					<td><a href="<?php echo e(route('admin-details', ['id' => $value->id])); ?>"><i class="icon-tv"
					                                                                    aria-hidden="true"></i></a></td>
					<td><a href="<?php echo e(route('admin-edit', ['id' => $value->id])); ?>"><i class="icon-pencil"
					                                                                 aria-hidden="true"></i></a></td>
					<td><a class="do-delete"
					       href="<?php echo e(auth()->user()->id == $value->id ?  '#' : route('admin-delete', ['id' => $value->id])); ?>"><i
									class="<?php echo e(auth()->user()->id == $value->id ?  '' : 'icon-database-remove'); ?>"></i></a>
					</td>
				</tr>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</tbody>
		</table>
	</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>