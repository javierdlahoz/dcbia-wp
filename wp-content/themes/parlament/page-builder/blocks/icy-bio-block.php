<?php
/* Image Block */
if(!class_exists('ICY_Bio_Block')) {
	class ICY_Bio_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Bio',
				'size' => 'span4',
			);
			
			//create the widget
			parent::__construct('ICY_Bio_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title' => '',
				'candidate_name' => '',
				'img' => '',
				'position' => 'Presidency Candidate',
				'bio' => 'Organizing for Action is the grassroots movement fighting for the agenda Americans voted for in 2012. We are millions of people, empowering individuals to make their voices heard.',		
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (Optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('candidate_name') ?>">
					Candidate Name<br/>
					<?php echo aq_field_input('candidate_name', $block_id, $candidate_name) ?>
				</label>
			</p>	
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('img') ?>">
					Upload an image<br/>
					<?php echo aq_field_upload('img', $block_id, $img) ?>
				</label>
				<?php if($img) { ?>
				<div class="screenshot">
					<img src="<?php echo $img ?>" />
				</div>
				<?php } ?>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('position') ?>">
					Candidate position<br/>
					<?php echo aq_field_input('position', $block_id, $position) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('bio') ?>">
					Bio<br/>
					<?php echo aq_field_textarea('bio', $block_id, $bio, $size = 'full') ?>
				</label>
			</p>
			<?php
		}
		
		function block($instance) {
			extract($instance);	
			global $icy_options; 								
			
			if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>';

			echo '<div class="icy-member">';
			if ($img) {				
				echo '<figure class="icy-member-picture">';
					echo '<img alt="'.$title.'" src="'.$img.'" />';
					echo '<span class="icy-member-name">' . $candidate_name . '</span>';
					if ($position) echo '<span class="icy-position">' . $position . '</span>';
				echo '</figure>';
			}

			if ($bio) {
				echo '<div class="icy-bio">';
				echo wpautop(do_shortcode(htmlspecialchars_decode($bio)));
				echo '</div>';
			}
						
			echo '</div>';
		}
		
		
	}
}