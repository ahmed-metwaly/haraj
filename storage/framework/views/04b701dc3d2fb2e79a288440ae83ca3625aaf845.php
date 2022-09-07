<?php $__env->startSection('content'); ?>
	<div class="col-xs-12 omola">
                <h2>عضوية معارض السيارات و مكاتب العقار</h2>
                <?php if($subscribeData != ''): ?>
                <p><?php echo $subscribeData->subscribe; ?></p>
                <?php endif; ?>
                <a href="<?php echo e(route('contact-us')); ?>" style="text-decoration: underline;">هل لديك استفسار او ملاحظة؟</a>
            	
            	<form action="<?php echo e(route('do-add-subscribe-transfer')); ?>" method="POST" role="form">
                <?php echo e(csrf_field()); ?>

                    
                	<div class="form-group">
                        <label for="">أسم المحول :</label>
                        <input name="transfered_by" type="text" class="form-control" id="">
                    </div>

                    <div class="form-group">
                        <label for="">رقم الجوال :</label>
                        <input type="text" name="phone" class="form-control" id="">
                    </div>

                    <div class="form-group">
                        <label for="">البريد الإلكترونى</label>
                        <input name="email" type="email" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">مبلغ العمولة :</label>
                        <input type="number" name="amount" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">البنك الذي تم التحويل إليه :</label>
                        <select name="bank_name" id="input" class="form-control black-color" required="required">
                            <option value="" disabled="" selected="">إختر إسم البنك</option>
                            <?php if(count($BankData) > 0): ?>
                            <?php $__currentLoopData = $BankData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option selected="" disabled="" value="">البنك</option>
                                <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->bank_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">متى تم التحويل؟ :</label>
                        <input name="transfered_at" type="text" class="form-control" id="">
                    </div>
                    
                    <!-- <div class="form-group">
                        <label for="">رقم الإعلان :</label>
                        <input type="number" name="ad_id"class="form-control" id="">
                        <span>نرجو حذف الإعلان بعد الإنتهاء منه.</span>
                    </div> -->
                    <div class="form-group">
                        <label for="">ملاحظات :</label>
                        <textarea name="notes" id="input" class="form-control" rows="3"></textarea>
                    </div>
                    <p>نرجو الحرص على أن تكون معلومات التحويل صحيحة ودقيقه </p>
                    <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
                </form>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>