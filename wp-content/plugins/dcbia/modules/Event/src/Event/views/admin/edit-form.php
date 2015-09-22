<?php
use INUtils\Helper\PostHelper;
use INUtils\Entity\PostEntity;

$eventEntity = new PostEntity(get_the_ID());
?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Payment Widget</label>
		<div class="col-lg-10 col-sm-10">
			<textarea class="form-control" rows="5"
				name="payment_url" id="payment_url"><?php echo $eventEntity->getPaymentUrl(); ?></textarea>
		</div>
	</div>	
</div>
<?php
echo PostHelper::addStylesAndScripts();