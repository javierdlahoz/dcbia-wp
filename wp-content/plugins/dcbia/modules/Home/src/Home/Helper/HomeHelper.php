<?php
namespace Home\Helper;

use INUtils\Singleton\AbstractSingleton;
use Home\Controller\HomeController;
use INUtils\Helper\PostHelper;

class HomeHelper extends AbstractSingleton
{
    const HOME_POST_TYPE = "home";
    const HOME_PLURAL = "Home";
    const HOME_SINGULAR = "home";
    
    function __construct(){
        $this->homeController = HomeController::getSingleton();
        $this->createHomePostType();
    
        add_action('add_meta_boxes_'.self::HOME_POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->homeController, 'save'));
    }
    
    /**
     * It creates the Staff post type
     */
    public function createHomePostType(){
        PostHelper::createPostType(self::HOME_POST_TYPE,
            self::HOME_SINGULAR,
            self::HOME_PLURAL
        );
    }
    
    public function addMetaBoxes(){
        add_meta_box( self::HOME_POST_TYPE.'_more_info', 'info',
            array(&$this, 'getHomeMetaBoxes'),
            self::HOME_POST_TYPE, 'advanced');
    }
    
    public function getHomeMetaBoxes(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}
