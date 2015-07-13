<?php
/* Image Block */
if(!class_exists('ICY_Quote_Block')) {
	class ICY_Quote_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Quote',
				'size' => 'span4',
			);
			
			//create the widget
			parent::__construct('ICY_Quote_Block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'author' => 'Ronald Reagan',							
				'quote' => 'If we ever forget that we are One Nation Under God, then we will be a nation gone under.',		
				'quote_color' => '#ef3f42',
				'quote_text_color' => '#fff',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('author') ?>">
					Author<br/>
					<?php echo aq_field_input('author', $block_id, $author) ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('quote') ?>">
					Testimonial<br/>
					<?php echo aq_field_textarea('quote', $block_id, $quote, $size = 'full') ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('quote_color') ?>">
					Quote Background Color<br/>
					<?php echo aq_field_color_picker('quote_color', $block_id, $quote_color) ?>
				</label>			
			</p>	

			<p class="description">
				<label for="<?php echo $this->get_field_id('quote_text_color') ?>">
					Quote Text Color<br/>
					<?php echo aq_field_color_picker('quote_text_color', $block_id, $quote_text_color) ?>
				</label>			
			</p>	

			<?php
		}
		
		function block($instance) {
			extract($instance);	
			global $icy_options; 								
					
			if ($quote) {
				echo '<div class="icy-quote" style="background-color: '. $quote_color .'; color: ' . $quote_text_color . ';">';
				echo wpautop(do_shortcode(htmlspecialchars_decode($quote)));
				if($author) echo '<span class="author">&#8212; ' . $author . '</span>';
				echo '</div>';
			}
								
		}
		
		
	}
}