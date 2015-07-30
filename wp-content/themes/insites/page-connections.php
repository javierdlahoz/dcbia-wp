<?php

use Client\Helper\ClientHelper;
use Client\Entity\ClientTypeEntity;
use Client\Service\ClientService;
use INUtils\Entity\PostEntity;

require_once __DIR__ . "/helpers/front-page-helper.php";
$clientTypeEntity = new ClientTypeEntity(get_queried_object()->term_id, ClientHelper::CLIENT_TAXONOMY_NAME);
$clients = ClientService::getSingleton()->getPosts();

$postEntity = new PostEntity(get_the_ID());
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
            <h3><?php echo $clientTypeEntity->getName(); ?></h3>
            <share-this></share-this>

            <p><?php echo $clientTypeEntity->getDescription(); ?></p>
            <p><?php echo $postEntity->getContent(); ?></p>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <p>&nbsp;</p>
            <a class="button-blu connections-btn" href="/contact/">Contact Us!</a>
        </div>
    </div>
<p>&nbsp;</p>
<div class="container-fluid home-logo-box">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <h4>InSites is a 20-year-old, Colorado-based nonprofit organization. We promote learning, growth, and change through inquiry-based evaluation, planning, and research.</h4>
             </div>
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#clients").addClass("active");
});
</script>
<?php
get_footer();
