<?php
namespace Staff\Controller;

use INUtils\Controller\AbstractController;
use Staff\Entity\StaffEntity;
use Staff\Service\StaffService;

class StaffController extends AbstractController
{
    public function save($postId){
        $staffEntity = new StaffEntity($postId);
        if($staffEntity->getType() == StaffService::STAFF_POST_TYPE){
            $staffEntity->setJobTitle($this->getPost(StaffEntity::JOB_TITLE));
            //$staffEntity->setEmail($this->getPost(StaffEntity::EMAIL));

            $staffEntity->setFacebook($this->getPost(StaffEntity::FACEBOOK));
            $staffEntity->setTwitter($this->getPost(StaffEntity::TWITTER));
            $staffEntity->setGoogle($this->getPost(StaffEntity::GOOGLE));
            $staffEntity->setPinterest($this->getPost(StaffEntity::PINTEREST));
            $staffEntity->setLinkedin($this->getPost(StaffEntity::LINKEDIN));
        }
    }
}