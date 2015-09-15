<?php
namespace Sponsor\Service;

use INUtils\Service\WPPostService;
use Sponsor\Helper\SponsorHelper;

class SponsorService extends WPPostService
{
    const ENTITY_CLASS = "Sponsor\Entity\SponsorEntity";

    /**
     *
     * @see \INUtils\Service\WPPostService::init()
     */
    public function init(){
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setPostType(SponsorHelper::POST_TYPE);
    }
}