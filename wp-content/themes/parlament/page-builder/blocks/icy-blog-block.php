<?php

global $icy_options;

if(!class_exists('ICY_Block_Block')) {
	class ICY_Blog_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(				
				'name' => 'Blog Posts',
				'size' => 'span6',				
			);
			
			//create the block
			parent::__construct('icy_blog_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(			
				'itemno' => '',
				'types'	=> '',
				'style' => 'hero-view',
				'thumb_style' => 'half',
				'content' => 'excerpt-view',
				
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);			

			$thumb_options = array(
				'half' => 'Two thumbnails in a row',
				'full' => 'One thumbnail in a row'
			);			

			$style_options = array(
				'hero-view' => 'Hero',
				'regular-view' => 'Regular',
				'thumb-view' => 'Thumbnails only',
			);

			$content_options = array(
				'content-view' => 'Content',
				'excerpt-view' => 'Excerpt'
			);

			$output_categories = array();
			$categories=get_categories();
			foreach($categories as $category) { 
			     $output_categories[$category->cat_ID] = $category->name;
			}					
			
			?>
			<?php _e('Recommended minimum size of block: 1/3', 'framework'); ?><br />

			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('itemno') ?>">
					Number of Items (-1 for All)<br/>
					<?php echo aq_field_input('itemno', $block_id, $itemno, $size = 'full'); ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('style') ?>">
					Blog Style<br/>
					<?php echo aq_field_select('style', $block_id, $style_options, $style); ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('thumb_style') ?>">
					Thumbnails per row (Works ONLY with Blog Style : Thumbnails only)<br/>
					<?php echo aq_field_select('thumb_style', $block_id, $thumb_options, $thumb_style); ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Content to be displayed<br/>
					<?php echo aq_field_select('content', $block_id, $content_options, $content); ?>
				</label>
			</p>		
			<p class="description">
				<label for="<?php echo $this->get_field_id('types') ?>">
					Blogs Categories (for all leave blank)<br/>
				<?php echo aq_field_multiselect('types', $block_id, $output_categories, $types); ?>
				</label>
			</p>				
					
			<?php								
		}
		
		function block($instance) {
			extract($instance);		
			global $icy_options; 
                                
			?>			

			<section class="icy-blogposts-wrapper icy-block">

			<?php if($title) echo '<h2 class="icy-block-title">'.strip_tags($title).'</h2>'; ?>
		     
	            <!--Output Blog items-->
	            <ul class="blogposts-grid row-fluid <?php echo $style; ?>">
				
				<?php 				
				$type = 'post';
			    $args=array(
				    'post_type' => $type,
			        'posts_per_page' => $itemno,
			        'orderby' => 'date',
			        'order' => 'DESC',
			    );			    
			    if(!empty($types)) {
			    	$args['tax_query'] = array(
			    			array(
			    				'taxonomy' => 'category',
			    				'field' => 'id',
			    				'terms' => $types
			    			)
			    	);
			    }

			    global $post;			    
			    $query = new WP_Query( $args );                            
	            $counter = 1;

	            if($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post(); 	                
	                
	                $postid = $post->ID;	                

	            switch($style) {
	            	case "hero-view":
	            	?>

	            		<?php if ($counter == 1) { ?> 
	            			<li class="blog-item big-thumbnail">      		                	
		            			<figure class="picture">                								               	
					               	<?php 
				                        the_post_thumbnail('thumbnail-blog-block') ?>  
		            			</figure>      
		            			<section class="post-meta">

		            				<section class="meta">
		            				
		            					<span class="meta-info">
		            						<span class="icon-author"></span>
		            						<?php _e('By', 'framework'); ?> 
		            						<strong><?php the_author_posts_link(); ?></strong>
		            					</span>
											
		            					<span class="meta-info">
		            						<span class="icon-time"></span>
		            						<?php _e('On', 'framework'); ?> 
		            						<strong><?php the_time('j F Y'); ?></strong>
		            					</span>
										
		                				<span class="meta-info">
		                					<span class="icon-category"></span>
		                					<?php _e('In', 'framework'); ?> 
		                					<strong><?php the_category(', '); ?></strong>
		                				</span>                				
		                				<?php if( has_tag() ) { ?>
		                				<span class="meta-info">
		                					<span class="icon-tag"></span>
		                					<?php _e('Tags', 'framework'); ?> 
		                					<strong><?php	the_tags('',', ',''); ?></strong>
		                				</span>
		                				<?php } ?>
		                			</section>

		                			<section class="share">
		                				<span class="icon-sharing">
		                				</span>
		                				<div class="share-icons">
		                					<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon facebook"><?php _e('share', 'framework'); ?></a>
        									<a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon twitter"><?php _e('tweet', 'framework'); ?></a>
        									<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" class="icy-social icon googleplus"><?php _e('+1', 'framework'); ?></a>
		                				</div>
		                				<span class="icon-comments">	                				
		                				</span>
		                				<span class="comment-count"><?php comments_popup_link('0', '1', '%'); ?></span>

		                				<?php edit_post_link( '', '<span class="icon-editpost">', '</span>' ); ?>				
		                			</section>
				                    			                  			                   	
		            			</section>          		
		            			<section class="article-title">                			
		            				<a class="article-link" href="<?php the_permalink(); ?>">
		            					<h1 class="entry-title"><?php the_title(); ?></h1>     
		            				</a>                				                		
		            			</section>    
		            			<article class="article-content">		            			
		            				<?php /* You can modify the Continue Reading text below to suit your needs. */
						            if($content != 'excerpt-view') { 
	            						global $more; $more = 0; 			                    
	            						the_content(__('Continue Reading', 'framework')); 
	            					} else {		            				
	            						the_excerpt();
	            					} ?>
		            			</article>
			                </li>
	            		<?php } else { ?>
	            			<?php if ($counter % 2 == 0) { ?>
	            				</ul><ul class="blogposts-grid row-fluid <?php echo $style; ?>">
	            			<?php } ?>
	            			<li class="blog-item span6 small-thumbnail">
	            					            			      		                	
		            			<figure class="picture">                								               	
					               	<?php the_post_thumbnail( 'thumbnail-blog-block' ); ?>
		            			</figure>      
		            			
		            			<section class="post-meta">

		            				<section class="meta">
											
		            					<span class="meta-info">
		            						<span class="icon-time"></span>
		            						<?php _e('On', 'framework'); ?> 
		            						<strong><?php the_time('j M Y'); ?></strong>
		            					</span>

		            					<span class="meta-info">
		            						<span class="icon-author"></span>
		            						<?php _e('By', 'framework'); ?> 
		            						<strong><?php the_author_posts_link(); ?></strong>
		            					</span>
										
		                			</section>

		                			<section class="share">
		                				<span class="icon-sharing">
		                				</span>
		                				<div class="share-icons">
		                					<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon facebook"><?php _e('share', 'framework'); ?></a>
        									<a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon twitter"><?php _e('tweet', 'framework'); ?></a>
        									<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" class="icy-social icon googleplus"><?php _e('+1', 'framework'); ?></a>
		                				</div>
		                			</section>
				                    			                  			                   	
		            			</section>          		
		            			<section class="article-title">                			
		            				<a class="article-link" href="<?php the_permalink(); ?>">
		            					<h1 class="entry-title"><?php the_title(); ?></h1>     
		            				</a>                				                		
		            			</section>    
			                </li>			                

	            		<?php } ?>

	            	  

	            	<?php
	            	break;

	            	case "regular-view":	            
	            	?>
	            	
            			<li class="blog-item big-thumbnail">      		                	
	            			<figure class="picture">                								               	
									<?php 
				                        the_post_thumbnail('thumbnail-blog-block') ?>    
	            			</figure>      
	            			<section class="post-meta">

	            				<section class="meta">
	            				
	            					<span class="meta-info">
	            						<span class="icon-author"></span>
	            						<?php _e('By', 'framework'); ?> 
	            						<strong><?php the_author_posts_link(); ?></strong>
	            					</span>
										
	            					<span class="meta-info">
	            						<span class="icon-time"></span>
	            						<?php _e('On', 'framework'); ?> 
	            						<strong><?php the_time('j F Y'); ?></strong>
	            					</span>
									
	                				<span class="meta-info">
	                					<span class="icon-category"></span>
	                					<?php _e('In', 'framework'); ?> 
	                					<strong><?php the_category(', '); ?></strong>
	                				</span>                				
	                				<?php if( has_tag() ) { ?>
	                				<span class="meta-info">
	                					<span class="icon-tag"></span>
	                					<?php _e('Tags', 'framework'); ?> 
	                					<strong><?php	the_tags('',', ',''); ?></strong>
	                				</span>
	                				<?php } ?>
	                			</section>

	                			<section class="share">
	                				<span class="icon-sharing">
	                				</span>
	                				<div class="share-icons">
	                					<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon facebook"><?php _e('share', 'framework'); ?></a>
        								<a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon twitter"><?php _e('tweet', 'framework'); ?></a>
        								<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" class="icy-social icon googleplus"><?php _e('+1', 'framework'); ?></a>
	                				</div>
	                				<span class="icon-comments">	                				
	                				</span>
	                				<span class="comment-count"><?php comments_popup_link('0', '1', '%'); ?></span>

	                				<?php edit_post_link( '', '<span class="icon-editpost">', '</span>' ); ?>				
	                			</section>
			                    			                  			                   	
	            			</section>          		
	            			<section class="article-title">                			
	            				<a class="article-link" href="<?php the_permalink(); ?>">
	            					<h1 class="entry-title"><?php the_title(); ?></h1>     
	            				</a>                				                		
	            			</section>    
	            			<article class="article-content">		            			
	            				<?php /* You can modify the Continue Reading text below to suit your needs. */
						            if($content != 'excerpt-view') { 
	            						global $more; $more = 0; 			                    
	            						the_content(__('Continue Reading', 'framework')); 
	            					} else {		            				
	            						the_excerpt();
	            					} ?>
	            			</article>
		                </li>	            		

	            	<?php 
	            	break;

	            	case "thumb-view": ?>

	            		<?php if (($counter % 2 == 1) && ($thumb_style == 'half')) { ?>
	            			</ul><ul class="blogposts-grid row-fluid <?php echo $style; ?>">
	            		<?php } ?>	            	
	         

	         			<?php $css_style = '';
	         				  if ($thumb_style == 'full') {
	         				  		$css_style = 'span12';
	         				  } else {
	         				  		$css_style = 'span6';
	         				  } ?>
            			<li class="blog-item <?php echo $css_style; ?> small-thumbnail">
            					            			      		                	
	            			<figure class="picture">                								               	
				               	<?php the_post_thumbnail( 'thumbnail-blog-block' ); ?>
	            			</figure>      

	            			<section class="post-meta">

	            				<section class="meta">
										
	            					<span class="meta-info">
	            						<span class="icon-time"></span>
	            						<?php _e('On', 'framework'); ?> 
	            						<strong><?php the_time('j M Y'); ?></strong>
	            					</span>

	            					<span class="meta-info">
	            						<span class="icon-author"></span>
	            						<?php _e('By', 'framework'); ?> 
	            						<strong><?php the_author_posts_link(); ?></strong>
	            					</span>
									
	                			</section>

	                			<section class="share">
	                				<span class="icon-sharing">
	                				</span>
	                				<div class="share-icons">
	                					<a onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon facebook"><?php _e('share', 'framework'); ?></a>
        								<a onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?>%20-%20<?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon twitter"><?php _e('tweet', 'framework'); ?></a>
        								<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" class="icy-social icon googleplus"><?php _e('+1', 'framework'); ?></a>
	                				</div>
	                			</section>
			                    			                  			                   	
	            			</section>          		
	            			<section class="article-title">                			
	            				<a class="article-link" href="<?php the_permalink(); ?>">
	            					<h1 class="entry-title"><?php the_title(); ?></h1>     
	            				</a>                				                		
	            			</section>    
		                </li>
	            			

	            	<?php
	            	break;

	            	case "default":
	            	break;
	            } ?>								            	                  				       
					
					<?php 
	                
            		$counter++;
        			endwhile; 
					wp_reset_query(); 
				endif;

				?>
            	</ul>
		
			</section>
													          
			<?php
		}
		
		function update($new_instance, $old_instance) {
			$new_instance['itemno'] = htmlspecialchars(stripslashes($new_instance['itemno']));
			return $new_instance;
		}
		
	}
}