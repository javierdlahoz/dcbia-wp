<?php
use Committee\Entity\CommitteeEntity;
use INUtils\Helper\PostHelper;

$committeeEntity = new CommitteeEntity(get_the_ID());

$facebook = $committeeEntity->getFacebook();
$twitter = $committeeEntity->getTwitter();
$google = $committeeEntity->getGoogle();
$pinterest = $committeeEntity->getPinterest();
$linkedin = $committeeEntity->getLinkedin();

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
					name="<?php echo CommitteeEntity::JOB_TITLE; ?>" id="<?php echo CommitteeEntity::JOB_TITLE; ?>"
					value="<?php echo $committeeEntity->getJobTitle(); ?>"
					required="true" />
			</div>
		</div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Facebook</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo CommitteeEntity::FACEBOOK; ?>" id="<?php echo CommitteeEntity::FACEBOOK; ?>"
                placeholder="Type url Facebook" class="form-control" value="<?php echo $facebook; ?>">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Twitter</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo CommitteeEntity::TWITTER; ?>" id="<?php echo CommitteeEntity::TWITTER; ?>"
                placeholder="Type url Twitter" class="form-control" value="<?php echo $twitter; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Linkedin</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo CommitteeEntity::LINKEDIN; ?>" id="<?php echo CommitteeEntity::LINKEDIN; ?>"
                placeholder="Type url Linkedin" class="form-control" value="<?php echo $linkedin; ?>">
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Google</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo CommitteeEntity::GOOGLE; ?>" id="<?php echo CommitteeEntity::GOOGLE; ?>"
            placeholder="Type url Google" class="form-control" value="<?php echo $google; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Pinterest</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo CommitteeEntity::PINTEREST; ?>" id="<?php echo CommitteeEntity::PINTEREST; ?>"
            placeholder="Type url Pinterest" class="form-control" value="<?php echo $pinterest; ?>">
          </div>
        </div>

	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();