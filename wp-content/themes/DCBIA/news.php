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
    
    ]<div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog Results</h2>
            </div>    
        </div>    
    </div>    
    
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-sm-4">   
                <div class="inside-blog">
                    <h4>Blog Catagories</h4>
                    <div class="inside-side-member">
                        <p><a href="" class="business-categories">Sample1</a></p>
                        <p><a href="">&nbsp;</a></p>
                    </div>    
                </div> 
             </div>
   
        </div>
    </div>
</div>
<?php get_footer(); ?>
