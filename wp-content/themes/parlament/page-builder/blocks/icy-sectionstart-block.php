<?php
/** 
 * Skills Block 
 *
 * Options - Title, Skills {Title, Level[Beginner, Intermediate, Expert], Color]
 */
class ICY_SectionSTART_Block extends AQ_Block {
	
	// Construct the subclass via parent::__construct()
	function __construct() {
	
		$block_options = array(
			'name' => 'Section START',
			'size' => 'span12',
			'resizable' => 0,
		);
		
		parent::__construct('icy_sectionstart_block', $block_options);
		
	}
	
	// Define the form fields in the block
	function form($instance) {
		
		$defaults= array(				
			'section_color' => '',
			'section_background_color' => '',
			'section_bg_type' => 'fixed',
			'section_padding' => '50',											
			'section_margin' => '0',	
			'section_check' => false,
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$background_options = array(
			'fixed' => 'Fixed',
			'scroll' => 'Normal'
		);
		
		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('section_color') ?>">
				Section Background Color<br/>
				<?php echo aq_field_color_picker('section_color', $block_id, $section_color) ?>
			</label>			
		</p>	

		<p class="description half">
			<label for="<?php echo $this->get_field_id('section_padding') ?>">
				Padding (in px)<br/>
				<?php echo aq_field_input('section_padding', $block_id, $section_padding, 'min', 'number') ?>
			</label>			
		</p>	
		<p class="description half last">
			<label for="<?php echo $this->get_field_id('section_margin') ?>">
				Margin (in px)<br/>
				<?php echo aq_field_input('section_margin', $block_id, $section_margin, 'min', 'number') ?>
			</label>			
		</p>					
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('section_background') ?>">
				Section Background Image (Optional)<br/>
				<?php echo aq_field_upload('section_background', $block_id, $section_background) ?>
			</label>
			<?php if($section_background) { ?>
			<div class="screenshot">
				<img src="<?php echo $section_background ?>" />
			</div>
			<?php } ?>
		</p>	

		<p class="description">
			<label for="<?php echo $this->get_field_id('section_bg_type') ?>">
				Background Type<br/>
				<?php echo aq_field_select('section_bg_type', $block_id, $background_options, $section_bg_type); ?>
			</label>
		</p>	

		<p class="description ">
			<label for="<?php echo $this->get_field_id('section_check') ?>">
				<?php echo aq_field_checkbox('section_check', $block_id, $section_check); ?>
				Tick this if you're using two sections one right after the other (stacked), to prevent weird layout of the website.
			</label>
		</p>		
	
		<?php
		
	}
	
	// Output the HTML on front end
	function block($instance) {
		extract($instance);
		global $icy_options; 

		$layout_correcter = '';

		if ($section_color == '') { $section_color == 'transparent'; }
		if ($section_background == '' ) { $section_background == 'none'; }
		if ($section_check == true) { $layout_correcter = 'stacked'; } else { $layout_correcter = ''; }
		
		?>
	
						</div><!-- END aq-block-icy_sectionstart_block -->
					</div>	<!-- END aq-template-wrapper -->
				</div>	<!-- END entry-content -->
			</article> <!-- END .post -->
		</section> <!-- END .content -->
	</section> <!-- END .primary -->
</section> <!-- END .main-container -->

<section class="icy-section <?php echo $layout_correcter; ?>" style="background-attachment: <?php echo $section_bg_type; ?>; background-color: <?php echo $section_color; ?>; background-image: url(<?php echo $section_background; ?>); padding: <?php echo $section_padding; ?>px 0; margin: <?php echo $section_margin; ?>px 0;">	

		<!-- START .main-container -->
		<section class="row-fluid">
			<!-- START .primary -->
			<section class="wrapper">	
				<!-- START .content -->
				<section class="span12">	
					<!-- article -->
					<article>
						<div class="entry-content">
							<div class="aq-template-wrapper aq_row">
<?php 		
	}

	function after_block($instance) {
	 		extract($instance);
	 		echo '';	
	}

}
