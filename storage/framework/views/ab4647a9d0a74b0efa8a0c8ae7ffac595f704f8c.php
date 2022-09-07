

<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.bankTransfers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
<?php echo e(trans('admin.bankTransfers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
<?php echo e(trans('admin.bankTransfers')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


        <!-- Highlighting rows and columns -->
<div class="panel panel-flat">

    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
        <tr>
            <th>#</th>
            <th>اسم المحول</th>
            <th>البريد الالكترونى</th>
            <th>الجوال</th>
            <th>مبلغ التحويل</th>
            <th>اسم البنك</th>
            <th>وقت التحويل</th>
            <th>موافقة </th>
            <!-- <th>رقم الإعلان</th> -->
            <!-- <th>الإعلان</th> -->
            <th> <?php echo e(trans('admin.addedBy')); ?> </th>
            <!-- <th><?php echo e(trans('admin.AddedDate')); ?></th> -->
            <th><?php echo e(trans('admin.delete')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($TransferData) > 0): ?>
            <?php $__currentLoopData = $TransferData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td><?php echo e($value->transfered_by); ?></td>
                    <td><?php echo e($value->email); ?></td>
                    <td><?php echo e($value->phone); ?></td>
                    <td><?php echo e($value->amount); ?></td>
                    <td><?php echo e($value->Bank()->first()->bank_name); ?></td>
                    <td><?php echo e($value->transfered_at); ?></td>
                    <?php if($value->byUser()->first()->is_pro ==0): ?>
                    <td><a href="<?php echo e(route('transfer-pro', ['id' => $value->byUser()->first()->id])); ?>">موافقة</a></td>
                    <?php else: ?>
                    <td><a href="<?php echo e(route('transfer-dispro', ['id' => $value->byUser()->first()->id])); ?>">الغاء العضوية</a></td>
                    <?php endif; ?>
                    
                    <td><?php echo e($value->byUser()->first()->name); ?> </a> </td>
                    <!-- <td><?php echo e($value->created_at); ?></td> -->
                    <td><a class="do-delete" href="<?php echo e(route('transfer-delete', ['id' => $value->id])); ?>"><i
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