<?php $__env->startSection('content'); ?>
	<div class="col-xs-12 omola">
                <h2>اتصل بنا</h2>
                <p style="    background: rgba(0, 0, 0, 0.2);color: #0674c0;border-radius: 5px;padding: 5px 10px;margin: 15px 0;">
                    * نعتذر عن الإتصال بأرقام الجوالات، وسيلة التواصل لدينا هي البريد الإلكتروني
                    <br> * تأكد من صحة بريدك الإلكتروني حتى يتم الرد عليك
                </p>
                <form action="<?php echo e(route('contact-do-us')); ?>" method="POST" role="form">
                    <?php echo e(csrf_field()); ?>


                	<div class="form-group">
						<label for="name">الاسم</label>
						<input type="text" name="name" class="form-control" id="name_id">
					</div>
                    <div class="form-group">
                        <label for="">البريد :</label>
                        <input name="email" type="email" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">سبب الإتصال :</label>
                        <input name="title" type="text" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">نص الرساله :</label>
                        <textarea name="message" id="input" class="form-control" rows="6" required="required"></textarea>
                    </div>
                    <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
                </form>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>