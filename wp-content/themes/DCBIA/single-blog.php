<?php
use INUtils\Entity\PostEntity;
use Staff\Controller\StaffController;
/*
  Template Name: single-blog
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="blog"]'); ?>
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
 <br>
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive" alt="" src="<?php echo get_template_directory_uri() ;?>/img/property-team.jpg" alt="Property Group Partners logo" />
        </div>
        <div class="col-md-8 key-info">
            <h4>Title of Post</h4>
            <h5>Date of Post</h5>  
            <p>Content of Post</p>
        </div>
    </div>

</div>
<?php get_footer(); 
