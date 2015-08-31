<?php
namespace Member\Helper;

class MemberHelper
{
    const POST_TYPE = "member";
    const POST_SINGULAR = "Member";
    const POST_PLURAL = "Members";

    private $memberController;

    function __construct(){
//         $this->memberController = MemberController::getSingleton();

//         PostHelper::createPostType(
//             self::POST_TYPE,
//             self::POST_SINGULAR,
//             self::POST_PLURAL
//         );

//         add_action('add_meta_boxes_member', array(&$this, 'addMetaBoxesForMembers'));
//         add_action('save_post', array(&$this->memberController, 'save'));
//         add_action('delete_post', array(&$this->memberController,'delete') );
//         add_action('restrict_manage_posts', array(&$this, 'setOrderByTypeInAdminPanel'));
//         add_action('restrict_manage_posts', array(&$this, 'setOrderByAreaOfFocusInAdminPanel'));
        //add_filter('parse_query', array(&$this, 'setMemberFilter'));
        $this->addFieldsToRegistration(); 
        add_action("pmpro_checkout_before_submit_button", array(&$this, "getUserMembers"));
    }
    
    /**
     * 
     */
    private function addFieldsToRegistration(){
        
        $moreFields = array(
            array(
                "field" => "address",
                "label" => "Address",
                "class" => "input",
                "type"  => "text",
                "g-places-autocomplete" => null,
                "ng-model" => "address1",
                "profile" => false
            ),
            array(
                "field" => "address2",
                "label" => " ",
                "class" => "input",
                "type"  => "text",
                "ng-model" => "address2",
                "profile" => false
            ),
            array(
                "field" => "address3",
                "label" => " ",
                "class" => "input",
                "type"  => "text",
                "profile" => false
            ),
            array(
                "field" => "city",
                "label" => "City",
                "class" => "input",
                "type"  => "text",
                "ng-model" => "city",
                "profile" => false
            ),
            array(
                "field" => "state",
                "label" => "State",
                "class" => "input",
                "type"  => "text",
                "ng-model" => "state",
                "profile" => false
            ),
            array(
                "field" => "zip",
                "label" => "Zip Code",
                "class" => "input",
                "type"  => "text",
                "ng-model" => "zip",
                "size"  => 6,
                "profile" => false
            ),
            array(
                "field" => "telephone",
                "label" => "Telephone",
                "class" => "input",
                "type"  => "text",
                "profile" => false
            ),
            array(
                "field" => "referred",
                "label" => "Referred By",
                "class" => "input",
                "type"  => "text",
                "profile" => false
            ),
            array(
                "field" => "company_name",
                "label" => "Company Name",
                "class" => "input",
                "type"  => "text",
                "profile" => false
            ),
            array(
                "field" => "company_website",
                "label" => "Company Website",
                "class" => "input",
                "type"  => "text",
                "profile" => false
            ),
            array(
                "field" => "company_description",
                "label" => "Description of Company",
                "class" => "input",
                "type"  => "textarea",
                "profile" => false
            )
        );
        
        foreach ($moreFields as $field){
            $text = new \PMProRH_Field($field["field"], $field["type"], $field);
            pmprorh_add_registration_field("after_email", $text);
        }
    }
    
    public function getUserMembers(){
        
    }
    
    /**
     *
     * @return multitype:string
     */
    public static function getResourceTypes(){
        return array(
            "concept_papers_and_publications" => "Concept Papers & Publications",
            "evaluation_reports" => "Evaluation Designs & Reports",
            "guides_handbooks_and_tip_sheets" => "Guides, Handbooks, & Tip Sheets",
            "instruments" => "Instruments",
            "seminars_and_presentations" => "Seminars & Presentations"
        );
    }

    /**
     *
     * @return multitype:string
     */
    public static function getAreasOfFocus(){
        return array(
            "evaluation_capacity_building" => "Evaluation Capacity Building",
            "inclusiveness_and_equity" => "Basic Evaluation Methods",
            "sustainable_communities" => "Sustainability & Equity",
            "systems_oriented_evaluation" => "Systems-Oriented Evaluation"
        );
    }

