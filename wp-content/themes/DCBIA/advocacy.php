<?php
use Event\Controller\EventController;
/*
  Template Name: advocacy
*/
$home = dcbia::getController("home")->getHome();
get_header(); 
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="advocacy"]'); ?>
            
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

    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12 advocacy">   
                <h2>ADVOCACY</h2>
                <p>Members serve frequently and prominently on commissions, task forces and study groups to address crucial economic development and municipal governance issues. Member participation on a more continuous basis is encouraged through eleven standing committees, which work closely with agencies of the DC government to advise and assist in the efficient administration of city programs – most recently in areas related to land use, building regulation, comprehensive planning, tax issues and affordable housing and community development. Committees also work in collaboration with other business groups and community organizations to attract and retain business investment and to facilitate the revitalization of distressed areas in the city.</p>    
            </div>    
        </div>
        
        <div class="row">
            <div class="col-md-12 key-issues-container">
                <div class="key-top-search">
                    <input type="text" name="" id="advocacy-search" class="form-control" placeholder="Search">
                    <button class="btn advo-search-btn" type="button" onclick="">Submit</button>
                </div>
                   <p>&nbsp;</p>
                <div class="row key-issue-boxes">    
                    <div class="col-sm-3">
                        <a href="">
                            <span></span>
                            <span>key issues</span>
                            <span></span>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a href="">
                            <span></span>
                            <span>recent testimony</span>
                            <span></span>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a href="">
                            <span></span>
                            <span>publications</span>
                            <span></span>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a href="">
                            <span></span>
                            <span>Industry data</span>
                            <span></span>
                        </a>
                    </div>    
                </div>
         </div>    
    </div>
</div>

   

<?php get_footer();
