<?php
namespace Director\Service;

use INUtils\Service\WPPostService;
use Director\Helper\DirectorHelper;

class DirectorService extends WPPostService
{
    const ENTITY_CLASS = "Director\Entity\DirectorEntity";

    /**
     *
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(DirectorHelper::DIRECTOR_POST_TYPE);
    }
}