<?php 
/*
	Template Name: Page /w Left Sidebar
*/?>

<?php
/**
 * File: template-pagewithsidebar.php
 * This file is used to display a page with sidebar on the left instead of a full-width page
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman 
 *
 * @since		Icy Framework 1.0
 */
?>

<?php get_header(); ?>

<!-- START #main-container -->
<section class="row-fluid main-container">

	<section class="wrapper primary">

		<div class="left-side">
			<?php get_sidebar(); ?>  
		</div>
		
		<section class="span8 content">		

		<?php 			
          
    	if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        	<!--BEGIN article -->
        	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       

	            <!--BEGIN .entry-content -->
	            <div class="entry-content">	            
	                        
	                <?php the_content(); ?>

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
	                            
	           <!--END .entry-content -->
	            </div>	

	        </article>		

			<?php endwhile; ?>			

			<?php comment_form(); ?>

			<?php else : ?>

			<!--BEGIN #post-0-->
			<div id="post-404" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
			
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				<!--END .entry-content-->
				</div>
			
			<!--END #post-0-->
			</div>

			</article>
			<?php endif; ?>

		</section>		
	
	</section>	

<?php get_footer(); ?>