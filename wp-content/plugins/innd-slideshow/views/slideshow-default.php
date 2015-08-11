<div class="item <?php echo $active; ?>">
            
        <?php 
            if($slideshowType == "video" && $video != ""){
                self::showIframe($video);
            }
            else if($image != ""){
        ?>
        <div class="slideshow-image-wrapper">
            <div class="item <?php echo $active; ?>" >
            </div>
        </div>
        <?php 
          }  
        ?>
        <div class="container">
            <div class="carousel-caption">
                <h1><a style="text-decoration:none;" href='<?php echo $link; ?>'><?php echo $title; ?></a></h1>
                <?php if(isset($subtitle)): ?>
                    <p><a href='<?php echo $link; ?>'><?php echo $subtitle;  ?> </a></p> 
                <?php endif; ?>
                
                <?php if($link != ""): ?>
                    <p><a class="slide-bt" style="text-decoration:none;" href='<?php echo $link; ?>'>Learn More</a></p>
                <?php endif; ?>
            </div> 
        </div>
</div>

<style type="text/css">
    .slideshow-image-wrapper .item{
        background: -moz-linear-gradient(right, rgba(255,255,255,0.2), rgba(0,0,0,0.6) 90%), url(<?php echo $image; ?>) no-repeat center !important;
        background: -webkit-radial-gradient(top center, ellipse cover, rgba(255,255,255,0.2) 0%,rgba(0,0,0,0.6) 90%),url(<?php echo $image; ?>) no-repeat center !important;
        background: radial-gradient(ellipse at top center,  rgba(255,255,255,0.2) 0%,rgba(0,0,0,0.6) 90%),url(<?php echo $image; ?>) no-repeat center !important;
    }
</style>