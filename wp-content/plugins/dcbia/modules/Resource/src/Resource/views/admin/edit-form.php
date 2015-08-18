<?php

use INUtils\Helper\PostHelper;
use Resource\Helper\ResourceHelper;
$resourceEntity = dcbia::getEntity("resource");

?>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Resource Type</label>
		<div class="col-lg-10 col-sm-10">
			<select class="form-control"
				name="resource_type" id="resource_type"
				required="true">
				<?php foreach(ResourceHelper::getResourceTypes() as $typeKey => $typeValue): ?>
				    <option value="<?php echo $typeKey; ?>" 
				        <?php if($typeKey == $resourceEntity->getResourceType()) echo "selected='selected'"; ?>>
				        <?php echo $typeValue; ?>
				    </option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Subject of Resource</label>
		<div class="col-lg-10 col-sm-10">
			<select class="form-control"
				name="subject_resource" id="subject_resource"
				required="true" >
				<?php foreach(ResourceHelper::getSubjectOfResource() as $typeKey => $typeValue): ?>
				    <option value="<?php echo $typeKey; ?>" 
				        <?php if($typeKey == $resourceEntity->getSubjectOfResource()) echo "selected"; ?>>
				        <?php echo $typeValue; ?>
				    </option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-2">Resource Type</label>
		<div class="col-lg-10 col-sm-10">
			<select class="form-control"
				name="key_issue" id="key_issue"
				required="true" >
				<?php foreach(ResourceHelper::getKeyIssues() as $typeKey => $typeValue): ?>
				    <option value="<?php echo $typeKey; ?>" 
				        <?php if($typeKey == $resourceEntity->getKeyIssues()) echo "selected"; ?>>
				        <?php echo $typeValue; ?>
				    </option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
        <label for="url" class="control-label col-lg-2 col-sm-2">URL</label>
        <div class="col-lg-10 col-sm-10">
             <input type="url" name="url" id="url" placeholder="http://dcbia.org/file.zip" class="form-control"
                value="<?php if(!empty($resourceEntity)) { echo $resourceEntity->getUrl(); } ?>">
        </div>
    </div>
   
    
    <div class="form-group">
        <label for="url" class="control-label col-lg-2 col-sm-2">File</label>
        <div class="col-lg-10 col-sm-10">
            <input type="file" name="file" id="file" class="form-control">
            <br>
            <?php if(isset($resourceEntity) && $resourceEntity->getFileUrl() != false): ?>
            <div class="pull-right" id="downloaded-file">
                <a href="<?php echo $resourceEntity->getFileUrl(); ?>">Download - <?php echo $resourceEntity->getFileName(); ?></a>
                <div class="btn btn-danger btn-sm" onclick="deleteResourceFile('<?php echo $resourceEntity->getId(); ?>')">Delete</div>
            </div>
            
            <div class="alert alert-success" style="display: none" id="deleted-file-alert">
                File deleted successfully
            </div>
            <?php endif; ?>
         </div>
    </div>
	
</div>
<?php
echo PostHelper::addStylesAndScripts();