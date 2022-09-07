

<?php $__env->startSection('title'); ?>
    <?php echo trans('admin.akarDet') . ' ' . $data->name; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <a href="<?php echo e(route('akars')); ?>"> <?php echo e(trans('admin.akars')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
      <?php echo trans('admin.akarDet')  . ' : <span class="text-success">' . $data->name . '</span>'; ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="#" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> <?php echo e(trans('admin.akarDet')); ?> </h5>

                </div>


                <div class="panel-body">
                    <fieldset>
                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> <?php echo e(trans('admin.akarName')); ?> </label>
                                <input readonly type="text" value="<?php echo e($data->name); ?>"  class="form-control"
                                       placeholder=" <?php echo e(trans('admin.akarName')); ?> ">
                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.addedBy')); ?> </label>

                                <input type="text" class="form-control" readonly value="<?php echo e($user->name); ?>">
                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADStatus')); ?> </label>
                                <input type="text" class="form-control" readonly value="<?php echo e($data->status == 1 ?  trans('admin.settingsOpen') : trans('admin.settingsClose')); ?>">

                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADDate')); ?> </label>
                                <input type="text" class="form-control" readonly value="<?php echo e($data->created_at); ?>">

                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.lastUpdate')); ?> </label>
                                <input type="text" class="form-control" readonly value="<?php echo e($data->updated_at); ?>">

                            </div>

                        </div>
                    </fieldset>

                    <div class="text-right">

                    </div>
                </div>
            </div>
        </form>
        <!-- /a legend -->

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>