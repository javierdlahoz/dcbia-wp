<?php
/** Slider Block **/
if(!class_exists('ICY_Lightbox_Block')) {
	class ICY_Lightbox_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name'			=> 'Lightbox',
				'size'			=> 'span6',				
			);
			
			parent::__construct('icy_lightbox_block', $block_options);
			
			add_action('wp_ajax_aq_block_slider_add_new', array($this, 'add_slide'));
		}
		
		function form($instance) {
			$defaults = array(
				'slides'		=> array(
					1 => array(
						'title' => 'My New Image',
						'upload' => '',
						'caption' => '',						
						'embed' => ''
					)
				),
				'slider' => '',				
				'columns' => 'span6',
			);

			$columns_options = array(
					'fullwidth' => __('One Column', 'framework'),
					'half' => __('Two Column', 'framework'),
					'third' => __('Three Column', 'framework'),
					'quarter' => __('Four Column', 'framework'),
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-columns">
					Images per row							
					<?php echo aq_field_select('columns', $block_id, $columns_options, $columns); ?>
				</label>
			</p>
			
			<div class="description cf">
				<ul id="sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$slides = is_array($slides) ? $slides : $defaults['slides'];
					$count = 1;
					foreach($slides as $slide) {	
						$this->slide($slide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="slider" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function slide($slide = array(), $count = 0) {
			
			$defaults = array (				
				'upload' => '',
				'caption' => '',					
			);
			
			$slide = wp_parse_args($slide, $defaults);
			
			?>
			<li id="<?php echo $this->get_field_id('slides') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $slide['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title">
							Slide Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][title]" value="<?php echo $slide['title'] ?>" />
						</label>
					</p>		
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-upload">
							Upload Image<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-upload" class="input-small input-upload" value="<?php echo $slide['upload'] ?>" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][upload]">
							<a href="#" class="aq_upload_button button" rel="img">Upload</a>
							<p></p>
						</label>
					</p>					
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-caption">
							Caption<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-caption" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][caption]" value="<?php echo $slide['caption'] ?>" />
						</label>
					</p>
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
			
		}
		
		function add_slide() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$slide = array(
				'title' => 'New Image',
				'upload' => '',
				'caption' => '',				
				'embed' => ''
			);
			
			if($count) {
				$this->slide($slide, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function block($instance) {
			
			extract($instance);				
			global $icy_options; 		
							

			if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>';
			
			$output = '';
			if($slides) {
				$rand = rand(1,100);

				?>
				<?php 								
												
					$output .= '<ul class="gallery-images">';
					
					if ($slides) {
					
						foreach ($slides as $i=>$slide) {
						
							$output .= '<li class="image image-'.$i. ' ' . $columns . '">';
								
								if(!empty($slide['upload'])) {
								
									$image = $slide['upload'];
									$caption_content = $slide['caption'];										
									$output .= '<a href="'.$image.'"  title="'.$caption_content.'">';
									$output .= '<img src="'.$image.'" alt="'.$caption_content.'"/>';
									$output .= '</a>';
																	
								}
								
							$output .= '</li>';
						}	
					}
					
					$output .= '</ul>';																														
			}
			
			echo $output;
			
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}			
	}
}