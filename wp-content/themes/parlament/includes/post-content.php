<?php 

/**
 * The Post Content Template part
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */

/**
 * Outputs all the data regarding a blog post. 
 * Helper template part. Doesn't overcrowd other files with this piece of code.
 *
 * @return  string HTML
 * @uses get_template_part();
 * @uses get_post_format();
 */

?>

            <!--BEGIN .post -->
            <li <?php post_class('blog-item big-thumbnail'); ?> id="post-<?php the_ID(); ?>">                       

                <!--BEGIN .entry-content -->
                <div class="entry-content">			                
			
    			<figure class="picture">                								               	
	               	<?php 
                        $format = get_post_format();
                        if( false === $format ) { $format = 'standard'; }
                    ?>                 

                    <!-- Post Format Element-->
                    <?php get_template_part( 'post', $format ); ?>  
    			</figure>      

                <?php 
                /**
                 * Meta Information related to the post. Date, Category, Author and Tags.                 
                 *
                 * @return  string HTML
                 * @uses the_time(); 
                 * @uses the_author_posts_link();
                 * @uses the_tags();
                 * @uses the_category();
                 */ 
                ?>
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
                <?php 
                /**
                 * Article Title and Content
                 *
                 * @return  string HTML                                  
                 * @uses the_title();
                 * @uses the_content();
                 */ 
                ?>       		
    			<section class="article-title">                			
    				<a class="article-link" href="<?php the_permalink(); ?>">
    					<h1 class="entry-title"><?php the_title(); ?></h2>     
    				</a>                				                		
    			</section>    
    			<article class="article-content">		            			
                    <?php /* You can modify the Continue Reading text below to suit your needs. */ ?>
    				<?php the_content(__('Continue Reading', 'framework')); ?>
    			</article>		        				    	                               		                                              
                <?php
                    $args = array(
                        'before'           => '<p class="pagenavi"><span class="desc">' . __( 'Pages:' ) . '</span>',
                        'after'            => '</p>',
                        'link_before'      => '',
                        'link_after'       => '',
                        'next_or_number'   => 'number',
                        'separator'        => '</span><span>',
                        'nextpagelink'     => __( 'Next page' ),
                        'previouspagelink' => __( 'Previous page' ),
                        'pagelink'         => '%',
                        'echo'             => 1
                    );
                     wp_link_pages($args); ?>
			<!--END .post-->  
			</li>