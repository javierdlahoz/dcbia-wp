<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
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
        <div class="committees">
                <div class="col-md-6">
                    <h4>Capital Markets</h4> 
                    <p>Provides roundtable discussions on current and future capital markets, financing trends, and current project financing. Evaluates federal/local legislative/regulatory proposals and government policies relating to financing issues. Organizes Annual Capital Markets Seminar.</p>

                    <h5>Co-Chairs:</h5>
                    <p>Brian Berry | Oak Point Investors</p>
                    <p>Kent Marquis | StonebridgeCarras</p>

                    <h5>DLD Vice Chair:</h5>
                    <p>Jeffrey Chod | Tishman Speyer</p> 
                </div>
        </div>
    </div>
</div>
<?php get_footer(); 
