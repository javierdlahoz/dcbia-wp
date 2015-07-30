<?php

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/min/bootstrap.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

add_theme_support( 'post-thumbnails' );

//add re-write rules for blog permalinks

function add_rewrite_rules( $wp_rewrite )
{
	$new_rules = array(
		'blog/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
	);

	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');

function change_blog_links($post_link, $id=0){

	$post = get_post($id);

	if( is_object($post) && $post->post_type == 'post'){
		return home_url('/blog/'. $post->post_name.'/');
	}

	return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);
add_action( 'template_redirect', 'wpse_128636_redirect_post' );

function wpse_128636_redirect_post() {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && 'sf-slideshow' ==  $queried_post_type ) {
    wp_redirect( home_url(), 301 );
    exit;
  }
}


if( !function_exists('wp_remove_wp_columns') ):
    function wp_remove_wp_columns( $columns ) {
        unset($columns['tags']);
        return $columns;
    }

    function wp_remove_wp_columns_init() {
        add_filter( 'manage_posts_columns' , 'wp_remove_wp_columns' );
    }
    add_action( 'admin_init' , 'wp_remove_wp_columns_init' );
endif;
