<?php
use INUtils\Helper\AdminPanelHelper;
?>
<div class="col-sm-3 left-pad-gone">
	<div class="audiences-widget purplish">
		<p>&nbsp;</p>
		<img alt="drop pin icon" class="widget-icon"
			src="<?php echo get_template_directory_uri() ;?>/img/drop-pin.png" />
		<p class="large-text">1307 Sanford Drive<br />Fort Collins, CO 80526</p>
				<p class="large-text">Phone: <?php echo AdminPanelHelper::getOption(\InsitesBackend::PHONE); ?><br>
                   <!-- Direct: <!--?php echo AdminPanelHelper::getOption(\InsitesBackend::DIRECT); ?>--></p>
	</div>
	
	<?php if($isBlog === true): ?>
	<?php getBlogSidebar(); ?>
    <?php endif;?>
</div>
