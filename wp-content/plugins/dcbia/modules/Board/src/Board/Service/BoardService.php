<?php
namespace Board\Service;

use INUtils\Service\WPPostService;
use Board\Helper\BoardHelper;

class BoardService extends WPPostService
{
    const ENTITY_CLASS = "Board\Entity\BoardEntity";
    
    /**
     * 
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(BoardHelper::POST_TYPE);
    }
}