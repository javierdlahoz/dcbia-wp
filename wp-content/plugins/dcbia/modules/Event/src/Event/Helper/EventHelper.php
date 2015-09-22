<?php
namespace Event\Helper;

use Event\Controller\EventController;

class EventHelper
{
    const POST_TYPE = "tribe_events";
    
    function __construct(){
        $this->eventController = EventController::getSingleton();

        add_action('add_meta_boxes_'.self::POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->eventController, 'save'));
    }

    
    public function addMetaBoxes(){
        add_meta_box( self::POST_TYPE.'_more_info', 'info',
        array(&$this, 'getEventMetaBoxForMoreInfo'),
        self::POST_TYPE, 'advanced');
    }

    public function getEventMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}