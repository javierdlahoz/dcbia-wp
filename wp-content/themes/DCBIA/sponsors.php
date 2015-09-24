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
            <h4>SEMINARS &amp; PROGRAMS</h4>

            <p>DCBIA seminars and programs are content-rich, led by the best and brightest of the DC real estate development industry. Designed to educate and inform real estate development professionals of the latest market forecasts, developing trends, and capital markets, our programs and seminars also inform members of the changes in the DC legislation and regulatory environment that affect both residential and commercial development.</p>
            <a class="button2" href="">
                <i class="fa fa-file-pdf-o"></i>
            </a>
        </div>
    </div>

</div>
<?php get_footer(); 
