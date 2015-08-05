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

    <div class="container">
        <div class="row">
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do do"></div>
                    <h2>What we do</h2>
                    
                    <a class="button-blu" href="/about/#what-we-do">Learn More</a>
                </div>
           </div>
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do work"></div>
                    <h2>How we work</h2>
                    
                    <a class="button-blu" href="/about/#how-we-work">Learn More</a>
                </div>
           </div>
           <div class="col-md-4">
                <div class="what-we-boxes">
                    <div class="what-we-do know"></div>
                    <h2>What we know</h2>
                   
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
                <div class="col-md-3 all-pad-gone">
                    <div class="color-blocks purplish">
                        <div class="inside-color-blocks systems"></div>
                        <h3>Systems-Oriented Evaluation</h3>
                        <p>test</p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone">
                    <div class="color-blocks orangish">
                        <div class="inside-color-blocks spiral"></div>
                        <h3>Evaluation Capacity<br>Building</h3>
                        <p>test</p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone">
                   <div class="color-blocks blueish">
                        <div class="inside-color-blocks sustainability"></div>
                        <h3>Sustainability & Equity</h3>
                        <p>test</p>
                    </div>
                </div>
                <div class="col-md-3 all-pad-gone">
                    <div class="color-blocks orangish">
                        <div class="inside-color-blocks inclusiveness"></div>
                        <h3>Basic Evaluation Methods</h3>
                        <p>test</p>
                    </div>
                </div>
           
        </div>
    </div>
<p>&nbsp;</p>


<div class="container">
    <div class="row">
         <h3 class="home-res-heading">Insites Blog Results</h3>
            <br>
        <div class="reyed-out-box">

        </div>
    </div>
</div>


<p>&nbsp;</p>
    <div class="container-fluid call-to-action-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 call-to-action-box">
                    <h2>tester</h2>
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
                    <p>test</p>
                <a href='/about/connections/' title="learn-more" href="" class="button-blu">Learn More</a>
                </div>
                <div class="col-md-5">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/globe.jpg" alt="globe image with people" />
                </div>
            </div>
            <p>&nbsp;</p>
        </div>
    </div>
   

<?php get_footer();
