<?php
use INUtils\Entity\PostEntity;
use Job\Controller\JobController;
/*
  Template Name: job-bank
*/
$pageEntity = new PostEntity(get_the_ID());
$jobs = JobController::getSingleton()->getAll();
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
        <?php foreach ($jobs as $job): ?>
        <div class="col-md-6">
            <div class="job-bank">
                <h4><?php echo $job->getTitle(); ?></h4> 
                <h5><?php echo $job->getCompanyNames(); ?></h5>
                <p>Posted <?php echo mysql2date("F j, Y", $job->getDate()); ?></p>
                <div class="board">
                    <?php if($job->getFileUrl() == ""){
                        $url = $job->getUrl();
                    }
                    else{
                        $url = $job->getFileUrl();
                    }
                    ?>
                    <a class="button2" href="<?php echo $url; ?>"><i class="fa fa-file-pdf-o"></i>Download full job post here!</a>
                </div> 
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer(); 
