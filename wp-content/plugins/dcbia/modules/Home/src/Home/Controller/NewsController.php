<?php
namespace Home\Controller;

use INUtils\Controller\AbstractController;
use Home\Service\NewsService;

class NewsController extends AbstractController
{
    /**
     *
     * @return multitype:\INUtils\Entity\PostEntity
     */
    public function getStickyNews(){
        $pS = NewsService::getSingleton();
        return $pS->getStickyPosts(3);
    }
    
    /**
     *
     * @return multitype:\INUtils\Entity\PostEntity
     */
    public function getRecentNews(){
        $pS = NewsService::getSingleton();
        $pS->setPostsPerPage(2);
        return $pS->getPosts();
    }
}