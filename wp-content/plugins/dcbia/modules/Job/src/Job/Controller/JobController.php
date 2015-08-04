<?php
namespace Job\Controller;

use INUtils\Controller\AbstractController;
use Job\Entity\JobEntity;
use Job\Helper\JobHelper;

class JobController extends AbstractController
{
    public function save($postId){
        $jobEntity = new JobEntity($postId);
        if($jobEntity->getType() == JobHelper::JOB_POST_TYPE){
            $jobEntity->setLink($this->getPost(JobEntity::LINK));
        }
    }
}