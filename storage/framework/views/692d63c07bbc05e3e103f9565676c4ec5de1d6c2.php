

<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.blackListAdd')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <a href="<?php echo e(route('black-lists')); ?>"> <?php echo e(trans('admin.blackList')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
<?php echo e(trans('admin.blackListAdd')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo e(trans('admin.userName')); ?></th>
            <th><?php echo e(trans('admin.userEmail')); ?></th>
            <th><?php echo e(trans('admin.adminsADCount')); ?></th>
            <th><?php echo e(trans('admin.AddedDate')); ?></th>
            <th><?php echo e(trans('admin.add')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($data) > 0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td><a href="<?php echo e(route('admin-details', ['id' => $value->id])); ?>"><?php echo e($value->name); ?></a></td>
                    <td><?php echo e($value->email); ?></td>
                    <td><?php echo e($value->country_name); ?></td>
                    <td><?php echo e($value->created_at); ?></td>
                    <td><a class="" href="<?php echo e(route('black-do-add', ['id' => $value->id])); ?>"><i
                                    class="icon-user-plus"></i></a>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>