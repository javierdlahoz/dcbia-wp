<?php
use INUtils\Helper\PostHelper;

$jobEntity = dcbia::getEntity("job");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">URL</label>
		<div class="col-lg-10 col-sm-10">
			<input type="url" class="form-control" 
			 name="url" id="url" value="<?php echo $jobEntity->getUrl(); ?>"/>
		</div>
	</div>
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