<?php $__env->startSection('style'); ?>
<style>
    #akar , #car{
    display:none;
    }  
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="col-xs-12 omola">
                <h2 style="text-align: center;">إضافة إعلان جديد</h2>
              
                 <form action="<?php echo e(route('ad-do-add')); ?>" method="post" enctype="multipart/form-data" role="form" style="margin: auto">
                <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <label for="">عنوان الإعلان :</label>
                        <input type="text" name="title" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">إختر المدينة :</label>
                        <select name="city" id="input" class="form-control" required="required">
                            <option value=""></option>
                            <option value="">-- اختر المدينة --</option>
							<?php if(count($cities)>0): ?>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($city->id); ?>" <?php echo e(old('city') ==  $city->id ? 'selected' : ''); ?>> <?php echo e($city->name); ?> </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">اختر القسم المناسب :</label>
                        <select name="cat" id="cat" class="form-control" required="required">

                            <option value="">-- اختر القسم المناسب --</option>

                            <?php if(count($categories)>0): ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                            <option value="<?php echo e(json_encode([$category->id => $category->name])); ?>" data-type="<?php echo e($category->type); ?>"> <?php echo e($category->name); ?> </option>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div id="except_car">
                    <div class="form-group">
                        <label for="">اختر القسم الفرعى المناسب :</label>
                        <select name="SubCat" disabled class="form-control SubCat_id">

                            <option value="">-- اختر القسم الفرعى المناسب --</option>
                        </select>
                    </div>
                    </div>

                    <div id="akar">
                    	<div class="form-group">
                    		<label> فئة العقار </label>
                            <select name="akar_type_id" id="mark">
                                <option value="">-- يرجى اختيار فئة العقار --</option>
				<?php if(count($akars)>0): ?>
                                <?php $__currentLoopData = $akars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akar): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <option <?php echo e(old('akar_type_id') == $akar->id ? 'selected' : ''); ?> value="<?php echo e($akar->id); ?>"> <?php echo e($akar->name); ?> </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php endif; ?>

                            </select>
                    	</div>
                    </div>

                    <div id="car">

	                    <div class="form-group">
	                        <label> الماركة </label>
	                        <select name="mark_id" id="mark">
	                            <option value="">-- يرجى اختيار ماركة السيارة --</option>
								<?php $__currentLoopData = Marks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <option <?php echo e(old('mark_id') ==  $mark->id ? 'selected' : ''); ?> value="<?php echo e($mark->id); ?>"> <?php echo e($mark->name); ?> </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 

	                        </select>
	                    </div>

	                    <div class="form-group">
	                        <label> النوع </label>
	                        <select name="model_id" id="modal">
	                            <option value="">-- يرجى اختيار نوع السيارة --</option>

	                        </select>
                    	</div>

                    	<div class="form-group">
	                        <label for="">اختر الموديل :</label>
	                        <select name="year_id" id="year" class="form-control">
	                            <option value="">-- اختر الموديل  --</option>
				                <?php if(count($years)>0): ?>
	                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

	                                <option <?php echo e(old('year_id') == $year->id ? 'selected' : ''); ?> value="<?php echo e($year->id); ?>"> <?php echo e($year->name); ?> </option>

	                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	                            <?php endif; ?>
                        	</select>
                    	</div>
                    </div>

                    <div class="form-group">
                        <label for="">وسيلة الإتصال :</label>
                        <input type="number" name="phone" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">نص الإعلان :</label>
                        <textarea name="desc" id="input" class="form-control" rows="10" required="required"></textarea>
                    </div>
                    <label for="">تحميل الصور :</label>
                    <div class="controls" style="overflow: auto">
                        <div class="entry input-group col-xs-12">
                            <input class="btn btn-primary" name="img[]" type="file">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="hvr-shutter-out-horizontal">إرسال</button>
                </form>
            </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script type="text/javascript">
      //  $(document).ready(function(){
            $(window).load(function() {
console.log('here');
            //getAjaxData('#city_id', '#hay_id', '<?php echo e(baseUrl('/ajax-hay-data')); ?>', 'city_id' );
            getAjaxData('#mark', '#modal', '<?php echo e(Url('/ajax-model-data')); ?>', 'mark_id' );

            $('#cat').on('change', function(e){
                    var cat = e.target.value;
                    var i=JSON.parse(cat);
                    var cat1=Object.keys(i)[0];

                          var cat_type = $('#cat').find(':selected').data('type');

console.log('type : ',cat_type);
                    if(cat_type == 1){
            $('#akar').hide();
            $('#akar').val(0);
            $('#except_car').hide();
            $('#car').show(1000);
        } else if(cat_type == 2) {
            $('#car').hide();
            $('#car').val(0);
            $('#except_car').hide();
            $('#akar').show(1000);
        }else{
            $('#car').hide();
            $('#car').val(0);
             $('#akar').hide();
            $('#akar').val(0);
            $('#except_car').show();
        }
                    console.log(i);
                    console.log(i[Object.keys(i)[0]]);
                    console.log(Object.keys(i)[0]);
                    $.get('<?php echo e(url("/ajax-subcat-data/cat_id")); ?>/'+ cat1 , function(data){
                         // $('#SubCat_id').empty();
                        obj = JSON.parse(data);
                        //if(obj.length>0){
                             $('.SubCat_id').removeAttr('disabled');
                             $.each(obj, function(index, subcat){
                                     console.log('subcat',subcat.name);
                                     $('.SubCat_id').append('<option value="'+subcat.id+'">'+subcat.name+'</option>');
                              });
                         // }
                      });   
            });
        });
    </script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>