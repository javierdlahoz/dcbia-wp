<?php
namespace Issue\Service;

use INUtils\Service\WPPostService;
use Issue\Helper\IssueHelper;

class IssueService extends WPPostService
{
    const ENTITY_CLASS = "Issue\Entity\IssueEntity";

    /**
     *
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(IssueHelper::POST_TYPE);
    }
}