<?php
namespace Resource\Controller;

use INUtils\Controller\AbstractController;
use Resource\Entity\ResourceEntity;
use Resource\Helper\ResourceHelper;
use INUtils\Helper\FileHelper;

class ResourceController extends AbstractController
{
    public function save($postId){
        $resourceEntity = new ResourceEntity($postId);
        if($resourceEntity->getType() == ResourceHelper::POST_TYPE){
            $resourceEntity->setResourceType($this->getPost("resource_type"));
            $resourceEntity->setSubjectOfResource($this->getPost("subject_resource"));
            $resourceEntity->setKeyIssues($this->getPost("key_issue"));
            $resourceEntity->setUrl($this->getPost("url"));
            
            if(isset($_FILES) && $_FILES["file"]["name"] != ""){
                $fileInfo = FileHelper::uploadFile("file");
                 
                $resourceEntity->setFileUrl($fileInfo["fileUrl"]);
                $resourceEntity->setFileSize($fileInfo["fileSize"]);
                $resourceEntity->setFileName($fileInfo["fileName"]);
            }
        }
    }
    
    /**
     * @return array 
     */
    public function getAction(){        
        $rs = \dcbia::getService("resource");
        if(!is_null($this->getPost("resource_type"))){
            $rs->setResourceTypeFilter($this->getPost("resource_type"));
        }
        elseif (!is_null($this->getPost("subject_of_resource"))){
            $rs->setSubjectOfResourceFilter($this->getPost("subject_of_resource"));
        }
        elseif (!is_null($this->getPost("key_issue"))){
            $rs->setKeyIssueFilter($this->getPost("key_issue"));
        }
        
        $resources = $rs->getPosts();
        $rArr = array();
        foreach ($resources as $resource){
            $rArr[] = $resource->toArray();
        }
        return $rArr;
    }
}