<?php $__env->startSection('content'); ?>

	<div class="col-xs-12 col-md-12 col-sm-12 containt-left search-result">
                <form action="<?php echo e(route('search-ads')); ?>" method="get" role="form" class="search-sel3a  wow zoomIn" data-wow-delay="1.6s">
                    <div class="form-group">
                        <input type="text"  name="title" class="form-control" id="" placeholder="إبحث عن سلعة" onfocus="this.placeholder = ''" onblur="this.placeholder = 'إبحث عن سلعة'">
                    </div>
                    <button type="submit" class="hvr-skew-forward"><i class="fa fa-search"></i></button>
                </form>
                <form action="<?php echo e(route('search-ads')); ?>" method="get" role="form" class="search-city wow fadeIn" data-wow-delay="1.7s">
                    <div class="form-group">
                        <select name="city" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر المدينة</option>
                             <?php $__currentLoopData = cities(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneCity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<option value="<?php echo e($oneCity->id); ?>"><?php echo e($oneCity->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="" id="input" class="form-control black-color" required="required">
                            <option selected="" disabled="" value="">إختر الوقت</option>
                            <option value="">جميع الأوقات</option>
                            <option value="">منذ 25 ساعة</option>
                            <option value="">منذ اسبوع</option>
                            <option value="">منذ شهر</option>
                        </select>
                    </div>
                </form>
                <div class="">
                    <table class="table table-hover">
                        <tbody>
                        	<?php if(count($data) > 0): ?>
                        	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="<?php echo e(route('ad-view', ['id' => $ad->id])); ?>"><?php echo e((strlen($ad->title) > 50) ? (mb_substr($ad->title, 0, 50) . ' ... ')  : (mb_substr($ad->title, 0, 50))); ?></a>
                                    <i class="fa fa-star"></i>
                                    <a class="topic-country" href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo e($ad->city_name); ?></a>
                                </td>
                                <td>
                                    <span class="topic-time "><?php echo e($ad->created_at->diffForHumans()); ?></span>
                                    <a class="topic-user" href="profile-user.html"><i class="fa fa-user"></i><?php echo e($ad->username); ?></a>
                                </td>
                                <td>
                                <img src="<?php echo e(url('public/ads_262x249/' . $ad->photo )); ?>">
                                    <a class="topic-img" href="<?php echo e(route('ad-view', ['id' => $ad->id])); ?>"><img src="<?php echo e(url('public/ads_262x249/' . $ad->photo )); ?>" alt="image-topic"></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php else: ?>
                        	<div class="alert alert-danger">
										لا يوجد نتائج لهذا البحث
									</div>
                        <?php endif; ?>
                            <!-- <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="single-page.html">بطاقات ايتونز بسعر مميز جدا</a>
                                    <i class="fa fa-star"></i>
                                    <a class="topic-country" href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i>الرياض</a>
                                </td>
                                <td>
                                    <span class="topic-time ">قبل 3 أسبوع و يوم</span>
                                    <a class="topic-user" href="profile-user.html"><i class="fa fa-user"></i>صالح بن حميد</a>
                                </td>
                                <td>
                                    <a class="topic-img" href="single-page.html"><img src="images/image-topic.jpg" alt="image-topic"></a>
                                </td>
                            </tr>
                            <tr class="wow fadeInUp" data-wow-delay="1.75s">
                                <td>
                                    <a class="topic-titel" href="single-page.html">بطاقات ايتونز بسعر مميز جدا</a>
                                    <i class="fa fa-star"></i>
                                    <a class="topic-country" href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i>الرياض</a>
                                </td>
                                <td>
                                    <span class="topic-time ">قبل 3 أسبوع و يوم</span>
                                    <a class="topic-user" href="profile-user.html"><i class="fa fa-user"></i>صالح بن حميد</a>
                                </td>
                                <td>
                                    <a class="topic-img" href="single-page.html"><img src="images/image-topic.jpg" alt="image-topic"></a>
                                </td>
                            </tr> -->

                        </tbody>
                    </table>
                    <ul class="pagination">
                       <?php echo e($data->links('web.pagination')); ?>

                    </ul>
                </div>
            </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>