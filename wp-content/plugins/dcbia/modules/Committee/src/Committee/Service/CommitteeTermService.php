<?php
namespace Committee\Service;

use INUtils\Service\WPTermService;
use Committee\Helper\CommitteeHelper;

class CommitteeTermService extends WPTermService
{
    const ENTITY_CLASS = "\\Committee\\Entity\\CommitteeTermEntity";
    
    
    public function init()
    {
        $this->setEntityClass(self::ENTITY_CLASS);
        $this->setTaxonomy(CommitteeHelper::TAXONOMY);
    }
}