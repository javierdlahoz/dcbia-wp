<?php
namespace Committee\Controller;

use INUtils\Controller\AbstractController;
use Committee\Entity\CommitteeEntity;
use Committee\Helper\CommitteeHelper;
use Committee\Service\CommitteeTermService;
use Committee\Service\CommitteeService;

class CommitteeController extends AbstractController
{
    public function save($postId){
        $committeeEntity = new CommitteeEntity($postId);
        if($committeeEntity->getType() == CommitteeHelper::POST_TYPE){
            $committeeEntity->setCoChairs($this->getPost("co_chairs"));
            $committeeEntity->setViceChairs($this->getPost("vice_chairs"));
        }
    }
    
    /**
     * @return multitype: Committee\Entity\CommitteeEntity
     */
    public function getAll(){
        return CommitteeService::getSingleton()->getPosts();
    }
    
    /**
     * @return multiple: \Committee\Entity\CommitteeTermEntity
     */
    public function getCommitteeTerms()
    {
        return CommitteeTermService::getSingleton()->getTerms(); 
    }
}