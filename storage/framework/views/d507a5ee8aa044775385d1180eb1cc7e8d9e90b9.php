

<?php $__env->startSection('content'); ?>

    <div class="col-xs-12 omola">
        <h2>إرسال رسالة خاصة</h2>
        
        <form action="<?php echo e(route('do-add-message')); ?>" method="POST" role="form">
            <?php echo e(csrf_field()); ?>


            <div class="form-group">
                <label for="">مستلم الرسالة :</label>
                        <input type="email" name="email" class="form-control" id="" placeholder="البريد الإلكترونى لمستلم الرسالة" onfocus="this.placeholder = ''" onblur="this.placeholder = 'أوامر الشبكة'">
            </div>
            <div class="form-group">
                <label for="">نص الرسالة :</label>
                        <textarea name="message" id="" cols="30" rows="10" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'استفسار بخصوص نظام اشتراك المعارض و المكاتب'"></textarea>
            </div>
            
            <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
        </form>
    </div>


<?php $__env->stopSection(); ?>        
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>