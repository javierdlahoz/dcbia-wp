<?php

use INUtils\Entity\PostEntity;
/*
  Template Name: resources
*/
require_once __DIR__ . "/helpers/front-page-helper.php";
$pageEntity = new PostEntity(get_the_ID());
get_header(); ?>
<div ng-controller="ResourceController" ng-init="queryinit();" ng-cloak>
        <?php echo do_shortcode('[slideshow group="resources"]'); ?>
    <resources-nav></resources-nav>

    <!--start main content here-->
    <div class="container-fluid greyish">
        <div class="container">
            <div class="row">
                <form action="" method="post" class="form-inline resources-form" id="search_form" role="form" onsubmit="return false;">
                    <div class="col-sm-5">
                        <label class="hidden" for="query">Search</label>    
                        <input id="query_from_post" type="hidden"
                        value="<?php
                            if(isset($_POST['query'])):
                                echo $_POST['query'];
                            else:
                                echo "";
                            endif;
                            ?>"/>
                        <label class="hidden" for="area-of-focus">Areas Of Focus</label>    
                        <input id="area-of-focus" type="hidden" value="<?php
                            if(isset($_POST['areasOfFocus'])):
                                echo $_POST['areasOfFocus'];
                            else:
                                echo "*";
                            endif;
                        ?>"/>

                        <input id="expression" type="text" ng-model="query"
                            class="form-control" placeholder="Search Resources"
                            ng-change="setQuery(query); searchResources()"
                         />
                    </div>
                    <div class="col-sm-2 col-xs-4 pull-left">
                        <label class="hidden" for="expression">Search Resources</label>
                        <input id="sub1" ng-click="searchResources();" type="submit"
                        class="resource-sub-btn" placeholder="Submit" />
                    </div>
                    <div class="col-sm-2 col-xs-4 pull-left">
                       <!--span class="search-titles hidden-sm">SORT BY:</span-->
                       <a ng-click="setOrderBy('title'); searchResources();" class="resource-sort">Title A-Z</a>
                    </div>
                    <div class="col-sm-2 col-xs-4 pull-left">
                       <!--<a ng-click="setOrderBy('date'); searchResources();" class="resource-sort">Date Created</a>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>
    <!--sidebar-->
    <div class="container">
        <div class="row" style="min-height: 800px;">
            <div class="col-sm-3 left-pad-gone">

                <div class="audiences-widget blueish" ng-show="query !== ''">
                    <h3>Keyword</h3>
                        <ul>
                            <li class="bold">
                                <i class="glyphicon glyphicon-ok"></i>
                                {{query}}
                            </li>
                        </ul>
                        <span ng-click="setQuery(''); searchResources()"
                            style="cursor: pointer">
                            <i class="glyphicon glyphicon-remove"></i>
                            Clear selection
                        </span>
                </div>

                <div class="audiences-widget purplish"><!-- resource-type-widget -->
                    <h3>Resource Type</h3>
                        <!-- p><b>System Thinking in Evatuation</b>&nbsp;<span>(70)</span></p -->
                        <ul>
                            <li ng-repeat="(resourceTypeKey, facetCount) in resources.facets.resource_type_facets"
                                ng-click="setResourceType(resourceTypeKey);" style="cursor: pointer"
                                ng-show="facetCount > 0" ng-class="{bold: checkIfValueExistsInObject(resourceTypeKey, resourceType)}">
                                <i class="glyphicon glyphicon-ok" ng-show="checkIfValueExistsInObject(resourceTypeKey, resourceType)"></i>
                                {{resourceTypeKey}}&nbsp;<span>({{facetCount}})</span>
                            </li>
                        </ul>
                        <br>
                        <span ng-click="setResourceType('*');"
                            style="cursor: pointer" ng-show="resourceType != '*' && resourceType != ''">
                            <i class="glyphicon glyphicon-remove"></i>
                            Clear selection
                        </span>
                </div>
                <div class="audiences-widget orangish">
                    <h3>Areas of Focus</h3>
       
                    <ul>
                        <li ng-repeat="areaOfFocusObject in resources.facets.areas_of_focus | orderBy : 'order'"
                            ng-click="setAreasOfFocus(areaOfFocusObject.key); searchResources()" style="cursor: pointer"
                            ng-show="areaOfFocusObject.value > 0" ng-class="{bold: checkIfValueExistsInObject(areaOfFocusObject.key, areasOfFocus)}">
                            <i class="glyphicon glyphicon-ok" ng-show="checkIfValueExistsInObject(areaOfFocusObject.key, areasOfFocus)"></i>
                            {{areaOfFocusObject.key}}&nbsp;<span>({{areaOfFocusObject.value}})</span>
                        </li>
                    </ul>
                    <span ng-click="setAreasOfFocus('*'); searchResources()"
                        style="cursor: pointer" ng-show="areasOfFocus != '*' && areasOfFocus != ''">
                        <i class="glyphicon glyphicon-remove"></i>
                        Clear selection
                    </span>
                </div>
                <div class="audiences-widget purplish">
                    <h3>Stakeholders</h3>
                  
                    <ul>
                        <li ng-repeat="(stakeholderKey, facetCount) in resources.facets.stakeholders"
                            ng-click="setStakeholders(stakeholderKey); searchResources()" style="cursor: pointer"
                            ng-show="facetCount > 0" ng-class="{bold: checkIfValueExistsInObject(stakeholderKey, stakeholders)}">
                            <i class="glyphicon glyphicon-ok" ng-show="checkIfValueExistsInObject(stakeholderKey, stakeholders)"></i>
                            {{stakeholderKey}}&nbsp;<span>({{facetCount}})</span>
                        </li>
                    </ul>
                    <span ng-click="setStakeholders('*'); searchResources()"
                        style="cursor: pointer" ng-show="stakeholders != '*' && stakeholders != ''">
                        <i class="glyphicon glyphicon-remove"></i>
                        Clear selection
                    </span>
                </div>

                <p>&nbsp;</p>
            </div>
            <!--main content-->
            <div class="col-sm-8 col-sm-offset-1 resource-main col-sm-offset-1" infinite-scroll="increasePaged()" infinite-scroll-distance="1">
                <h3>Resources Found: {{resources.count}}</h3>
                <share-this></share-this>
                <br><br>
                
                <div ng-repeat="resource in resources.resources">
                    <div class="col-md-12" ng-class-odd="left-pad-gone">
                        <div class="resource-info-blocks">
                            <h5>{{resource.title}}</h5>
                            <p class="tags">
                                <span>By:</span> {{resource.authors}} &nbsp;<br>
                            </p>
                            <p class="resources-box-text">{{resource.limitedDescription}}</p>
                            
                           <!-- <a ng-if="resource.format == 'word'" href="{{resource.file.url}}">
                                <img src="<?php echo get_template_directory_uri() ;?>/img/doc-icon.png" />
                            </a>
                            <a ng-if="resource.format == 'pdf'" href="{{resource.file.url}}">
                                <img src="<?php echo get_template_directory_uri() ;?>/img/pdf-icon.png" />
                                Download File
                            </a>
                            <a ng-if="resource.format == 'web_page'" href="{{resource.file.url}}" target="_new">
                                <img src="<?php echo get_template_directory_uri() ;?>/img/mail-icon.png" />
                                Go To Website
                            </a>
                            <a ng-if="resource.format == 'video'" href="{{resource.file.url}}">
                                <img src="<?php echo get_template_directory_uri() ;?>/img/video-icon.png" />
                            </a> -->
                            <a class="button-orng" href="{{resource.permalink}}">View Resource</a>
                        </div>
                        <br><br>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div ng-show="loading">
                    <center>
                        <img src="<?php echo get_template_directory_uri() ;?>/img/lazy-loading.gif" width="180px" />
                    </center>
                </div>
                
            </div>
<!--

            <br>
            <div class="pull-right" ng-show="resources.count > 0">
                <span ng-show="paged > 1">
                    <a href="" ng-click="decreasePaged(); searchResources()">< Previous</a>
                </span>
                <span>&nbsp;</span>
                <span ng-show="resources.pages > 1 && paged < resources.pages">
                    <a href="" ng-click="increasePaged(); searchResources()">Next ></a>
                </span>
            </div>
-->
        </div>
    </div>
    <p>&nbsp;</p>
</div>
<!--	infinite scroll-->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/ResourceService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/ResourceController.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/directives/resourcesNav.js"></script>
<?php get_footer();
