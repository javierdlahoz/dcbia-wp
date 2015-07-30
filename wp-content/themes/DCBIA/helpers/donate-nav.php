<?php
use INUtils\Service\PostService;
use INUtils\Helper\TextHelper;

$donatePage = PostService::getSingleton()->getPostByPageName("donate");
?>
<div class="audiences-widget purplish"><!-- resource-type-widget -->
<h3>Donate</h3>
<br>
<p><?php echo TextHelper::cropText($donatePage->getContent()); ?></p>
    <a href="<?php echo $donatePage->getPermalink(); ?>" class="button-widget">Contribute</a>
</div>