<div class="custom-text">
	<div>
		<label><?php _e('Titile: ','custom-text'); ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo esc_attr($instance['name']); ?>" class="widefat" />
	</div>
	<div>
		<label><?php _e('Content: ','custom-text'); ?></label><br />
		<textarea id="<?php echo $this->get_field_id('bio'); ?>" name="<?php echo $this->get_field_name('bio'); ?>" rows="3" cols="35" maxlength="160" class="custom-text-bio"><?php echo esc_textarea($instance['bio']); ?></textarea>
		<p class="description"><?php _e('You have ','front-to-back'); ?><span class="custom-text-count">160</span><?php _e(' characters remaining.','custom-text'); ?></p>
	</div>
	<div class="">
		<p>
			<label><?php _e('Display Title: ','custom-text'); ?></label>
			<select id="<?php echo $this->get_field_id('position'); ?>" name="<?php echo $this->get_field_name('position'); ?>">
				<option value="above" <?php selected('above',$instance['position'], true); ?>><?php _e(' above the content','custom-text'); ?></option>
				<option value="below" <?php selected('below',$instance['position'], true); ?>><?php _e(' below the content','custom-text'); ?></option>
			</select>
		</p>
	</div>
	<div>
		<label>
			<input type="checkbox" id="<?php echo $this->get_field_id('homepage-only'); ?>" name="<?php echo $this->get_field_name('homepage-only'); ?>" value="1" <?php checked(1,$instance['homepage-only'], true); ?> />
			<?php _e('Display only on the homepage','custom-text'); ?>
		</label>
	</div>
</div>
	
