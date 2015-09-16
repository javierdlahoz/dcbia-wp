<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
/*
  Template Name: staff
*/
$pageEntity = new PostEntity(get_the_ID());
$staffs = StaffController::getSingleton()->getAll();
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="about"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 

<!--start main content here-->

<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about">   
            <h2><?php echo $pageEntity->getTitle(); ?></h2>
            <p><?php echo $pageEntity->getContent(); ?></p>
        </div>    
    </div>
    <?php foreach($staffs as $staff): ?>
    <div class="row">
        <div class="staff-results">
                <div class="col-sm-2 staff-pic">
                    <img class="img-responsive" 
                    src="<?php 
                            if($staff->getImage() != ''){
                                echo $staff->getImage();
                            }
                            else{
                                echo get_template_directory_uri()."/img/place-holder.jpg";   
                            }
                        ?>"
                         alt="<?php echo $staff->getTitle(); ?>" />
                </div>
                <div class="col-sm-10 key-info">
                    <h4><?php echo $staff->getTitle(); ?></h4>
                    <h5><?php echo $staff->getJobTitle(); ?></h5>  
                    <p><?php echo $staff->getContent(); ?></p>
    
                    <a class="button1" href="mailto: <?php echo $staff->getEmail(); ?>">Contact</a>
                </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php get_footer(); 
