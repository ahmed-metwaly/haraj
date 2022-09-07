

<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.adminMessageShow')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
<?php echo e(trans('admin.adminMessages')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
<?php echo e(trans('admin.adminMessageShow')); ?>

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
            <th><?php echo e(trans('admin.titleMessage')); ?></th>
            <!-- <th><?php echo e(trans('admin.ip')); ?></th> -->
            <th><?php echo e(trans('admin.message')); ?></th>
            <th><?php echo e(trans('admin.AddedDate')); ?></th>
            <th><?php echo e(trans('admin.show')); ?></th>
            <th><?php echo e(trans('admin.replay')); ?></th>
            <th><?php echo e(trans('admin.delete')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($data) > 0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td> <?php echo e($value->name); ?> </td>
                    <td> <?php echo e($value->email); ?> </td>
                    <td> <?php echo e($value->title); ?> </td>
                    <!-- <td> <?php echo e($value->ip); ?> </td> -->
                    <td> <?php echo e(mb_substr($value->message, 0, 50)); ?> </td>
                    <td><?php echo e($value->created_at); ?></td>
                    <td><a href="<?php echo e(route('admin-message-details', ['id' => $value->id])); ?>"><i class="icon-tv"
                                                                                          aria-hidden="true"></i></a></td>
                    <td><a href="mailto:<?php echo e($value->email); ?>"><i class="icon-reply"
                                                                                     aria-hidden="true"></i></a></td>
                    <td><a class="do-delete" href="<?php echo e(route('admin-message-delete', ['id' => $value->id])); ?>"><i
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