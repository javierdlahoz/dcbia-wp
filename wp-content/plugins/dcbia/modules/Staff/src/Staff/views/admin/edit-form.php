<?php
use Staff\Entity\StaffEntity;
use INUtils\Helper\PostHelper;

$staffEntity = new StaffEntity(get_the_ID());
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Job Title</label>
		<div class="col-lg-10 col-sm-10">
			<input type="text" class="form-control"
				name="<?php echo StaffEntity::JOB_TITLE; ?>" id="<?php echo StaffEntity::JOB_TITLE; ?>"
				value="<?php echo $staffEntity->getJobTitle(); ?>"
				required="true" />
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();