<?php
use INUtils\Entity\PostEntity;

$member = new PostEntity(get_the_ID());
require_once __DIR__ . "/helpers/front-page-helper.php";

get_header(); ?>
<?php echo do_shortcode('[slideshow group="resources"]'); ?>
<div ng-app="angular-wp" ng-controller="EmailController" ng-cloak>
    <!--start main content here-->

    <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container left-pad-gone">
        <div class="row">
            <?php getContactSidebar(); ?>
           
            <!--main content-->

            <div class="col-sm-8 col-sm-offset-1 resource-main" ng-show="successfull === undefined">
                <h3 class=""><?php echo $member->getTitle(); ?></h3>
                <div ng-controller="PostController" ng-init="searchPosts()">  
                     <div ng-repeat="blog in posts">
                        <div ng-class-odd="left-pad-gone">
                            <div class="resource-info-blocks">
                                <h5>{{blog.title}}</h5>
                                <p class="">
                                    <span>By:</span> {{blog.author}} &nbsp;<br>
                                    <span ng-show="blog.tags != null">Tags:</span> {{blog.tags}}
                                </p>
                                <p class="">{{blog.limitedContent}}</p>
                                <a class="button-orng" href="{{blog.permalink}}">View Blog</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="pull-right" ng-show="postsFound > 0">
                    <span ng-show="paged > 1">
                        <a href="" ng-click="decreasePaged(); searchPosts()">< Previous</a>
                    </span>
                    <span>&nbsp;</span>
                    <span ng-show="pagesNumber > 1 && paged < pagesNumber">
                        <a href="" ng-click="increasePaged(); searchPosts()">Next ></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/PostService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/PostController.js"></script>

<?php get_footer();
