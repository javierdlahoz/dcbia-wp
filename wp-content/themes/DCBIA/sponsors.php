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
        <div class="col-md-12 sponsor-sections">
            <h4>SEMINARS &amp; PROGRAMS</h4>

            <p>DCBIA seminars and programs are content-rich, led by the best and brightest of the DC real estate development industry. Designed to educate and inform real estate development professionals of the latest market forecasts, developing trends, and capital markets, our programs and seminars also inform members of the changes in the DC legislation and regulatory environment that affect both residential and commercial development.</p>
            
            <br>
            
            <h5>We have customized sponsorship packages available to provide maximum visibility for your company in the DC real estate development industry.</h5>

<p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
            <br>
            <h4>2015-2016 Event Sponsors</h4>
            <div class="sonsors-lower-box">
                <h5>Pinnacle Sponsors</h5>
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
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/pepco.gif" alt="Pepco logo" /></a>    
                </div>
                <div class="col-md-3">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/MMD.png" alt="MMD Logo" /></a>    
                </div> 
            </div>
            <br>
            <div class="sonsors-lower-box">
                <h5>Event Title Sponsors</h5>
                <div class="col-md-3">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/electricalalliance.jpg" alt="lectrical alliance logo" /></a>     
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
            <br>
            <div class="sonsors-lower-box">
                <h5>Signature Sponsors</h5>
                <div class="col-md-3">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/WDG_logo.gif" alt="WDG logo" /></a>    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 sponsor-sections">
            <div class="col-md-6">
                <h4>ANNUAL AWARDS DINNER</h4>

    <p>Every year, DCBIA attracts hundreds of real estate professionals from the Washington, DC area to its Annual Awards Dinner where Building Industry Awards are presented to outstanding individuals and/or entities.</p>
                <p>Sponsorship Opportunities are now available for DCBIA’s 31st Annual Achievement Awards Dinner. The premier black-tie affair that attracts over 1,000 of the best in DC real estate development! It is sure to sell-out again this year.</p>

    <p>We have three sponsorship levels available at $9,000, $6,000 and $4,000. Premier seating is available and there will be plenty of marketing for your company before and during the event. Act now so you don’t miss out on these anticipated opportunities.</p>
                <br>
            </div>    
            <div class="col-md-6">
                <br>
                <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/Sponsorship_2015.png" alt="Sponsorship logo" /></a>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 sponsor-sections">
                <h4>GOLF CLASSIC</h4>
                <p>The DCBIA Golf Classic has been a sold out event every year since its inception in 1999. The tournament takes place at the Belmont Country Club where players meet every year in September for good fun and challenges.</p>
            <p>The DCBIA Golf Classic has been a sold out event every year since its inception in 1999. The tournament takes place at the Belmont Country Club where players meet every year in September for good fun and challenges.</p>

                <h5>We have customized sponsorship packages available to provide maximum visibility for your company in the DC real estate development industry.</h5>

                <p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
            <br>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 sponsor-sections">
                <h4>HOLIDAY CHEER</h4>
                <p>"Holiday Cheer" is an annual event that takes place each year in December, generally at a newly developed building in the District.</p>
                <p>We have customized sponsorship packages available to provide maximum visibility for your company in the DC real estate development industry.</p>
                <p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
            <br>
        </div>
    </div>
    
</div>
<?php get_footer(); 
