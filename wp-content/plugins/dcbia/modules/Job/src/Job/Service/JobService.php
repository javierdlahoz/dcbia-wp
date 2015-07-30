<?php
namespace Job\Service;

use INUtils\Service\WPPostService;

class JobService extends WPPostService
{
    const ENTITY_CLASS = "Job\Entity\JobEntity";
    const STAFF_POST_TYPE = "job";
    
    /**
     * 
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(self::STAFF_POST_TYPE);
    }
}