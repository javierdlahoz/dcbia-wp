<?php
namespace Committee\Controller;

use INUtils\Controller\AbstractController;
use Committee\Entity\CommitteeEntity;
use Committee\Helper\CommitteeHelper;
use Committee\Service\CommitteeTermService;

class CommitteeController extends AbstractController
{
    public function save($postId){
        $committeeEntity = new CommitteeEntity($postId);
        if($committeeEntity->getType() == CommitteeHelper::POST_TYPE){
            $committeeEntity->setJobTitle($this->getPost(CommitteeEntity::JOB_TITLE));
        }
    }
    
    /**
     * @return multiple: \Committee\Entity\CommitteeTermEntity
     */
    public function getCommitteeTerms()
    {
        return CommitteeTermService::getSingleton()->getTerms(); 
    }
}