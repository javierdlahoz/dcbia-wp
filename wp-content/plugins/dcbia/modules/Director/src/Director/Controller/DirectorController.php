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
        DirectorService::getSingleton()->setTaxQuery(array(array(
           "taxonomy"   => DirectorHelper::TAXONOMY,
            "terms"     => "board",
            "field"     => "slug",
            "operator"  => "IN"
        )));
        $directors = DirectorService::getSingleton()->getPosts();
        return $directors;
    }
    
    /**
     *
     * @return multitype:\Director\Entity\DirectorEntity
     */
    public function getAllMedia(){
        DirectorService::getSingleton()->setTaxQuery(array(array(
            "taxonomy"   => DirectorHelper::TAXONOMY,
            "terms"     => "media",
            "field"     => "slug",
            "operator"  => "IN"
        )));
        $directors = DirectorService::getSingleton()->getPosts();
        return $directors;
    }
}