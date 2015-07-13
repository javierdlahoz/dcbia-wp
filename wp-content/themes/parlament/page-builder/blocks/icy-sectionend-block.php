<?php
/** 
 * Skills Block 
 *
 * Options - Title, Skills {Title, Level[Beginner, Intermediate, Expert], Color]
 */
class ICY_SectionEND_Block extends AQ_Block {
	
	// Construct the subclass via parent::__construct()
	function __construct() {
	
		$block_options = array(
			'name' => 'Section END',
			'size' => 'span12',
			'resizable' => 0,
		);
		
		parent::__construct('icy_sectionend_block', $block_options);
		
	}
	
	// Define the form fields in the block
	function form($instance) {
		
		$defaults= array(				
											
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>

		This block is used in collaboration with the Section START block ONLY, otherwise it will break your website.
			
		
		<?php
		
	}
	
	// Output the HTML on front end
	function block($instance) {
		extract($instance);
		global $icy_options; 		
		?>
							</div><!-- END aq-block-icy_sectionend_block -->
						</div><!-- END AQ Template Wrapper -->
					</div> <!-- END Entry Content -->
				</article> <!-- END .post -->
			</section> <!-- END content -->
		</section> <!-- END primary -->
	</section> <!-- END main container -->
</section> <!-- END section -->

<!-- START #main-container -->
<section class="row-fluid main-container">

	<section class="wrapper primary">

		<section class="span12 content">	

			<article <?php post_class(); ?>>

				<div class="entry-content">

					<div class="aq-template-wrapper aq_row">
		<?php					
	}

	function after_block($instance) {
	 		extract($instance);
	 		echo '';	
	}

}
