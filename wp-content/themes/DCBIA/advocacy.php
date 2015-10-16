<?php
use Resource\Helper\ResourceHelper;
use Issue\Controller\IssueController;
use INUtils\Entity\PostEntity;
/*
  Template Name: advocacy
*/
get_header();
$keyIssues = ResourceHelper::getKeyIssues();
$headings = IssueController::getSingleton()->getHeadings();
$pageEntity = new PostEntity(get_the_ID());
//var_dump($headings[0]->getName()); die();

?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="advocacy"]'); ?>
    <?php echo getTopMenu(); ?>     
</div> 

<!--start main content here-->

<div class="container all-pad-gone" ng-controller="ResourceController" ng-init="initial()">
    <div class="row">
        <div class="col-md-12 advocacy">   
            <h2><?php echo $pageEntity->getTitle(); ?></h2>
            <p><?php echo $pageEntity->getContent(); ?></p>    
        </div>    
    </div>

    <div class="row">
        <div class="col-md-12 key-issues-container">
                <div class="key-top-search">
                    <form ng-submit="searchOnlyInText()">
                        <input type="text" name="" id="advocacy-search" class="form-control" placeholder="Search" ng-model="formData.query">
                        <button class="btn advo-search-btn" type="button" ng-click="searchOnlyInText()">Submit</button>
                    </form>
                </div>
                <p>&nbsp;</p>
                
                <div ng-show="resultsInTop">
                    <div ng-show="resources.length == 0" ng-cloak>
                        <h2>No results were found</h2>
                    </div>
                    
                    <div ng-show="loading">
                        <center>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" height="64">
                        </center>
                    </div>
                    
                    <div class="lower-key-results" ng-repeat="resource in resources" ng-cloak >
                        <div class="col-sm-2 bookmark-box">
                            <p><i class="fa fa-bookmark-o"></i></p>
                        </div>
                        <div class="col-sm-9 col-sm-offset-1 key-info">
                            <h5>{{resource.title}}</h5>  
                            <p>{{resource.limitedContent}}</p>
                            
                            <a class="button1" href="{{resoure.permalink}}">More Information</a>
                        </div>
                    </div>
                </div>
                   
                <div class="row key-issue-boxes">      
                    <div class="col-sm-4">
                        <a class="types" ng-click="getResourcesByType('resource_testimony')" id="resource_testimony">
                            <i class="fa fa-commenting"></i>
                            <span>Advocacy</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                    <div class="col-sm-4">
                        <a class="types" ng-click="getResourcesByType('resource_publications')" id="resource_publications">
                            <i class="fa fa-book"></i>
                            <span>publications</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                    <div class="col-sm-4">
                        <a class="types" ng-click="getResourcesByType('resource_industry_data')" id="resource_industry_data">
                            <i class="fa fa-database"></i>
                            <span>Industry data</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                </div>
                
                <div ng-hide="resultsInTop">
                    <div ng-show="resources.length == 0" ng-cloak>
                        <h2>No results were found</h2>
                    </div>
                    
                    <div ng-show="loading">
                        <center>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" height="64">
                        </center>
                    </div>
                    
                    <div class="lower-key-results" ng-repeat="resource in resources" ng-cloak>
                        <div class="col-sm-2 bookmark-box">
                            <p><i class="fa fa-bookmark-o"></i></p>
                        </div>
                        <div class="col-sm-9 col-sm-offset-1 key-info">
                            <h5>{{resource.title}}</h5>  
                            <p>{{resource.limitedContent}}</p>
                            
                            <a class="button1" href="{{resoure.permalink}}">More Information</a>
                        </div>
                    </div>
                </div>
            
         </div>    
    </div>
</div>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/ResourceController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/ResourceService.js"></script>
