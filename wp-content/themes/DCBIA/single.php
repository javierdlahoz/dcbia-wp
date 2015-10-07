<?php 
use Member\Helper\MemberHelper;
use INUtils\Entity\PostEntity;
use Staff\Helper\StaffHelper;
use Director\Helper\DirectorHelper;

$p = new PostEntity(get_the_ID());

if($p->getType() == StaffHelper::STAFF_POST_TYPE){
    header('location: /about/staff');
}
elseif($p->getType() == "post"){
    require_once __DIR__.'/single-blog.php';
    exit();
}
elseif($p->getType() == "issue" || $p->getType() == "resource"){
    header('location: /advocacy');
}
elseif($p->getType() == "job"){
    header('location: /job-bank');
}
elseif($p->getType() == "sponsor"){
    header('location: /sponsors');
}
elseif($p->getType() == "board_member"){
    header('location: /about/board');
}
elseif(!MemberHelper::isCurrentAccountActive()){
    header('location: /renewal');
}
get_header(); ?>
<?php the_content(); ?>
<?php get_footer();