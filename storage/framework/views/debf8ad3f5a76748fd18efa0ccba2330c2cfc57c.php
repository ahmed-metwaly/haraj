<?php $__env->startSection('style'); ?>

    <style>

        #akar, #car {
            display: none;
        }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="name-page">

            <a href="<?php echo e(route('home')); ?>">الرئيسية</a>
            /
            <a href="<?php echo e(route('ad-add')); ?>"> تعديل الاعلان </a>
        </div>
        <div class="bg-content-page">
            <div class="title-page-content wow animate fadeIn" data-wow-duration="2.0s">
                <h2><span>&#8226;</span> تعديل الاعلان <span>&#8226;</span></h2>
            </div>

            <div class="form-add-ads">

                <form action="<?php echo e(route('add-do-edit', ['id' => $data->id])); ?>" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="_method" value="PUT"> -->

                    <div class="select-inputs-page">
                        <label> القسم </label>
                        <select name="cat" id="cat">

                            <option value="">-- القسم الاعلان --</option>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <option value="<?php echo e(json_encode([$category->id => $category->name])); ?>"> <?php echo e($category->name); ?> </option>


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </select>
                    </div>
                    <br>

                    <label>الفئة</label>
                    <div class="text-inputs-page form-group">
                        <label class="radio-box"><input <?php echo e($data->type == 'sell' ? 'checked' : ''); ?>  type="radio"
                                                        name="type" value="sell"> بيع </label>
                        <label class="radio-box"><input <?php echo e($data->type == 'rent' ? 'checked' : ''); ?> type="radio"
                                                        name="type" value="rent"> إيجار </label>
                    </div>
                    <br>
                    <label>العنوان</label>

                    <div class="text-inputs-page">
                        <input type="text" name="title" value="<?php echo e($data->title); ?>"
                               placeholder="عنوان الاعلان . 'يفضل ان يكون العنوان مميز'">
                    </div>

                    <br/>
                    <div class="text-inputs-page">
                        <label> السعر </label>
                        <input type="text" name="price" value="<?php echo e($data->price); ?>"
                               placeholder="قيمة الاعلان بالريال السعودى">
                    </div>
                    <br>
                    <div class="file-inputs-page">
                        <label class="pull-right"> الصورة الرئيسية </label>
                        <div class="box">
                            <input type="file" name="photo" id="file-7" class="inputfile inputfile-6"
                                   data-multiple-caption="{count} files selected"/>
                            <label for="file-7">
                                <span></span>
                                <strong>


                                    صورة رئيسية للاعلان
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div>
                    </div>

                    <br>

                    <img src="<?php echo e(url('public/ads_262x249/' . $data->photo)); ?>" alt="...">

                    <br>
                    <div class="file-inputs-page">
                        <label class="pull-right"> الصور الفرعية </label>
                        <div class="box">

                            <input type="file" name="img[]" id="file-8" class="inputfile inputfile-6"
                                   data-multiple-caption="{count} files selected" multiple/>

                            <label for="file-8">
                                <span></span>
                                <strong>
                                    يمكنك تحديد اكثر من صورة
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </strong>
                            </label>
                        </div>
                    </div>

                    <br>

                    <?php if($photos != ''): ?>

                        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="img-edit " style="display: inline-block;">
                                <a class="delete-img" href="<?php echo e(route('delete-ads-img', ['id' => $photo->id])); ?>"><i
                                            class="fa fa-trash"></i></a>
                                <img width="100" height="100" src="<?php echo e(url('public/ads_74x84/' . $photo->img)); ?>" alt="...">
                            </div>

                            &nbsp;&nbsp;

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                    <?php endif; ?>

                    <br>
                    <br>
                    <div class="text-inputs-page">
                        <label> رقم الهاتف </label>
                        <input type="tel" name="phone"
                               value="<?php echo e($data->phone); ?>"
                               placeholder="رقم الجوال">
                    </div>
                    <br>
                    <div class="select-inputs-page">
                        <label> المدينة </label>
                        <select name="city" id="city_id">
                            <option value="">-- يرجى اختيار المدينة --</option>

                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <option value="<?php echo e($city->id); ?>" <?php echo e($data->city ==  $city->id ? 'selected' : ''); ?>> <?php echo e($city->name); ?> </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </select>

                    </div>
                    <br/>

                    <div class="select-inputs-page">
                        <label> الحى </label>
                        <select name="hay" id="hay_id">

                            <option value="">-- يرجى اختيار الحى --</option>

                            <?php $__currentLoopData = $hay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneHay): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <option value="<?php echo e($oneHay->id); ?>" <?php echo e($data->hay == $oneHay->id ? 'selected' : ''); ?> > <?php echo e($oneHay->name); ?> </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </select>

                    </div>

                    <br/>

                    <div id="car">
                        <div class="select-inputs-page">
                            <label> الماركة </label>
                            <select name="mark_id" id="mark">
                                <option value="">-- يرجى اختيار ماركة السيارة --</option>

                                <?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <option <?php

                                            if (isset($carData->mark_id) && $carData->mark_id != '') {
                                                if ($carData->mark_id == $mark->id) {
                                                    echo 'selected';
                                                }
                                            }

                                            ?> value="<?php echo e($mark->id); ?>"> <?php echo e($mark->name); ?> </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </select>

                        </div>
                        <br/>
                        <div class="select-inputs-page">
                            <label> الموديل </label>
                            <select name="model_id" id="modal">
                                <option value="">-- يرجى اختيار موديل السيارة --</option>
                                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($model->id); ?>"
                                            <?php if(isset($carData->model_id) && $carData->model_id !=''): ?>
                                            <?php if($carData->model_id == $model->id): ?>
                                            selected
                                            <?php endif; ?>
                                            <?php endif; ?> > <?php echo e($model->name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


                            </select>

                        </div>
                        <br/>
                        <div class="select-inputs-page">
                            <label> السنة </label>
                            <select name="year_id" id="year">
                                <option value="">-- يرجى اختيار السنة --</option>

                                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <option value="<?php echo e($year->id); ?>"

                                            <?php if(isset($carData->year_id) && $carData->year_id !=''): ?>
                                            <?php if($carData->year_id == $year->id): ?>
                                            selected
                                            <?php endif; ?>
                                            <?php endif; ?>
                                    > <?php echo e($year->name); ?> </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </select>

                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد الابواب </label>
                            <input type="number"
                                   value="<?php if(isset($carData->doors) && $carData->doors != ''): ?> <?php echo e($carData->doors); ?> <?php endif; ?>"
                                   placeholder="عدد الابواب" name="doors">

                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> لون السيارة </label>
                            <input type="text"
                                   value="<?php if(isset($carData->color) && $carData->color != ''): ?> <?php echo e($carData->color); ?> <?php endif; ?>"
                                   placeholder="لون السيارة" name="color">

                        </div>
                        <br/>
                    </div>


                    <div id="akar">
                        <div class="select-inputs-page">
                            <label> فئة العقار </label>
                            <select name="akar_type_id" id="mark">
                                <option value="">-- يرجى اختيار فئة العقار --</option>

                                <?php $__currentLoopData = $akars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akar): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <option
                                        <?php if(isset($akarData->akar_type_id) && $akarData->akar_type_id !=''): ?>
                                              <?php if($akarData->akar_type_id == $akar->id): ?>
                                                selected
                                            <?php endif; ?>
                                        <?php endif; ?>
                                            value="<?php echo e($akar->id); ?>"> <?php echo e($akar->name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> المساحة </label>
                            <input type="text" value="<?php if(isset($akarData->dest) && $akarData->dest != ''): ?> <?php echo e($akarData->dest); ?> <?php endif; ?>" name="dest" placeholder="مساخة العقار">
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد الفرف </label>
                            <input type="number" value="<?php if(isset($akarData->rooms) && $akarData->rooms != ''): ?> <?php echo e($akarData->rooms); ?> <?php endif; ?>" name="rooms" placeholder="عدد الغرف">
                        </div>
                        <br/>
                        <div class="text-inputs-page">
                            <label> عدد دورات المياة </label>
                            <input type="number" value="<?php if(isset($akarData->bathrooms) && $akarData->bathrooms != ''): ?> <?php echo e($akarData->bathrooms); ?> <?php endif; ?>" name="bathrooms"
                                   placeholder="عدد ورات المياة">
                        </div>
                        <br/>
                    </div>

                    <div class="text-inputs-page">
                        <label> وصف الاعلان </label>
                        <textarea name="desc" placeholder="وصف الاعلان" rows="8"> <?php if(isset($data->desc) && $data->desc != ''): ?> <?php echo e($data->desc); ?> <?php endif; ?> </textarea>

                    </div>
                    <br>

                    <div class="submit-form-page">
                        <div class="">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="submit" name="submit" value="إرسال"/>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script type="text/javascript">
        $(document).ready(function () {


            $('.delete-img').click(function(e) {

                e.preventDefault();

                var thisClass = $(this);

                var route = $(this).attr('href');

                $.ajax({
                    url : route,
                    method : 'GET',
                    data: ''

                }).success(function(data) {

                    thisClass.closest('div').remove();



                }).error(function(data) {
                    console.log(data);
                });


            });

            getAjaxData('#city_id', '#hay_id', '<?php echo e(baseUrl('/ajax-hay-data')); ?>', 'city_id');
            getAjaxData('#mark', '#modal', '<?php echo e(baseUrl('/ajax-model-data')); ?>', 'mark_id');


            <?php if(isset($carData->id) && $carData->id != ''): ?>

            $('#car').show();
            $('#akar').hide();

            <?php elseif(isset($akarData->id) && $akarData->id != ''): ?>

                $('#akar').show();
                $('#car').hide();


            <?php endif; ?>


        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>