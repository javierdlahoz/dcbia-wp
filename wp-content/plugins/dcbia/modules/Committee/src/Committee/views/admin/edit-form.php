<?php

use INUtils\Helper\PostHelper;

$committeeEntity = dcbia::getEntity("committee");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">CO - Chairs</label>
		<div class="col-lg-10 col-sm-10">
			<textarea type="text" class="form-control" name="co_chairs" 
			 id="co_chairs"><?php echo $committeeEntity->getCoChairs(); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">DLD Vice Chair</label>
		<div class="col-lg-10 col-sm-10">
			<textarea type="text" class="form-control" name="vice_chairs" 
			 id="vice_chairs"><?php echo $committeeEntity->getViceChairs(); ?></textarea>
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();