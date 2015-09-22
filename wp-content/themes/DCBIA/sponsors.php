<?php
use INUtils\Entity\PostEntity;
use Director\Controller\DirectorController;
/*
  Template Name: sponsors
*/
$pageEntity = new PostEntity(get_the_ID());
$boards = DirectorController::getSingleton()->getAll();
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="sponsors"]'); ?>
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
        <div class="col-md-12 board">
            <a class="button2" href="">
                <i class="fa fa-file-pdf-o"></i>
            </a>
        </div>
    </div>

</div>
<?php get_footer(); 
