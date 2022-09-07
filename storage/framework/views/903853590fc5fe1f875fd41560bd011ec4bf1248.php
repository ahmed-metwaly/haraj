<?php if($paginator->lastPage() > 1): ?>
	<ul class="pagination">
		<li class="<?php echo e(($paginator->currentPage() == 1) ? 'disabled' : ''); ?>">
			<a href="<?php echo e($paginator->url(1)); ?>">&lsaquo;</a>
		</li>
		<?php for($i = 1; $i <= $paginator->lastPage(); $i++): ?>
			<li class="<?php echo e(($paginator->currentPage() == $i) ? 'active' : ''); ?>">
				<a href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a>
			</li>
		<?php endfor; ?>
		<li class="<?php echo e(($paginator->currentPage() == $paginator->lastPage()) ? 'sdisabled' : ''); ?>">
			<a href="<?php echo e($paginator->url($paginator->currentPage()+1)); ?>">&rsaquo;</a>
		</li>
	</ul>
<?php endif; ?>