    /**
     *
     * @return multitype:string
     */
    public static function getStakeholders(){
        return array(
            "business_and_organization_leaders" => "Business & Organization Leaders",
            "evaluators" => "Evaluators",
            "funders" => "Funders",
            "policymakers" => "Policymakers",
            "general_public" => "General Public"
        );
    }

    /**
     *
     * @return multitype:string
     */
    public static function getResourceFormats(){
        return array(
            "audio" => "Audio",
            "image" => "Image",
            "excel" => "Excel/Spreadsheet",
            "pdf" => "PDF",
            "presentation" => "Presentation/Powerpoint",
            "video" => "Video",
            "web_page" => "Web page",
            "word" => "Word/Text"
        );
    }

    /**
     *
     * @return multitype:string
     */
    public static function getCopyRight(){
        return array(
            "available_for_purchase" => "Available for purchase",
            "available_by_subscription" => "Available by subscription",
            "free_access_re_use" => "Free access/re-use",
            "free_access_with_registration" => "Free access with registration",
            "limited_free_access" => "Limited free access"
        );
    }
    
    /**
     * 
     * @param \WP_Query $query
     */
    public static function setOrderByTypeInAdminPanel(){
        $type = "post";
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }
    
        if ('resource' == $type){
            require_once __DIR__.'/../views/admin/filter.php';
        }
    }
    
    /**
     *
     * @param \WP_Query $query
     */
    public static function setOrderByAreaOfFocusInAdminPanel(){
        $type = "post";
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }
    
        if ('resource' == $type){
            require_once __DIR__.'/../views/admin/areas-filter.php';
        }
    }
    
    /**
     * 
     * @param \WP_Query $query
     */
    public function setMemberFilter($query){
        global $pagenow;
        $type = 'post';
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }
        
        if ('resource' == $type && is_admin() && $pagenow=='edit.php' 
                && ((isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '')
                || (isset($_GET['ADMIN_FILTER_FIELD_VALUE_AREAS']) && $_GET['ADMIN_FILTER_FIELD_VALUE_AREAS'] != ''))
            ) {
                
            if(isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != ''  ){
                $query->query_vars['meta_key'] = ResourceEntity::RESOURCE_TYPE_IN_WP;
                $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
            }
            else{
                $query->query_vars['meta_key'] = ResourceEntity::AREA_OF_FOCUS_IN_WP;
                $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE_AREAS'];
            }
        }
    }

    public function addMetaBoxesForMembers(){
        add_meta_box('more_info', 'Member Info',
            array(&$this, 'getMoreInfoFormView'),
            self::POST_TYPE, 'advanced'
        );
    }

    public function getMoreInfoFormView(){
        include __DIR__."/../views/admin/edit-form.phtml";
    }

    /**
     *
     * @param array $facets
     * @return multitype
     */
    public static function formatFacetsAsArray($facets){
        $facetArray = array();
        foreach ($facets as $key => $facetEntity){
            if($facetEntity instanceof \Solarium\QueryType\Select\Result\Facet\Field){
                if($key == "areas_of_focus"){
                    $areasOfFocus = array();
                    foreach ($facetEntity->getValues() as $facetKey => $facetCount){
                        $areasOfFocus[] = 
                            array(
                                "key" => $facetKey,
                                "value" => $facetCount,
                                "order" => self::setOrder($facetKey)
                            );
                    }
                    $facetArray[$key] = $areasOfFocus;
                }
                else{
                    $facetArray[$key] = $facetEntity->getValues();
                }
            }
        }
        return $facetArray;
    }
    
    /**
     * 
     * @param string $facetKey
     */
    public static function setOrder($facetKey){
        switch ($facetKey){
            case "Basic Evaluation Methods":
                return 4; 
                break;
            
            case "Sustainability & Equity":
                return 3;
                break;
                
            case "Evaluation Capacity Building":
                return 2;
                break;
                
            case "Systems-Oriented Evaluation":
                return 1;
                break;
        }
    }

}
