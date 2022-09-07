<?php $__env->startSection('content'); ?>
	<div class="col-xs-12 col-md-12 col-sm-12 containt-left fave">
                <div class="">
                    <h2 style="text-align: center; color: #888"><i class="fa fa-heart"></i> المفضلة</h2>
                    <table class="table table-hover">
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr class="other-tr-color wow fadeInUp" data-wow-delay="1.7s">
                                <td>
                                    <a class="topic-titel" href="<?php echo e(route('ad-view', ['id' => $ad->id])); ?>"><?php echo e((strlen($ad->title) > 50) ? (mb_substr($ad->title, 0, 50) . ' ... ')  : (mb_substr($ad->title, 0, 50))); ?></a>
                                    <i class="fa fa-star"></i>
                                    <a href="<?php echo e(route('delete-following',['id'=>$ad->id])); ?>" >الغاء المتابعة</a>

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
                        </tbody>
                    </table>
                </div>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>