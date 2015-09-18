<?php
use INUtils\Entity\PostEntity;
use Director\Controller\DirectorController;
use INUtils\Helper\TextHelper;
/*
  Template Name: media
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="media"]'); ?>
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
        <?php foreach (DirectorController::getSingleton()->getAllMedia() as $media): ?>
        <div class="col-md-4">
            <div class="media">
                <h4><?php echo $media->getTitle(); ?></h4> 
                <h5><?php echo mysql2date("F j, Y", $media->getDate()); ?></h5>
                <p><?php echo TextHelper::cropText($media->getContent(), 200); ?></p>
                <div class="board">
                    <a class="button2" href="<?php echo $media->getFileUrl(); ?>"><i class="fa fa-file-pdf-o"></i>Download press release here!</a>
                </div> 
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer(); 
