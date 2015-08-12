<?php
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
    <div class="container all-pad-gone issues">
        <div class="row">
            <div class="col-sm-8 all-pad-gone"> 
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
                </div>    
                <div class="col-sm-4">
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
                </div>
        </div>
    </div>

<div class="container">
    <div class="row">
         <div class="col-sm-8 left-pad-gone">
            <h2>Events</h2>
            <p>palceholder</p>
         </div>     
          <div class="col-sm-4">
            <p>&nbsp;</p>  
            <h2>News</h2>
            <div class="light-blue">
                <h3 class="">Recent news</h3>
                <h5>Job Opportunity: Public Information Officer</h5>
                <p>July 9, 2015</p>
                <p>The incumbent serves as an expert public information and communications advisor to senior management, responsible for managing, planning, developing and administering the public information and communications program for DDOT. The incumbent provides leadership and expertise to staff and senior management in planning, designing, executing, and evaluating the Department's public affairs division....</p>
            </div>  
         </div>
    </div>
</div>

<div class="container">
    <div class="row">     
        <div class="col-sm-8 left-pad-gone">
                <h2>INDUSTRY IMPACT</h2>
                <p>Over the years, DCBIA has achieved a prominent position in the local business community as an advocate for a vigorous, responsible real estate industry. It interprets that advocacy role broadly – to not only give voice to the specific concerns of its members, but also to speak out in support of public policies that promote the economic growth and vitality of the nation’s capital.</p>
            
        <!--Jquery circle plugin-->
            
        <div id="myStathalf" data-dimension="250" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#7ea568" data-bgcolor="#eee" data-type="half" data-fill="#ddd"></div>

        <div id="myStat" data-dimension="250" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd"></div>

        <div id="myStathalf2" data-dimension="250" data-text="35" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#7ea568" data-bgcolor="#eee" data-type="half" data-icon="fa-task"></div>

        <div id="myStat2" data-dimension="250" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#61a9dc" data-bgcolor="#eee"></div>

        <div id="myStat3" data-startdegree="90" data-dimension="250" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#61a9dc" data-bgcolor="#eee"></div>

        <div id="myStat4" data-startdegree="180" data-dimension="250" data-text="35%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="35" data-fgcolor="#61a9dc" data-bgcolor="#eee"></div>

        <div id="myStathalf3" data-startdegree="45" data-dimension="250" data-text="50%" data-info="New Clients" data-width="30" data-fontsize="38" data-percent="50" data-fgcolor="#7ea568" data-bgcolor="#eee" data-type="half" data-fill="#ddd"></div>
            
        </div>     
        <div class="col-sm-4">
            <p>&nbsp;</p>  
            <h2>Sponsors</h2>
            <div class="sponsor-box">
                <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="logo" /></a>
                <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="logo" /></a>
            </div>  
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">

            <div class="col-md-7">

            </div>
            <div class="col-md-5">

            </div>
        </div>
    </div>
   

<?php get_footer();
