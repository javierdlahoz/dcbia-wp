<?php
namespace Board\Controller;

use INUtils\Controller\AbstractController;
use Board\Service\BoardService;
use Board\Helper\BoardHelper;
use Board\Entity\BoardEntity;

class BoardController extends AbstractController
{
    public function save($postId){
        $boardEntity = new BoardEntity($postId);
        if($boardEntity->getType() == BoardHelper::POST_TYPE){
            $boardEntity->setJobTitle($this->getPost(BoardEntity::JOB_TITLE));
            //$boardEntity->setEmail($this->getPost("board_email"));
        }
    }
    
    /**
     * 
     * @return multitype:\Board\Entity\BoardEntity
     */
    public function getAll() {
        $ss = BoardService::getSingleton();
        return $ss->getPosts();
    }
    
}