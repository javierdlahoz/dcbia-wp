<?php
use Event\Controller\EventController;
/*
  Template Name: front-page
*/
get_header(); ?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="home"]'); ?>
            
      <nav class="site-navigation" role="navigation">
          <ul class="nav custom-nav hide-on-phone">
              <li id="about" <?php if($url == "about" || $url == "about")
                  echo "class='active'"; ?>><a href="/about">ABOUT</a>
                  <ul class="" id="" role="menu">       
                        <li id="staff"><a href="/about/">STAFF</a></li>
                        <li id="board"><a href="/about/">BOARD</a></li>
                        <li id="committees"><a href="/about/">COMMITTEES</a></li>
                  </ul>
              </li>
              <li id="join"><a href="/join">JOIN</a></li>
            <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
              <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>

              <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
              <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
            </ul> 
        </nav>      
    </div> 

<!--start main content here-->

    <div class="container all-pad-gone featured">
        <div class="row">
            <div class="col-md-12">   
                <h2>FEATURED</h2>
            </div>    
        <br>
           <div class="col-sm-4">
                <a href="">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-sailboat.jpg" alt="sail boat on water" />
                        <span class="infoblock1 light-blue">WE KEEP YOU UPDATED...</span>
                        <span class="infoblock2 red">28 OCTOBER 2015</span>
                </a>
           </div>   
           <div class="col-sm-4">
                <a href="">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-icerink.jpg" alt="sail boat on water" />
                        <span class="infoblock1 light-blue">WE KEEP YOU UPDATED...</span>
                        <span class="infoblock2 orange">28 OCTOBER 2015</span>
                </a>
           </div> 
           <div class="col-sm-4">
                <a href="">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="sail boat on water" />
                        <span class="infoblock1 light-blue">WE KEEP YOU UPDATED...</span>
                        <span class="infoblock2 grey">28 OCTOBER 2015</span>
                </a>
           </div> 
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
                    <div class="col-sm-6">
                        <a href="">
                            <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/issues.jpg" alt="sail boat on water" />
                            <span class="infoblock3 light-blue">JOBS &amp; THE ECONOMY</span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="">
                            <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/issues1.jpg" alt="sail boat on water" />
                            <span class="infoblock3 light-blue">IMMIGRATION</span>
                        </a>
                    </div>
                </div><!--issues end-->            
                        
                <div class="events">
                    <div id="aq-block-16-16" class="aq-block aq-block-icy_events_block aq_span8 aq-first clearfix col-md-12">		
                        <?php EventController::getSingleton()->getCalendarWidget(); ?>
                    </div>
                </div><!--events end-->             
                
                    <p>&nbsp;</p>    
                        
                <div class="industry col-sm-12">        
                    <h2>INDUSTRY IMPACT</h2>
                    <p>Over the years, DCBIA has achieved a prominent position in the local business community as an advocate for a vigorous, responsible real estate industry. It interprets that advocacy role broadly – to not only give voice to the specific concerns of its members, but also to speak out in support of public policies that promote the economic growth and vitality of the nation’s capital.</p><p>&nbsp;</p>

                <!--Jquery circle plugin-->

                    <div id="myStat" data-dimension="275" data-text="30%" data-info="New Clients" data-width="30" data-fontsize="35" data-percent="30" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" data-total="750" data-part="350" data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>

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
                    <div class="news-block">
                        <h5><a href="">Job Opportunity: Public Information Officer</a></h5>
                        <p class="news-date">July 9, 2015</p>
                        <p>The incumbent serves as an expert public information and communications advisor to senior management, responsible for managing, planning, developing and administering the public information and communications program for DDOT. The incumbent provides leadership and expertise to staff and senior management in planning, designing, executing, and evaluating the Department's public affairs division....</p>
                    </div>
                    
                    <div class="news-block">
                        <h5><a href="">Job Opportunity: Transportation Planner (TDM)</a></h5>
                        <p class="news-date">July 17, 2015</p>
                        <p>District Department of Transportation (DDOT) 
Transportation Planner (Transportation Demand Management / TDM) is the senior level position within the Transportation Planning Coordinator job progression. Develops and manages the transportation demand management program for the District of Columbia, with emphasis on a multi-modal approach to reduce travel demand.</p>
                    </div>
                    <br>
                </div>  

                 <!--sponsors starts-->

                    <p>&nbsp;</p>  
                <h2>Sponsors</h2>
                <div class="sponsor-box">
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/property-team.jpg" alt="Property Group Partners logo" /></a>
                    <p>&nbsp;</p>
                    <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/pepco.jpg" alt="Pepco logo" /></a>
                    <p>&nbsp;</p>
                </div>   
                
            </div><!--main col4 end-->
        </div>
    </div>
   

<?php get_footer();
