<?php
namespace Committee\Helper;

use INUtils\Helper\PostHelper;
use Committee\Service\CommitteeService;
use Committee\Controller\CommitteeController;
use Director\Helper\DirectorHelper;

class CommitteeHelper
{
    const POST_SINGULAR = "Committee Member";
    const POST_PLURAL = "Committee Members";
    const POST_TYPE = "committee";
    const TAXONOMY = "committee";
    const TAXONOMY_URL = "committee_tax";
    

    function __construct(){
        $this->committeeController = CommitteeController::getSingleton();
        $this->createCommitteePostType();

        add_action('add_meta_boxes_committee', array(&$this, 'addMetaBoxesForCommittee'));
        add_action('save_post', array(&$this->committeeController, 'save'));
        $this->createCommitteeTaxonomy();
    }

    /**
     * It creates the Staff post type
     */
    public function createCommitteePostType(){
        PostHelper::createPostType(self::POST_TYPE,
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
    
    public function createCommitteeTaxonomy(){
        $labels = array(
            'name'              => "Committee",
            'singular_name'     => "Committee",
            'update_item'       => "Update Committee",
            'add_new_item'      => "Add a new Committee",
            'new_item_name'     => "New Committee Name",
        );
        
        register_taxonomy(
            'committee',
            array(self::POST_TYPE, DirectorHelper::DIRECTOR_POST_TYPE),
            array( 'hierarchical' => true,
                'labels' => $labels,
                'query_var' => 'committee',
                'rewrite' => array('slug' => self::TAXONOMY_URL)
            )
        );
    }
}