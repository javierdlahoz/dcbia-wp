<?php
use Resource\Helper\ResourceHelper;
/*
  Template Name: about
*/
get_header();
$keyIssues = ResourceHelper::getKeyIssues();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="about"]'); ?>
            
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
              <li id="join"><a href="/register">JOIN</a></li>
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
        <div class="col-md-12 about">   
            <h2>About dcbia</h2>
            <p>The District of Columbia Building Industry Association (DCBIA) is the professional association representing both the commercial and residential real estate industries in the nation’s capital. Its membership of nearly 500 companies and organizations comprises several thousand real estate professionals. Association members are engaged in all aspects of real estate development and include developers, general contractors, architects and engineers, lenders, attorneys, brokers, title companies, utility companies, community development organizations and other industry members.</p>

<p>As an advocacy organization, DCBIA represents the interests and views of its members before the District of Columbia and the federal governments, community organizations and other business associations. As a service organization, it offers comprehensive educational programs, social events and community service activities.</p>

<p>DCBIA’s extensive committee structure invites direct member participation in the shaping of association and business community positions on key issues impacting the economic health and governance of Washington, DC – from investment and economic development to regulatory and management reform; from city-wide housing development to tax reform; from retail business expansion to development “east of the river.” Many DCBIA members participate in its 10 standing committees.</p>
        </div>    
    </div>
</div>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/ResourceController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/ResourceService.js"></script>
