<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.markEdit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sectionName'); ?>
    <a href="<?php echo e(route('marks')); ?>"> <?php echo e(trans('admin.marks')); ?> </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageName'); ?>
    <?php echo e(trans('admin.markEdit')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="col-md-12">

        <!-- Advanced legend -->
        <form action="<?php echo e(route('mark-do-edit', ['id' => $data->id])); ?>" method="post" enctype="multipart/form-data">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> <?php echo e(trans('admin.markData')); ?> </h5>
                </div>


                <div class="panel-body">
                    <fieldset>
                        <div class="collapse in" id="demo1">
                            <div class="form-group">
                                <label> <?php echo e(trans('admin.markName')); ?> </label>
                                <input type="text"  name="name" value="<?php echo e($data->name); ?>" class="form-control"
                                       placeholder=" <?php echo e(trans('admin.markName')); ?> ">
                            </div>

                            <div class="form-group">
                                <label> شعار الماركة </label>
                                <input type="file" name="photo"  class="form-control"
                                       placeholder=" <?php echo e(trans('admin.markPhoto')); ?> ">
                            </div>
                            
                             <div class="form-group">
                                <label> الفصيلة </label>
                                <select data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="cat_id"
                                        class="select">
                                       
                                    <?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vale): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($vale->id); ?>" <?php echo e($vale->id == $subcat->cat_id ?'selected' : ''); ?>> <?php echo e($vale->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <img class="img-preview" src="<?php echo e(isset($data->photo) && $data->photo != '' ? url('public/marks_90x90/' . $data->photo) : url('public/categories/cat-empty.png')); ?>" alt="...">
                            </div>
                            
                          

                            <div class="form-group">
                                <label> <?php echo e(trans('admin.adminsADStatus')); ?> </label>
                                <select data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="status"
                                        class="select">
                                    <option value="1" <?php echo e($data->status == 1 ? 'selected' : ''); ?> > <?php echo e(trans('admin.settingsOpen')); ?> </option>
                                    <option value="0" <?php echo e($data->status == 0 ? 'selected' : ''); ?> > <?php echo e(trans('admin.settingsClose')); ?> </option>
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




<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>