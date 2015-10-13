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
            <p>DCBIA (District of Columbia Building Industry Association) builds leaders, community, partnership and the economy for our vibrant city through content-rich programs, networking and education.</p>
            <p>With a membership of nearly 500 companies and organizations and several thousand real estate professionals, DCBIA members represent all aspects of real estate development including developers, general contractors, architects and engineers, lenders, attorneys, brokers, title companies, utility companies, and community development organizations.</p>
            <p>DCBIA represents the interests and views of its members before the District of Columbia and the federal governments, community organizations and other business associations. As a service organization, it offers comprehensive educational programs, social events and community service activities. DCBIA’s extensive committee structure invites direct member participation in the shaping of association and business community positions on key issues impacting the economic health and governance of Washington, DC. </p>
            <br>
        </div>    
    </div>
    <div class="row about">
        <div class="col-md-12 about">
            <h3>2015 Officers</h3>
            <br>
        </div>
        <?php foreach (BoardController::getSingleton()->getAll() as $member): ?>
        <div class="col-sm-3 staff-pic board-members">
            <?php if($member->getImage() == ""): ?>
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/avatar.jpg" alt="Board memeber" />
            <?php else: ?>
                <img class="img-responsive" src="<?php echo $member->getImage(); ?>" alt="<?php echo $member->getTitle(); ?>" />
            <?php endif;?>
            <h4 class="heading-top-space"><a href="<?php echo $member->getUrl(); ?>"><?php echo $member->getTitle(); ?></a></h4>
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
