<?php

use Director\Controller\DirectorController;
use INUtils\Entity\PostEntity;
/*
  Template Name: staff
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$directors = DirectorController::getSingleton()->getAll();
$directorPage = new PostEntity(get_the_ID());

get_header(); ?>

 <?php echo do_shortcode('[slideshow group="about"]'); ?>

<!--start main content here-->
<?php getAboutNav(); ?>
<!--start main content here-->

<p>&nbsp;</p>
<!--sidebar-->
    <div class="container">
            <div class="about-main">
                <h3><?php echo $directorPage->getTitle(); ?></h3>
                <share-this></share-this>
                <br><br>
                    <p><?php echo $directorPage->getContent(); ?></p>
                    <?php foreach($directors as $director): ?>
                    <div class="col-md-3 left-pad-gone">
                        <?php
                        if($director->getImage() != null){
                            $imageUrl = $director->getImage();
                        }
                        else{
                            $imageUrl = get_template_directory_uri()."/img/avatar.jpg";
                        }
                        ?>
                        <a href="<?php echo $director->getPermalink(); ?>"><img class="img-responsive" src="<?php echo $imageUrl; ?>" /></a>
                        <h5><a href="<?php echo $director->getPermalink(); ?>"><?php echo $director->getTitle(); ?></a></h5>
                        <p><?php echo $director->getJobTitle(); ?></p>
                        <p>&nbsp;</p>
                    </div>    
                <?php endforeach; ?>
            </div>
        </div>
    
    <p>&nbsp;</p>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#directors").addClass("active");
});
</script>
<?php get_footer();
