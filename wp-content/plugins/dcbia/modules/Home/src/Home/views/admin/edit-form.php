<?php

use INUtils\Helper\PostHelper;

$home = dcbia::getEntity("home");
?>
<div class="form-group">
   <label>New Customers Percent.</label>
   <input type="number" class="form-control" id="newcustomers" name="newcustomers" value="<?php echo $home->getNewcustomers(); ?>">
</div>
<div class="form-group">
   <label>Industry Data</label>
   <input type="number" class="form-control" id="industrydata" name="industrydata" value="<?php echo $home->getIndustrydata(); ?>">
</div>
<br>
<br>
<?php echo PostHelper::addStylesAndScripts();