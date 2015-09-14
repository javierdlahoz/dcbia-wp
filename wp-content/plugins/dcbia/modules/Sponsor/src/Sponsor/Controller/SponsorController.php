<?php
namespace Sponsor\Controller;

use INUtils\Controller\AbstractController;
use Sponsor\Entity\SponsorEntity;
use Sponsor\Helper\SponsorHelper;

class SponsorController extends AbstractController
{
    public function save($postId){
        $sponsorEntity = new SponsorEntity($postId);
        if($sponsorEntity->getType() == SponsorHelper::POST_TYPE){
            $sponsorEntity->setUrl($this->getPost(SponsorEntity::URL));
        }
    }
}