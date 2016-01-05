<?php
use INUtils\Entity\PostEntity;
use Director\Controller\DirectorController;
use Sponsor\Controller\SponsorController;
/*
  Template Name: sponsors
*/
$pageEntity = new PostEntity(get_the_ID());
$sts = SponsorController::getSingleton()->getSponsorTypes();
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="sponsors"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 
<!--start main content here-->
<div class="container all-pad-gone">
<div class="row">   
<div class="col-md-12">
    <h2><?php echo $pageEntity->getTitle(); ?></h2>
</div>    
</div>    
<div class="col-md-12 sponsor-sections">
    <?php foreach($sts as $st): ?>
    <div class="sonsors-lower-box">
        <h5><?php echo $st->getName(); ?></h5>
        <?php foreach(SponsorController::getSingleton()->getSponsorsByType($st->getTermId()) as $sponsor): ?>
            <div class="col-md-3">  
                <a href="<?php echo $sponsor->getUrl(); ?>">
                    <img class="img-responsive" src="<?php echo $sponsor->getImage(); ?>" 
                    alt="<?php echo $sponsor->getTitle(); ?>" />
                </a>    
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <?php endforeach; ?>
</div>

<div class="row">
    <div class="col-md-12 about">   
        <p><?php echo $pageEntity->getContent(); ?></p>
    </div>    
</div>    
<div class="row">
    <div class="col-md-12 sponsor-sections">
        <div class="col-md-6">
            <h4>ANNUAL AWARDS DINNER</h4>
            <p>Every year, DCBIA attracts hundreds of real estate professionals from the Washington, DC area to its Annual Awards Dinner where Building Industry Awards are presented to outstanding individuals and/or entities.</p>
            <p>Sponsorship Opportunities are now available for DCBIA’s 31st Annual Achievement Awards Dinner. The premier black-tie affair that attracts over 1,000 of the best in DC real estate development! It is sure to sell-out again this year.</p>

            <p>Premier seating is available and there will be plenty of marketing for your company before and during the event. Act now so you don’t miss out on these anticipated opportunities.</p>
            <br>
        </div>    
        <div class="col-md-6">
             <br>
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/Ona-SSV6e_U" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>
    <div class="row">
      <div class="col-md-12 sponsor-sections">
        <div class="col-md-6">
                <h4>GOLF CLASSIC</h4>
                <p>The DCBIA Golf Classic has been a sold out event since its inception in 1999. The tournament takes place at a prominent DC area golf course where players meet every year in September for good fun, challenges, and the best networking in DC real estate development.</p>

                <h5>We have customized sponsorship packages available to provide maximum visibility for your company in the DC real estate development industry.</h5>

                <p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
            <br>
        </div>
        <div class="col-md-6">
            <br>
            <iframe width="100%" height="400" src="https://www.youtube.com/embed/gI1mRII6sc8" frameborder="0" allowfullscreen></iframe>
        </div>    
      </div>
    </div>
    
    <div class="row">
       <div class="col-md-12 sponsor-sections">
        <div class="col-md-6">
            <h4>DCBIA ANNUAL NETWORKING EVENTS</h4>
            <p>You want to find the experts in DC real estate development? Want to make a business connection that is worth your time? Maximize your business relationships by attending and sponsoring DCBIA’s highly-anticipated, sold-out networking events. In Spring, our <b>Spring Fling</b> is talk of the Cherry Blossom season. We welcome back the real estate development industry after summer break at our <b>Back to Business</b> event in the fall (a partnership with AIA| DC) and of course, we celebrate the holidays with some <b>Holiday Cheer</b> in winter!</p>
            <p>We customize sponsorship packages to provide maximum visibility for your company in the DC real estate development industry.</p>
            <p>Contact Sherrita Lancaster at (202) 966-8665 or <a href="mailto:slancaster@dcbia.org">slancaster@dcbia.org</a> to get details!</p>
        <br>
        </div>
        <br>    
        <div class="col-md-6">    
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/5cIFYQXlF8w" frameborder="0" allowfullscreen></iframe>
      </div>
   </div>
    
</div>
<?php get_footer(); 
