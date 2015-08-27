<?php

namespace Member\Controller;

use INUtils\Controller\AbstractController;
use Member\Helper\ImporterHelper;

require("wp-content/plugins/paid-memberships-pro/paid-memberships-pro.php");

class MemberController extends AbstractController{
    
    public function registerAction(){
        $level = 1;
        $this->createMember($_POST, $level);
        foreach($_POST["additional_users"] as $userToAdd){
            $this->createAMember($userToAdd, $level);
        }

        return array("message" => "success");
    }
    
    /**
     * 
     * @param array $member
     * @param number $level
     */
    public function createMember($member, $level = 1){
        $userId = wp_create_user($member["username"], $member["password"], $member["email"]);
        pmpro_changeMembershipLevel($level, $userId);
        $user = array(
            "ID" => $userId,
            "user_email" => $member["email"],
            "first_name" => $member["first_name"],
            "last_name" => $member["last_name"],
        );
        wp_update_user($user);
        update_user_meta($userId, "address1", $member["address1"]);
        update_user_meta($userId, "address2", $member["address2"]);
        update_user_meta($userId, "address3", $member["address3"]);
        update_user_meta($userId, "city", $member["city"]);
        update_user_meta($userId, "state", $member["state"]);
        update_user_meta($userId, "zip", $member["zip"]);
        update_user_meta($userId, "telephone", $member["telephone"]);
        update_user_meta($userId, "refered_by", $member["refered_by"]);
        update_user_meta($userId, "company_name", $member["company_name"]);
        update_user_meta($userId, "company_website", $member["company_website"]);
        update_user_meta($userId, "company_description", $member["company_description"]);
        update_user_meta($userId, "registration_date"   , $member["registration_date"]);
        update_user_meta($userId, "renewal_status"      , $member["renewal_status"]);
        update_user_meta($userId, "committee1"          , $member["committee1"]);
        update_user_meta($userId, "committee2"          , $member["committee2" ]);
        update_user_meta($userId, "membership_type"     , $member["membership_type"]);
        update_user_meta($userId, "PAC"                 , $member["PAC"]);
        update_user_meta($userId, "payment_weblink"     , $member["payment_weblink"]);
        update_user_meta($userId, "affilates_number"    , $member["affilates_number"]);
        update_user_meta($userId, "total_amount"        , $member["total_amount"]);
        update_user_meta($userId, "payment_received"    , $member["payment_received" ]);
        update_user_meta($userId, "payment_method"      , $member["payment_method"]);
        update_user_meta($userId, "cost_per_affiliate"  , $member["cost_per_affiliate"]);
        update_user_meta($userId, "membership_base_cost", $member["membership_base_cost"]);
    }
    
    
    
    /**
     * 
     * @param array $user
     * @param int $level
     */
    public function createAMember($user, $level = 1){
        $userId = wp_create_user($user["email"], $user["password"], $user["email"]);
        pmpro_changeMembershipLevel($level, $userId);
        $userTmp = array(
            "ID" => $userId,
            "user_email" => $user["email"],
            "first_name" => $user["first_name"],
            "last_name" => $user["last_name"],
        );
        wp_update_user($userTmp);
    }
    
    /**
     * 
     * @return multitype:boolean
     */
    public function checkAction(){
        if(username_exists($this->getPost("username"))){
            return array("is_taken" => true);
        }
        else{
            return array("is_taken" => false);
        }
    }
    
    public function importAction(){
        ImporterHelper::importMembers();
    }
}
