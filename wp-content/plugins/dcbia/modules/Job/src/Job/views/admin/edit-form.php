<?php
use INUtils\Helper\PostHelper;

$jobEntity = dcbia::getEntity("job");
?>
<div class="panel-body">
	<!-- div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Company</label>
		<div class="col-lg-10 col-sm-10">
			<input type="text" class="form-control"
				name="company" id="company"
				value="<?php echo $jobEntity->getCompany(); ?>"
				required="true" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Company</label>
		<div class="col-lg-10 col-sm-10">
			<input type="text" class="form-control"
				name="company_url" id="company_url"
				value="<?php echo $jobEntity->getCompanyUrl(); ?>"/>
		</div>
	</div -->
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">PDF</label>
		<div class="col-lg-10 col-sm-10">
			<input type="file" class="form-control" name="file" id="file"/>
		</div>
	</div>
	<?php if($jobEntity->getFileName() != ""): ?>
	   <a href="<?php echo $jobEntity->getFileUrl(); ?>"><?php echo $jobEntity->getFileName(); ?></a>
	<?php endif; ?>
</div>
<?php
echo PostHelper::addStylesAndScripts();