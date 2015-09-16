<?php
use INUtils\Helper\PostHelper;

$directorEntity = dcbia::getEntity("director");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">PDF</label>
		<div class="col-lg-10 col-sm-10">
			<input type="file" class="form-control" name="file" id="file"/>
		</div>
	</div>
	<?php if($directorEntity->getFileName() != ""): ?>
	   <a href="<?php echo $directorEntity->getFileUrl(); ?>"><?php echo $directorEntity->getFileName(); ?></a>
	<?php endif; ?>
</div>
<?php
echo PostHelper::addStylesAndScripts();