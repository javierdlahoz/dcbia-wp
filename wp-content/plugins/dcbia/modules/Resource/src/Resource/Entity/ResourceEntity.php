<?php
namespace Resource\Entity;

use INUtils\Entity\WPPostEntity;
use Job\Helper\JobHelper;

class ResourceEntity extends WPPostEntity
{
    public function toArray(){
        $entityArray = parent::toArray();
        $entityArray["url"] = $this->getUrl();
        $entityArray["resource_type"] = $this->getResourceType();
        $entityArray["subject_of_resource"] = $this->getSubjectOfResource();
        $entityArray["key_issues"] = $this->getKeyIssues();
        $entityArray["url"] = $this->getUrl();
        $entityArray["file_url"] = $this->getFileUrl();
        $entityArray["file_size"] = $this->getFileSize();
        $entityArray["file_name"] = $this->getFileName();
        
        return $entityArray;
    }
}