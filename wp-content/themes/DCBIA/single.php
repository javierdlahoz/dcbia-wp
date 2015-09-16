<?php 
use Member\Helper\MemberHelper;
use INUtils\Entity\PostEntity;
use Staff\Helper\StaffHelper;

$p = new PostEntity(get_the_ID());

if($p->getType() == StaffHelper::STAFF_POST_TYPE){
    header('location: /about/staff');
}
elseif(!MemberHelper::isCurrentAccountActive()){
    header('location: /renewal');
}
get_header(); ?>
<?php the_content(); ?>
<?php get_footer();