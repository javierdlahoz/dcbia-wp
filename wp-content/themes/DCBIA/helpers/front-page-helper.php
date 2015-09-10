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

function getResourcesNav(){
    include __DIR__.'/resources-nav.php';
}

function getAboutNav(){
    include __DIR__.'/about-nav.php';
}

function getContactSidebar($isBlog = false){
    include __DIR__.'/contact-sidebar.php';
}

function getBlogSidebar(){
    include __DIR__.'/blog-sidebar.php';
}

function getFeaturedContentNav(){
    include __DIR__.'/featured-content.php';
}

function getDonateNav(){
    include __DIR__.'/donate-nav.php';
}

function getTopMenu(){ ?>
    <nav class="site-navigation" role="navigation">
        <ul class="nav custom-nav hide-on-phone">
        <li id="about">
            <a href="/about">ABOUT</a>
            <ul class="" id="" role="menu">       
                <li id="staff"><a href="/about/">STAFF</a></li>
                <li id="board"><a href="/about/">BOARD</a></li>
                <li id="committees"><a href="/about/">COMMITTEES</a></li>
            </ul>
            </li>
            <li id="join"><a href="/register">JOIN</a></li>
            <li id="advocacy" <?php if($url == "advocacy" || $url == "advocacy") echo "class='active'"; ?>><a href="/advocacy">ADVOCACY</a></li>
            <li id="sponsors" <?php if($url == "sponsors" || $url == "sponsors") echo "class='active'"; ?>><a href="/sponsors">SPONSORS</a></li>
            
            <li id="events" <?php if($url == "events" || $url == "events") echo "class='active'"; ?>><a href="/events">EVENTS</a></li>
            <li id="news" <?php if($url == "news" || $url == "news") echo "class='active'"; ?>><a href="/news">NEWS</a></li>
        </ul> 
    </nav> 
<?php }