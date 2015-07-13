<?php

global $icy_options;

if(!class_exists('ICY_Events_Block')) {
	class ICY_Events_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(				
				'name' => 'Event',
				'size' => 'span12',							
			);
			
			//create the block
			parent::__construct('icy_events_block', $block_options);
		}

		function form($instance) {
			
			$defaults = array(			
				'itemno' => '',	
				'types'	=> '',
				'see_all' => 'See All',				
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);							
		
			if ( is_multisite() && (is_plugin_active_for_network('the-events-calendar/the-events-calendar.php') == true)) {
				echo __('Sorry, this block requires the <a href="http://wordpress.org/extend/plugins/the-events-calendar/">Events Calendar</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'framework');
				return false;
			}

			if (!is_plugin_active('the-events-calendar/the-events-calendar.php')) {
				echo __('Sorry, this block requires the <a href="http://wordpress.org/extend/plugins/contact-form-7/">Events Calendar</a> plugin to be installed & activated. Please install/activate the plugin before using this block', 'framework');
				return false;
			}
			?>

			<?php
			$output_categories = array();
			$terms = get_categories('taxonomy=tribe_events_cat&type=tribe_events'); 
	        foreach ( $terms as $term ) {
	        	$output_categories[$term->cat_ID] = $term->name;
    		}	  
			?>
		

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('see_all') ?>">
					See All Text<br/>
					<?php echo aq_field_input('see_all', $block_id, $see_all) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('itemno') ?>">
					Number of Items (-1 for All)<br/>
					<?php echo aq_field_input('itemno', $block_id, $itemno, $size = 'full'); ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('types') ?>">
					Events Categories (for all leave blank)<br/>
				<?php echo aq_field_multiselect('types', $block_id, $output_categories, $types); ?>
				</label>
			</p>	
					
			<?php			
		}
		
		function block($instance) {
			extract($instance);		
			global $icy_options; 
                                
			?>				

			<section class="icy-events-wrapper icy-block">

			<?php if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>'; ?>		     	            
				
				<?php 				
				$type = 'tribe_events';

			    $args=array(
				    'post_type' => $type,
			        'posts_per_page' => $itemno,
			        'orderby' => 'event_date',
			        'order' => 'ASC',	
			        /*'tax_query' => array(
				        array(
				            'taxonomy' => 'tribe_events_cat',
				            'field' => 'id',
				            'terms' => $types
				        )
				    )*/		        
			    );	

			    if(!empty($types)) {
			    	$args['tax_query'] = array(
			    			array(
			    				'taxonomy' => 'tribe_events_cat',
			    				'field' => 'id',
			    				'terms' => $types
			    			)
			    	);
			    }		 
			    
			    wp_reset_query(); 			   
			    global $post;
			    $query = new WP_Query( $args );                            
	            $counter = 1; ?>

	            <div class="icy-eventslider-navigation">
	   				<ul class="slides">

	   				<?php	           

		            if($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post(); 	                    
		                $postid = $post->ID;		    
					    // Getting all the Meta Information to be displayed
				        $start_day    	= tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'd'); // Day    
				        $start_day_r2   = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'M'); // Month			        			       

	    				?>
		    				<li class="icy-eventslider-day">
		    					<span class="day-number"><?php echo $start_day; ?></span>
		    					<span class="month"><?php echo $start_day_r2; ?></span>
		    				</li>	    								
						<?php 	                

	            		$counter++;
	        			endwhile; 					
					endif;

					?>						
				
					</ul>
					<div class="icy-eventslider-day see-all">
							<?php
								$event_url = tribe_get_events_link();
							?>
							<a href="<?php echo $event_url; ?>" title="<?php echo $see_all; ?>"><span class="text"><?php echo $see_all; ?></span></a>
							<span class="icy-button icon-next"></span>
					</div>
				</div>

				<div class="icy-eventslider">
					<ul class="slides">

						<?php
						wp_reset_query(); 
					    global $post;
					    $query = new WP_Query( $args );   

					    if($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();

					    // Getting all the Meta Information to be displayed
        				$start_day    	= tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'l jS');    
        				$start_day_r2   = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'F Y'); 
        				if (!tribe_event_is_all_day()) {
        					$end_day    	= tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'l jS');    
        					$end_day_r2   	= tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'F Y'); 
        					$hour_start     = tribe_get_start_date($event = null, $displayTime = true, $dateFormat = ' ');   
        					$hour_end		= tribe_get_end_date($event = null, $displayTime = true, $dateFormat = ' ');
        				}

				        $address = tribe_get_address(); 
        				$city	 = tribe_get_city();
        				$country = tribe_get_country();    
        				$cost 	 = tribe_get_cost(null, true);    
					    ?>

					    <li class="icy-eventslider-content">
					    	<div class="picture">
					    		<?php the_post_thumbnail('thumbnail-events-slider'); ?>
					    	</div>
					    	<div class="text">
					    		<a href="<?php the_permalink(); ?>"><h1 class="event-title">
					    			<?php the_title(); ?>
					    		</h1>
					    		</a>
					    	</div>
					    	<article class="content">					    		
					    		<span class="meta day">
					    			<?php echo $start_day . ', ' . $start_day_r2;	?>
					    			<span class="icy-button icon-time"></span>
					    		</span>
					    		
					    		<span class="meta address">
					    			<?php echo $address . ', ' . $city; ?>
					    			<span class="icy-button icon-location"></span>
					    		</span>
					    		<span class="meta cost">
					    			<?php echo $cost; ?>
					    			<span class="icy-button icon-pricetag"></span>
					    		</span>
					    	</article>


					    </li>

					    <?php	endwhile; 					
						endif;
						wp_reset_query(); 
						?>

					</ul>
				</div>
            	
		
			</section>
													          
			<?php			
		}

		function update($new_instance, $old_instance) {
			$new_instance['categories'] = htmlspecialchars(stripslashes($new_instance['categories']));
			return $new_instance;
		}
		
	}
}