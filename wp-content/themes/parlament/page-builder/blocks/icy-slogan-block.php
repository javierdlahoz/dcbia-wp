<?php
/** A simple text block **/
class ICY_Slogan_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Slogan',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('icy_slogan_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'LIBERTY, WHEN IT BEGINS TO TAKE ROOT, IS A PLANT OF RAPID GROWTH.',		
			'slogan_color' => '#ffffff',
			'slogan_background' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Main Slogan
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('slogan_color') ?>">
				Slogan Color<br/>
				<?php echo aq_field_color_picker('slogan_color', $block_id, $slogan_color) ?>
			</label>			
		</p>	
		<p class="description">
			<label for="<?php echo $this->get_field_id('slogan_background') ?>">
				Slogan Background<br/>
				<?php echo aq_field_color_picker('slogan_background', $block_id, $slogan_background) ?>
			</label>			
		</p>	

		<?php
	}
	
	function block($instance) {
		extract($instance);
		global $icy_options; 

		echo "<section class='icy-slogan'>";
			if($title) echo '<h2 class="icy-slogan-title" style="color:' . $slogan_color . '; background-color: '. $slogan_background .'">' . strip_tags($title).'</h2>';						
		echo '</section>';
	}
	
}