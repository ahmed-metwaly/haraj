

<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.sideMarksShow')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
<?php echo e(trans('admin.marks')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
<?php echo e(trans('admin.sideMarksShow')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('admin.markPhoto')); ?></th>
            <th><?php echo e(trans('admin.markName')); ?></th>
            <th> <?php echo e(trans('admin.addedBy')); ?> </th>
            <th><?php echo e(trans('admin.AddedDate')); ?></th>
            <th><?php echo e(trans('admin.show')); ?></th>
            <th><?php echo e(trans('admin.edit')); ?></th>
            <th><?php echo e(trans('admin.delete')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($data) > 0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td> <img  class="img-header  img-preview img-thumbnail pull-right" src="<?php echo e(isset($value->photo) && $value->photo != '' ? url('public/marks_90x90/' . $value->photo) : url('public/categories/cat-empty.png')); ?>"> </td>
                    <td><a href="<?php echo e(route('mark-details', ['id' => $value->id])); ?>"><?php echo e($value->name); ?></a></td>
                    
                    <td><a href="<?php echo e(route('admin-details', ['id' => $value->user_id ])); ?>"> <?php echo e($value->username); ?> </a> </td>
                    <td><?php echo e($value->created_at); ?></td>
                    <td><a href="<?php echo e(route('mark-details', ['id' => $value->id])); ?>"><i class="icon-tv"
                                                                                        aria-hidden="true"></i></a></td>
                    <td><a href="<?php echo e(route('mark-edit', ['id' => $value->id])); ?>"><i class="icon-pencil"
                                                                                     aria-hidden="true"></i></a></td>
                    <td><a class="do-delete" href="<?php echo e(route('mark-delete', ['id' => $value->id])); ?>"><i
                                    class="icon-database-remove"></i></a>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>