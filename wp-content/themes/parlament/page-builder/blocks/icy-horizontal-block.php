<?php
/** Horizontal line block 
 * 
 * Clear the floats vertically
 * Use horizontal lines/images
**/
class ICY_Horizontal_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Separator',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('icy_horizontal_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			
			'line_color' => '#ebebeb',			
			'height' => '1',
			'topmargin' => '35',
			'botmargin' => '35'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#ebebeb';
		
		?>
		<p class="description note">
			<?php _e('Use this block for horizontal separation of elements.', 'framework') ?>
		</p>		
		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('line_color') ?>">
				Pick a line color<br/>
				<?php echo aq_field_color_picker('line_color', $block_id, $line_color) ?>
			</label>
			
		</div>
		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height<br/>
				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
			</label>
			
		</div>
		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('topmargin') ?>">
				Top margin<br/>
				<?php echo aq_field_input('topmargin', $block_id, $topmargin, 'min', 'number') ?> px
			</label>
			
		</div>
		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('botmargin') ?>">
				Bottom margin<br/>
				<?php echo aq_field_input('botmargin', $block_id, $botmargin, 'min', 'number') ?> px
			</label>
			
		</div>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		global $icy_options; 		

		if (!$height) { $height == 1; }
									
			echo '<hr class="aq-block-hr-single" style="background:'.$line_color.'; margin-top:'.$topmargin.'px; margin-bottom:'.$botmargin.'px; height:'.$height.'px"/>';
		
	}
	
}