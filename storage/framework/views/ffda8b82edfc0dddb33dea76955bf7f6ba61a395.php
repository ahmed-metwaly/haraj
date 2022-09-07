

<?php $__env->startSection('title'); ?>
    <?php echo trans($data->is_admin == 0 ? 'admin.sideUserDetails' : 'admin.sideAdminsDetails') . ' ' . $data->name; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <?php echo e(trans('admin.sideAdminsTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
    <?php echo trans($data->is_admin == 0 ? 'admin.sideUserDetails' : 'admin.sideAdminsDetails')  . ' : <span class="text-success">' . $data->name . '</span>'; ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="#" method="post">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> <?php echo e(trans($data->is_admin == 0 ? 'admin.userDet' : 'admin.adminEditAdminTitle')); ?> </h5>
                </div>

                <div class="panel-body">
                    <fieldset>


                        <div class="form-group">
                            <img class="img-header  img-preview img-thumbnail pull-right"
                                 src="<?php echo e(url('public/users/' . $data->photo)); ?>">
                        </div>

                        <br>
                        <br>

                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> <?php echo e(trans('admin.sideAdminsName')); ?> </label>
                                <input readonly type="text" name="name" value="<?php echo e($data->name); ?>" class="form-control"
                                       placeholder=" <?php echo e(trans('admin.sideAdminsName')); ?> ">
                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADEmail')); ?> </label>
                                <input readonly type="email" name="email" value="<?php echo e($data->email); ?>"
                                       class="form-control"
                                       placeholder=" <?php echo e(trans('admin.adminsADEmail')); ?> ">
                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADCount')); ?> </label>
                                <input type="text" class="form-control" readonly
                                       value="<?php echo e($data->k_name != '' ? $data->k_name : trans('admin.countryRemoved')); ?>">
                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADCity')); ?> </label>
                                <input type="text" class="form-control" readonly
                                       value="<?php echo e($data->c_name != '' ? $data->c_name : trans('admin.cityRemoved')); ?>">

                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADLevel')); ?> </label>
                                <input type="text" class="form-control" readonly
                                       value="<?php

                                       if ($data->is_admin == 0) {

                                           echo trans('admin.lAdmin');

                                       } else {

                                           if ($data->g_name != '') {

                                               echo $data->g_name;

                                           } else {

                                               echo trans('admin.levelRemoved');

                                           }
                                       }

                                       ?>">

                            </div>

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADStatus')); ?> </label>
                                <input type="text" class="form-control" readonly
                                       value="<?php echo e($data->status == 1 ?  trans('admin.settingsOpen') : trans('admin.settingsClose')); ?>">

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