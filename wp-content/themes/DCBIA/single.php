<?php
use INUtils\Entity\PostEntity;

$member = new PostEntity(get_the_ID());
require_once __DIR__ . "/helpers/front-page-helper.php";

get_header(); ?>
<div ng-app="angular-wp" ng-controller="EmailController">
    <!--start main content here-->
 <?php echo do_shortcode('[slideshow group="blog"]'); ?>
    <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container left-pad-gone">
        <div class="row">
            <?php getBlogSidebar(); ?>
           
            <!--main content-->

            <div class="col-md-8 col-sm-offset-1 resource-main" ng-show="successfull === undefined">
                <h3 class=""><?php echo $member->getTitle(); ?></h3>
                <div>
                    <img src="<?php echo $member->getImage(); ?>" height="333px" width="100%">
                </div>
                <p>&nbsp;</p>
                <p><?php echo $member->getContent(); ?></p>
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
