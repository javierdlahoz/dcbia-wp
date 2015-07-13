<?php

global $icy_options;

if(!class_exists('ICY_Carousel_Block')) {
	class ICY_Carousel_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(				
				'name' => 'Latest Posts/Events',
				'size' => 'span12',
				'resizable' => 0				
			);
			
			//create the block
			parent::__construct('icy_carousel_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => 'Latest Posts',			
				'style' => 'post',	
				'categories' => array(),
				'ordering' => 'DESC'											
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);			
			
			$style_options = array(
				'post' => 'Posts',
				'tribe_events' => 'Events',						
			);		

			$ordering_options = array(
				'ASC' => 'Ascending',
				'DESC' => 'Descending',
			);

			$post_categories = ($temp = get_terms('category')) ? $temp : array();
			$categories_options = array();
			foreach($post_categories as $cat) {
				$categories_options[$cat->term_id] = $cat->name;
			} 

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('style') ?>">
					What to display:<br/>
					<?php echo aq_field_select('style', $block_id, $style_options, $style); ?>
				</label>
			</p>	

			<p class="description half last">
				<label for="<?php echo $this->get_field_id('ordering') ?>">
					Order of display:<br/>
					<?php echo aq_field_select('ordering', $block_id, $ordering_options, $ordering); ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('categories') ?>">
				Posts Categories (leave empty to display all)<br/>
				<?php echo aq_field_multiselect('categories', $block_id, $categories_options, $categories); ?>
				</label>
			</p>

			<?php
		}
		
		function block($instance) {
			extract($instance);		
			global $icy_options; 

			$orderby = '';

			if ($style == 'post') { $orderby == 'date'; } else { $orderby == 'event_date'; }
			?>	

			<section class="icy-posts-carousel icy-block row-fluid">

				<div class="span3">

					<?php if($style == 'post') { echo '<span class="icy-button icon-book"></span>'; } else { echo '<span class="icy-button icon-calendar"></span>'; } ?>
					<?php if($title) echo '<h2 class="icy-carousel-title '. $style .'">'.strip_tags($title).'</h2>'; ?>

				</div>
		    
	            <!--Output Blog items-->
	            <ul class="carousel-grid span9">
				
				<?php 				
				$type = 'post';
			    $args=array(
				    'post_type' => $style,
			        'posts_per_page' => 3,
			        'orderby' => $orderby,
			        'order' => $ordering,
			    );	

			    if($categories) $args['category__in'] = $categories;	    			    

			    global $post;			    
			    $query = new WP_Query( $args );                            
	            $counter = 1;

	            if($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post(); 	                
	                
	                $postid = $post->ID;	                

	            switch($style) {
	            	case "post":
	            	?>	            		
        			<li class="blog-item span4 startAnimation"> 

        				<a class="article-link" href="<?php the_permalink(); ?>"><span class="hover"></span></a>                				                

	        			<figure class="picture">                								               	
			               	<?php the_post_thumbnail( 'thumbnail-carousel-block' ); ?>
	        			</figure>       		                	
        				<section class="article-title">                			
            				<a class="article-link" href="<?php the_permalink(); ?>">
            					<h1 class="entry-title"><?php the_title(); ?></h1>     
            				</a>                				                		
            			</section>    
            		
            			<section class="post-meta">

            				<section class="meta">
            				            						
            					<span class="meta-info">            						          					
            						<?php the_time('j F Y'); ?>
            					</span>
								                				                					                				                				                				
                			</section>                			
		                    			                  			                   	
            			</section>          		
            			
						    
	                </li>
        	    	  
	            	<?php
	            	break;
	            	case "tribe_events":
	            	?>

	            	<?php
					    // Getting all the Meta Information to be displayed
				        $start_day    	= tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'jS M Y');    
				        $end_day   = tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'jS M Y'); 

				        $address = tribe_get_address(); 
				        $city	 = tribe_get_city();
				    ?>

	            	<li class="blog-item span4"> 

        				<a class="article-link" href="<?php the_permalink(); ?>"><span class="hover"></span></a>                				                

	        			<figure class="picture">                								               	
			               	<?php the_post_thumbnail( 'thumbnail-carousel-block' ); ?>
	        			</figure>       		                	
        				<section class="article-title">                			
            				<a class="article-link" href="<?php the_permalink(); ?>">
            					<h1 class="entry-title"><?php the_title(); echo " / " . $address . " / " . $city; ?></h1>     
            				</a>                				                		
            			</section>    
            		
            			<section class="post-meta">

            				<section class="meta">
            				            						
            					<span class="meta-info">            						          					
            						<?php if ($start_day != $end_day) {
            							echo $start_day . ' / ' . $end_day; 
            						}
            						else {
            							echo $start_day;
            						}
            						?>
            					</span>
								                				                					                				                				                				
                			</section>                			
		                    			                  			                   	
            			</section>          		            									    
	                </li>

	            	<?php
	            	break;
	          
	            	case "default":
	            	break;
	            } 

    			endwhile; 
				wp_reset_query(); 
			endif;

			?>
        	</ul>
		
			</section>
													          
			<?php
		}	

		function update($new_instance, $old_instance) {
			$new_instance['sorts'] = htmlspecialchars(stripslashes($new_instance['sorts']));
			return $new_instance;
		}	
	}
}