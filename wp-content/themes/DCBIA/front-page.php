<?php
use Event\Controller\EventController;
use Issue\Controller\IssueController;
use Home\Controller\NewsController;
use INUtils\Helper\TextHelper;
/*
  Template Name: front-page
*/
$stickyNews = NewsController::getSingleton()->getStickyNews();
$recentNews = NewsController::getSingleton()->getRecentNews();
$home = dcbia::getController("home")->getHome();
$featuredIssues = IssueController::getSingleton()->getFeatured();

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
                <a href="<?php echo $news->getPermalink(); ?>">
                    <img class="img-responsive" src="<?php echo $news->getImage(); ?>" alt="<?php echo $news->getTitle(); ?>" />
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
                <div class="issues">
                    <div class="col-sm-12">
                        <h2>ISSUES<h2>
                    </div>    
                    <?php foreach ($featuredIssues as $issue): ?>
                    <div class="col-sm-6">
                        <a href="<?php echo $issue->getPermalink(); ?>">
                            <?php if($issue->getImage() == ""): ?>
                                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/issues.jpg" 
                                    alt="<?php echo $issue->getTitle(); ?>" />
                            <?php else: ?>
                                <img class="img-responsive" src="<?php echo $issue->getImage(); ?>" 
                                    alt="<?php echo $issue->getTitle(); ?>" />
                            <?php endif; ?>
                            <span class="infoblock3 light-blue"><?php echo $issue->getTitle(); ?></span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div><!--issues end-->            
                        
                <div class="events">
                    <div class="col-md-12">
                        <div id="aq-block-16-16" class="aq-block aq-block-icy_events_block aq_span8 aq-first clearfix">		
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

                    <div id="myStat1" data-dimension="275" data-text="30%" data-info="New Clients" data-width="30" data-fontsize="35" data-percent="30" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" data-total="750" data-part="350" data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>
                 <br>   
                </div> <!--industry end-->
                
                    <p>&nbsp;</p>        
                    <p>&nbsp;</p>        
                
                <div class="col-sm-12">
                    <div class="quoter">
                        <h2>IF WE EVER FORGET THAT WE ARE ONE NATION UNDER GOD, THEN WE WILL BE A NATION GONE UNDER.</h2>
                        <p>— Ronald Reagan</p>
                    </div> 
                </div> 
                        
                <p>&nbsp;</p>        
                        
            </div> <!--main col8 end-->       
                           
            <div class="col-sm-4"><!--main col4--> 
                <div class="email-sign-up offblack">
                <h3>SIGN UP FOR DCBIA emails</h3>
                    <div id="inside-email">
                        <p>Feel free to subscribe to the DCBIA mailing list. You'll get promotional and crucial information regarding DCBIA</p>
                     </div>    
                    <form id="signup-form" action="" method="">
                        <label class="hidden" for="email"></label>
                        <input id="email1" class="" name="email" type="text" placeholder="Email Address" />
                        <input class="light-blue" id="submit-btn" type="submit" value="SUBMIT" />
                    </form>						
                </div>
                
                <!--news starts-->  
                <br>   
                <h2>News</h2>
                <div class="light-blue news">
                    <h3>Recent news</h3>
                    <?php 
                    $isFirst = true;
                    foreach ($recentNews as $news): ?>
                    <div class="news-block">
                        <h5><a href="<?php echo $news->getPermalink(); ?>"><?php echo $news->getTitle(); ?></a></h5>
                        <p class="news-date"><?php echo mysql2date('F j, Y', $news->getDate()); ?></p>
                        <p><?php echo TextHelper::cropText($news->getContent(), 400); ?></p>
                    </div>
                    <?php if($isFirst): $isFirst = false; ?>
                        <hr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <br>
                </div>  

                 <!--sponsors starts-->

                    <p>&nbsp;</p>  
                <h2>Sponsors</h2>
                <div class="sponsor-box-sidebar">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/property-team.jpg" alt="Property Group Partners logo" /></a>
                    <p>&nbsp;</p>
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/pepco.jpg" alt="Pepco logo" /></a>
                    <p>&nbsp;</p>
                </div>   
                
            </div><!--main col4 end-->
        </div>
    </div>
   

<?php get_footer();
