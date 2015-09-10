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
              <a title="link to home page" id="logo" href="/"><span id="top"></span><img class="img-responsive" alt="DCBIA logo" src="<?php echo get_template_directory_uri() ;?>/img/dcbia-logo.png" /></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul id="main-nav" class="nav navbar-nav hide-desktop">
                  <li id="about" <?php if($url == "about" || $url == "about")
                      echo "class='active'"; ?>><a href="/about">ABOUT</a>
                  </li>
                  <li id="join"><a href="/join">JOIN</a></li>
                <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
                  <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>

                  <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
                  <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
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
                        <li><a href="/member-directory">MEMBER DIRECTORY</a></li>
                        <li><a href="">JOB BANK</a></li>    
                        <li><a href="">MEDIA</a></li>    
                        <li><a href="">CONTACT</a></li>
                    </ul>
                </li>  
               </ul>
               
              <br>
            </div> 
        </nav>      
     </div>     
  </header>
<div class="container-fluid">

