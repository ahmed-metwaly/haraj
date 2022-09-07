    <!--===========Start-Header===========-->
    <header>
        <div class="header-top">
            <ul>
                <li><a class="hvr-push wow zoomIn" data-wow-delay="1.51s" href="<?php echo e(url('')); ?>"><i class="fa fa-home"></i>الرئيسية</a></li>

                <?php $i = -1; ?>
                <?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php $i++; ?>
                <?php if($i<6): ?>
                        <li><a class="hvr-push wow zoomIn" data-wow-delay="1.53s" href="<?php echo e(route('get-cat' , ['id' => $cat->id])); ?>"><i
                                        aria-hidden="true"></i><?php echo e($cat->name); ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                
                <!-- <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.53s" href="cars.html"><i class="fa fa-car"></i>حراج سيارات</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.56s" href="mobiles.html"><i class="fa fa-mobile"></i>أجهزة</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.59s" href="building.html"><i class="fa fa-university" aria-hidden="true"></i>عقارات</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.62s" href="animals.html"><i class="fa fa-paw" aria-hidden="true"></i>مواشي و حيوانات و طيور</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.65s" href="furniture.html"><i class="fa fa-cubes" aria-hidden="true"></i>اثاث</a>
                </li>
                
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.71s" href="service.html"><i class="fa fa-shield" aria-hidden="true"></i>خدمات</a>
                </li> -->

                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.68s" href="<?php echo e(route('search')); ?>"><i class="fa fa-search"></i>البحث</a>
                </li>
                <li>
                    <a class="hvr-push wow zoomIn" data-wow-delay="1.73s" href="more-section.html"><i class="fa fa-spinner fa-pulse fa-fw"></i>أقسام أكثر ...</a>
                </li>

            </ul>
        </div>
        <div class="header-bottom wow  zoomIn" data-wow-delay="1.5s">
            <div id="particles-background" class="vertical-centered-box"></div>
            <div id="particles-foreground" class="vertical-centered-box"></div>
            <div class="vertical-centered-box">
            </div>
            <a href="<?php echo e(url('')); ?>"><img src="<?php echo e(url('public/web')); ?>/images/haraj-logo.png" alt="site-logo"></a>
            <ul>
                <?php if(! auth()->check()): ?>

                
                
                <li>
                    <a href="<?php echo e(route('login')); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i>تسجيل الدخول</a>
                </li>
                
                <?php else: ?>

                    <?php if(auth()->user()->is_admin): ?>
                        <li><a href="<?php echo e(route('dashboard')); ?>">لوحة التحكم</a></li>
                    <?php endif; ?>
                
                <li>
                    <a href="<?php echo e(route('user-profile')); ?>"><i class="fa fa-user"></i><?php echo e(Auth::user()->name); ?></a>
                </li>
                <li>
               <!--  message.html -->
                    <a href="<?php echo e(route('received-messages')); ?>"><span>1</span><i class="fa fa-envelope"></i>الرسائل</a>
                </li>
                <li>
               <!--  notification.html -->
                    <a href="<?php echo e(route('all-notifs')); ?>"><?php if(getNotifs() >0): ?><span><?php echo e(getNotifs()); ?></span><?php endif; ?><i class="fa fa-bell"></i>الإشعارات</a>
                </li>
                <li>
                    <a href="<?php echo e(route('all-favorites')); ?>"><i class="fa fa-heart"></i>المفضلة</a>
                </li>
                <li>
                    <!-- followers.html -->
                    <a href="<?php echo e(route('all-followings')); ?>"><i class="fa fa-rss" aria-hidden="true"></i>المتابعة</a>
                </li>

                <li>
                    <!-- followers.html -->
                    <a href="<?php echo e(route('logout')); ?>"><i class="fa fa-rss" aria-hidden="true"></i>تسجيل الخروج</a>
                </li>
                
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <!--===========End-Header===========
.
.
-->