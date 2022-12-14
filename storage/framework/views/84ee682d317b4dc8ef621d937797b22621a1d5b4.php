<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $__env->yieldContent('title'); ?></title>


	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
	      type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/icons/icomoon/styles.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo e(url('public/admin/assets/css/bootstrap-switch.min.css')); ?>">
	<link href="<?php echo e(url('public/admin/assets/css/core.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/components.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/colors.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/extras/animate.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(url('public/admin/assets/css/dropzone.min.css')); ?>" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->


	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/dropzone.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/plugins/loaders/pace.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/core/libraries/jquery.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/core/libraries/bootstrap.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/plugins/loaders/blockui.min.js')); ?>"></script>
	<!-- /core JS files -->

	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/tables/datatables/datatables.min.js')); ?>"></script>
	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/uploaders/fileinput.min.js')); ?>"></script>

	<!-- /core JS files -->


	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/pages/animations_css3.js')); ?>"></script>

	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/notifications/bootbox.min.js')); ?>"></script>
	<script type="text/javascript"
	        src="<?php echo e(url('public/admin/assets/js/plugins/notifications/sweet_alert.min.js')); ?>"></script>

	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/core/app.js')); ?>"></script>

	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/pages/form_layouts.js')); ?>"></script>

	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/pages/uploader_bootstrap.js')); ?>"></script>

	
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/pages/datatables_advanced.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(url('public/admin/assets/js/pages/components_modals.js')); ?>"></script>
	<script src="<?php echo e(url('public/admin/assets/js/bootstrap-switch.min.js')); ?>"></script>


	<script src="<?php echo e(url('public/admin/assets/js/main.js')); ?>"></script>

	<script type="text/javascript">
		$(document).ready(function () {

			$("input[name='accept']").bootstrapSwitch();
		});
		$("input[name='accept']").on('switchChange.bootstrapSwitch', function (e, state) {
			e.preventDefault();
			alert(state)
			//
			// $.ajax({
			// 	url: $('.acceptForm').attr('action'),
			// 	type: 'POST',
			// 	success:function(data){
			//
			// 		return ;
			// 	}
			// });
		});

	</script>


	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>

	<style>
		li, a, p, article, h1, h2, h3, h4, h5, h6, button, input, table, td, section, li a, label, span, textarea, div, th, span {
			font-family: 'DroidArabicKufiRegular' !important;
			font-weight: normal !important;
			font-style: normal !important;
		}

	</style>
	<!-- /theme JS files -->

	<?php echo $__env->yieldContent('style'); ?>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<a class="navbar-brand" href="#"><img src="<?php echo e(url('public/admin/assets/images/logo_light.png')); ?>"
		                                      alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
			</li>


		</ul>

		<p class="navbar-text"><span class="label bg-success-400">???????????? ????????</span></p>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<div class="media">
						<img src="<?php echo e(url('public/users/' .  Auth()->user()->photo)); ?>"
						     class="img-circle img-sm" alt="">
					</div>

				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?php echo e(route('admin-edit',[ 'id' => Auth()->user()->id ])); ?>"><i
									class="icon-user-plus"></i>
							???????????? ?????????????? </a></li>
					<li><a href="<?php echo e(route('admin-messages')); ?>"><span
									class="badge bg-teal-400 pull-right"><?php echo e(\App\Admin_messages::get()->count()); ?></span>
							<i
									class="icon-comment-discussion"></i> ??????????????</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo e(route('logout')); ?>"><i class="icon-switch2"></i> ?????????? ????????????</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

	<?php echo $__env->make('admin.template.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<!-- start content -->
		<div class="content-wrapper">

			<div class="page-header">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-right6 position-left"></i> <span
									class="text-semibold"> <?php echo $__env->yieldContent('sectionName'); ?> </span> -
							<?php echo $__env->yieldContent('pageName'); ?>
						</h4>
					</div>
				</div>

				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="<?php echo e(route('dashboard')); ?>"><i
										class="icon-home2 position-left"></i> <?php echo e(trans('admin.home')); ?> </a></li>
						<li class="active"><?php echo $__env->yieldContent('pageName'); ?></li>
					</ul>
				</div>
			</div>


			<div class="content">
				<div class="row ">
					<div class="alertM">
						<?php echo $__env->make('admin.template.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
			<!-- Footer -->
			<div class="footer text-center center-block">
				 <a target="_blank" href="https://www.ws4it.com">?????????? ???????????? </a> &copy; <a href="https://www.ws4it.com" target="_blank"> ?????????? ????????????
					<small> ???????????? ?????????????????? </small>
				</a>
			</div>
			<!-- /footer -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->
<script type="text/javascript">
	$(document).ready(function () {

		// $("input[name='accept']").bootstrapSwitch();
		$("input[name='accept']").on('change', function (e) {
			e.preventDefault();
			var accept = $('.acceptForm').serialize();
			alert(accept);
			//request using ajax
			$.ajax({
				url: "",
				type: 'POST',
				dataType: 'json',
				data: {accept: accept, _token: _token},
				success: function (data) {

					alert(data);
				}
			});
		});


	});

</script>

<!-- Danger modal -->
<div id="modal_Delete_User" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">??????????</h4>
			</div>

			<div class="modal-body text-center">
				<h5 class="text-semibold">???? ?????? ?????????? ???? ?????????? ?????? ?????????????? ??</h5>
				<h2 class="text-semibold">???????? ?????? ???????? ???????????????? !</h2>
			</div>
			<div class="modal-footer">
				<form action="#" method="get" id="DeleteFrm">
					<?php echo e(csrf_field()); ?>

					<button type="button" class="btn btn-link" data-dismiss="modal">??????????</button>
					<button type="submit" class="btn btn-danger">??????</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /default modal -->

<?php echo $__env->yieldContent('script'); ?>


</body>
</html>
