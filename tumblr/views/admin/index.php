<div class="box">

	<h3><?php echo lang('tumblr_form_title');?></h3>
	
	<div class="box-container">	
	    <?php echo form_open(current_url(), 'class="crud"');?>
		    <ol>
		        <li class="even">
		                <label for="title"><?php echo lang('tumblr_username_label');?></label>
		                <input type="text" id="tumblr_username" name="tumblr_username" value="<?php echo set_value('tumblr_username', $this->settings->item('tumblr_username')); ?>" class="text" />
		                <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		        </li>

			<li>
				<input type="submit" value="Save" />
			</li>
		    </ol>
	    <?php echo form_close();?>		
	</div>
</div>
