<?php

function getUrl(){
    $urls = explode("/", $_SERVER["REQUEST_URI"]);
    if(isset($urls[1])){
        $url = $urls[1];
    }
    else{
        $url = "/";
    }

    if($url == "publication" && count($urls) == 3){
        header("Location: /publications");
    }

    return $url;
}

function getTopMenu(){ ?>
    <nav class="site-navigation" role="navigation">
        <ul class="nav custom-nav hide-on-phone">
        <li id="about">
            <a href="<?php echo get_site_url(); ?>/about">ABOUT</a>
            <ul class="" id="" role="menu">       
                <li id="staff"><a href="<?php echo get_site_url(); ?>/about/staff">STAFF</a></li>
                <li id="board"><a href="<?php echo get_site_url(); ?>/about/">BOARD</a></li>
                <li id="committees"><a href="<?php echo get_site_url(); ?>/about/">COMMITTEES</a></li>
            </ul>
            </li>
            <li id="join"><a href="<?php echo get_site_url(); ?>/join">JOIN</a></li>
            <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/advocacy">ADVOCACY</a></li>
            <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/sponsors">SPONSORS</a></li>
            
            <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/events">EVENTS</a></li>
            <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="<?php echo get_site_url(); ?>/news">NEWS</a></li>
        </ul> 
    </nav> 
<?php }