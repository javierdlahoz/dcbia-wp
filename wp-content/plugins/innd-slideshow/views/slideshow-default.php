<div class="item <?php echo $active; ?>">
            
        <?php 
            if($slideshowType == "video" && $video != ""){
                self::showIframe($video);
            }
            else if($image != ""){
        ?>
        <div class="slideshow-image-wrapper">
            <div class="item <?php echo $active; ?>" style="height: 450px; background:-webkit-radial-gradient(top center, ellipse cover, rgba(255,255,255,0.2) 0%,rgba(0,0,0,0.5) 90%),url(<?php echo $image; ?>) no-repeat center;">
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
                    <p><a class="slide-bt" style="text-decoration:none;" href='<?php echo $link; ?>'>LEARN MORE</a></p>
                <?php endif; ?>
            </div> 
        </div>
</div>

