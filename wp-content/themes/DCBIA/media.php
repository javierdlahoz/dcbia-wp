<?php
use INUtils\Entity\PostEntity;
/*
  Template Name: media
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="media"]'); ?>
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
    <div class="row">
        <div class="col-md-4">
            <div class="media">
                <h4>DCBIA Announces 1st Scholarship Recipient to Georgetown University’s Master’s in Real Estate Program </h4> 
                <h5>August 6, 2015</h5>
                <p>Talented DC Recipient to Use Georgetown University Degree to Find Solutions for DC’s Neighborhood Challenges</p>
                <div class="board">
                    <a class="button2" href=""><i class="fa fa-file-pdf-o"></i>Download press release here!</a>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); 
