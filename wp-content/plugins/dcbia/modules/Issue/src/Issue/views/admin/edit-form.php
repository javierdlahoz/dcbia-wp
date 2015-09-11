<?php
use INUtils\Helper\PostHelper;

$issueEntity = dcbia::getEntity("issue");
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Short Description</label>
		<div class="col-lg-10 col-sm-10">
			<textarea type="text" class="form-control" rows="5"
				name="short_description" id="short_description"
				required="true"><?php echo $issueEntity->getShortDescription(); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Is Featured?</label>
		<div class="col-lg-10 col-sm-10">
			<input type="checkbox" class="form-control" name="is_featured" id="is_featured" 
			     <?php if($issueEntity->getIsFeatured()): ?>checked="checked"<?php endif; ?>/>
		</div>
	</div>
	
</div>
<?php
echo PostHelper::addStylesAndScripts();