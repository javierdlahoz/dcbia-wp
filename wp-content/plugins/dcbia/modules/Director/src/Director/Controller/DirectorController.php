<?php
namespace Director\Controller;

use INUtils\Controller\AbstractController;
use Director\Entity\DirectorEntity;
use Director\Helper\DirectorHelper;
use INUtils\Helper\FileHelper;
use Director\Service\DirectorService;

class DirectorController extends AbstractController
{
    public function save($postId){
        $directorEntity = new DirectorEntity($postId);
        if($directorEntity->getType() == DirectorHelper::DIRECTOR_POST_TYPE){
             if(isset($_FILES) && $_FILES["file"]["name"] != ""){
                $fileArray = FileHelper::uploadFile("file");
                $directorEntity->setFileName($fileArray["fileName"]);
                $directorEntity->setFileUrl($fileArray["fileUrl"]);
                $directorEntity->setFileSize($fileArray["fileSize"]);
             }
        }
    }
    
    /**
     * 
     * @return multitype:\Director\Entity\DirectorEntity
     */
    public function getAll(){
        $directors = DirectorService::getSingleton()->getPosts();
        return $directors;
    }
}