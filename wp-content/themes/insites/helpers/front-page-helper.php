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