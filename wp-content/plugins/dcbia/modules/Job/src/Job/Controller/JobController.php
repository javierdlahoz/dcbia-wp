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
            $jobEntity->setJobTitle($this->getPost(JobEntity::JOB_TITLE));
            //$staffEntity->setEmail($this->getPost(StaffEntity::EMAIL));

            $jobEntity->setFacebook($this->getPost(JobEntity::FACEBOOK));
            $jobEntity->setTwitter($this->getPost(JobEntity::TWITTER));
            $jobEntity->setGoogle($this->getPost(JobEntity::GOOGLE));
            $jobEntity->setPinterest($this->getPost(JobEntity::PINTEREST));
            $jobEntity->setLinkedin($this->getPost(JobEntity::LINKEDIN));
        }
    }
}