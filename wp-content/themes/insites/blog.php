<?php
use INUtils\Service\PostService;
use INUtils\Helper\TextHelper;
use INUtils\Helper\PictureHelper;
/*
  Template Name: blog
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$postService = PostService::getSingleton();
$postService->setPostType("post");

$blogs = $postService->getPosts();
get_header(); ?>
       <?php echo do_shortcode('[slideshow group="blog"]'); ?>

<div ng-app="angular-wp" ng-controller="EmailController">
    <!--start main content here-->

    <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container left-pad-gone">
        <div class="row">
            <?php getBlogSidebar(true); ?>
            <!--main content-->

            <div class="col-sm-8 col-sm-offset-1 resource-main" ng-show="successfull === undefined">
                <h3 class="">Blog</h3>
                <br><br>
                <?php foreach($blogs as $blog): ?>
                    <div class="col-md-12" ng-class-odd="left-pad-gone">
                        <div class="resource-info-blocks">
                            <div>
                                <img src="<?php echo PictureHelper::getThumbnail($blog->getImage(), 25); ?>" width="100%">
                            </div>
                            <h5><?php echo $blog->getTitle(); ?></h5>
                            <p class="tags">
                                <span>By:</span> <?php echo $blog->getAuthor(); ?> &nbsp;<br>
                            </p>
                            <p class="resources-box-text"><?php echo TextHelper::cropText($blog->getContent()); ?></p>
                            <a class="button-orng" href="<?php echo $blog->getPermalink(); ?>">View Post</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <br>

            </div>
        </div>
    </div>
    <p>&nbsp;</p>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/angular.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/app.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/EmailService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/EmailController.js"></script>

<?php get_footer();
