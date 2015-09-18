<?php
namespace Job\Controller;

use INUtils\Controller\AbstractController;
use Job\Entity\JobEntity;
use Job\Helper\JobHelper;
use INUtils\Helper\FileHelper;
use Job\Service\JobService;

class JobController extends AbstractController
{
    public function save($postId){
        $jobEntity = new JobEntity($postId);
        if($jobEntity->getType() == JobHelper::JOB_POST_TYPE){
            if(isset($_FILES) && $_FILES["file"]["name"] != ""){
                $fileArray = FileHelper::uploadFile("file");
                $jobEntity->setFileName($fileArray["fileName"]);
                $jobEntity->setFileUrl($fileArray["fileUrl"]);
                $jobEntity->setFileSize($fileArray["fileSize"]);
            }
            //$jobEntity->setCompany($this->getPost("company"));
            //$jobEntity->setCompanyUrl($this->getPost("company_url"));
        }
    }
    
    /**
     * @return multitype:Job\Entity\JobEntity
     */
    public function getAll(){
        return JobService::getSingleton()->getPosts();
    }
}