<?php
/*
Template Name: full width template
*/
get_header(); ?>
  </div>
</div> <!--These divs are here to fix the inner-shell and grid-shell nav issue-->
<div class="green-nav-bar">
	<div class="inner-shell">
		<h4>
			<a href="/">Home</a>
		</h4>
	</div>
</div>
<div class="grey-nav-bar">
	<div class="inner-shell">
		<div class="col-xs-6 vanish-left-pad">
			<h3><?php echo the_title(); ?></h3>
		</div>
		<div class="actions-box">
			<span class="sharing-icon pull-right" data-toggle="modal" data-target="#share-this">
	            <span>SHARE</span>
	            <span class="share"></span>
	        </span>
        </div>
	</div>
</div>
<div class="container-fluid wt">
  <div class="row-fluid">
   <div class="inner-shell">
       <p>&nbsp;</p>
        <div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php if ( has_post_thumbnail() )  { // check if the post has a Post Thumbnail assigned to it.
                  the_post_thumbnail('medium', array('class' => 'img-responsive'));} ?>
                    <div class="blog-home-post-box">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; else: ?>
                  <p><?php _e('Sorry, there are no posts.'); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php echo do_shortcode("[sf_professional_anouncements]"); ?>
                <br>
                <?php echo do_shortcode("[sf_calendar_widget]"); ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_before_carrousel();
get_footer();
EmailHelper::getEmailModal('share-this', get_the_title(get_the_ID()));
exit();