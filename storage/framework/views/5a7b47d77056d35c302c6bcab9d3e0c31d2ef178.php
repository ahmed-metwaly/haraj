<?php $__env->startSection('content'); ?>
	
	<div class="col-xs-12 col-md-9 col-sm-9 containt-left">
                <div class="">
                    <table class="table table-hover">
                        <tbody>

                        <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="<?php echo e(route('ad-view', ['id' => $ad->id])); ?>"><?php echo e((strlen($ad->title) > 50) ? (mb_substr($ad->title, 0, 50) . ' ... ')  : (mb_substr($ad->title, 0, 50))); ?></a>
                                    <i class="fa fa-star"></i>
                                    <a class="topic-country" href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo e($ad->city_name); ?></a>
                                </td>
                                <td>
                                    <span class="topic-time "><?php echo e($ad->created_at->diffForHumans()); ?></span>
                                    <!-- <a class="topic-user" href="profile-user.html"><i class="fa fa-user"></i></a> -->
                                </td>
                                <td>
                                <img src="<?php echo e(url('public/ads_262x249/' . $ad->photo )); ?>">
                                    <a class="topic-img" href="<?php echo e(route('ad-view', ['id' => $ad->id])); ?>"><img src="<?php echo e(url('public/ads_262x249/' . $ad->photo )); ?>" alt="image-topic"></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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
                            </tr> -->

                        </tbody>
                    </table>
                    <ul class="pagination">
                    	<?php echo e($ads->links('web.pagination')); ?>

                        <!-- <li><a href="#" class="active">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-sm-3 online-user">
                <h3><i class="fa fa-user"></i> <?php echo e(Auth::user()->name); ?></h3>
                <h5><span class=" online">متصل</span></h5>
                <h5><span class=" online offline">غير متصل</span></h5>
                <h6><a href="">إضافة تقييم</a></h6>
                <h6><a href="<?php echo e(route('add-message')); ?>">إرسالة رسالة</a></h6>
                <h6>عضو منذ 8 شهر و 2 أسبوع</h6>
            </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

	<script>

		$(document).ready(function ($) {
			$("input[name='enable']").click(function () {
				if ($(this).is(':checked')) {
					$('input.textbox:text').attr("disabled", true);
				}
				else if ($(this).not(':checked')) {
					var ok = confirm('åá ÇäÊ ãÊÃßÏ ãä ÇÓÊÑÌÇÚ ÌãíÚ ÈíÇäÇÊß ÇáÞÏíãÉ');
					if (ok) {
						var remove = '';
						$('input.textbox:text').attr('value', remove);
						$('input.textbox:text').attr("disabled", true);
					}
				}
			});
		});

	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>