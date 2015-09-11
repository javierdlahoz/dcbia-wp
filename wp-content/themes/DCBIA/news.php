<?php
use Member\Helper\MemberHelper;
/*
  Template Name: news
*/
get_header();  ?>
<div id="container-app" ng-controller="MemberController" ng-init="search()">
    <div class="container all-pad-gone">      
        <?php echo getTopMenu(); ?>
        <?php echo do_shortcode('[slideshow group="blog"]'); ?> 
    </div> 
    
    <!--start main content here-->
    
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog Results</h2>
                <br>
            </div>    
        </div>    
    </div>    
    
    <div class="container all-pad-gone blog">
        <div class="row">
            <div class="col-sm-4">
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-sailboat.jpg" alt="sail boat on water" />
                <div class="inside-blog">
                    <h4>Latest News</h4>
                    <p>This is a sample post that will be cropped</p>
                    <a href="">Read More</a>
                </div>    
           </div>   
           <div class="col-sm-4">
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/place-holder.jpg" alt="sail boat on water" />
                <div class="inside-blog">
                    <h4>Latest News</h4>
                    <p>This is a sample post that will be cropped</p>
                    <a href="">Read More</a>
                </div>
           </div> 
           <div class="col-sm-4">
                <img class="img-responsive" src="<?php echo get_template_directory_uri() ;?>/img/featured-building.jpg" alt="sail boat on water" />
                <div class="inside-blog">
                    <h4>Latest News</h4>
                    <p>This is a sample post that will be cropped</p>
                    <a href="">Read More</a>
                </div>
           </div>
   
        </div>
    </div>
</div>
<?php get_footer(); ?>
