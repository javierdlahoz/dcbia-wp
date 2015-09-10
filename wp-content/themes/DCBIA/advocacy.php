<?php
use Resource\Helper\ResourceHelper;
/*
  Template Name: advocacy
*/
get_header();
$keyIssues = ResourceHelper::getKeyIssues();
?>
<div class="container all-pad-gone">
    <?php echo do_shortcode('[slideshow group="advocacy"]'); ?>
    <?php echo getTopMenu(); ?>     
</div> 

<!--start main content here-->

<div class="container all-pad-gone" ng-controller="ResourceController" ng-init="initial()">
    <div class="row">
        <div class="col-md-12 advocacy">   
            <h2>ADVOCACY</h2>
            <p>Members serve frequently and prominently on commissions, task forces and study groups to address crucial economic development and municipal governance issues. Member participation on a more continuous basis is encouraged through eleven standing committees, which work closely with agencies of the DC government to advise and assist in the efficient administration of city programs – most recently in areas related to land use, building regulation, comprehensive planning, tax issues and affordable housing and community development. Committees also work in collaboration with other business groups and community organizations to attract and retain business investment and to facilitate the revitalization of distressed areas in the city.</p>    
        </div>    
    </div>

    <div class="row">
        <div class="col-md-12 key-issues-container">
                <div class="key-top-search">
                    <input type="text" name="" id="advocacy-search" class="form-control" placeholder="Search" ng-model="formData.query">
                    <button class="btn advo-search-btn" type="button" ng-click="search()">Submit</button>
                </div>
                   <p>&nbsp;</p>
                <div class="row key-issue-boxes">    
                    <div class="col-sm-3">
                        <a ng-click="initial()" id="keys">
                            <i class="fa fa-key"></i>
                            <span>key issues</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a class="types" ng-click="getResourcesByType('resource_testimony')" id="resource_testimony">
                            <i class="fa fa-commenting"></i>
                            <span>recent testimony</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a class="types" ng-click="getResourcesByType('resource_publications')" id="resource_publications">
                            <i class="fa fa-book"></i>
                            <span>publi cations</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                    <div class="col-sm-3">
                        <a class="types" ng-click="getResourcesByType('resource_industry_data')" id="resource_industry_data">
                            <i class="fa fa-database"></i>
                            <span>Industry data</span>
                            <i class="fa fa-chevron-down arrowed"></i>
                        </a>
                    </div>    
                </div>
           
                <div class="row key-results" ng-hide="isTypeSearch">
                    <div class="col-md-12 top-key-nav">
                        <p>Choose a Key Issue:</p>
                        <ul>
                            <?php $isFirst = true; ?>
                            <?php foreach($keyIssues as $key => $value): ?>
                                <?php if($isFirst): ?>
                                    <li class="no-border">
                                        <a class="issues" href="" ng-click="getResourcesByKeyIssue('<?php echo $key; ?>')" id="<?php echo $key; ?>">
                                            <?php echo $value; ?>
                                        </a>
                                    </li>
                                <?php 
                                $isFirst = false;
                                else: ?>
                                    <li>
                                        <a class="issues" href="" ng-click="getResourcesByKeyIssue('<?php echo $key; ?>')" id="<?php echo $key; ?>">
                                            <?php echo $value; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>    
                </div>
                
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
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/ResourceController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/ResourceService.js"></script>
