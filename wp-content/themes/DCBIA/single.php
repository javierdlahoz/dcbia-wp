<?php 
use Member\Helper\MemberHelper;
if(!MemberHelper::isCurrentAccountActive()){
    header('location: /renewal');
}
get_header(); ?>
<?php the_content(); ?>
<?php get_footer();