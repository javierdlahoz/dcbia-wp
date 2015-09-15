<?php
namespace Sponsor\Helper;

use INUtils\Helper\PostHelper;
use Sponsor\Controller\SponsorController;

class SponsorHelper
{
    const SINGULAR = "Sponsor";
    const PLURAL = "Sponsors";
    const POST_TYPE = "sponsor";

    function __construct(){
        $this->sponsorController = SponsorController::getSingleton();
        $this->createSponsorPostType();

        add_action('add_meta_boxes_sponsor', array(&$this, 'addMetaBoxesForSponsor'));
        add_action('save_post', array(&$this->sponsorController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createSponsorPostType(){
        PostHelper::createPostType(self::POST_TYPE,
            self::SINGULAR,
            self::PLURAL
        );
    }

    public function addMetaBoxesForSponsor()
    {
        add_meta_box( 'sponsor_more_info', 'info',
        array(&$this, 'getMetaBoxForMoreInfo'),
        self::POST_TYPE, 'advanced');
    }

    public function getMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
}