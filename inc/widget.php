<?php if( (1 == $instance['homepage-only'] && is_home()) || 1 != $instance['homepage-only']) : ?>
	<?php if('above' == $instance['position']) : ?>
		<p class="custom-text-name"><?php echo $instance['name']; ?></p>
		<p class="custom-text-bio"><?php echo $instance['bio']; ?></p>
	<?php else: ?>
		<p class="custom-text-bio"><?php echo $instance['bio']; ?></p>
		<p class="custom-text-name"><?php echo $instance['name']; ?></p>
	<?php endif; ?>
<?php endif; ?>
