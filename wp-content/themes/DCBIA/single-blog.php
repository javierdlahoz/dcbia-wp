<?php
use INUtils\Entity\PostEntity;

$p = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="blog"]'); ?>
    <?php echo getTopMenu(); ?>       
</div> 
<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about">   
            <h2><?php echo $p->getTitle(); ?></h2>
        </div>    
    </div>
 <br>
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive" alt="" src="<?php if($p->getImage() == "")
            { 
                echo get_template_directory_uri()."/img/place-holder.jpg"; 
            }
            else{
                echo $p->getImage();
            }
            ?>" 
            alt="Property Group Partners logo" />
        </div>
        <div class="col-md-8 key-info">
            <h5><?php echo mysql2date("j F, Y", $p->getDate()); ?></h5>  
            <p><?php echo $p->getContent(); ?></p>
        </div>
    </div>
</div>
<?php get_footer(); 
