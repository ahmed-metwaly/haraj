<?php $__env->startSection('content'); ?>
	
	<div class="col-xs-12 col-md-9 col-sm-8 single-data">
	<div id="msg"></div>
                <div class="single-data-info">
                
                    <h2><i class="fa fa-pencil-square" aria-hidden="true"></i><?php echo e($data->title); ?></h2>
                    <h3><a href="topic-contry.html"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo e($city->name); ?><span><a href="<?php echo e(route('public-profile',['id'=>$user->id])); ?>"><i class="fa fa-user"></i> <?php echo e($user->name); ?></span></a></h3>

                    <?php if(auth()->check()): ?>

                    <?php if(count($follow) > 0): ?>

					<button id="unfollow"  data-f_id="<?php echo e($data->id); ?>">الغاء المتابعة</button>
					<button id="follow" class="hidden" data-ad_id="<?php echo e($data->id); ?>">متابعة</button>
					<?php else: ?>
					<button id="follow" data-ad_id="<?php echo e($data->id); ?>">متابعة</button>
					<button id="unfollow" class="hidden" data-f_id="<?php echo e($data->id); ?>">الغاء المتابعة</button>
					<?php endif; ?>

						<?php if(auth()->user()->id == $data->created_by || auth()->user()->is_admin): ?>
							
							<h3><a href="<?php echo e(route('add-edit', ['id' => $data->id])); ?>"
							   style="color: #a68b6a;"> <span><i class="fa fa-pencil-square" aria-hidden="true"></i>تعديل الاعلان</span>
							</a></h4>
							<h4><a href="<?php echo e(route('add-delete', ['id' => $data->id])); ?>"
							   class="do-delete" style="color: red;"> <span><i class="fa fa-pencil-square" aria-hidden="true"></i>حذف الاعلان</span>
							</a></h3>
							
						<?php endif; ?>
					<?php endif; ?>
                    <h5><?php echo e($data->created_at->diffForHumans()); ?><span>#<?php echo e($user->phone); ?></span></h5>
                    <a href="<?php echo e(route('next-ad',['id'=>$data->id])); ?>">التالى <i class="fa fa-caret-left" aria-hidden="true"></i></a>


                </div>
                <p><?php echo e($data->desc); ?> </p>
                <img src="<?php echo e(url('public/ads_435x490/' . $data->photo)); ?>" alt="topic-image">
                <?php if(count($photos)>0): ?>
				<?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<img src="<?php echo e(url('public/ads_435x490/' . $photo->img)); ?>" alt="topic-image"/>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php endif; ?>

                <h6><i class="fa fa-phone"></i> <?php echo e($data->phone); ?></h6>
                <ul>
                    <li><a href="<?php echo e(route('send-msg',['id'=>$data->id])); ?>"><i class="fa fa-envelope"></i></a></li>
                   <!--  count-favorite -->
                    <li>
                    <?php if($countFavorites > 0): ?>
                    <span id="count-favorite" style="padding-left: 2px" data-val="<?php echo e($countFavorites); ?>"> <?php echo e($countFavorites); ?> </span>
                    <?php endif; ?>

                    <a id="favorite" data-id="<?php echo e($data->id); ?>" href="#"><i class="fa fa-heart"  <?php if($userFavorite != '' && $userFavorite > 0): ?>
							   style="color:red;"
							   <?php endif; ?>
							   data-id="<?php echo e($data->id); ?>"
							   aria-hidden=" true" id="favorite"></i></a></li>
                    <li><a href=""><i class="fa fa-whatsapp"></i></a></li>
                    <li><a href="<?php echo e(route('add-report', ['id' => $data->id])); ?>"><i class="fa fa-flag"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
                <div class="omola">
                <?php if(auth()->check()): ?>
						<?php if($data->comments_status == 1): ?>
							<?php if(settings()->site_comments_status == 1): ?>
                    <form action="<?php echo e(route('add-comment')); ?>" method="POST" role="form" style="width: 100%; margin: 10px 0 0">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                    <input type="hidden" name="scrf">
                        <div class="form-group">
                            <label for="">أكتب ردك هنا :</label>
                            <textarea name="comment" id="input" class="form-control" rows="6" required="required"></textarea>
                        </div>
                        <button type="submit" class="hvr-shutter-out-horizontal" id="commentAd" data-ad_id="<?php echo e($data->id); ?>">إرسال</button>
                    </form>
                    <?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>

					<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<div class="comment<?php echo e($comment->id); ?>">
						<div class="comment-image col-xs-1">
							<div class="row">
								<a href=""><img style="border-radius: 5px; width: 100%"
								                src="<?php echo e(url('public/web/')); ?>/images/comment.png" alt=""></a>
							</div>
						</div>
						<div class="comment-info col-xs-11">
							<h5><span style="float: right"> <?php echo e(App\User::find($comment->created_by)->name); ?> </span><span
										style="float: left"><i
											class="fa fa-calendar"
											aria-hidden="true"></i> <?php echo e(date_format($comment->created_at, 'Y/m/d')); ?> </span>
							</h5>
							<p> <?php echo e($comment->comment); ?> </p>
							<?php if(auth()->check()): ?>
								<?php if(auth()->user()->id == $comment->created_by || auth()->user()->is_admin ): ?>
									<a href="<?php echo e(route('delete-comment', ['id' => $comment->id])); ?>"
									   class="do-delete pull-left" data-comment_id="<?php echo e($comment->id); ?>">حذف</a>
								<?php endif; ?>
							<?php endif; ?>

						</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<?php if($countComments > 0): ?>
							<div class="more" >
								<?php echo e($comments->links()); ?>

							</div>
						<?php endif; ?>
						<hr>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-sm-4 single-data-other">
                <div class="single-data-other-data">
                    <a href="index.html"><i class="fa fa-link"></i> <?php echo e($cat->name); ?> في <?php echo e($city->name); ?></a>
                    <?php if(count($sameAds) > 0): ?>
                    <?php $__currentLoopData = $sameAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $samAds): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <a href="<?php echo e(route('ad-view', ['id' => $samAds->id])); ?>" class="col-xs-6"><img src="<?php echo e(url('public/ads_262x249/' . $samAds->photo)); ?>" alt="<?php echo e($samAds->title); ?>"></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    
                </div>
                <div class="single-data-other-data">
                    <a href="index.html"><i class="fa fa-link"></i> <?php echo e($cat->name); ?></a>
                    <?php if(count($sameCat) > 0): ?>
                    <?php $__currentLoopData = $sameCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $samAds): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <a href="<?php echo e(route('ad-view', ['id' => $samAds->id])); ?>" class="col-xs-6"><img src="<?php echo e(url('public/ads_262x249/' . $samAds->photo)); ?>" alt="<?php echo e($samAds->title); ?>"></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    
                </div>
          
            </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>



	<script>
		//$(document).ready(function () {
			$(window).load(function() {
			console.log('script');

			// favorite
			$(document).on('click', '#favorite', function(e){
			//$('#favorite').click(function (e) {
				e.preventDefault();
				var id = $(this).data('id');
				console.log(id);
				var count = $('#count-favorite').data('val');
				count = parseInt(count);
				if ($('#favorite').attr('style') == undefined) {

					// add favorite
					$.ajax({
						method: 'get',
						//url: '/ticket/add-like/' + id
						url: '<?php echo e(url("/favourites/add-favorite")); ?>/' +id
					}).success(function (data) {
					if(data.error == 0){
						$("#count-favorite").attr("data-val", count);
						$('#count-favorite').html(count + 1);
						$('#favorite').css('color', 'red');
					}else{
						$('#msg').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
					}
					}).error(function (error) {
						//$("#myModal1").modal('show');
						console.log(error);
					});

				} else {

					//remove favorite
					$.ajax({
						method: 'get',
						//url: '/ticket/remove-like/' + id
						url: '<?php echo e(url("/favourites/remove-favorite")); ?>/' +id
					}).success(function (data) {
						$("#count-favorite").attr("data-val", count);
						$('#count-favorite').html(count);
						$('#favorite').removeAttr('style');
					}).error(function (error) {
						console.log(error);
					});

				}
			});

			// like
			$('#like').click(function (e) {
				e.preventDefault();
				var id = $(this).data('id');
				var count = $('#count-likes').data('val');
				count = parseInt(count);
				if ($('#like').attr('style') == undefined) {

					// add like
					$.ajax({
						method: 'get',
						//url: '/ticket/add-like/' + id
						url: '<?php echo e(url("/add-like")); ?>/' +id
					}).success(function (data) {
						$("#count-likes").attr("data-val", count);
						$('#count-likes').html(count + 1);
						$('#like').css('color', 'red');
					}).error(function (error) {
						$("#myModal1").modal('show');
						console.log(error);
					});

				} else {

					//remove like
					$.ajax({
						method: 'get',
						//url: '/ticket/remove-like/' + id
						url: '<?php echo e(url("/remove-like")); ?>/' +id
					}).success(function (data) {
						$("#count-likes").attr("data-val", count);
						$('#count-likes').html(count);
						$('#like').removeAttr('style');
					}).error(function (error) {
						console.log(error);
					});

				}
			});

			//comment

			//$('#commentAd').click(function(e){
			$(document).on('click', '#commentAd', function(e){
			//$('#commentAd').on('click', function(e){
				e.preventDefault();
				var id = $(this).data('ad_id');
				console.log('ad_id',id)
				var comment =$('textarea#input').val();
				console.log('comment',comment);
				var token = $("input[name=_token]").val();
				console.log(token);
			
			$.ajax({
						method: 'post',
						url: '<?php echo e(url("/ads/add-comment")); ?>',
						data: {comment : comment ,
								id :id ,
								_token : token,
								scrf:''}
					}).success(function (response) {
						console.log(response);
						$('textarea').val('');
				var array = [];
				array.push('<div class="'+response['id']+'"><div class="comment-image col-xs-1"><div class="row"><a href=""><img style="border-radius: 5px; width: 100%" src="<?php echo e(url('public/web/')); ?>/images/comment.png" alt=""></a></div></div>');
               array.push('<div class="comment-info col-xs-11">');
               array.push('<h5><span style="float: right">'+response['username']+'</span></h5>');
               
               array.push('<p>'+ response['comment']+' </p>');
              array.push('<a href="<?php echo e(url("/ads/delete-comment")); ?>/'+response['id']+'" class="do-delete pull-left" data-comment_id="'+response['id']+'">حذف</a>');
               array.push('</div></div>');		
               $(array.join('')).insertBefore('.more');

					}).error(function (error) {
						console.log(error);
					});
			});
			
			//delete comment
			$(document).on('click', '.do-delete', function(e){
			//$('.do-delete').on('click', function(e){
			//$('.do-delete').click(function (e) {
				e.preventDefault();
				var id = $(this).data('comment_id');
				$.ajax({
						method: 'get',
						//url: '<?php echo e(url("/followings/delete")); ?>/' +id
						url: '<?php echo e(url("/ads/delete-comment")); ?>/'+id
					}).success(function (data) {
						console.log(data);
					$('.comment'+id).remove();
						console.log('success');
					}).error(function (error) {
						console.log(error);
						console.log(id);
					});

			});		

			// follow
			$(document).on('click', '#follow', function(e){
			//$('#follow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('ad_id');
				$.ajax({
						method: 'get',
						url: '<?php echo e(url("/followings/save")); ?>/' + 0 +'/'+id
					}).success(function (data) {
						$('#follow').addClass('hidden');
						$('#unfollow').removeClass('hidden');
						$('#unfollow').addClass('visible');
						$('#unfollow').attr('data-f_id',data);
						console.log('follow');
						console.log(data);
						var follow_id =data;
					}).error(function (error) {
						console.log(error);
					});

			});

			// un follow
			$(document).on('click', '#unfollow', function(e){
			//$('#unfollow').click(function (e) {
				e.preventDefault();
				var id = $(this).data('f_id');
				$.ajax({
						method: 'get',
						url: '<?php echo e(url("/followings/delete")); ?>/' +id
					}).success(function (data) {
						//console.log(data);
						console.log(id);
						$('#unfollow').addClass('hidden');
						$('#follow').removeClass('hidden');
						$('#follow').addClass('visible');
					
						console.log('success');
					}).error(function (error) {
						console.log(error);
						console.log(id);
					});

			});
		});
	</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>