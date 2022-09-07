<?php $__env->startSection('content'); ?>
	<form action="<?php echo e(route('register-user')); ?>" method="POST" role="form" class="log">
	<?php echo e(csrf_field()); ?>

                <legend>التسجيل بالموقع</legend>
                <div class="form-group">
                    <input required="" type="number" name="phone" class="form-control" id="" placeholder="ادخل رقم جوالك مثلا 0500010008" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ادخل رقم جوالك مثلا 0500010008'">
                </div>
                <div class="form-group">
                    <select name="city" id="input" class="form-control" required="required">
                        <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                </div>
                <p><i class="fa fa-hand-o-left" aria-hidden="true"></i> التسجيل في حراج يتطلب وجود رقم جوال. جميع معلوماتك لدينا هي أمانة في ذمتنا ونتعهد بالحفاظ عليها. لمزيد من التفاصيل، نرجو زيارة صفحة معاهدة استخدام الموقع.
                </p>
                <button type="submit" class="hvr-shutter-out-horizontal">تسجيل</button>
            </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>