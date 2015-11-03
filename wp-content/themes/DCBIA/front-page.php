<?php
use Event\Controller\EventController;
use Issue\Controller\IssueController;
use Home\Controller\NewsController;
use INUtils\Helper\TextHelper;
use Sponsor\Controller\SponsorController;
/*
  Template Name: front-page
*/
$stickyNews = NewsController::getSingleton()->getStickyNews();
$recentNews = NewsController::getSingleton()->getRecentNews();
$home = dcbia::getController("home")->getHome();

get_header(); 
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="home"]'); ?>      
    <?php echo getTopMenu(); ?>     
</div> 

<!--start main content here-->

    <div class="container all-pad-gone featured">
        <div class="row">
            <div class="col-md-12">   
                <h2>FEATURED</h2>
            </div>    
        <br>
            <?php foreach($stickyNews as $news): ?>
           <div class="col-sm-4">
                <a class="image-cover" href="<?php echo $news->getPermalink(); ?>" style="background-image: url(<?php echo $news->getImage(); ?>)">
                        <span class="infoblock1 light-blue"><?php echo $news->getTitle(); ?></span>
                        <span class="infoblock2 red"><?php echo mysql2date('j F Y', $news->getDate()); ?></span>
                </a>  
           </div>   
            <?php endforeach; ?>          
        </div>
    </div>

<p>&nbsp;</p>
    <!--main col8-->
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-sm-8 all-pad-gone">
<!--                <div class="issues">
                    <div class="col-sm-12">
                        <h2>ISSUES<h2>
                    </div>
                    <br>        
                    <!--?php foreach ($featuredIssues as $issue): ?>
                    <div class="col-sm-6">
                        <a class="image-cover2" href="<!--?php echo $issue->getPermalink(); ?>" style="background-image: url(<!--?php echo $issue->getImage(); ?>)">
                            <span class="infoblock3 light-blue"><!--?php echo $issue->getTitle(); ?></span>
                        </a>     
                    </div>
                    <!--?php endforeach; ?>
                </div>--><!--issues end-->            
                        
            <div class="events">
                <div class="col-md-12">
                    <div id="aq-block-16-16" class="aq-block aq-block-icy_events_block aq_span8 aq-first clearfix">		                       <br>
                        <?php EventController::getSingleton()->getCalendarWidget(); ?>
                    </div>
                </div>
            </div><!--events end-->             
                
                    <p>&nbsp;</p>    
                        
                <div class="industry col-sm-12">        
                    <h2>INDUSTRY IMPACT</h2>
                    <p>Over the years, DCBIA has achieved a prominent position in the local business community as an advocate for a vigorous, responsible real estate industry. It interprets that advocacy role broadly – to not only give voice to the specific concerns of its members, but also to speak out in support of public policies that promote the economic growth and vitality of the nation’s capital.</p><p>&nbsp;</p>

                <!--Jquery circle plugin-->

                    <div id="myStat" data-dimension="275" data-text="<?php echo $home->getNewcustomers(); ?>%" data-info="New Clients" 
                        data-width="30" data-fontsize="35" data-percent="<?php echo $home->getNewcustomers(); ?>" data-fgcolor="#61a9dc" 
                        data-bgcolor="#eee" data-fill="#ddd" data-total="100" data-part="<?php echo $home->getNewcustomers(); ?>" 
                        data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>

                    <div id="myStat1" data-dimension="275" data-text="<?php echo $home->getIndustrydata(); ?>%" data-info="<?php echo $home->getIndustrydatalabel(); ?>" 
                    	data-width="30" data-fontsize="35" data-percent="<?php echo $home->getIndustrydata(); ?>" data-fgcolor="#61a9dc" 
                    	data-bgcolor="#eee" data-fill="#ddd" data-total="100" data-part="<?php echo $home->getIndustrydata(); ?>" 
                    	data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>
                 <br>   
                </div> <!--industry end-->
                    <p>&nbsp;</p>        
                    <p>&nbsp;</p>        
                <div class="col-sm-12">
                    <div class="quoter">
                        <h3>When I think of the possibilities for the future, I am excited by what DCBIA can continue to accomplish. We are creating a roadmap to shape DC’s future so we can continue to build a vibrant, innovative and world-class city. DCBIA’s invigorated strategic approach is welcoming to organizations of all sizes and we invite you to join us.</h3>
                        <p>— Sean C. Cahill, President of DCBIA and Senior Vice President of Property Group Partners.</p>
                    </div> 
                </div>     
                <p>&nbsp;</p>                 
            </div> <!--main col8 end-->       
                           
            <div class="col-sm-4" ng-controller="EmailController"><!--main col4--> 
                <div class="email-sign-up offblack">
                <h3>SIGN UP FOR DCBIA emails</h3>
                    <div id="inside-email">
                        <p ng-hide="successToNewsletter">
                            Feel free to subscribe to the DCBIA mailing list. You'll get promotional and crucial information regarding DCBIA
                        </p>
                        
                        <p ng-show="successToNewsletter">
                            Thanks for subsribing with us
                        </p>
                        
                     </div>    
                    <form id="signup-form" action="" method="" ng-submit="addToNewsletter()" ng-hide="successToNewsletter">
                        <label class="hidden" for="email"></label>
                        <input id="email1" class="" name="email" type="email" placeholder="Email Address" ng-model="newsletter.ne" />
                        <input class="light-blue" id="submit-btn" type="submit" value="SUBMIT" />
                    </form>	
                    
                    <div id="inside-email" ng-show="errorOnNewsletter" ng-cloak>
                        <p>
                            {{errorOnNewsletter}}
                        </p>
                     </div>    					
                </div>
                
                <!--news starts-->  
                <br>   
                <h2>News</h2>
                <div class="light-blue news">
                    <h3>Recent news</h3>
                    <?php 
                    $isFirst = true;
                    $c = 0;
                    foreach ($recentNews as $news): $c++; ?>
                    <div class="news-block" <?php if(count($recentNews) == $c): ?> style="border: 0px" <?php endif; ?>>
                        <h5><a href="<?php echo $news->getPermalink(); ?>"><?php echo $news->getTitle(); ?></a></h5>
                        <p class="news-date"><?php echo mysql2date('F j, Y', $news->getDate()); ?></p>
                        <p><?php echo TextHelper::cropText($news->getContent(), 150); ?></p>
                        <a href="<?php echo $news->getPermalink(); ?>">Read More...</a>
                    </div>
                    
                    <?php if($isFirst): $isFirst = false; ?>
                        
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <br>
                </div>  
                <!--sponsors starts-->

                    <p>&nbsp;</p>  
                <h2>Sponsors</h2>
                <div class="sponsor-box-sidebar">
                    <?php foreach(SponsorController::getSingleton()->getStartedSponsors() as $sponsor): ?>
                        <a href="<?php echo $sponsor->getUrl(); ?>">
                            <img class="img-responsive" src="<?php echo $sponsor->getImage(); ?>" alt="Property Group Partners logo" />
                        </a>
                        <p>&nbsp;</p>    
                    <?php endforeach; ?>
                </div>   
                
            </div><!--main col4 end-->
        </div>
    </div>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/EmailController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/EmailService.js"></script>