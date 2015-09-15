<?php

use INUtils\Helper\PostHelper;
use Sponsor\Entity\SponsorEntity;

$sponsorEntity = new SponsorEntity(get_the_ID());
?>
<div id="url">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-lg-2 col-sm-2">Url</label>
			<div class="col-lg-10 col-sm-10">
				<input type="text" class="form-control"
					name="<?php echo SponsorEntity::URL; ?>" id="<?php echo SponsorEntity::URL; ?>"
					value="<?php echo $sponsorEntity->getUrl(); ?>" />
			</div>
		</div>
	</div>
</div>
<?php
echo PostHelper::addStylesAndScripts();