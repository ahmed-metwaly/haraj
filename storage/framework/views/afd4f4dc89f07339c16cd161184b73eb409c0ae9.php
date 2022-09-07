<?php $__env->startSection('title'); ?>

    <?php echo trans('admin.pageDet') . ' ' . $data->name; ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('sectionName'); ?>

    <a href="<?php echo e(route('pages')); ?>"> <?php echo e(trans('admin.pages')); ?> </a>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('pageName'); ?>

      <?php echo trans('admin.pageDet')  . ' : <span class="text-success">' . $data->name . '</span>'; ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="col-md-12">



        <!-- Advanced legend -->

        <form action="#" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> <?php echo e($data->name); ?> </h5>



                </div>

                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pageName')); ?> </label>

                                <input readonly type="text" value="<?php echo e($data->name); ?>"  class="form-control"

                                       placeholder=" <?php echo e(trans('admin.pageName')); ?> ">

                            </div>


                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pageTitle')); ?> </label>

                                <input readonly type="text" value="<?php echo e($data->title); ?>"  class="form-control"

                                       placeholder=" <?php echo e(trans('admin.pageTitle')); ?> ">

                            </div>


                            <div class="form-group">

                                <label> <?php echo e(trans('admin.content')); ?> </label>

                                <textarea id="editor1" rows="8" readonly name="content" class="form-control" placeholder="<?php echo e(trans('admin.content')); ?>"> <?php echo e($data->content); ?> </textarea>

                            </div>



                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pos')); ?> </label>

                                <input type="text" class="form-control" readonly value="<?php echo e($data->type == 1 ? 'الهيدر' : 'الفوتر'); ?>">

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