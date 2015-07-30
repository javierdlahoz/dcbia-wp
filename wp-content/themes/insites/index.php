<?php

$url = $_SERVER["REQUEST_URI"];
if($url == "/about/testimonials/"){
    require_once 'testimonials.php';
    exit();
}

get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
<?php get_footer(); ?>