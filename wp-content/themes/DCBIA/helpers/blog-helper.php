<?php 

use SFUtils\Helper\TextHelper;

include __DIR__."/front-page-helper.php";

const NUMBER_OF_BLOG_POST = 10;
function get_blog_posts() {

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if(isset($_GET["blog_page"])){
		$paged = $_GET["blog_page"];
	}
	else{
		$paged = 1;
	}
	
	$orderBy = "date";
	$order = "DESC";
	
    $args = array(
        'posts_per_page' => NUMBER_OF_BLOG_POST,
        'orderby' => $orderBy,
        'order' => $order,
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true,
    	'paged' => $paged
    );
    
    if(isset($_POST['expression'])){
    	$args["s"] = $_POST["expression"];
    }

    $postList = new \WP_Query($args);
    
    $posts = null;
    while ($postList->have_posts()) {
        $post = $postList->next_post();

        $posts[] = array(
            'id'        => $post->ID,
            'title'     => $post->post_title,
        	'date'		=> get_the_date("F j, Y", $post->ID),
            'url'       => get_permalink($post->ID),
            'content'   => TextHelper::cropText(avoid_first_image($post->post_content)),
            'image'     => get_image($post->post_content)
        );
    }

    return array(
    		"posts" => $posts,
    		"page"  => $paged,
    		"resultNumber" => $postList->found_posts,
    		"pages" => $postList->max_num_pages
    );
}