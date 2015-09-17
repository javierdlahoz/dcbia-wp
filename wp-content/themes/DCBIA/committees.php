<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
use Committee\Controller\CommitteeController;
use INUtils\Helper\TextHelper;
/*
  Template Name: committees
*/
$pageEntity = new PostEntity(get_the_ID());
$staffs = StaffController::getSingleton()->getAll();
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
        <?php foreach (CommitteeController::getSingleton()->getAll() as $committee): ?>
        <div class="col-md-6">
            <div class="committees">
                <h4><?php echo $committee->getTitle(); ?></h4> 
                <p><?php echo TextHelper::cropText($committee->getContent(), 400); ?></p>

                <h5>Co-Chairs:</h5>
                <p><?php echo $committee->getCoChairs(); ?></p>

                <h5>DLD Vice Chair:</h5>
                <p><?php echo $committee->getViceChairs(); ?></p> 
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer(); 
