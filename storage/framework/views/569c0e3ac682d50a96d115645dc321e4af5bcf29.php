<?php $__env->startSection('title'); ?>

    <?php echo e(trans('admin.pageAdd')); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('sectionName'); ?>

    <a href="<?php echo e(route('pages')); ?>"> <?php echo e(trans('admin.pages')); ?> </a>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('pageName'); ?>

    <?php echo e(trans('admin.pageAdd')); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>



    <div class="col-md-12">

        <!-- Advanced legend -->

        <form action="<?php echo e(route('page-do-add')); ?>" method="post">

            <div class="panel panel-flat">

                <div class="panel-heading">

                    <h5 class="panel-title"> <?php echo e(trans('admin.pageData')); ?> </h5>

                </div>





                <div class="panel-body">

                    <fieldset>

                        <div class="collapse in" id="demo1">

                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pageName')); ?> </label>

                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control"

                                       placeholder=" <?php echo e(trans('admin.pageName')); ?> ">

                            </div>



                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pageTitle')); ?> </label>

                                <input type="text" name="title" value="<?php echo e(old('name')); ?>" class="form-control"

                                       placeholder=" <?php echo e(trans('admin.pageTitle')); ?> ">

                            </div>



                            <div class="form-group">

                                <label> <?php echo e(trans('admin.content')); ?> </label>

                                <textarea id="editor1" rows="8" name="content" class="form-control ckeditor" placeholder="<?php echo e(trans('admin.content')); ?>"> <?php echo e(old('content')); ?> </textarea>

                            </div>



                            <div class="form-group">

                                <label> <?php echo e(trans('admin.pos')); ?> </label>

                                <select data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="type"

                                        class="select">

                                    <option value="1"> <?php echo e(trans('admin.posTop')); ?> </option>

                                    <option value="2"> <?php echo e(trans('admin.posBottom')); ?> </option>

                                </select>

                            </div>





                            <div class="form-group">

                                <label> <?php echo e(trans('admin.adminsADStatus')); ?> </label>

                                <select data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="status"

                                        class="select">

                                    <option value="1"> <?php echo e(trans('admin.settingsOpen')); ?> </option>

                                    <option value="0"> <?php echo e(trans('admin.settingsClose')); ?> </option>

                                </select>

                            </div>



                            <div class="col-md-2"></div>

                        </div>

                    </fieldset>

                    <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">

                    <div class="text-right">

                        <button type="submit" class="btn btn-primary"> <?php echo e(trans('admin.save')); ?> <i

                                    class="icon-arrow-left13 position-right"></i></button>

                    </div>

                </div>

            </div>

        </form>

        <!-- /a legend -->



    </div>





<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

    <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>