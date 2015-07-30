<?php

use Home\Entity\HomeEntity;
use INUtils\Helper\PostHelper;

$home = new HomeEntity(get_the_ID());
?>
<div class="form-group">
   <label>What We Do</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::WHAT_WE_DO?>"
        name="<?php echo HomeEntity::WHAT_WE_DO?>"><?php echo $home->getWhatWeDo(); ?></textarea>
</div>

<div class="form-group">
   <label>How we work</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::WHO_WE_ARE?>"
        name="<?php echo HomeEntity::WHO_WE_ARE?>"><?php echo $home->getWhoWeAre(); ?></textarea>
</div>

<div class="form-group">
   <label>What We Know</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::WHAT_WE_KNOW?>"
        name="<?php echo HomeEntity::WHAT_WE_KNOW?>"><?php echo $home->getWhatWeKnow(); ?></textarea>
</div>

<div class="form-group">
   <label>Evaluation Capacity Building</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::EVALUATION?>"
        name="<?php echo HomeEntity::EVALUATION?>"><?php echo $home->getEvaluation(); ?></textarea>
</div>

<div class="form-group">
   <label>Systems-Oriented Evaluation</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::SYSTEM_ORIENTED?>"
        name="<?php echo HomeEntity::SYSTEM_ORIENTED?>"><?php echo $home->getSystemOriented(); ?></textarea>
</div>

<div class="form-group">
   <label>Sustainability & Equity</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::SUSTAINABILITY?>"
        name="<?php echo HomeEntity::SUSTAINABILITY?>"><?php echo $home->getSustainabilty(); ?></textarea>
</div>

<div class="form-group">
   <label>Basic Evaluation Methods</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::BASIC_EVALUATION?>"
        name="<?php echo HomeEntity::BASIC_EVALUATION?>"><?php echo $home->getBasicEvaluation(); ?></textarea>
</div>

<div class="form-group">
   <label>Support networks for learning change</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::SUPPORT_NETWORKS?>"
        name="<?php echo HomeEntity::SUPPORT_NETWORKS?>"><?php echo $home->getSupportNetworks(); ?></textarea>
</div>

<div class="form-group">
   <label>Get Connected!</label>
   <textarea class="form-control" rows="5" rows="" cols="" id="<?php echo HomeEntity::GET_CONNECTED?>"
        name="<?php echo HomeEntity::GET_CONNECTED?>"><?php echo $home->getGetConnected(); ?></textarea>
</div>

<br>
<br>
<?php echo PostHelper::addStylesAndScripts();