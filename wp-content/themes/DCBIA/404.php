<?php

if(strpos($_SERVER['REQUEST_URI'], "/board/") >= 0){
    header('location: /about/board');
}

get_header();
?>
<img src="<?php echo get_template_directory_uri() ;?>/404.jpg" alt="Page Not Found (404)." style="left: 10%; top: 15%; width: 100%;">
<?php
get_footer();