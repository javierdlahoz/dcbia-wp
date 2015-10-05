<?php
use INUtils\Entity\PostEntity;
use Director\Controller\DirectorController;
use Board\Controller\BoardController;
use INUtils\Helper\TextHelper;
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
            <p>The execution of DCBIA’s advocacy and member service functions is broadly overseen by an elected Board of Directors comprising a virtual who’s who of Washington real estate. Closer oversight is exercised through regularly scheduled meetings of the twelve-member Executive Committee of the board, which includes the elected officers of the association and special presidential appointees.</p>
        </div>    
    </div>
    <div class="row about">
        <?php foreach (BoardController::getSingleton()->getAll() as $member): ?>
        <div class="col-sm-3 staff-pic board-members">
            <?php if($member->getImage() == ""): ?>
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/place-holder.jpg" alt="Board memeber" />
            <?php else: ?>
                <img class="img-responsive" src="<?php echo $member->getImage(); ?>" alt="<?php echo $member->getTitle(); ?>" />
            <?php endif;?>
            <h4 class="heading-top-space"><?php echo $member->getTitle(); ?></h4>
            <h5><?php echo $member->getJobTitle(); ?></h5>  
            <p><?php echo TextHelper::cropText($member->getContent()); ?></p>
        </div>
        <?php endforeach;?>    
    </div>        
    <br>
    <div class="row">
        <div class="col-md-12 about board-list">
            <?php echo $pageEntity->getContent(); ?>
        </div>
    </div>

</div>
<?php get_footer(); 
