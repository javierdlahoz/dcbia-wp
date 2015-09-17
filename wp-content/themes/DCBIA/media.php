<?php
use INUtils\Entity\PostEntity;
/*
  Template Name: job-bank
*/
$pageEntity = new PostEntity(get_the_ID());
get_header();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="job-bank"]'); ?>
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
        <div class="col-md-6">
            <div class="job-bank">
                <h4>Economic Development Manager</h4> 
                <h5>Golden Triangle Business Improvement District (BID)</h5>
                <p>Posted 9/03/2015</p>
                <div class="board">
                    <a class="button2" href=""><i class="fa fa-file-pdf-o"></i>Download full job post here!</a>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php get_footer(); 
