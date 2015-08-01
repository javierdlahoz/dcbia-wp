<?php
use Job\Entity\JobEntity;
use INUtils\Helper\PostHelper;

$jobEntity = new JobEntity(get_the_ID());
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Link</label>
		<div class="col-lg-10 col-sm-10">
			<input type="url" class="form-control"
				name="<?php echo JobEntity::LINK; ?>" id="<?php echo JobEntity::LINK; ?>"
				value="<?php echo $jobEntity->getLink(); ?>"
				required="true" />
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();