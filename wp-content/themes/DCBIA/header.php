<?php?>
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

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/angular.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/angular-cookies.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular/app.js"></script>
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
              <a title="link to home page" id="logo" href="/"><span id="top"></span><img class="img-responsive" alt="DCBIA logo" src="<?php echo get_template_directory_uri() ;?>/img/dcbia-logo.png" /></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse hide-desktop" id="bs-example-navbar-collapse-1">
              <ul id="main-nav" class="nav navbar-nav custom-nav">
                  <li id="about" <?php if($url == "about" || $url == "about")
                      echo "class='active'"; ?>><a href="/about">ABOUT</a>
                  </li>
                  <li id="join"><a href="/join">JOIN</a></li>
                <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
                  <li id="donate" <?php if($url == "donate" || $url == "donate") echo "class='active'"; ?>><a href="/donate">Donate</a></li>

                  <li id="contact" <?php if($url == "contact" || $url == "contact") echo "class='active'"; ?>><a href="/contact">Contact</a></li>
             </ul>
           	 		   			 SPONSORS             	EVENTS	     	        NEWS   	         
                
              <ul id="main-nav" class="nav navbar-nav navbar-right">
                <li class="dropdown new-search-dropdown">
                  <a href="#" title="search button" class="dropdown-toggle search-button" data-toggle="dropdown">&nbsp;</a>
                  <ul class="dropdown-menu" role="">
                    <li>
                      <form title="Search Insites" class="homeFormSearch" action="/resources" method="post" class="navbar-form" role="search">
                        <div class="form-group">
                            <label class="hidden" for="search-resources">Search Resources</label>
                            <input name="query" id="query" type="text" class="form-control" placeholder="Search Resources">
                        </div>
                        <button type="submit" class="search-form-btn1" title="submit seach results">Submit</button>
                      </form>
                    </li>
                  </ul>
                </li>
               </ul>
              <br>
            </div> 
        </nav>      
     </div>     
  </header>
<div class="container-fluid">

    <script type="text/javascript">
      jQuery( document ).ready(function() {
        jQuery('#homeFormSearch').submit(function (event){
            jQuery(this).attr('action', action = "/" + jQuery("#homeFormSearch select").val() + "/");
        });
      });
    </script>
