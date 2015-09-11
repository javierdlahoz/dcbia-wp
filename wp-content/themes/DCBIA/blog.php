<?php
use Member\Helper\MemberHelper;
/*
  Template Name: blog
*/
get_header();  ?>
<div id="container-app" ng-controller="MemberController" ng-init="search()">
    <div class="container all-pad-gone">      
          <?php echo getTopMenu(); ?>  
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
                <div class="member-side-result-box">
                    <h4>Types</h4>
                    <div class="inside-side-member">
                       
                            <p><a href="" class="business-categories"></a></p>
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