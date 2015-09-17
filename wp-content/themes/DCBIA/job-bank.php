<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
/*
  Template Name: job-bank
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="job-bank"]'); ?>
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
        <div class="col-md-6">
            <div class="committees">
                <h4>Capital Markets</h4> 
                <p>Provides roundtable discussions on current and future capital markets, financing trends, and current project financing. Evaluates federal/local legislative/regulatory proposals and government policies relating to financing issues. Organizes Annual Capital Markets Seminar.</p>

                <div class="col-md-12 board">
                    <a class="button2" href="<?php echo $board->getFileUrl(); ?>">
                        <i class="fa fa-file-pdf-o"></i><?php echo $board->getTitle(); ?>
                    </a>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); 
