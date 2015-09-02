<?php 
use Member\Helper\MemberHelper;
get_header(); 
var_dump(MemberHelper::isCurrentAccountActive()); die();
?>
<?php the_content(); ?>
<?php get_footer();