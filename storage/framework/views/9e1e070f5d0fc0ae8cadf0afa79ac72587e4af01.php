


<?php $__env->startSection('content'); ?>


<div class="col-xs-12 omola">
        <h2 style="text-align: center;">ابلاغ عن اعلان سيئ</h2>
        <!-- <h3>نص الابلاغ:</h3> -->
       <!--  <p><i class="fa fa-user"></i> المشرف حكيم</p> -->
        <form action="<?php echo e(route('do-add-report',['id' => $id])); ?>" method="POST" role="form">
            <div class="form-group">
                <label for="">نص الابلاغ: </label>
                <textarea name="text" placeholder="اكتب سبب انزعاجك من الاعلان" id="input" class="form-control" rows="15" required="required"></textarea>
            </div>
             <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>