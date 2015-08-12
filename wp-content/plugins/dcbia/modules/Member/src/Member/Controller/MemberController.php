<?php

namespace Member\Controller;

use INUtils\Controller\AbstractController;

class MemberController extends AbstractController{
    
    public function registerAction(){
        require("wp-content/plugins/paid-memberships-pro/paid-memberships-pro.php");
        $level = 1;
        $userId = wp_create_user($this->getPost("username"), $this->getPost("password"), $this->getPost("email"));
        pmpro_changeMembershipLevel($level, $userId);
        $user = array(
            "ID" => $userId,
            "user_email" => $this->getPost("email"),
            "first_name" => $this->getPost("first_name"),
            "last_name" => $this->getPost("last_name"),
        );
        wp_update_user($user);
        update_user_meta($userId, "address1", $this->getPost("address1"));
        update_user_meta($userId, "address2", $this->getPost("address2"));
        update_user_meta($userId, "address3", $this->getPost("address3"));
        update_user_meta($userId, "city", $this->getPost("city"));
        update_user_meta($userId, "state", $this->getPost("state"));
        update_user_meta($userId, "zip", $this->getPost("zip"));
        update_user_meta($userId, "telephone", $this->getPost("telephone"));
        update_user_meta($userId, "refered_by", $this->getPost("refered_by"));
        update_user_meta($userId, "company_name", $this->getPost("company_name"));
        update_user_meta($userId, "company_website", $this->getPost("company_website"));
        update_user_meta($userId, "company_description", $this->getPost("company_description"));
        
        foreach($_POST["additional_users"] as $userToAdd){
            $this->createAMember($userToAdd, $level);
        }

        return array("message" => "success");
    }
    
    /**
     * 
     * @param array $user
     * @param int $level
     */
    private function createAMember($user, $level){
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
}
