<?php
use Staff\Entity\StaffEntity;
use INUtils\Helper\PostHelper;

$staffEntity = dcbia::getEntity("staff");
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
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Email</label>
		<div class="col-lg-10 col-sm-10">
			<input type="email" class="form-control"
				name="staff_email" id="staff_email"
				value="<?php echo $staffEntity->getEmail(); ?>"
				required="true" />
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();