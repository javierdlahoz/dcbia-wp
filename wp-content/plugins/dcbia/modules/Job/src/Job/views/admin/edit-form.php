<?php
use Job\Entity\JobEntity;
use INUtils\Helper\PostHelper;

$jobEntity = new JobEntity(get_the_ID());

?>
<h2>
	<legend>Job Title</legend>
</h2>
<div id="location">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-lg-2 col-sm-2">Job Title</label>
			<div class="col-lg-10 col-sm-10">
				<input type="text" class="form-control"
					name="<?php echo JobEntity::JOB_TITLE; ?>" id="<?php echo JobEntity::JOB_TITLE; ?>"
					value="<?php echo $jobEntity->getJobTitle(); ?>"
					required="true" />
			</div>
		</div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Facebook</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo JobEntity::FACEBOOK; ?>" id="<?php echo JobEntity::FACEBOOK; ?>"
                placeholder="Type url Facebook" class="form-control" value="<?php echo $jobEntity->getFacebook(); ?>">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Twitter</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo JobEntity::TWITTER; ?>" id="<?php echo JobEntity::TWITTER; ?>"
                placeholder="Type url Twitter" class="form-control" value="<?php echo $jobEntity->getTwitter(); ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Linkedin</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo JobEntity::LINKEDIN; ?>" id="<?php echo JobEntity::LINKEDIN; ?>"
                placeholder="Type url Linkedin" class="form-control" value="<?php echo $jobEntity->getLinkedin(); ?>">
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Google</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo JobEntity::GOOGLE; ?>" id="<?php echo JobEntity::GOOGLE; ?>"
            placeholder="Type url Google" class="form-control" value="<?php echo $jobEntity->getGoogle(); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Pinterest</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo JobEntity::PINTEREST; ?>" id="<?php echo JobEntity::PINTEREST; ?>"
            placeholder="Type url Pinterest" class="form-control" value="<?php echo $jobEntity->getPinterest(); ?>">
          </div>
        </div>

	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();