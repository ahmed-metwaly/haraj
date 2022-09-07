<?php $__env->startSection('content'); ?>
	
	<div class="col-xs-12 omola">
        <h2>البحث في القائمة السوداء</h2>
        <p>القائمة السوداء هي قائمة بإرقام حسابات وأرقام جوالات من يقومون بإساءة إستخدام الموقع لأغراض ممنوعه مثل الغش أو الأحتيال أو مخالفة قوانين الموقع </p>
        <form action="<?php echo e(route('do-black-list')); ?>" method="POST" role="form">
        <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <label for="">أدخل رقم الحسب أو رقم الجوال :</label>
                <input type="text" name="search" class="form-control" id="">
            </div>
            <button type="submit" class="hvr-shutter-out-horizontal">فحص</button>
        </form>
        <?php if(isset($data) && $data != ''): ?>
			<br>
			<br>
			<table class="table">

				<tr>
					<th>الاسم</th>
					<th> الدولة</th>
					<th> الحالة</th>
				</tr>

				<tr>
					<td> <?php echo e($data->name); ?> </td>
					<th> <?php echo e($data->name_ar); ?> </th>
					<th> حظر</th>
				</tr>

			</table>
		<?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>