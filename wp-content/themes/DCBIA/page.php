<?php
use INUtils\Entity\PostEntity;

include "taxonomy-client_type.php";
/*
  Template Name: history-of-ISGP
*/
$pageEntity = new PostEntity(get_the_ID());

$resourcesResults = array();
if(isset($insitesApp->getResultsFromPostAction()->resources)){
    $resourcesResults = $insitesApp->getResultsFromPostAction()->resources;
}

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
                <p><?php echo $pageEntity->getContent(); ?></p>
                <br>
                <?php if(!empty($resourcesResults)){
                            var_dump($resourcesResults["resources"]);
                            echo "<br>";
                            var_dump($resourcesResults["facets"]);
                      }
                ?>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer();