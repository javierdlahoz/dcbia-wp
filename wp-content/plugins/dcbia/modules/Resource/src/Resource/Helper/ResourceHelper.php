<?php
namespace Resource\Helper;

use INUtils\Helper\PostHelper;
use Resource\Controller\ResourceController;

class ResourceHelper
{
    const POST_SINGULAR = "Resource";
    const POST_PLURAL = "Resources";
    const POST_TYPE = "resource";
    

    function __construct(){
        $this->ResourceController = ResourceController::getSingleton();
        $this->createResourcePostType();

        add_action('add_meta_boxes_resource', array(&$this, 'addMetaBoxesForResource'));
        add_action('save_post', array(&$this->ResourceController, 'save'));
    }

    /**
     * It creates the Job post type
     */
    public function createResourcePostType(){
        PostHelper::createPostType(self::POST_TYPE,
            self::POST_SINGULAR,
            self::POST_PLURAL
        );
    }
    
    /**
     * @return array
     */
    public static function getResourceTypes(){
        return array(
            "resource_key_issues" => "Issues",
            "resource_publications" => "Publications",
            "resource_testimony" => "Testimony",
            "resource_industry_data" => "Industry Data"
        );
    }
    
    /**
     * @return array
     */
    public static function getSubjectOfResource(){
        return array(
            "comments_and_regulations" => "Comments and Regulations",
            "budget_oversight" => "Budget Oversight Hearing",
            "resolution" => "Resolution"
        );
    }
    
    /**
     * @return array
     */
    public static function getKeyIssues(){
        return array(
            "housing" => "Housing",
            "local_regional_markets" => "Local, Regional, & Global Markets",
            "public_policy" => "Public Policy & Regulation",
            "building_sustainable_city" => "Building a Sustainable City"
        );
    }
    

    public function addMetaBoxesForResource(){
        add_meta_box( 'resource_more_info', 'info',
        array(&$this, 'getPublicationMetaBoxForMoreInfo'),
        self::POST_TYPE, 'advanced');
    }

    public function getPublicationMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
    
}