<?php

use Director\Entity\DirectorEntity;
/*
  Template Name: staff
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$director = new DirectorEntity(get_the_ID());
get_header(); ?>
 <?php echo do_shortcode('[slideshow group="about"]'); ?>
<!--start main content here-->
<?php getAboutNav(); ?>
<!--start main content here-->

<p>&nbsp;</p>
<!--sidebar-->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3><?php echo $director->getTitle(); ?></h3>
            <br>
            <?php
            if($director->getImage() != null){
                $imageUrl = $director->getImage();
            }
            else{
                $imageUrl = get_template_directory_uri()."/img/avatar.jpg";
            }
            ?>
            <img class="img-responsive" src="<?php echo $imageUrl; ?>" />
            
        </div>  
        <div class="col-md-8 col-sm-offset-1 about-main">
            <share-this></share-this>
            <br><br>
            <p>&nbsp;</p>
                    <div class="staff">
                        <h4><?php echo $director->getJobTitle(); ?></h4>
                        <p><?php echo $director->getContent(); ?></p>
                        <p>&nbsp;</p>
                        <div class="social-box2 pull-right">
                            <?php if($director->getLinkedin() != null): ?>
                                <a id="linkedin1" href="<?php echo $director->getLinkedin(); ?>"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<p>&nbsp;</p>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#directors").addClass("active");
});
</script>
<?php get_footer();