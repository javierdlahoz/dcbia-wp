<?php
namespace Staff\Service;

use INUtils\Service\WPPostService;

class StaffService extends WPPostService
{
    const ENTITY_CLASS = "Staff\Entity\StaffEntity";
    const STAFF_POST_TYPE = "staff";
    
    /**
     * 
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(self::STAFF_POST_TYPE);
    }
}