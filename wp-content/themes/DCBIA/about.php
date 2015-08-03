<?php
use INUtils\Entity\PostEntity;
use INUtils\Service\PostService;
use INUtils\Helper\TextHelper;
/*
  Template Name: about
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$pageEntity = new PostEntity(get_the_ID());
$donatePage = PostService::getSingleton()->getPostByPageName("donate");
get_header(); ?>

        <?php echo do_shortcode('[slideshow group="about"]'); ?>
<!--start main content here-->
<?php getAboutNav(); ?>
<!--start main content here-->

<p>&nbsp;</p>
<!--sidebar-->
<div class="container">
    <div class="row">

        <div class="col-md-12 about-main">
            <h3>About Us</h3>
            <share-this></share-this>
            <p><?php echo $pageEntity->getContent(); ?></p>
    
            <p>&nbsp;</p>    
        </div>
    </div>
</div>
<p>&nbsp;</p>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#company").addClass("active");
});
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/ResourceService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/ResourceController.js"></script>
<?php get_footer();
