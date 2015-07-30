<?php
use Staff\Entity\StaffEntity;
use INUtils\Helper\PostHelper;

$staffEntity = new StaffEntity(get_the_ID());

$facebook = $staffEntity->getFacebook();
$twitter = $staffEntity->getTwitter();
$google = $staffEntity->getGoogle();
$pinterest = $staffEntity->getPinterest();
$linkedin = $staffEntity->getLinkedin();

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
					name="<?php echo StaffEntity::JOB_TITLE; ?>" id="<?php echo StaffEntity::JOB_TITLE; ?>"
					value="<?php echo $staffEntity->getJobTitle(); ?>"
					required="true" />
			</div>
		</div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Facebook</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo StaffEntity::FACEBOOK; ?>" id="<?php echo StaffEntity::FACEBOOK; ?>"
                placeholder="Type url Facebook" class="form-control" value="<?php echo $facebook; ?>">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Twitter</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo StaffEntity::TWITTER; ?>" id="<?php echo StaffEntity::TWITTER; ?>"
                placeholder="Type url Twitter" class="form-control" value="<?php echo $twitter; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Linkedin</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo StaffEntity::LINKEDIN; ?>" id="<?php echo StaffEntity::LINKEDIN; ?>"
                placeholder="Type url Linkedin" class="form-control" value="<?php echo $linkedin; ?>">
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Google</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo StaffEntity::GOOGLE; ?>" id="<?php echo StaffEntity::GOOGLE; ?>"
            placeholder="Type url Google" class="form-control" value="<?php echo $google; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Pinterest</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo StaffEntity::PINTEREST; ?>" id="<?php echo StaffEntity::PINTEREST; ?>"
            placeholder="Type url Pinterest" class="form-control" value="<?php echo $pinterest; ?>">
          </div>
        </div>

	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();