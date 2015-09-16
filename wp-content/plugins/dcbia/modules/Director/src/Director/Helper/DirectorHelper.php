<?php
namespace Director\Helper;

use INUtils\Helper\PostHelper;
use Director\Service\DirectorService;
use Director\Controller\DirectorController;

class DirectorHelper
{
    const DIRECTOR_SINGULAR = "Board Entry";
    const DIRECTOR_PLURAL = "Board Entries";
    const DIRECTOR_POST_TYPE = "board";

    function __construct(){
        $this->directorController = DirectorController::getSingleton();
        $this->createDirectorPostType();

        add_action('add_meta_boxes_'.self::DIRECTOR_POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->directorController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createDirectorPostType(){
        PostHelper::createPostType(self::DIRECTOR_POST_TYPE,
            self::DIRECTOR_SINGULAR,
            self::DIRECTOR_PLURAL
        );
    }

    public function addMetaBoxes(){
        add_meta_box( self::DIRECTOR_POST_TYPE.'_more_info', 'info',
        array(&$this, 'getDirectorMetaBoxForMoreInfo'),
        self::DIRECTOR_POST_TYPE, 'advanced');
    }

    public function getDirectorMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}