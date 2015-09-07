<?php
use Member\Helper\MemberHelper;
/*
  Template Name: member-directory
*/
get_header();  ?>
<div id="container-app" ng-controller="MemberController" ng-init="search()">
    <div class="container all-pad-gone">      
          <nav class="site-navigation" role="navigation">
              <ul class="nav custom-nav hide-on-phone">
                  <li id="about" <?php if($url == "about" || $url == "about")
                      echo "class='active'"; ?>><a href="/about">ABOUT</a>
                      <ul class="" id="" role="menu">       
                            <li id="staff"><a href="/about/">STAFF</a></li>
                            <li id="board"><a href="/about/">BOARD</a></li>
                            <li id="committees"><a href="/about/">COMMITTEES</a></li>
                      </ul>
                  </li>
                  <li id="join"><a href="/join">JOIN</a></li>
                  <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
                  <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>
    
                  <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
                  <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
                </ul> 
            </nav>
            <div class="member-top-searchbar">
                <div class="col-md-5">
                    <input type="text" ng-model="query.query" name="" id="member-search" class="form-control" placeholder="SEARCH">
                    <button type="submit" ng-click="search()" class="member-search-btn" title="submit member seach results"><i class="fa fa-search"></i></button>
                </div>    
                <div class="col-md-1 col-xs-2">
                    <span class="search-titles">SORT BY:</span>
                </div>
                <div class="col-sm-2 col-xs-4">    
                    <a href="" class="member-sort" id="sort-title" ng-click="setOrderBy('title')">TITLE A-Z</a>
                </div>
                <div class="col-sm-2 col-xs-4">
                    <a href="" class="member-sort" id="sort-date" ng-click="setOrderBy('date')">DATE CREATED</a>
                </div>
            </div>
            <div class="member-bottom-resultbar" ng-cloak>
                <div class="col-sm-6 col-xs-6">
                    <h4>member directory</h4>
                    <h5 ng-show="total > 0">DISPLAYING {{fNumber}}-{{lNumber}} OF {{total | number}} RESULTS</h5>
                    <h5 ng-show="members.length == 0" ng-cloak>No members were found</h5>
                
                </div>       
                <div class="col-sm-6 col-xs-6">
                    <a class="member-share pull-right" href="">share<i class="fa fa-share-square"></i></a>
                </div>       
            </div>    
        </div> 
    
    <!--start main content here-->
    
    <p>&nbsp;</p>
    <div class="row col-md-12">
        <div class="pull-right">
            <a class="button1" ng-click="decreasePage()" ng-hide="query.page <= 1"><< Last</a>
            <span>&nbsp;&nbsp;</span>
            <a class="button1" ng-click="increasePage()" ng-hide="query.page >= pages">Next >></a>
        </div>
    </div>
    
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-sm-4">
                Results per page:
                <span>&nbsp;</span> 
                <a href="" ng-click="setResultsPerPage(20)">20</a>
                <span>&nbsp;</span>
                <a href="" ng-click="setResultsPerPage(50)">50</a>
                <span>&nbsp;</span>
                <a href="" ng-click="setResultsPerPage(100)">100</a>
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
                <h2 ng-cloak>members found: <span>{{total | number}}</span></h2>
                
                <div ng-show="loading">
                    <center>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/loading.gif" height="64">
                    </center>
                </div>
                
                
                <div class="member-details" ng-repeat="member in members">
                    <h4>{{member.name}}</h4>
                    <p ng-hide="member.cropBio == ''">{{member.cropBio}}</p>
                    <p ng-show="member.cropBio == ''">{{member.email}}</p>
                    <a class="button1" href="{{member.permalink}}">View  memeber</a>
                </div>
             </div>     
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/MemberController.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/angular/services/MemberService.js"></script>