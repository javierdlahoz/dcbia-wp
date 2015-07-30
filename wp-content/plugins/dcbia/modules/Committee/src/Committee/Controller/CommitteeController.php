<?php
namespace Committee\Controller;

use INUtils\Controller\AbstractController;
use Committee\Entity\CommitteeEntity;
use Committee\Service\CommitteeService;
use Committee\Helper\CommitteeHelper;

class CommitteeController extends AbstractController
{
    public function save($postId){
        $committeeEntity = new CommitteeEntity($postId);
        if($committeeEntity->getType() == CommitteeHelper::POST_POST_TYPE){
            $committeeEntity->setJobTitle($this->getPost(CommitteeEntity::JOB_TITLE));
            //$staffEntity->setEmail($this->getPost(StaffEntity::EMAIL));

            $committeeEntity->setFacebook($this->getPost(CommitteeEntity::FACEBOOK));
            $committeeEntity->setTwitter($this->getPost(CommitteeEntity::TWITTER));
            $committeeEntity->setGoogle($this->getPost(CommitteeEntity::GOOGLE));
            $committeeEntity->setPinterest($this->getPost(CommitteeEntity::PINTEREST));
            $committeeEntity->setLinkedin($this->getPost(CommitteeEntity::LINKEDIN));
        }
    }
}