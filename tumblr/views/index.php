	<?php if (!empty($posts)): ?>
		<?php foreach ($posts as $post): ?>
			<?php if (isset($post->regular_title) || isset($post->regular_body)):?>
				<h5><?php echo  anchor($this->uri->segment(1).'/view/'.$post->id, (isset($post->regular_title) && !empty($post->regular_title)?$post->regular_title:$post->regular_body)); ?></h5>
				<p><em><?php echo lang('tumblr_posted_label');?>: <?php echo date('M d, Y', $post->unix_timestamp); ?></em>&nbsp;</p>
				<hr/>
			<?php endif?>
		<?php endforeach; ?>		
		
		<?php echo $pagination['links']; ?>
	<?php endif; ?>

