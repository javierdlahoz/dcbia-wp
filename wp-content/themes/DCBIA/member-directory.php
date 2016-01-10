<?php
use Member\Helper\MemberHelper;
/*
  Template Name: member-directory
*/
get_header();  ?>
<div id="container-app" ng-controller="MemberController" ng-init="search()">
    <div class="container all-pad-gone">      
          <?php echo getTopMenu(); ?>
            <div class="member-top-searchbar">
                <div class="col-md-5">
                	<form ng-submit="search()">
                        <input type="text" ng-model="query.query" name="" id="member-search" class="form-control" placeholder="SEARCH">
                        <button type="submit" class="member-search-btn" title="submit member seach results"><i class="fa fa-search"></i></button>
                    </form>
                </div>    
                <div class="col-sm-1 col-xs-2">
                    <span class="search-titles">SORT BY:</span>
                </div>
                <div class="col-sm-3 col-xs-3">    
                    <a href="" class="member-sort" id="sort-title" ng-click="setOrderBy('title')">TITLE A-Z</a>
                </div>
   <!--             <div class="col-sm-1 col-xs-3">
                    <a href="" class="member-sort" id="sort-date" ng-click="setOrderBy('date')">DATE CREATED</a>
                </div>-->
            </div>
            <div class="member-bottom-resultbar" ng-cloak>
                <div class="col-sm-6 col-xs-6">
                    <h4>member directory</h4>
                    <h5 ng-show="members.length == 0" ng-cloak>No members were found</h5>
                
                </div>       
                <div class="col-sm-6 col-xs-6">
                    <!--<a class="member-share pull-right" href="">share<i class="fa fa-share-square"></i></a>-->
                </div>       
            </div>    
        </div> 
    
    <!--start main content here-->
    
    <p>&nbsp;</p>
    <div class="container all-pad-gone pagination-box">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <a class="button1" ng-click="decreasePage()" ng-hide="query.page <= 1">< Last</a>
                    <span>&nbsp;&nbsp;</span>
                    <a class="button1" ng-click="increasePage()" ng-hide="query.page >= pages">Next ></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-sm-4">
                <div class="results-heading">
                    <h4>Results per page:</h4>
                    <span>&nbsp;</span> 
                    <a href="" ng-click="setResultsPerPage(20)" ng-class="{'active': query.resultsPerPage == 20}">20</a>
                    <span>&nbsp;</span>
                    <a href="" ng-click="setResultsPerPage(50)" ng-class="{'active': query.resultsPerPage == 50}">50</a>
                    <span>&nbsp;</span>
                    <a href="" ng-click="setResultsPerPage(100)" ng-class="{'active': query.resultsPerPage == 100}">100</a>
                </div>    
                <div class="member-side-result-box">
                    <h4>Types</h4>
                    <div class="inside-side-member">
                        <?php foreach(MemberHelper::getBusinessCategories() as $category): ?>
                            <p><a href="" class="business-categories" id="<?php echo MemberHelper::replaceSpaces($category); ?>"
                                ng-click="setBusinessCategory('<?php echo $category?>')">
                                <?php echo $category; ?>
                            </a></p>
                        <?php endforeach; ?>
                        <p ng-hide="query.business_category == ''"><a href="" ng-click="setBusinessCategory('')" class="pull-right">
                            Clear
                        </a></p>
                        <p><a href="">&nbsp;</a></p>
                    </div>    
                </div>
             </div>
             <div class="col-sm-8 members-main">
                
                <div ng-show="loading">
                    <center>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" height="64">
                    </center>
                </div>
                
                
                <div class="member-details" ng-repeat="member in members" ng-hide="loading" ng-cloak ng-hide="member.organization == ''">
                    <!--  h4 ng-show="member.name != ' '">{{member.name}}</h4>
                    <h4 ng-hide="member.name != ' '">{{member.email}}</h4 -->
                    <h4>{{member.organization}}</h4>
                    <p>{{member.cropBio}}</p>
                    
                    <!-- a class="button1" href="{{member.permalink}}">View Company Site</a  -->
                </div>
             </div>     
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MemberController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/MemberService.js"></script>