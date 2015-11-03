<?php
namespace Home\Controller;

use INUtils\Controller\PostController;
use Home\Service\HomeService;
use Home\Helper\HomeHelper;
use Home\Entity\HomeEntity;
use Home\Service\NewsService;

class HomeController extends PostController
{
    
    /**
     * 
     * @return \Home\Entity\HomeEntity
     */
    public function getHome(){
        $homeService = HomeService::getSingleton();
        $homes = $homeService->getPosts();
        return $homes[0];
    }
    
    /**
     * 
     * @see \INUtils\Controller\PostController::save()
     */
    public function save($postId){
        $homeEntity = new HomeEntity($postId);
        if($homeEntity->getType() == HomeHelper::HOME_POST_TYPE){
            $homeEntity->setNewcustomers($this->getPost("newcustomers"));
            $homeEntity->setIndustrydata($this->getPost("industrydata"));
        }
    }
   
}
