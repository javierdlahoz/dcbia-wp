<?php

use INUtils\Entity\PostEntity;

$postV = get_post();
if($postV->post_type == "tribe_events"){
    require_once __DIR__.'/single-tribe_event.php';
    exit();
}


$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<p>&nbsp;</p>
<div class="container inside-pages">
    <div class="breadcrumbs-box">
        <a href="/">Home</a><span>></span><a href="/about/">About</a><span>></span>
        <a href="/<?php echo $pageEntity->getName(); ?>"><?php echo $pageEntity->getTitle(); ?></a>
    </div>
   <p>&nbsp;</p>
    <div class="container inside-pages">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <input type="text" name="query">
                    <input type="submit" value="Search">
                    <input type="hidden" name="action-type" value="search">
                    <input type="hidden" name="resource-types[]" id="resource-types[]" value="Evaluation Reports">
                </form>

                <h3><?php echo $pageEntity->getTitle(); ?></h3>
                <?php the_content(); ?>
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer();