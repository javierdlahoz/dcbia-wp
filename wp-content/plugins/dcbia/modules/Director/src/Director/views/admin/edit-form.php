<?php
use Director\Entity\DirectorEntity;
use INUtils\Helper\PostHelper;

$directorEntity = dcbia::getEntity("director");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Job Title</label>
		<div class="col-lg-10 col-sm-10">
			<input type="text" class="form-control"
				name="<?php echo DirectorEntity::JOB_TITLE; ?>" id="<?php echo DirectorEntity::JOB_TITLE; ?>"
				value="<?php echo $directorEntity->getJobTitle(); ?>"
				required="true" />
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();