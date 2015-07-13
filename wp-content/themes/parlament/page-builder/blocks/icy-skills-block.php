<?php
/** 
 * Skills Block 
 *
 * Options - Title, Skills {Title, Level[Beginner, Intermediate, Expert], Color]
 */
class ICY_Skills_Block extends AQ_Block {
	
	// Construct the subclass via parent::__construct()
	function __construct() {
	
		$block_options = array(
			'name' => 'Stats',
			'size' => 'span4'
		);
		
		parent::__construct('icy_skills_block', $block_options);
		
	}
	
	// Define the form fields in the block
	function form($instance) {
		
		$defaults= array(				
			'skill_title' => 'Text',
			'skill_level' => '70',			
			'skill_label' => 'Label',
			'skill_color' => '#0a9de2',
			'label_color' => '#777777',
			'title_color' => '#999999',
			'track_color' => '#f6f6f6',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_title') ?>">
				Stat Title<br/>
				<?php echo aq_field_input('skill_title', $block_id, $skill_title) ?>		
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title_color') ?>">
				Title Color<br/>
				<?php echo aq_field_color_picker('title_color', $block_id, $title_color) ?>
			</label>			
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_level') ?>">
				Stat Level ( X% out of 100% )<br/>
				<?php echo aq_field_input('skill_level', $block_id, $skill_level, 'min', 'number') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_label') ?>">
				Stat Label (inside the pie chart)<br/>
				<?php echo aq_field_input('skill_label', $block_id, $skill_label) ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('label_color') ?>">
				Label Color<br/>
				<?php echo aq_field_color_picker('label_color', $block_id, $label_color) ?>
			</label>			
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('skill_color') ?>">
				Stat Graph Color<br/>
				<?php echo aq_field_color_picker('skill_color', $block_id, $skill_color) ?>
			</label>			
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('track_color') ?>">
				Stat Graph Tracking Color<br/>
				<?php echo aq_field_color_picker('track_color', $block_id, $track_color) ?>
			</label>			
		</p>
		
		
		<?php
		
	}
	
	// Output the HTML on front end
	function block($instance) {
		extract($instance);
		global $icy_options; 
		wp_enqueue_script('easy-pie-chart');					
		$rand = rand(1,100);		
		?>

		<script type="text/javascript">
			jQuery(window).load(function($) {
				jQuery('.icy-knob-<?php echo $rand; ?>').easyPieChart({
		            barColor: '<?php echo $skill_color; ?>',
		            trackColor: '<?php echo $track_color; ?>',
		            scaleColor: false,
		            lineCap: 'butt',
		            size: jQuery('.icy-knob-<?php echo $rand; ?>').parent().width()-40,
		            lineWidth: 10,
		            animate: 3000
		        });		
			});

		</script>


		<div class="icy-skill">
			<span class="icy-knob-<?php echo $rand; ?>" data-percent="<?php echo $skill_level; ?>"><span style="color: <?php echo $label_color; ?>;"><?php echo $skill_label; ?></span></span>
			<h2 style="color: <?php echo $title_color; ?>"><?php echo $skill_title; ?></h2>
		</div>

		<?php 		
	}

}
