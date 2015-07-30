<?php
namespace Home\Service;

use INUtils\Service\PostService;
use Home\Helper\HomeHelper;

class HomeService extends PostService
{
    const ENTITY_CLASS = "Home\Entity\HomeEntity";
    
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(HomeHelper::HOME_POST_TYPE);
    }
}

