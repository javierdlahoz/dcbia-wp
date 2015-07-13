<?php
/** Slider Block **/
if(!class_exists('ICY_Slider_Normal_Block')) {
	class ICY_Slider_Normal_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name'			=> 'Slider',
				'size'			=> 'span6',				
			);
			
			parent::__construct('icy_slider_normal_block', $block_options);
			
			add_action('wp_ajax_aq_block_slider_add_new', array($this, 'add_slide'));
		}
		
		function form($instance) {
			$defaults = array(
				'slides'		=> array(
					1 => array(
						'title' => 'My New Slide',
						'upload' => '',
						'caption' => '',						
						'embed' => ''
					)
				),
				'slider' => '',				
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
				'title' => '',
				'upload' => '',
				'caption' => '',	
				'textbgcolor' => '#ef3f42',	
				'textfgcolor' => '#ffffff',					
				'embed' => '',
				'html' => ''
			);
			$slide = wp_parse_args($slide, $defaults);
			
			?>
			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
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
					<div class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-textbgcolor">
							Caption Background Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-textbgcolor" class="input-color-picker" value="<?php echo $slide['textbgcolor'] ?>" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][textbgcolor]" data-default-color="<?php echo $slide['textbgcolor'] ?>" />
							</div>
						</label>						
					</div>
					<div class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-textfgcolor">
							Caption Text Color<br/>
							<div class="aqpb-color-picker">
								<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-textfgcolor" class="input-color-picker" value="<?php echo $slide['textfgcolor'] ?>" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][textfgcolor]" data-default-color="<?php echo $slide['textfgcolor'] ?>" />
							</div>
						</label>						
					</div>
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-embed">
							Embed Code (optional, will override image)<br/>
							<textarea id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-embed" class="textarea-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][embed]" rows="5"><?php echo $slide['embed'] ?></textarea>
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-html">
							Custom HTML (optional, will override embed &amp; image)<br/>
							<textarea id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-html" class="textarea-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][html]" rows="5"><?php echo $slide['html'] ?></textarea>
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
				'title' => 'New Slide',
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

			wp_enqueue_script('flexslider');
			wp_enqueue_style('flexslider_css');	
							

			if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>';
			
			$output = '';
			if($slides) {
				$rand = rand(1,100);

				?>
				<?php 								
					
				$output .= '<div class="flexslider loading">';
					
					$output .= '<ul class="slides">';
					
					if ($slides) {
					
						foreach ($slides as $i=>$slide) {
						
							$output .= '<li class="slide slide-'.$i.'">';
								
								if(!empty($slide['embed'])) {
									wp_enqueue_script('fitvids');
									
									$output .= '<div class="fitvids">';
										$output .= htmlspecialchars_decode(stripslashes($slide['embed']));
									$output .= '</div>';
									
								} elseif(!empty($slide['html'])) {
									
									$output .= '<div class="slide-html row cf">';
										$output .= do_shortcode(htmlspecialchars_decode(stripslashes($slide['html'])));
									$output .= '</div>';
									
									if(!empty($slide['upload'])) {
										$output .= '<style>';
											$output .= '.post-slider-'.$rand.' .slide-'.$i.'{';
												$output .= 'background:url('.$slide['upload'].');';
											$output .= '}';
										$output .= '</style>';
									}	
									
								} elseif(!empty($slide['upload'])) {
								
									$image = $slide['upload'];
									$output .= '<img src="'.$image.'"/>';
								
									if(!empty($slide['caption'])) {
										$caption_content = $slide['caption'];										
										$text_bg = $slide['textbgcolor'];
										$text_fg = $slide['textfgcolor'];	
										
											$output .= '<div class="flex-caption">';
												$output .= '<h2 class="caption-title" style="background-color: '. $text_bg .'; color: '. $text_fg .' ;">' . htmlspecialchars_decode($caption_content) . '</h2>';												
											$output .= '</div>';

									}
								}
								
							$output .= '</li>';
						}	
					}
					
					$output .= '</ul>';										
					
				$output .= '</div>';
													
			}
			
			echo $output;
			
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}			
	}
}