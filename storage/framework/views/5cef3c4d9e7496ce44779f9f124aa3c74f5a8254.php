<?php $__env->startSection('title'); ?>
	<?php echo e(trans('admin.sideAdssShow')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
	<?php echo e(trans('admin.sideAdssShow')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
	<?php echo e(trans('admin.sideAdssShow')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

	<?php if($Ads->count() > 0): ?>
		<!-- Highlighting rows and columns -->
		<div class="panel panel-flat">
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>#</th>
					<th><?php echo e(trans('admin.adsTitle')); ?></th>
					<th><?php echo e(trans('admin.addedBy')); ?></th>
					<th><?php echo e(trans('admin.adminsADDate')); ?></th>
					<th><?php echo e(trans('admin.show')); ?></th>
					<th><?php echo e(trans('admin.edit')); ?></th>
					<th><?php echo e(trans('admin.delete')); ?></th>


				</tr>
				</thead>
				<tbody>

				<?php $__currentLoopData = $Ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

					<tr>
						<td><?php echo e($value->id); ?></td>
						<td><a target="_blank"
						       href="<?php echo e(route('ad-view', ['id' => $value->id])); ?>"><?php echo e($value->title); ?></a>
						</td>
						<td><?php echo e($value->username); ?></td>
						<td><?php echo e($value->created_at->diffForHumans()); ?></td>
						<td><a target="_blank" href="<?php echo e(route('ad-view', ['id' => $value->id])); ?>"><i class="icon-tv"
						                                                                              aria-hidden="true"></i></a>
						</td>
						<td><a target="_blank" href="<?php echo e(route('add-edit', ['id' => $value->id])); ?>"><i
										class="icon-pencil"
										aria-hidden="true"></i></a>
						</td>
						<td><a class="do-delete"
						       href="<?php echo e(Auth()->user()->id == $value->id ?  '#' : route('delete-ad', ['id' => $value->id])); ?>"><i
										class="<?php echo e(Auth()->user()->id == $value->id ?  '' : 'icon-database-remove'); ?>"></i></a>
						</td>
					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</tbody>
			</table>
		</div>
		<div style="text-align: left">
			<?php echo e($Ads->links('admin.pagination')); ?>

		</div>

	<?php else: ?>
		<div class="alert alert-warning no-border" style="text-align: center">
			لا يوجد إعلانات غير مفعلة
		</div>
	<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>