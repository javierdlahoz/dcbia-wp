<?php

use INUtils\Service\PostService;
/*
  Template Name: news
*/
$pS = new PostService();
$pS->setPostsPerPage(-1);
$news = $pS->getPosts(); 

get_header();  ?>
<div id="container-app" ng-controller="MemberController" ng-init="search()">
    <div class="container all-pad-gone">
        <?php echo do_shortcode('[slideshow group="blog"]'); ?> 
        <?php echo getTopMenu(); ?>
    </div> 
    
    <!--start main content here-->
    
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog Results</h2>
            </div>    
        </div>    
    </div>    
    
    <div class="container all-pad-gone blog">
        <div class="row">
            <?php foreach ($news as $p): ?>
            <div class="col-sm-4">
                <img class="img-responsive" src="<?php 
                    if($p->getImage() == "") { 
                        echo get_template_directory_uri()."/img/featured-sailboat.jpg";
                    } 
                    else{
                        echo $p->getImage();
                    }
                    ?>" alt="sail boat on water" />
                <div class="inside-blog">
                    <h4><?php echo $p->getTitle(); ?></h4>
                    <p><?php echo $p->getContent(); ?></p>
                    <a href="<?php echo $p->getPermalink(); ?>">Read More</a>
                </div>    
            </div>
            <?php endforeach; ?>   
        </div>
    </div>
</div>
<?php get_footer(); ?>
