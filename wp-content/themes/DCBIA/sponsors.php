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
        <div class="col-md-12 committees">
            <h4>SEMINARS &amp; PROGRAMS</h4>

            <p>DCBIA seminars and programs are content-rich, led by the best and brightest of the DC real estate development industry. Designed to educate and inform real estate development professionals of the latest market forecasts, developing trends, and capital markets, our programs and seminars also inform members of the changes in the DC legislation and regulatory environment that affect both residential and commercial development.</p>
            
            <br>
            
            <h5>We have customized sponsorship packages available to provide maximum visibility for your company in the DC real estate development industry.</h5>

<p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
            <br>
            <h4>2015-2016 Event Sponsors</h4>
            <div class="sonsors-lower-box">
                <h5>Pinniacle Sponsors</h5>
                <div class="col-md-3">  
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/PGP_logo.gif" alt="Property Group Partners logo" /></a>    
                </div>
                <div class="col-md-3">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/Balfour_logo.gif" alt="Balfour Logo" /></a>    
                </div>    
            </div>
            <br>
            <div class="sonsors-lower-box">
                <h5>Premium Sponsors</h5>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
            <br>
            <div class="sonsors-lower-box">
                <h5>Event Title Sponsors</h5>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
            <br>
            <div class="sonsors-lower-box">
                <h5>Signature Sponsors</h5>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    </div>

</div>
<?php get_footer(); 
