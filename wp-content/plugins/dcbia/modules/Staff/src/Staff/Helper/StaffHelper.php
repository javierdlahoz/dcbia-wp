<?php
namespace Staff\Helper;

use INUtils\Helper\PostHelper;
use Staff\Service\StaffService;
use Staff\Controller\StaffController;

class StaffHelper
{
    const STAFF_SINGULAR = "Staff Member";
    const STAFF_PLURAL = "Staff Members";
    const STAFF_POST_TYPE = "staff";

    function __construct(){
        $this->staffController = StaffController::getSingleton();
        $this->createStaffPostType();

        add_action('add_meta_boxes_staff', array(&$this, 'addMetaBoxesForStaff'));
        add_action('save_post', array(&$this->staffController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createStaffPostType(){
        PostHelper::createPostType(self::STAFF_POST_TYPE,
            self::STAFF_SINGULAR,
            self::STAFF_PLURAL
        );
    }

    public function addMetaBoxesForStaff(){
        add_meta_box( 'staff_more_info', 'info',
        array(&$this, 'getPublicationMetaBoxForMoreInfo'),
        StaffService::STAFF_POST_TYPE, 'advanced');
    }

    public function getPublicationMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}