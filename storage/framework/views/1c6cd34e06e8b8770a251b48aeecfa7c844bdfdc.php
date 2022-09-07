<?php $__env->startSection('title'); ?>

<?php echo e(trans('admin.settingsTitle')); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('sectionName'); ?>

<?php echo e(trans('admin.sideSettingsTitle')); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('pageName'); ?>

<?php echo e(trans('admin.sideSettings')); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>


<div class="col-md-12">

    <!-- Advanced legend -->

    <form action="<?php echo e(route('settings-do-edit')); ?>" method="post">

        <div class="panel panel-flat">

            <div class="panel-heading">

                <h5 class="panel-title"> <?php echo e(trans('admin.settingsFormTitle')); ?> </h5>



            </div>





            <div class="panel-body">

                <fieldset>

                    <div class="collapse in" id="demo1">

                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsSiteName')); ?> </label>

                            <input type="text" required name="site_name" value="<?php echo e($data->site_name); ?>" class="form-control" placeholder=" <?php echo e(trans('admin.settingsSiteName')); ?> ">

                        </div>

                        <div class="form-group">

                            <label><?php echo e(trans('admin.settingsSiteEmail')); ?></label>

                            <input type="email" required name="site_email" value="<?php echo e($data->site_email); ?>" class="form-control" placeholder="<?php echo e(trans('admin.settingsSiteEmail')); ?>">

                        </div>





                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsSitePhone')); ?> </label>

                            <input type="tel" required name="site_phone" value="<?php echo e($data->site_phone); ?>" class="form-control" placeholder=" <?php echo e(trans('admin.settingsSitePhone')); ?> ">

                        </div>

                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsFb')); ?> </label>

                            <input type="text" required name="site_fb" value="<?php echo e($data->site_fb); ?>" class="form-control" placeholder=" <?php echo e(trans('admin.settingsFb')); ?> ">

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsTw')); ?> </label>

                            <input type="text" required name="site_tw" value="<?php echo e($data->site_tw); ?>" class="form-control" placeholder="<?php echo e(trans('admin.settingsTw')); ?>">

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsGo')); ?> </label>

                            <input type="text" required name="site_go" value="<?php echo e($data->site_go); ?>" class="form-control" placeholder="<?php echo e(trans('admin.settingsGo')); ?>">

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsInst')); ?> </label>

                            <input type="text" required name="site_inst" value="<?php echo e($data->site_inst); ?>" class="form-control" placeholder="<?php echo e(trans('admin.settingsInst')); ?>">

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsYout')); ?> </label>

                            <input type="text" required name="site_yout" value="<?php echo e($data->site_yout); ?>" class="form-control" placeholder=" <?php echo e(trans('admin.settingsYout')); ?>  ">

                        </div>





                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsKeyword')); ?> </label>

                            <textarea rows="5" required cols="5" name="site_keyword" class="form-control" placeholder="<?php echo e(trans('admin.settingsKeyword')); ?>"><?php echo e($data->site_keyword); ?></textarea>

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsDescription')); ?> </label>

                            <textarea rows="5" required cols="5" name="site_description" class="form-control" placeholder="<?php echo e(trans('admin.settingsDescription')); ?>"><?php echo e($data->site_description); ?></textarea>

                        </div>

                        <div class="form-group">

                            <label> عضوية مكاتب العقار والسيارات </label>

                            <textarea id="editor1" rows="5" required cols="5" name="subscribe" class="form-control ckeditor" placeholder="" value="<?php echo e($data->subscribe); ?>"><?php echo e($data->subscribe); ?></textarea>

                        </div>

                        <div class="form-group">

                            <label> عمولة حراج </label>

                            <textarea id="editor1" rows="5" required cols="5" name="commission" class="form-control ckeditor" placeholder="" value="<?php echo e($data->commission); ?>"><?php echo e($data->commission); ?></textarea>

                        </div>

                        <div class="form-group">

                            <label> حساب العمولة </label>

                            <textarea rows="5" required cols="5" name="commission_count" class="form-control" placeholder="" value="<?php echo e($data->commission_count); ?>"><?php echo e($data->commission_count); ?></textarea>

                        </div>

                        <div class="form-group">

                            <label> السلع والإعلانات الممنوعة </label>

                            <textarea id="editor1" rows="5" required cols="5" name="black_ads" class="form-control ckeditor" placeholder="" value="<?php echo e($data->black_ads); ?>"><?php echo e($data->black_ads); ?></textarea>

                        </div>


                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsClose')); ?> </label>

                            <textarea rows="5" required cols="5" name="site_close_messge" class="form-control " placeholder="<?php echo e(trans('admin.settingsClose')); ?>"><?php echo e($data->site_close_messge); ?></textarea>

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.settingsComments')); ?> </label>

                            <select data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="site_comments_status" class="select">

                                <option value="1" <?php echo e($data->site_comments_status == 1 ? 'selected' : ''); ?> > <?php echo e(trans('admin.settingsOpen')); ?> </option>

                                <option value="0" <?php echo e($data->site_comments_status == 0 ? 'selected' : ''); ?> > <?php echo e(trans('admin.settingsClose')); ?> </option>

                            </select>

                        </div>



                        <div class="form-group">

                            <label> <?php echo e(trans('admin.SettingsStatus')); ?> </label>

                            <select required data-placeholder="-- <?php echo e(trans('admin.SettingsSelect')); ?> --" name="status" class="select">

                                <option value="1" <?php echo e($data->status == 1 ? 'selected' : ''); ?> > <?php echo e(trans('admin.SettingsStatusOpen')); ?> </option>

                                <option value="0" <?php echo e($data->status == 0 ? 'selected' : ''); ?> > <?php echo e(trans('admin.SettingsStatusClose')); ?> </option>

                            </select>

                        </div>

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
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>