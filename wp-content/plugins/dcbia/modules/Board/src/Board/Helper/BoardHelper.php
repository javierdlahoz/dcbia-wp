<?php
namespace Board\Helper;

use INUtils\Helper\PostHelper;
use Board\Controller\BoardController;

class BoardHelper
{
    const SINGULAR = "Board Member";
    const PLURAL = "Board Members";
    const POST_TYPE = "board_member";

    function __construct(){
        $this->boardController = \Board\Controller\BoardController::getSingleton();
        $this->createBoardPostType();

        add_action('add_meta_boxes_board_member', array(&$this, 'addMetaBoxesForBoard'));
        add_action('save_post', array(&$this->boardController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createBoardPostType(){
        PostHelper::createPostType(self::POST_TYPE,
            self::SINGULAR,
            self::PLURAL
        );
    }

    public function addMetaBoxesForBoard(){
        add_meta_box( 'board_more_info', 'info',
        array(&$this, 'getPublicationMetaBoxForMoreInfo'),
        self::POST_TYPE, 'advanced');
    }

    public function getPublicationMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}