<?php 

/**
 * File: archive.php
 * This file is used to display an archive of the posts.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 *
 * @since		Icy Framework 1.0
 */

get_header(); ?>  

<?php
	/* Fetching the Current Author Data */ 
	if(get_query_var('author_name')) :
		$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
		$curauth = get_userdata(get_query_var('author'));
	endif;
?>

<!-- START #main-container -->
<section class="row-fluid main-container">

	<!-- START .wrapper -->
    <section class="wrapper primary">

    	<!-- START .content -->
        <section class="content span8 icy-blogposts-wrapper icy-block" role="main">   	

			<ul class="posts-list blogposts-grid row-fluid">	 
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	            
	            <?php get_template_part('includes/post', 'content'); ?>

			<?php endwhile; 
				wp_reset_query(); ?>
			</ul>	

			<?php if (function_exists('wp_pagenavi')) { ?> <div class="row-fluid"><?php wp_pagenavi(); ?></div> <?php } else { ?>
				<!--BEGIN .navigation-->
				<div class="navigation-posts row-fluid">
						    
						<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
						<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>			       
				<!--END .navigation-->
				</div>
			<?php } ?>

			<?php else : ?>			

			<?php if ( is_category() ) { 
				// If this is a category archive
					printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'framework'), single_cat_title('',false));
				} elseif ( is_tag() ) { 
				// If this is a tag archive
				    printf(__('<h2>Sorry, but there aren\'t any posts tagged %s yet.</h2>', 'framework'), single_tag_title('',false));
				} elseif ( is_date() ) { 
				// If this is a date archive
					echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'framework'));
				} elseif ( is_author() ) { 
				// If this is a category archive
					$userdata = get_userdatabylogin(get_query_var('author_name'));
					printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'framework'), $userdata->display_name);
				} else {
					echo(__('<h2>No posts found.</h2>', 'framework'));
				}
			endif; ?>

		<!--END .content  -->
		</section>

    <?php get_sidebar(); ?>     

	<!--END .primary -->
	</section>

<?php get_footer(); ?>