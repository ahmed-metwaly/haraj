<!DOCTYPE html>
<html lang="ar">

<head>
    <!--start Head-->
    <!-- for Language -->
    <meta charset="utf-8">
    <!-- for internet ex -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for Google Search -->
    <meta name="description" content="مَوْقِع حِرَاجِ">
    <!-- for Google Search -->
    <meta name="keywords" content="مُؤَسَّسَةُ أوَامرُ الشّبكةِ- مَوْقِع حِرَاجِ">
    <!-- Html author -->
    <meta name="author" content="AAIT - UI.Developer - Ahmed Kotb">
    <!-- for Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- for robots.search -->
    <meta name="robots" content="index/follow">
    <!-- for Mobile-top.bar -->
    <meta name="theme-color" content="#212121">
    <meta name="msapplication-navbutton-color" content="#212121">
    <meta name="apple-mobile-web-app-status-bar-style" content="#212121">
    <!-- Site Tittle -->
    <!-- <title>♔ "مَوْقِع حِرَاجِ ♔</title> -->
    <title>♔ <?php echo e(settings()['site_name']); ?> ♔</title>
    <!-- Site Icons -->
    <link rel="icon" type="image/png" href="<?php echo e(url('public/web')); ?>/images/site-icon.png">
    <!--bootstrap.css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--font-awesome.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--hover.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css">
    <!--animate.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <!--Styel.css-->
    <link rel="stylesheet" href="<?php echo e(url('public/web')); ?>/css/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--jquery-->

    <script src="<?php echo e(url('public/web')); ?>/js/jquery-1.12.0.min.js"></script>

    <?php echo $__env->yieldContent('style'); ?>
    <?php echo $__env->yieldContent('top-script'); ?>
</head>
<!--End Head
.
.
-->

<body>
<?php echo $__env->make('web.template.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--===========Start-Page-content===========-->
    <section class="main-content">
<?php if(count($errors) > 0): ?>
    <div class=" alert alert-danger">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
    
<?php if(Session::has('mOk')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo e(Session::get('mOk')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('mNo')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo e(Session::get('mNo')); ?>

    </div>
<?php endif; ?>

        <div class="row">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

    </section>
    <!--===========End-Page-content===========
.
.
-->

<!--start-Footer-->
    <footer class="wow fadeInUp">
        <div class="footer-top">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <ul>
                        <li>
                            <a class="hvr-bounce-in" href="<?php echo e(route('add-commission-transfer')); ?>">حساب عمولة الموقع</a>
                        </li>
                       <!--  <li>
                            <a class="hvr-bounce-in" href="e3lan-momuez.html">الإعلانات المميزة</a>
                        </li> -->
                        <li>
                            <a class="hvr-bounce-in" href="<?php echo e(route('add-subscribe-transfer')); ?>">عضوية معارض السيارات و مكاتب العقار</a>
                        </li>

                        <li>
                            <a class="hvr-bounce-in" href="<?php echo e(route('black-list')); ?>">القائمة السوداء</a>
                        </li>
                        <li>
                            <a class="hvr-bounce-in" href="<?php echo e(route('Blacklisted')); ?>">قائمة السلع والإعلانات الممنوعة</a>
                        </li>
                        <!-- <li>
                            <a class="hvr-bounce-in" href="rosom-el5edma.html">رسوم الخدمات المكررة </a>
                        </li> -->
                       
                    </ul>
                </div>
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <ul>
                        <!-- <li>
                            <a class="hvr-bounce-in" href="mo3ahdet.html">معاهدة إستخدام الموقع</a>
                        </li> -->
                       <!--  <li>
                            <a class="hvr-bounce-in" href="eltaqyeem-system.html">نظام التقييم </a>
                        </li>
                        <li>
                            <a class="hvr-bounce-in" href="5asm-system.html">نظام الخصم</a>
                        </li> -->
                        

                         <?php $__currentLoopData = pages(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <li><a href="<?php echo e(route('page', ['id' => $page->id])); ?>"> <?php echo e($page->name); ?> </a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-4 col-sm-4">
                    <ul>
                        <h3>تطبيق حراج</h3>
                        <li><a class="hvr-bounce-in" href="index.html"><i class="fa fa-android"></i></a> <a class="hvr-bounce-in" href="index.html"><i class="fa fa-apple"></i></a></li>
                        <li><a class="hvr-bounce-in" href="<?php echo e(route('contact-us')); ?>">اتصل بنا </a></li>
                        <?php if(auth()->check()): ?>
                        <li><a class="hvr-bounce-in" href="home.html">تسجيل الخروج</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>مؤسسة وسائل الشبكة لتقنية المعلومات - <a href="<?php echo e(route('home')); ?>">موقع حراج</a></p>
            <p>تصميم وتنفيذ <a href="">وسائل الشبكة</a></p>
        </div>
    </footer>
    <!--end-Footer
.
.
-->

<!--start-loading-page-->
    <section class="over-lay">
        <div class="regot-loader">
            <div class="regot regot1"></div>
            <div class="regot regot2"></div>
            <div class="regot regot3"></div>
            <div class="regot regot4"></div>
        </div>
    </section>
    <!--end-loading-page
.
.
-->
    <!--start-scroll-top-->
    <div class="scroll-top">
        <a><i class="fa fa-arrow-up"></i></a>
    </div>
    <!--end-scroll-top
.
.
-->

        <!-- <script src="<?php echo e(url('public/web')); ?>/js/jquery-3.1.1.min.js"></script> -->

    <!--fancybox-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <!--wow-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- bootstrapcdn -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--Main-JS-->
    <script src="<?php echo e(url('public/web')); ?>/js/plugins.js"></script>
    <script src="<?php echo e(url('public/web')); ?>/js/loader.js"></script>

    <?php echo $__env->yieldContent('script'); ?>
</body>
<!--End body-->

</html>
