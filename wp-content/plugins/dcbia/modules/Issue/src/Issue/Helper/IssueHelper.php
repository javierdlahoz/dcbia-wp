<?php
namespace Issue\Helper;

use INUtils\Helper\PostHelper;
use Issue\Service\IssueService;
use Issue\Controller\IssueController;

class IssueHelper
{
    const SINGULAR = "Key Issue";
    const PLURAL = "Key Issues";
    const POST_TYPE = "issue";
    const TAXONOMY_URL = "heading";
    const TAXONOMY_NAME = "heading";

    function __construct(){
        $this->issueController = IssueController::getSingleton();
        $this->createIssuePostType();
        $this->createKeyIssuesTaxonomy();

        add_action('add_meta_boxes_'.self::POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->issueController, 'save'));
    }

    /**
     * It creates the Staff post type
     */
    public function createIssuePostType(){
        PostHelper::createPostType(self::POST_TYPE,
            self::SINGULAR,
            self::PLURAL
        );
    }

    public function addMetaBoxes(){
        add_meta_box( self::POST_TYPE.'_more_info', 'info',
        array(&$this, 'getIssueMetaBoxForMoreInfo'),
        self::POST_TYPE, 'advanced');
    }

    public function getIssueMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
    
    public function createKeyIssuesTaxonomy(){
        $labels = array(
            'name'              => "Heading for Key Issues",
            'singular_name'     => "Heading",
            'update_item'       => "Update Heading",
            'add_new_item'      => "Add a new Headind",
            'new_item_name'     => "New Heading Name",
        );
    
        register_taxonomy(
            self::TAXONOMY_NAME,
            array(self::POST_TYPE),
            array( 'hierarchical' => true,
                'labels' => $labels,
                'query_var' => self::TAXONOMY_NAME,
                'rewrite' => array('slug' => self::TAXONOMY_URL)
            )
        );
    }
}