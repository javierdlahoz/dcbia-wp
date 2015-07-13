<?php
/** A simple text block **/
class ICY_Video_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Video Embed',
			'size' => 'span12'
		);
		
		//create the block
		parent::__construct('icy_video_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		global $icy_options; 
		echo '<div class="icy_video">';						
				if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>';				
				echo wpautop(do_shortcode(htmlspecialchars_decode($text)));			
		echo '</div>';
				
	}
	
}