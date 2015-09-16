<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
/*
  Template Name: board
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="about"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 

<!--start main content here-->

<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about">   
            <h2><?php echo $pageEntity->getTitle(); ?></h2>
            <p><?php echo $pageEntity->getContent(); ?></p>
        </div>    
    </div>

    <div class="row">
        <div class="col-12 board">
            <h4><?php echo $staff->getTitle(); ?></h4> 
            <p><?php echo $staff->getContent(); ?></p>
            <a class="button1" href="mailto:<?php echo $staff->getEmail(); ?>">Contact</a>
        </div>
    </div>

</div>
<?php get_footer(); 
