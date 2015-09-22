<?php
namespace Event\Controller;

use INUtils\Controller\AbstractController;
use INUtils\Entity\PostEntity;
use Event\Helper\EventHelper;

class EventController extends AbstractController
{
    public function getCalendarWidget(){
        $instance = array(
            'order' => '12',
            'name' => 'Events',
            'size' => 'span8',
            'title' => 'Events',
            'parent' => '0',
            'number' => '16',
            'first' => true,
            'resizable' => 1,
            'see_all' => 'See All',
            'itemno' => '7',
            'template_id' => '16',
            'block_id' => 'aq_block_16' 
        );
    
        extract($instance);
        global $icy_options;
        require_once __DIR__."/../views/frontend/calendar-widget.php";
    }
    
    
    public function save($postId){
        $eventEntity = new PostEntity($postId);
        if($eventEntity->getType() == EventHelper::POST_TYPE){
            $eventEntity->setPaymentUrl($_POST["payment_url"]);
        }
    }
}