<?php
/**
 * File: single.php
 * This file is used to display a single post.
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

    <section class="primary wrapper">

        <section class=" content span8 icy-blogposts-wrapper icy-block" role="main">   		

		<ul class="posts-list blogposts-grid row-fluid">	
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	            
	            <?php get_template_part('includes/post', 'content'); ?>	     

			<?php endwhile; ?>
		</ul>
			
		<!--BEGIN .navigation-->
		<div class="navigation-posts">
	    
			<div class="nav-prev"><?php previous_post_link(__('%link', 'framework'), __('Previous: %title', 'framework')); ?></div>
			<div class="nav-next"><?php next_post_link(__('%link', 'framework'), __('Next: %title', 'framework')); ?></div>
	        
		<!--END .navigation-->
		</div>

			<div class="row-fluid">
				<?php comments_template('', true); ?>			
			</div>


		

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

		<?php endif; ?>

	<!--END #content -->
	</section>

    <?php get_sidebar(); ?>     

<!--END #primary -->
</section>


<?php get_footer(); ?>