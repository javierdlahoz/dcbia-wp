<?php
use Event\Controller\EventController;
/*
  Template Name: member-directory
*/
$home = dcbia::getController("home")->getHome();
get_header(); 
?>
<div class="container all-pad-gone">
            
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
        <div class="member-top-searchbar">
            <div class="col-md-5">
                <input type="text" name="" id="member-search" class="form-control" placeholder="SEARCH">
                <button type="submit" class="member-search-btn" title="submit member seach results"><i class="fa fa-search"></i></button>
            </div>    
            <div class="col-md-1 col-xs-2">
                <span class="search-titles">SORT BY:</span>
            </div>
            <div class="col-sm-2 col-xs-4">    
                <a href="" class="member-sort">TITLE A-Z</a>
            </div>
            <div class="col-sm-2 col-xs-4">
                <a href="" class="member-sort">DATE CREATED</a>
            </div>
        </div> 
    </div> 

<!--start main content here-->

<div class="container all-pad-gone">
    <div class="row">
        <div class="col-sm-3">

            <p>&nbsp;</p>

         </div>
         <div class="col-sm-9">
    
         </div>     
    </div>
</div>

   

<?php get_footer();
