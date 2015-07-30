<?php
namespace Committee\Helper;

use INUtils\Helper\PostHelper;
use Committee\Service\CommitteeService;
use Committee\Controller\CommitteeController;

class CommitteeHelper
{
    const POST_SINGULAR = "Committee Member";
    const POST_PLURAL = "Committee";
    const POST_POST_TYPE = "committee";

    function __construct(){
        $this->committeeController = CommitteeController::getSingleton();
        $this->createCommitteePostType();

        add_action('add_meta_boxes_committee', array(&$this, 'addMetaBoxesForCommittee'));
        add_action('save_post', array(&$this->committeeController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createCommitteePostType(){
        PostHelper::createPostType(self::POST_POST_TYPE,
            self::POST_SINGULAR,
            self::POST_PLURAL
        );
    }

    public function addMetaBoxesForCommittee(){
        add_meta_box( 'committee_more_info', 'info',
        array(&$this, 'getCommitteeMetaBoxForMoreInfo'),
        CommitteeService::POST_TYPE, 'advanced');
    }

    public function getCommitteeMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}