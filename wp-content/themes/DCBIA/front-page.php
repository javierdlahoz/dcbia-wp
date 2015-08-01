<?php
/*
  Template Name: front-page
*/
get_header(); ?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="home"]'); ?>
            
          <nav class="navbar navbar-default" role="navigation">
              <ul id="main-nav" class="nav navbar-nav custom-nav">
                  <li id="home" <?php if($url == "" || $url == "") echo "class='active'"; ?>><a href="/">Home</a></li>
                  <li id="about" <?php if($url == "about" || $url == "clients" || $url == "staff" || $url == "director")
                      echo "class='active'"; ?>><a href="/about">About Us</a></li>
                  <li id="resources"><a href="/resources">Resources</a></li>
                <li id="blog" <?php if($url == "blog" || $url == "blog") echo "class='active'"; ?>><a href="/blog">Blog</a></li>
                  <li id="donate" <?php if($url == "donate" || $url == "donate") echo "class='active'"; ?>><a href="/donate">Donate</a></li>

                  <li id="contact" <?php if($url == "contact" || $url == "contact") echo "class='active'"; ?>><a href="/contact">Contact</a></li>
             </ul>
              <ul id="main-nav" class="nav navbar-nav custom-nav navbar-right">
                <li class="dropdown new-search-dropdown">
                  <a href="#" title="search button" class="dropdown-toggle search-button" data-toggle="dropdown">&nbsp;</a>
                  <ul class="dropdown-menu" role="">
                    <li>
                      <form title="Search Insites" class="homeFormSearch" action="/resources" method="post" class="navbar-form" role="search">
                        <div class="form-group">
                            <label class="hidden" for="search-resources">Search Resources</label>
                            <input name="query" id="query" type="text" class="form-control" placeholder="Search Resources">
                        </div>
                        <button type="submit" class="search-form-btn1" title="submit seach results">Submit</button>
                      </form>
                    </li>
                  </ul>
                </li>
               </ul>
            </nav>      
         </div> 

<!--start main content here-->

<p>&nbsp;</p>
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
