<?php
namespace Resource\Service;

use INUtils\Service\WPPostService;
use Resource\Helper\ResourceHelper;

class ResourceService extends WPPostService
{
    const ENTITY_CLASS = "Resource\Entity\ResourceEntity";
    
    /**
     * 
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(ResourceHelper::POST_TYPE);
    }
    
    public function setResourceTypeFilter($resourceType){
        $this->setMetaKey("resource_type");
        $this->setMetaValue($resourceType);
    }
    
    public function setSubjectOfResourceFilter($subjectOfResource){
        $this->setMetaKey("subject_of_resource");
        $this->setMetaValue($subjectOfResource);
    }
    
    public function setKeyIssueFilter($keyIssue){
        $this->setMetaKey("key_issues");
        $this->setMetaValue($keyIssue);
    }
}