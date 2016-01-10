<?php
namespace Member\Facade;

use INUtils\Singleton\AbstractSingleton;
use INUtils\Helper\TextHelper;
use Member\Controller\MemberController;

class MemberFacade extends AbstractSingleton
{
    /**
     *
     * @param int $userId
     */
    public function getAffiliates($additionalUserIds){
        $affiliates = array();
        foreach($additionalUserIds as $affiliateId){
            $tmpU = get_userdata($affiliateId);
            $affiliates[] = array(
                "id" => $affiliateId,
                "first_name" => $tmpU->first_name,
                "last_name" => $tmpU->last_name,
                "email" => $tmpU->user_email,
                "committee" => get_user_meta($affiliateId, "committee", true)
            );
        }
    
        return array("affiliates" => $affiliates);
    }
    
    private function formatUserAsArray(\WP_User $user){
        $description = get_user_meta($user->ID, "company_description", true);
        $companyName = get_user_meta($user->ID, "company_name", true);
        
        return array(
            "name" => $user->first_name." ".$user->last_name,
            "cropBio" => TextHelper::cropText($description),
            "permalink" => $user->user_url,
            "picture" => get_avatar_url($user->ID),
            "email" => $user->user_login,
            "organization" => $companyName,
            "affilates_number" => get_user_meta($user->ID, "affilates_number", true),
            "account_id" => get_user_meta($user->ID, "account_id", true),
            "contact_id" => get_user_meta($user->ID, "contact_id", true),
            "city" => get_user_meta($user->ID, "city", true),
            "state" => get_user_meta($user->ID, "state", true)
        );
    }
    
    /**
     *
     * @param int $userPerPage
     * @param int $offset
     * @return int
     */
    private function getPage($usersPerPage, $offset){
        if($offset == 0){
            return 1;
        }
        else{
            $page = $offset/$usersPerPage + 1;
            return $page;
        }
    }
    
    /**
     * 
     * @param int $totalUsers
     * @param int $usersPerPage
     * @return int
     */
    private function getNumberOfPages($totalUsers, $usersPerPage){
        return ceil($totalUsers / $usersPerPage);
    }
    
    /**
     * 
     * @param \WP_User_Query $uQuery
     * @return multitype:number multitype:multitype:string Ambigous <false, string>
     */
    public function formatResults(\WP_User_Query $uQuery){
        $userArray = array();
        foreach ($uQuery->get_results() as $user){
            $userArray[] = $this->formatUserAsArray($user);
        }
        
        return array(
            "page"  => $this->getPage($uQuery->get("number"), $uQuery->get("offset")),
            "pages" => $this->getNumberOfPages($uQuery->total_users, $uQuery->get("number")),
            "limit" => $uQuery->get("number"),
            "total" => $uQuery->total_users,
            "users" => $userArray,
            
        );
    }
    
    /**
     * 
     * @param \WP_User $user
     * @return array
     */
    private function formatUserForRegister(\WP_User $user){
        $userId = $user->ID;
        
        $accountId = MemberController::getSingleton()->getZohoAccountId(get_user_meta($userId, "company_name", true));
        update_user_meta($userId, "account_id", $accountId);
        
        $contactId = MemberController::getSingleton()->getZohoContactId($user->user_email);
        update_user_meta($userId, "contact_id", $contactId);
        
        return array(
            "ID" => $userId,
            "user_email" => $user->user_email,
            "email" => $user->user_email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "address1" => get_user_meta($userId, "address1", true),
            "address2" => get_user_meta($userId, "address2", true),
            "address3" => get_user_meta($userId, "address3", true),
            "city" => get_user_meta($userId, "city", true),
            "state" => get_user_meta($userId, "state", true),
            "zip" => (int) get_user_meta($userId, "zip", true),
            "telephone" => (int) get_user_meta($userId, "telephone", true),
            "refered_by" => get_user_meta($userId, "refered_by", true),
            "company_name" => get_user_meta($userId, "company_name", true),
            "company_website" => get_user_meta($userId, "company_website", true),
            "company_description" => get_user_meta($userId, "company_description", true),
            "registration_date"    => get_user_meta($userId, "registration_date"   , true),
            "renewal_status"       => get_user_meta($userId, "renewal_status"      , true),
            "committee"           => get_user_meta($userId, "committee"          , true),
            "committee1"           => get_user_meta($userId, "committee1"          , true),
            "committee2"           => get_user_meta($userId, "committee2"          , true),
            "membership_type"      => get_user_meta($userId, "membership_type"     , true),
            "PAC"                  => get_user_meta($userId, "PAC"                 , true),
            "payment_weblink"      => get_user_meta($userId, "payment_weblink"     , true),
            "affilates_number"     => get_user_meta($userId, "affilates_number"    , true),
            "total_amount"         => get_user_meta($userId, "total_amount"        , true),
            "payment_received"     => get_user_meta($userId, "payment_received"    , true),
            "payment_method"       => get_user_meta($userId, "payment_method"      , true),
            "cost_per_affiliate"   => get_user_meta($userId, "cost_per_affiliate"  , true),
            "membership_base_cost" => get_user_meta($userId, "membership_base_cost", true),
            "business_category" => get_user_meta($userId, "business_category", true),
            "business_category2" => get_user_meta($userId, "business_category2", true),
            "membership_total_cost" => get_user_meta($userId, "membership_total_cost", true),
            "membership_level" => get_user_meta($userId, "tmp_membership_level", true),
            "account_id" => get_user_meta($userId, "account_id", true),
            "contact_id" => get_user_meta($userId, "contact_id", true),
        );
    }
    
    /**
     * 
     * @return multitype:string mixed string int Ambigous <mixed, boolean, string, multitype:, unknown, string>
     */
    public function formatCurrentUserForRegister(){
        $user = wp_get_current_user();
        $affiliateIds = get_user_meta($user->ID, MemberController::ADDITIONAL_USERS_ARRAY, true);
        $affiliates = array();
        //var_dump($affiliateIds); die();
        if(!empty($affiliateIds)){
            foreach($affiliateIds as $affiliateId){
                $affiliate = get_user_by("id", $affiliateId);
                $affiliates[] = $this->formatUserForRegister($affiliate);
            }    
        }
        $userArray = $this->formatUserForRegister($user);
        $userArray["affiliates"] = $affiliates;
        
        return $userArray;
    }
}