<?php
use Staff\Service\StaffService;
use INUtils\Entity\PostEntity;
/*
  Template Name: staff
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$staffMembers = StaffService::getSingleton()->getPosts();
$staffPage = new PostEntity(get_the_ID());

get_header(); ?>
<?php echo do_shortcode('[slideshow group="about"]'); ?>
<!--start main content here-->
<?php getAboutNav(); ?>
<!--start main content here-->

<p>&nbsp;</p>
<!--sidebar-->
    <div class="container">
        <div class="row">
            <div class="about-main">
                <h3><?php echo $staffPage->getTitle(); ?></h3>
                <share-this></share-this>
                <br><br>
                <p><?php echo $staffPage->getContent(); ?></p>
                <?php foreach($staffMembers as $staff): ?>
                    <div class="col-md-3 left-pad-gone">
                        <?php
                        if($staff->getImage() != null){
                            $imageUrl = $staff->getImage();
                        }
                        else{
                            $imageUrl = get_template_directory_uri()."/img/avatar.jpg";
                        }
                        ?>
                        <a href="<?php echo $staff->getPermalink(); ?>"><img class="img-responsive" src="<?php echo $imageUrl; ?>" /></a>
                        <div class="staff">
                            <h5><a href="<?php echo $staff->getPermalink(); ?>"><?php echo $staff->getTitle(); ?></a></h5>
                            <p><?php echo $staff->getJobTitle(); ?></p>
                            <p>&nbsp;</p>

                        </div>
                    </div>    
                <?php endforeach; ?>		
            </div>
        </div>
    </div>
<p>&nbsp;</p>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#consultants").addClass("active");
});
</script>
<?php get_footer();
