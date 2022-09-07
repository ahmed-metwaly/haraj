<?php $__env->startSection('content'); ?>

    <div class="col-xs-12 omola">
    <h2><?php echo e($data['title']); ?></h2>
    
       
	    <p> <?php echo $data['content']; ?> </p>
	   
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>