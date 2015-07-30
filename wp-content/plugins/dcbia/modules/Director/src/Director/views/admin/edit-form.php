<?php
use Director\Entity\DirectorEntity;
use INUtils\Helper\PostHelper;

$directorEntity = new DirectorEntity(get_the_ID());

$facebook = $directorEntity->getFacebook();
$twitter = $directorEntity->getTwitter();
$google = $directorEntity->getGoogle();
$pinterest = $directorEntity->getPinterest();
$linkedin = $directorEntity->getLinkedin();

?>
<div id="location">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-lg-2 col-sm-2">Job Title</label>
			<div class="col-lg-10 col-sm-10">
				<input type="text" class="form-control"
					name="<?php echo DirectorEntity::JOB_TITLE; ?>" id="<?php echo DirectorEntity::JOB_TITLE; ?>"
					value="<?php echo $directorEntity->getJobTitle(); ?>"
					required="true" />
			</div>
		</div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Facebook</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo DirectorEntity::FACEBOOK; ?>" id="<?php echo DirectorEntity::FACEBOOK; ?>"
                placeholder="Type url Facebook" class="form-control" value="<?php echo $facebook; ?>">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Twitter</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo DirectorEntity::TWITTER; ?>" id="<?php echo DirectorEntity::TWITTER; ?>"
                placeholder="Type url Twitter" class="form-control" value="<?php echo $twitter; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2 col-sm-2">Linkedin</label>
            <div class="col-lg-10 col-sm-10">
                <input type="text" name="<?php echo DirectorEntity::LINKEDIN; ?>" id="<?php echo DirectorEntity::LINKEDIN; ?>"
                placeholder="Type url Linkedin" class="form-control" value="<?php echo $linkedin; ?>">
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Google</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo DirectorEntity::GOOGLE; ?>" id="<?php echo DirectorEntity::GOOGLE; ?>"
            placeholder="Type url Google" class="form-control" value="<?php echo $google; ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-lg-2 col-sm-2">Pinterest</label>
          <div class="col-lg-10 col-sm-10">
            <input type="text" name="<?php echo DirectorEntity::PINTEREST; ?>" id="<?php echo DirectorEntity::PINTEREST; ?>"
            placeholder="Type url Pinterest" class="form-control" value="<?php echo $pinterest; ?>">
          </div>
        </div>

	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();