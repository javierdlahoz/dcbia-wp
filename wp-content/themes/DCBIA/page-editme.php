<?php
get_header(); ?>
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
              <li id="join"><a href="/register">JOIN</a></li>
              <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
              <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>

              <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
              <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
            </ul> 
        </nav> 
</div>
<p>&nbsp;</p>
<div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit my profile</h2>
                <?php echo do_shortcode("[wppb-edit-profile]"); ?>
                <br>
            </div>
        </div>
    </div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#edit_profile").click(function(){
	    	jQuery("#wppb-edit-user").submit();
	    });
	});
</script>