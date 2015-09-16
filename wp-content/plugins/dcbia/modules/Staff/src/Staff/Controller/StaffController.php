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
            $staffEntity->setEmail($this->getPost("staff_email"));
        }
    }
    
    /**
     * 
     * @return multitype:\Staff\Entity\StaffEntity
     */
    public function getAll() {
        $ss = StaffService::getSingleton();
        return $ss->getPosts();
    }
    
}