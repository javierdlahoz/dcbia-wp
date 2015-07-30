<?php
namespace Director\Controller;

use INUtils\Controller\AbstractController;
use Director\Entity\DirectorEntity;
use Director\Helper\DirectorHelper;
use Director\Service\DirectorService;

class DirectorController extends AbstractController
{
    public function save($postId){
        $directorEntity = new DirectorEntity($postId);
        if($directorEntity->getType() == DirectorHelper::DIRECTOR_POST_TYPE){
            $directorEntity->setJobTitle($this->getPost(DirectorEntity::JOB_TITLE));
            //$directorEntity->setEmail($this->getPost(DirectorEntity::EMAIL));

            $directorEntity->setFacebook($this->getPost(DirectorEntity::FACEBOOK));
            $directorEntity->setTwitter($this->getPost(DirectorEntity::TWITTER));
            $directorEntity->setGoogle($this->getPost(DirectorEntity::GOOGLE));
            $directorEntity->setPinterest($this->getPost(DirectorEntity::PINTEREST));
            $directorEntity->setLinkedin($this->getPost(DirectorEntity::LINKEDIN));
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