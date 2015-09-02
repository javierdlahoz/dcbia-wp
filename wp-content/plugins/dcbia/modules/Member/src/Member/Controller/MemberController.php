<?php

namespace Member\Controller;

use INUtils\Controller\AbstractController;
use Member\Helper\ImporterHelper;
use INUtils\Helper\EmailHelper;
use Member\Helper\MemberHelper;
use Member\Facade\MemberFacade;
require_once("wp-content/plugins/paid-memberships-pro/paid-memberships-pro.php");

class MemberController extends AbstractController{
    
    const ADDITIONAL_USER_COST = 75;
    const MEMBERSHIP_TOTAL_COST = "membership_total_cost";
    const ADDITIONAL_USERS_ARRAY = "addUsers";
    const SUCCESS_STATUS = "success";
    const PMPPRO_MEMBERSHIP_USERS = "pmpro_memberships_users";
    
    /**
     * 
     * @param int $userId
     */
    public function getAdditionalUserIds($userId){
        return get_user_meta($userId, self::ADDITIONAL_USERS_ARRAY, true);
    }
    
    public function registerAction(){
        $additionalUsers = count($_POST["additional_users"]);
        $level = MemberController::getSingleton()->getMembershipLevel();
        $_SESSION["amount"] = $level->billing_amount + $additionalUsers * self::ADDITIONAL_USER_COST;
        
        $level = MemberController::getSingleton()->getUnpaidLevel();
        $mainUserId = $this->createMember($_POST, $level->id, true);
        $addUserIds = array();
        
        foreach($_POST["additional_users"] as $userToAdd){
            $addUserIds[] = $this->createAMember($userToAdd, $level->id);
        }
        update_user_meta($mainUserId, self::ADDITIONAL_USERS_ARRAY, $addUserIds);
        return array("message" => "success");
    }
    
    public function getMembershipLevel(){
        global $wpdb;
        $level = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_membership_levels WHERE id = '" . 1 . "' LIMIT 1");
        
        return $level;
    }
    
    public function getUnpaidLevel(){
        global $wpdb;
        $level = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_membership_levels WHERE id = '" . 5 . "' LIMIT 1");
    
        return $level;
    }
    
    /**
     * 
     * @param int $userId
     */
    private function updateExpirationDate($userId){
        global $wpdb;
        $wpdb->pmpro_memberships_users = $wpdb->prefix . self::PMPPRO_MEMBERSHIP_USERS;
        $endDate = new \DateTime();
        $endDate->add(new \DateInterval('P1Y'));
        $endDate = date("Y-m-d H:i:s", $endDate->getTimestamp());
        
        $sql = "UPDATE $wpdb->pmpro_memberships_users SET `enddate`='" . $endDate . "' WHERE `user_id`=".$userId;
        $wpdb->query($sql);
    }
    
    /**
     * 
     * @param array $userIds
     */
    private function updateToMembershipLevel($userIds){
        foreach ($userIds as $userId){
            pmpro_changeMembershipLevel($this->getMembershipLevel()->id, $userId);
            if(!empty($userId)){
                $this->updateExpirationDate($userId);
            }
        }
    }
    
    /**
     * 
     * @param array $member
     * @param number $level
     */
    public function createMember($member, $level = 1, $isMain = false){
        $userId = wp_create_user($member["email"], $member["password"], $member["email"]);
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
        update_user_meta($userId, "membership_total_cost", $_SESSION["amount"]);
        
        if($isMain === true){
            $creds = array();
            $creds['user_login'] = $member["email"];
            $creds['user_password'] = $member["password"];
            $creds['remember'] = true;
            wp_signon($creds, false);
        }
        
        return $userId;
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
        update_user_meta($userId, "committee", $user["committee"]);
        return $userId;
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
    
    /**
     * it handles authorize.net payments
     */
    public function payAction(){
        $authorize = new \PMProGateway_authorizenet();
        $order = new \MemberOrder();
        $order->billing = new \stdClass();
        $order->membership_level = new \stdClass();
        $user = wp_get_current_user();
        
        $order->InitialPayment = get_user_meta($user->ID, self::MEMBERSHIP_TOTAL_COST, true);
        $order->Address1 = $this->getPost("address1");
        $order->Address2 = $this->getPost("address2");
        $order->Email = $this->getPost("email");
        $order->billing->phone = $this->getPost("phone");
        $order->cardtype = $this->getPost("card_type");
        $order->accountnumber = $this->getPost("account_number");
        $order->ExpirationDate = $this->getPost("expiration_date");
        $order->membership_level->name = "DCBIA";
        $order->FirstName = $this->getPost("first_name");
        $order->LastName = $this->getPost("last_name");
        $order->billing->city = $this->getPost("city");
        $order->billing->state = $this->getPost("state");
        $order->billing->zip = $this->getPost("zip");
        $order->billing->country = $this->getPost("country");
        $order->CVV2 = $this->getPost("cvv");
        $order->billing->name = $order->FirstName." ".$order->LastName;
        $order->billing->street = $order->Address1." ".$order->Address2;
        
        
        $status = $authorize->charge($order);
        if($status === true){
            $order->user_id = $user->ID;
            $order->status = self::SUCCESS_STATUS;
            $order->payment_type = "Credit Card";
            $order->membership_id = $this->getMembershipLevel()->id;
            
            $this->updateToMembershipLevel(get_user_meta($user->ID, 
                self::ADDITIONAL_USERS_ARRAY, true)
            );
            $this->sendOrderEmail($order, $user);
            $this->updateExpirationDate($user->ID);
            
            $order->saveOrder();
        }
        
        return array("status" => $status);
    }
    
    /**
     * 
     * @param \MemberOrder $order
     * @param \stdClass $user
     */
    private function sendOrderEmail(\MemberOrder $order, $user){
        $content = "Thanks for register with us \n";
        $content .= "\nYour Order Details\n\n";
        
        $content .="Description: Registration to DCBIA\n";
        $content .="Payment Type: ".$order->payment_type."\n\n";
        $content .="Total: $ ".$order->InitialPayment." US\n";
        
        EmailHelper::sendEmail($user->user_email, "Registration with DCBIA", null, $content, null);
    }
    
    /**
     * it handles affiliates actions POST for create affiliates and GET to get them
     */
    public function affiliatesAction(){
        $user = wp_get_current_user();
        if(!empty($_POST)){
            $addUserIds = array();
            foreach($_POST["additional_users"] as $userToAdd){
                $tmpU = get_user_by("email", $userToAdd["email"]);
                if(!empty($tmpU)){
                    $addUserIds[] = $tmpU->ID;
                }
                else{
                    $addUserIds[] = $this->createAMember($userToAdd, $this->getUnpaidLevel()->id);
                }
            }
            $amount = $this->getMembershipLevel()->billing_amount + count($addUserIds) * self::ADDITIONAL_USER_COST;
            update_user_meta($user->ID, self::ADDITIONAL_USERS_ARRAY, $addUserIds);
            update_user_meta($user->ID, "membership_total_cost", $amount);
            return array("message" => "success");
        }
        else{
            return MemberFacade::getSingleton()->getAffiliates($this->getAdditionalUserIds($user->ID));
        }
    }
    
}
