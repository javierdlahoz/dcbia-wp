<?php
namespace Committee\Service;

use INUtils\Service\WPPostService;

class CommitteeService extends WPPostService
{
    const ENTITY_CLASS = "Committee\Entity\CommitteeEntity";
    const POST_TYPE = "committee";
    
    /**
     * 
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(self::STAFF_POST_TYPE);
    }
}