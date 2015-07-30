<?php
use INUtils\Helper\TextHelper;
use Resource\Service\ResourceService;
/*
  Template Name: single-resource
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$resourceEntity = ResourceService::getSingleton()->findResourceById(get_the_ID());
get_header(); ?>
<div class="container-fluid greyish">
    <div class="container">
        <div class="row">
            <form action="/resources" method="post" class="form-inline resources-form" id="search_form" role="form">
                <div class="col-sm-10">
                    <input id="expression" type="text" name="query" class="form-control" placeholder="Search Resources" />
                </div>
                <div class="col-sm-2 col-xs-4 pull-left">
                    <input type="submit"
                    class="resource-sub-btn purplish" placeholder="Submit" />
                </div>
            </form>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<!--sidebar-->
<div class="container" ng-controller="SingleResourceController" >
    <div class="row">
        <div class="col-md-3 no-underline">
            <div class="audiences-widget purplish"><!-- resource-type-widget -->
                <h3>Resource Tags</h3>
                    <ul>
                    <?php foreach($resourceEntity->getType()->getOptions() as $type): ?>
                        <li>
                            <?php echo $type; ?>
                        </li>
                    <?php endforeach; ?>
  
                    <?php foreach($resourceEntity->getAreasOfFocus()->getOptions() as $areaOfFocus): ?>
                        <li>
                            <?php echo $areaOfFocus; ?>
                        </li>
                    <?php endforeach; ?>

                    <?php foreach($resourceEntity->getStakeholders()->getOptions() as $stakeholder): ?>
                        <li>
                            <?php echo $stakeholder; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p>&nbsp;</p>
            <div class="audiences-widget blueish">
                <h3>Related Resources</h3>
                <ul>
                    <?php foreach(ResourceService::getSingleton()->getRelatedResources($resourceEntity->getId()) as $resource): ?>
                        <li><a style="color:#ffffff;" href="<?php echo $resource->getPostEntity()->getPermalink(); ?>"><?php echo $resource->getTitle(); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p>&nbsp;</p>
        </div>

        <!--main content-->

        <div class="col-md-8 resource-main col-sm-offset-1">
            <h3><?php echo $resourceEntity->getTitle(); ?></h3>
            
            <?php if($resourceEntity->getResourceFormat() == "word"): ?>
            <a href="">
                <img src="<?php echo get_template_directory_uri() ;?>/img/doc-icon.png" />
            </a>
            <?php elseif($resourceEntity->getResourceFormat() == "pdf"): ?>
            <a href="">
                <img src="<?php echo get_template_directory_uri() ;?>/img/pdf-icon.png" />
            </a>
            <?php elseif($resourceEntity->getResourceFormat() == "web_site"): ?>
            <a href="">
                <img src="<?php echo get_template_directory_uri() ;?>/img/mail-icon.png" />
            </a>
            <?php elseif($resourceEntity->getResourceFormat() == "video"): ?>
            <a href="">
                <img src="<?php echo get_template_directory_uri() ;?>/img/video-icon.png" />
            </a>
            <?php endif; ?>
            
          
            <share-this></share-this>
            <br><br>
                <p class="tags">
                    <span>By:</span> <?php echo $resourceEntity->getAuthors()->toString(); ?> &nbsp;<br>
                </p>
            <p><?php echo $resourceEntity->getDescription(); ?></p>
            
           
            <?php if($resourceEntity->getUrl() != null): ?>
            <a class="download-file button-blu" href="<?php echo $resourceEntity->getUrl(); ?>">
                <img src="<?php echo get_template_directory_uri() ;?>/img/external-link.png" />
                &nbsp;Download File / View External Website
            </a>
           <?php endif; ?>
             <?php if($resourceEntity->getFileUrl() != null): ?>
            <a class="download-file button-blu" href="<?php echo $resourceEntity->getFileUrl(); ?>">
                <img src="<?php echo get_template_directory_uri() ;?>/img/download.png" />
                &nbsp;Download File
            </a>
          <?php endif; ?>
            <p>&nbsp;</p>
            <div class="videowrapper">
                <iframe width="100%" src="<?php echo TextHelper::getEmbedVideoUrl($resourceEntity->getVideo()); ?>"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<br>
<p>&nbsp;</p>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/SingleResourceController.js"></script>
<?php get_footer();