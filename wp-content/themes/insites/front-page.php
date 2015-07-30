<?php
use INUtils\Service\PostService;
use INUtils\Helper\PictureHelper;
use INUtils\Helper\TextHelper;
use Home\Controller\HomeController;
/*
  Template Name: front-page
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$stickyPosts = PostService::getSingleton()->getStickyPosts(5);
$home = HomeController::getSingleton()->getHome();
get_header(); ?>

    <?php echo do_shortcode('[slideshow group="home"]'); ?>


<!--start main content here-->

<p>&nbsp;</p>
    <div class="container">
        <div class="row">
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do do"></div>
                    <h2>What we do</h2>
                    <p><?php echo $home->getWhatWeDo(); ?></p>
                    <a class="button-blu" href="/about/#what-we-do">Learn More</a>
                </div>
           </div>
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do work"></div>
                    <h2>How we work</h2>
                    <p><?php echo $home->getWhoWeAre(); ?></p>
                    <a class="button-blu" href="/about/#how-we-work">Learn More</a>
                </div>
           </div>
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do know"></div>
                    <h2>What we know</h2>
                    <p><?php echo $home->getWhatWeKnow(); ?></p>
                    <a class="button-blu" href="/about/#what-we-know">Learn More</a>
                </div>
           </div>
        </div>
    </div>
<p>&nbsp;</p>
    <div class="container">
        <div class="row">
            <h3 class="home-res-heading">Insites Resources</h3>
            <br>
            <form action="/resources" method="POST" id="areas-form">
                <input type="hidden" name="areasOfFocus" id="areas-of-focus">
                <div class="col-md-3 all-pad-gone" onclick="gotoResources('Systems-Oriented Evaluation')">
                    <div class="color-blocks purplish">
                        <div class="inside-color-blocks systems"></div>
                        <h3>Systems-Oriented Evaluation</h3>
                        <p><?php echo $home->getSystemOriented(); ?></p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone" onclick="gotoResources('Evaluation Capacity Building')">
                    <div class="color-blocks orangish">
                        <div class="inside-color-blocks spiral"></div>
                        <h3>Evaluation Capacity<br>Building</h3>
                        <p><?php echo $home->getEvaluation(); ?></p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone" onclick="gotoResources('Sustainability & Equity')">
                   <div class="color-blocks blueish">
                        <div class="inside-color-blocks sustainability"></div>
                        <h3>Sustainability & Equity</h3>
                        <p><?php echo $home->getSustainabilty(); ?></p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone" onclick="gotoResources('Basic Evaluation Methods')">
                    <div class="color-blocks orangish">
                        <div class="inside-color-blocks inclusiveness"></div>
                        <h3>Basic Evaluation Methods</h3>
                        <p><?php echo $home->getBasicEvaluation(); ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<p>&nbsp;</p>

<?php if(count($stickyPosts) > 0): ?>
<div class="container">
    <div class="row">
         <h3 class="home-res-heading">Insites Blog Results</h3>
            <br>
        <div class="sticky-slide greyed-out-box">
            <div id="myCarousel" class="carousel slide myCarousel" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $isFirst = true;
                    foreach ($stickyPosts as $stickyPost): ?>
                    <div class="item <?php if($isFirst): echo "active"; $isFirst = false; endif; ?>">
                        <div class="col-md-6 all-pad-gone">
                            <div class="image-holder">
                                <img class="img-responsive" src="<?php echo PictureHelper::getThumbnail($stickyPost->getImage(), 50); ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 add-all-pad">
                            <h3><?php echo $stickyPost->getTitle(); ?></h3>
                            <p>By: <?php echo $stickyPost->getAuthor(); ?>
                            <p><?php echo TextHelper::cropText($stickyPost->getContent(), 400); ?></p>
                            <div class="slide-divider-sticky">
                            <a class="button-orng" href="<?php echo $stickyPost->getPermalink(); ?>">View Post</a>
                            <a title="previous slide" class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="stickyslide-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a title="next slide" class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="stickyslide-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<p>&nbsp;</p>
    <div class="container-fluid call-to-action-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 call-to-action-box">
                    <h2><span><?php echo $home->getSupportNetworks(); ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="get-involved">
                <div class="col-md-7">
                    <br>
                    <h1>Get Connected!</h1>
                    <br>
                    <p><?php echo $home->getGetConnected(); ?></p>
                <a href='/about/connections/' title="learn-more" href="" class="button-blu">Learn More</a>
                </div>
                <div class="col-md-5">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/globe.jpg" alt="globe image with people" />
                </div>
            </div>
            <p>&nbsp;</p>
        </div>
    </div>
    <!--<div class="container-fluid home-logo-box">
        <div class="container">
        <div class="row home-logo-box">
            <div class="row"> 
                 <div class="col-md-4">
                    <a href="http://ready4rigor.com/"><img alt="logo" src="<?php echo get_template_directory_uri() ;?>/img/rigor-ready.png" /></a>
                 </div>
                   <div class="col-md-4">
                    <a href="/about"><img alt="logo" src="<?php echo get_template_directory_uri() ;?>/img/Insites-color.png" /></a>
                 </div>
                 <div class="col-md-4">
                    <a href="http://i2i-institute.com/"><img alt="logo" src="<?php echo get_template_directory_uri() ;?>/img/i2i.png" /></a>
                 </div>
            </div>
            </div>
            <div class="row">
                 <div class="col-md-12">
                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. -Duis sagittis ipsum</h4>
                 </div>
            </div> 
        </div>
    </div>-->

<?php get_footer();
