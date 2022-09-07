<?php $__env->startSection('content'); ?>
	<form action="<?php echo e(route('login-user')); ?>" method="POST" role="form" class="log">
	<?php echo e(csrf_field()); ?>

                <legend>تسجيل الدخول</legend>
                <div class="form-group">
                    <input required="" type="text" name="phone" class="form-control" id="" placeholder="إسم المستخدم أو رقم الجوال" onfocus="this.placeholder = ''" onblur="this.placeholder = 'إسم المستخدم أو رقم الجوال'">
                </div>
                <div class="form-group">
                    <input required="" name="password" type="password" class="form-control" id="" placeholder="الرقم السرى" onfocus="this.placeholder = ''" onblur="this.placeholder = 'الرقم السرى'">
                </div>
                <button type="submit" class="hvr-shutter-out-horizontal">تسجيل الدخول</button>
                <a href="<?php echo e(url('/login-user-forget')); ?>" class="forget">هل نسيت الرقم السري؟</a>
                <a href="<?php echo e(route('register')); ?>" class="new-reg hvr-hang">التسجيل بالموقع</a>
            </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>