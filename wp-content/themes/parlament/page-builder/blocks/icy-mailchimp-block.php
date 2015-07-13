<?php

if(!class_exists('ICY_MailChimp_Block')) {
	class ICY_MailChimp_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array (
				'name' => 'MailChimp Widget',
				'size' => 'span3',
			);
			
			parent::__construct('icy_mailchimp_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array (
				'form_id' => 0,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			if ( is_multisite() && (is_plugin_active_for_network('mailchimp/mailchimp.php') == true)) {
				echo __('Sorry, this block requires the <a href="http://wordpress.org/plugins/mailchimp/">MailChimp</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'framework');
				return false;
			}

			if (!is_plugin_active('mailchimp/mailchimp.php')) {
				echo __('Sorry, this block requires the <a href="http://wordpress.org/plugins/mailchimp/">MailChimp</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'framework');
				return false;
			}
			
			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>			
			<?php
		}
		
		function block($instance) {
			extract($instance);
			global $icy_options; 


			if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>';
			mailchimpSF_signup_form();
		}
	}
}


