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
        if($committeeEntity->getType() == CommitteeHelper::POST_TYPE){
            $committeeEntity->setJobTitle($this->getPost(CommitteeEntity::JOB_TITLE));
        }
    }
}