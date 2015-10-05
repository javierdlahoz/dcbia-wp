<?php

use INUtils\Helper\PostHelper;
use Board\Entity\BoardEntity;

$boardEntity = dcbia::getEntity("board");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Job Title</label>
		<div class="col-lg-10 col-sm-10">
			<input type="text" class="form-control"
				name="<?php echo BoardEntity::JOB_TITLE; ?>" id="<?php echo BoardEntity::JOB_TITLE; ?>"
				value="<?php echo $boardEntity->getJobTitle(); ?>"
				required="true" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Email</label>
		<div class="col-lg-10 col-sm-10">
			<input type="email" class="form-control"
				name="board_email" id="board_email"
				value="<?php echo $boardEntity->getEmail(); ?>"
				required="true" />
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();