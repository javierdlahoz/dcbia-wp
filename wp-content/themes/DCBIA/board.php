<?php
use INUtils\Entity\PostEntity;
use Director\Controller\DirectorController;
/*
  Template Name: board
*/
$pageEntity = new PostEntity(get_the_ID());
$boards = DirectorController::getSingleton()->getAll();
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="about"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 
<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about">   
            <h2><?php echo $pageEntity->getTitle(); ?></h2>
            <p><?php echo $pageEntity->getContent(); ?></p>
        </div>    
    </div>
    <div class="row about">
        <div class="col-sm-2 staff-pic board-members">
             <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/place-holder.jpg" alt="Board memeber" />
            <h4 class="heading-top-space">Place Holder</h4>
            <h5>Place holder</h5>  
            <p>some text for a placeholder</p>
        </div>    
    </div>        
    <br>
    <div class="row">
        <div class="col-md-12 about">
            <h4>DOWNLOAD THE FOLLOWING PDF'S:</h4>
        </div>
        <?php foreach ($boards as $board): ?>
        <div class="col-md-12 board">
            <a class="button2" href="<?php echo $board->getFileUrl(); ?>">
                <i class="fa fa-file-pdf-o"></i><?php echo $board->getTitle(); ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

</div>
<?php get_footer(); 
