<?php

use INUtils\Helper\PostHelper;

$home = dcbia::getEntity("home");
?>

<div class="form-group">
   <label>Custom Data Label</label>
   <input type="text" class="form-control" id="customdatalabel" name="customdatalabel" 
    value="<?php echo $home->getCustomdatalabel(); ?>">
</div>

<div class="form-group">
   <label>Custom Data</label>
   <input type="number" class="form-control" id="newcustomers" step="any" 
   name="newcustomers" value="<?php echo $home->getNewcustomers(); ?>">
</div>

<div class="form-group">
   <label>Industry Data Label</label>
   <input type="text" class="form-control" id="industrydatalabel" name="industrydatalabel" 
    value="<?php echo $home->getIndustrydatalabel(); ?>">
</div>

<div class="form-group">
   <label>Industry Data</label>
   <input type="number" class="form-control" id="industrydata" name="industrydata" step="any" 
   value="<?php echo $home->getIndustrydata(); ?>">
</div>

<br>
<br>
<?php echo PostHelper::addStylesAndScripts();