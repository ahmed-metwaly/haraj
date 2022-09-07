

<?php $__env->startSection('title'); ?>
    <?php echo trans('admin.reportDet') . ' ' . $data->name_ar; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <a href="<?php echo e(route('reports')); ?>"> <?php echo e(trans('admin.reports')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
    <?php echo trans('admin.reportDet')  . ' : <span class="text-success">' . $ad->title . '</span>'; ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <div class="col-md-12">

        <!-- Advanced legend -->

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title"> <?php echo e(trans('admin.reportData')); ?> </h5>

            </div>


            <div class="panel-body">
                <fieldset>

                    <div class="collapse in" id="demo1">

                        <div class="form-group">
                            <label> <?php echo e(trans('admin.reportText')); ?> </label>
                            <textarea id="editor1" rows="8" readonly name="" class="form-control"
                                      placeholder=""> <?php echo e($data->text); ?> </textarea>
                        </div>


                        <div class="form-group">
                            <label> <?php echo e(trans('admin.addedBy')); ?> </label>
                            <input type="text" class="form-control" readonly
                                   value="<?php echo e($user->name); ?>">
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
                    <a href="<?php echo e(route('black-do-add', ['id' => $ad->created_by])); ?>"
                       class="btn btn-primary"> <?php echo e(trans('admin.addToBlackList')); ?> <i
                                class="icon-arrow-left13 position-right"></i></a>

                </div>
            </div>
        </div>
        <!-- /a legend -->

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>