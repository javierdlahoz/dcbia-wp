<?php

use INUtils\Service\PostService;
use INUtils\Helper\TextHelper;
/*
  Template Name: news
*/
$pS = new PostService();
$pS->setPostsPerPage(-1);
$news = $pS->getPosts(); 

get_header();  ?>
<div id="container-app">
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
                <a class="image-cover" href=""><img src="" /></a>
                <div class="inside-blog">
                    <h4><?php echo $p->getTitle(); ?></h4>
                    <p><?php echo TextHelper::cropText($p->getContent(), 200); ?></p>
                    <a href="<?php echo $p->getPermalink(); ?>">Read More</a>
                </div>    
            </div>
            <?php endforeach; ?>   
        </div>
    </div>
</div>
<?php get_footer(); ?>
