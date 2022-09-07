

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
            <th>رقم الإعلان</th>
            <th>الإعلان</th>
            <th>موافقة</th>
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
                    <td><?php echo e($value->bank_name); ?></td>
                    <td><?php echo e($value->transfered_at); ?></td>
                    <td><?php echo e($value->ad_id); ?></td>
                    <td><a target="_blank"
                               href="<?php echo e(route('ad-view', ['id' => $value->ad_id])); ?>"><?php echo e($value->ads_title); ?></a>
                        </td>
                        <?php if($value->ads_is_pro == 0): ?>
                        <td><a href="<?php echo e(route('pro-ad', ['id' => $value->ad_id])); ?>">تثبيت</a></td>
                        <?php else: ?>
                        <td><a href="<?php echo e(route('dis-pro-ad', ['id' => $value->ad_id])); ?>">الغاء التثبيت</a></td>
                         <?php endif; ?>
                        
                    <td><a href="<?php echo e(route('admin-details', ['id' => $value->user_id ])); ?>"> <?php echo e($value->username); ?> </a> </td>
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