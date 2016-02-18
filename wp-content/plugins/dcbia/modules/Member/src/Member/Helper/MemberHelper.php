<?php
namespace Member\Helper;

class MemberHelper
{
    const POST_TYPE = "member";
    const POST_SINGULAR = "Member";
    const POST_PLURAL = "Members";

    private $memberController;

    function __construct(){
        $this->addFieldsToRegistration(); 
        add_action("pmpro_checkout_before_submit_button", array(&$this, "getUserMembers"));
        add_action('show_user_profile', array(&$this, 'addCategoryFieldInUserProfile'));
        add_action('edit_user_profile', array(&$this, 'addCategoryFieldInUserProfile'));
        add_action('personal_options_update', array(&$this, 'saveMemberCustomFields'));
        add_action('edit_user_profile_update', array(&$this, 'saveMemberCustomFields'));
    }
    
    
    public static function getMembershipLevels(){
        global $wpdb;
        
        $sqlQuery = "SELECT * FROM $wpdb->pmpro_membership_levels ";
        $sqlQuery .= "ORDER BY id ASC";
        
        $levels = $wpdb->get_results($sqlQuery, OBJECT);
        return $levels;
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
    
 
    /**
     * @return array
     */
    public static function getBusinessCategories(){
        return array(
            "Architects / Interior Designers",
            "Attorneys",
            "Builders / Developers",
            "Business Improvement Districts / Community Associations / Government Agencies & Education",
            "Certified Public Accountants",
            "Commercial Brokers",
            "Consultants",
            "Engineers",
            "Financial",
            "General Contractors",
            "Information Technology",
            "Insurance / Title Insurance",
            "Marketing / Communications & Media",
            "Property  / Asset Management",
            "Subcontractors",
            "Suppliers & Misc. Services",
            "Utilities",
            "Other"
        );
    }
    
    /**
     * 
     * @param string $date
     * @return string
     */
    public static function formatDateForZoho($date){
        $dateA = explode("-", $date);
        return $dateA[1]."/".$dateA[2]."/".$dateA[0]; 
    }
    
    /**
     * @return boolean
     */
    public static function isCurrentAccountActive(){
        $user = wp_get_current_user();
        $user->membership_level = pmpro_getMembershipLevelsForUser($user->ID);
        $today = new \DateTime();
        
        if($today->getTimestamp() < (int) $user->membership_level[0]->enddate){
            return true;   
        }
        else{
            return false;
        }
    }
    
    /**
     * 
     * @param string $str
     * @return string 
     */
    public static function replaceSpaces($str){
        $str = str_replace(" ", "", $str);
        $str = str_replace("/", "-", $str);
        $str = str_replace("&", "-", $str);
        $str = str_replace(".", "-", $str);
        return $str;
    }
    
    public function addCategoryFieldInUserProfile($user){
        require_once __DIR__.'/../views/admin/member-fields.php';
    }

    public function saveMemberCustomFields($userId ) {
        if ( !current_user_can('edit_user', $userId))
            return false;
        update_usermeta($userId, 'business_category', $_POST['business_category'] );
        $fields = array(
            "company_name",
            "company_website",
            "company_description",
            "address1",
            "city",
            "state",
            "zip",
            "telephone"
        );
        
        foreach ($fields as $field){
            update_usermeta($userId, $field, $_POST[$field] );
        }
    }
}
