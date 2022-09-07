<?php $__env->startSection('content'); ?>
	
	<div class="col-xs-12 omola">
	    <h2>السلع والإعلانات الممنوعة</h2>
	    <?php if($black_ads != ''): ?>
	    <?php echo $black_ads->black_ads; ?>

	    <?php endif; ?>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>