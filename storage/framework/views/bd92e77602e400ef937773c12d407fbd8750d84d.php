<?php $__env->startSection('content'); ?>
	
	<div class="col-xs-12 omola">
        <h3>إشعارات حديثه</h3>
        <ul>

            <li>عميلنا الكريم: <big style="color: red">نرجو الحفاظ على رقمك السري وعدم إرساله لأي شخص يطلبه</big> منك عبر الاتصال أو المراسلة. <big style="color: green">معلومات العضوية هي أمانه في ذمتك و هي تحت مسؤوليتك.</big></li>
        
        <?php if(count($data)>0): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        	<li>

            	<?php if($item->type == 'like'): ?>
                    يوجد إعجاب جديد بالإعلان:
                    <?php else: ?>
                    يوجد رد جديد على الإعلان:
                <?php endif; ?>
             <a href="<?php echo e(route('ad-view', ['id' => $item->ad_id ])); ?>"><?php echo e($item->ad_title); ?></a> بواسطة <a href="<?php echo e(route('public-profile',['id'=>$item->user_id])); ?>"><?php echo e($item->username); ?></a> <?php echo e($item->created_at->diffForHumans()); ?> <a href="<?php echo e(route('delete-notif', ['id' => $item->id])); ?>"><i class="fa fa-remove"></i></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
        </ul>
        <h3>إشعارات أقدم</h3>
        <ul>

        <?php if(count($old_data)>0): ?>
        <?php $__currentLoopData = $old_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

            <li>

            	<?php if($item->type == 'like'): ?>
                    يوجد إعجاب جديد بالإعلان:
                    <?php else: ?>
                    يوجد رد جديد على الإعلان:
                <?php endif; ?>
             <a href="<?php echo e(route('ad-view', ['id' => $item->ad_id ])); ?>"><?php echo e($item->ad_title); ?></a> بواسطة <a href="<?php echo e(route('public-profile',['id'=>$item->user_id])); ?>"><?php echo e($item->username); ?></a> <?php echo e($item->created_at->diffForHumans()); ?> <a href="<?php echo e(route('delete-notif', ['id' => $item->id])); ?>"><i class="fa fa-remove"></i></a></li>

            <!-- <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>دعوة: ندعوك لإستخدام تطبيق حراج لجوالك. التطبيق سهل وسريع و يزيد من المتعة في تصفح حراج. أبحث عن تطبيق حراج في المتجر لتحميل التطبيق.</li>
            <li>يوجد رد جديد على الإعلان: <a href="single-page.html">مكتب فاخر للتقبيل</a> بواسطة <a href="profile-user.html">وسام السمو</a> قبل 5 شهر و 2 أسبوع</li> -->
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
        </ul>
    </div>
            
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>