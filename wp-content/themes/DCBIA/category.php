<?php

use INUtils\Service\PostService;
use INUtils\Helper\TextHelper;

require_once __DIR__ . "/helpers/front-page-helper.php";

$postService = PostService::getSingleton();
$postService->setTaxQuery(
    array(
        array(
           "taxonomy" => "category",
            "field" => "term_id",
            "terms"   => get_queried_object()->term_id
        )
    )
);

$blogs = $postService->getPosts();
get_header();
?>
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
                                <img src="<?php echo $blog->getImage(); ?>" width="100%">
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
<script type="text/javascript">
	jQuery("#blog").addClass("active");
</script>
<?php 
get_footer();
