<?php

/*
  Template Name: search-template
*/

get_header();
?>
<p>&nbsp;</p>
<div id="angular-app" style="display: none">
    <div ng-controller="PostController" ng-cloak>
        <div class="container inside-pages">
            <div class="row">

                <div class="form-group">
                    <label>Search</label>
                    <input type="text" ng-model="query" placeholder="type something to search">
                    <button class="btn btn-primary" ng-click="searchPosts()">Search</button>
                </div>

                <!-- this is gonna be visible only when we got results -->
                <div class="col-xs-12 searcher-page" ng-hide="isLoading === true">
                    <h1>Search Results</h1>
                    <h3>We Found About <span>{{postsFound}}</span> Results</h3>

                    <div class="search-results-inside-box" ng-repeat="post in posts">
                        <h4><a href="">{{post.title}}</a></h4>
                        <p><b>By:</b> {{post.author}}
                        <div class="search-text">
                            <p>{{post.limitedContent}}</p>
                        </div>
                        <a class="button-blu" href="{{post.permalink}}">View More</a>
                    </div>

                    <div class="pull-right" ng-show="postsFound > 0">
                        <span ng-show="paged > 1">
                            <a href="" ng-click="decreasePaged(); searchPosts()">< Previous</a>
                        </span>
                        <span>&nbsp;</span>
                        <span ng-show="pagesNumber > 1 && paged < pagesNumber">
                            <a href="" ng-click="increasePaged(); searchPosts()">Next ></a>
                        </span>
                    </div>

                </div>

                <!-- this is gonna be visible only when it's loading -->
                <div ng-show="isLoading === true">
                    <h2>Please wait my friend...</h2>
                </div>

            </div>
            <form>
                <input type="hidden" id="query" value="<?php echo $_POST['expression']; ?>" ng-init="searchPosts()">
            </form>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/services/PostService.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/PostController.js"></script>
<?php get_footer();