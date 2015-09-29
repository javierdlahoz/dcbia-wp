<?php
namespace Sponsor\Helper;

use INUtils\Helper\PostHelper;
use Sponsor\Controller\SponsorController;
use INUtils\Helper\TaxonomyHelper;

class SponsorHelper
{
    const SINGULAR = "Sponsor";
    const PLURAL = "Sponsors";
    const POST_TYPE = "sponsor";
    const TAXONOMY =  "sponsor_type";

    function __construct(){
        $this->sponsorController = SponsorController::getSingleton();
        $this->createSponsorPostType();
        $this->createTaxonomy();

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
    
    public function createTaxonomy(){
        $labels = array(
            'name'              => "Sponsor Type",
            'singular_name'     => "Sponsor Type",
            'update_item'       => "Update Sponsor Type",
            'add_new_item'      => "Add a new Sponsor Type",
            'new_item_name'     => "New Sponsor Type Name",
        );
    
        register_taxonomy(
            self::TAXONOMY,
            array(self::POST_TYPE),
            array( 'hierarchical' => true,
                'labels' => $labels,
                'query_var' => self::TAXONOMY,
                'rewrite' => array('slug' => self::TAXONOMY)
            )
        );
    }
}