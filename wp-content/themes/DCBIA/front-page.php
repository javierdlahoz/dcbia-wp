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
            <h2>Sponsors</h2>
            <div class="sponsor-box">
                <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="logo" /></a>
                <a href=""><img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="logo" /></a>
            </div>  
         </div>
    </div>
</div>

    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Wasssup</h2>
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
