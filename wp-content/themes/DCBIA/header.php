<?php
    use Member\Controller\MemberController;
use Member\Helper\MemberHelper;
require_once __DIR__."/helpers/front-page-helper.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DCBIA">
    <meta name="DCBIA">
    <link rel="icon" href="favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,400italic' rel='stylesheet' type='text/css'>
    <title>DCBIA</title>
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/wp-content/profile-builder\assets\css\style-front-end.css">
    
    <script src="<?php wp_enqueue_script("jquery"); ?>"></script>
    <?php wp_head(); ?>
  </head> 
  <body>

  <div class="wrapper">
      <div ng-app="angular-wp">
        <header>  
        <div class="container all-pad-gone"> 
          <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
              <a title="link to home page" id="logo" href="/"><span id="top"></span><img class="img-responsive" alt="DCBIA logo" src="<?php echo get_template_directory_uri() ;?>/img/dcbia-logo-top-nav.svg" /></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul id="main-nav" class="nav navbar-nav hide-desktop">
                  <li id="m-about" <?php if($url == "about" || $url == "about")
                      echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/about">ABOUT</a>
                  </li>
                <li id="m-join" <?php if($url == "register" || $url == "register") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/register">JOIN</a></li>
                <li id="m-advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/advocacy">ADVOCACY</a></li>
                  <li id="m-sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/sponsors">SPONSORS</a></li>

                  <li id="m-events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/events">EVENTS</a></li>
                  <li id="m-news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/news">NEWS</a></li>
             </ul>   	         
                
              <ul class="nav new-pull-right">
                <li>
                  <form title="Search Insites" class="searching" action="" method="post" class="top-search" role="search">
                    <div class="form-group new-pull-right">
                        <label class="hidden" for="search">SEARCH</label>
                        <input name="query" id="top-searcher" class="grey" type="text" placeholder="SEARCH">
                        <button type="submit" class="search-btn light-blue" title="submit seach results"><i class="fa fa-search"></i></button>
                    </div>
                  </form>
                </li>
                <li>
                    <ul id="btn-top-nav" class="nav new-pull-right">
                        <li><a href="<?php echo get_site_url(); ?>/member-directory">MEMBER DIRECTORY</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/job-bank">JOB BANK</a></li>    
                        <li><a href="<?php echo get_site_url(); ?>/media">MEDIA</a></li>    
                        <li><a href="<?php echo get_site_url(); ?>/contact">CONTACT</a></li>
                    </ul>
                </li>  
               </ul>
               
              <br>
            </div> 
        </nav>      
     </div>     
  </header>
<div class="container-fluid">
<?php if(wp_get_current_user()->ID != 0 && !MemberHelper::isCurrentAccountActive() && wp_get_current_user()->roles[0] != "administrator"): ?>
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12 about">   
               <div class="alert alert-warning">
                    Your account has expired, if you want to continue using our services click <a href="/renewal">here</a>
               </div>
            </div>
        </div>
    </div>
<?php endif; ?>
