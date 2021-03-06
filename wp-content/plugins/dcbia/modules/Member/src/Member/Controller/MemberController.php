<?php

namespace Member\Controller;

use INUtils\Controller\AbstractController;
use Member\Helper\ImporterHelper;
use INUtils\Helper\EmailHelper;
use Member\Helper\MemberHelper;
use Member\Facade\MemberFacade;
use Member\Service\MemberService;
require_once(__DIR__."/../../../../../../paid-memberships-pro/paid-memberships-pro.php");

class MemberController extends AbstractController{
    
    const ADDITIONAL_USER_COST = 75;
    const MEMBERSHIP_TOTAL_COST = "membership_total_cost";
    const ADDITIONAL_USERS_ARRAY = "addUsers";
    const SUCCESS_STATUS = "success";
    const PMPPRO_MEMBERSHIP_USERS = "pmpro_memberships_users";
    const UNPAID_LEVEL = 5;
    const PAC_COST = 25;
    
    
    const PMPRO_MEMBERSHIP_LEVELS = "pmpro_membership_levels";
    
    const ZOHO_API_VERSION = 2;
    const ZOHO_TIMEOUT = 15;
    const ZOHO_TOKEN = "22ddae076da1ccb0bcc5b3e9d81ac2fa";
    const ZOHO_CRM = "crmapi";
    const ZOHO_URL = "https://crm.zoho.com/crm/private/xml/";
    
    /**
     * 
     * @var boolean
     */
    private $isNewUser;
    
    /**
     * 
     * @param int $userId
     */
    public function getAdditionalUserIds($userId){
        return get_user_meta($userId, self::ADDITIONAL_USERS_ARRAY, true);
    }
    
    public function checkPacAction(){
        if(isset($_SESSION["pac"]) && $_SESSION["pac"] === true){
            return array(
                "pac" => true
            );
        }
        else{
            return array(
                "pac" => false
            );
        }
    }
    
    public function addPacAction(){
        if(isset($_SESSION["pac"]) && $_SESSION["pac"] === true){
            $_SESSION["pac"] = false;
            return array(
                "message" => "PAC removed",
                "pac"   => false
            );
        }
        else{
            $_SESSION["pac"] = true;
            return array(
                "message" => "PAC added",
                "pac"   => true
            );
        }
    }
    
    public function registerAction(){
        $additionalUsers = count($_POST["additional_users"]);
        $level = MemberController::getSingleton()->getMembershipLevel();
        $_SESSION["amount"] = $level->initial_payment + $additionalUsers * self::ADDITIONAL_USER_COST;
        
        if($_SESSION["pac"] === true){
            $_SESSION["amount"] += self::PAC_COST;
        }
        
        $level = MemberController::getSingleton()->getUnpaidLevel();
        $mainUserId = $this->createMember($_POST, $level->id, true);
        $addUserIds = array();
        
        if(isset($_POST["additional_users"])){
            foreach($_POST["additional_users"] as $userToAdd){
                $addUserIds[] = $this->createAMember($userToAdd, $level->id, $_POST);
            }
            update_user_meta($mainUserId, self::ADDITIONAL_USERS_ARRAY, $addUserIds);
        }
        
        return array("message" => "success", "isNewUser" => $this->isNewUser);
    }
    
    
    public function levelsAction(){
        return json_decode(json_encode(MemberHelper::getMembershipLevels()), true);
    }
    
    /**
     * 
     * @param int $id
     * @return \stdClass
     */
    private function getMembershipLevelById($id){
        global $wpdb;
        $level = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_membership_levels WHERE id = '" .
            $id . "' LIMIT 1");
        
        return $level;
    }
    
    /**
     * 
     * @return \stdClass
     */
    public function getMembershipLevel(){
        return $this->getMembershipLevelById($this->getPost("membership_level"));
    }
    
    /**
     * 
     * @param int $userId
     * @return \stdClass
     */
    public function getStoredMembershipLevel($userId){
        return $this->getMembershipLevelById(get_user_meta($userId, "tmp_membership_level", true));
    }
    
    public function getUnpaidLevel(){
        global $wpdb;
        $level = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_membership_levels WHERE id = '" .
            self::UNPAID_LEVEL . "' LIMIT 1");
    
        return $level;
    }
    
    /**
     * 
     * @param int $userId
     */
    private function updateExpirationDate($userId, $endDate = null){
        global $wpdb;
        $wpdb->pmpro_memberships_users = $wpdb->prefix . self::PMPPRO_MEMBERSHIP_USERS;
        if($endDate === null){
            $endDate = new \DateTime();
            $endDate->add(new \DateInterval('P1Y'));
            $endDate = date("Y-m-d H:i:s", $endDate->getTimestamp());
        }
        
        $sql = "UPDATE $wpdb->pmpro_memberships_users SET `enddate`='" . $endDate . "' WHERE `user_id`=".$userId;
        $wpdb->query($sql);
        update_user_meta($userId, "expiration_date", $endDate);
    }
    
    private function getMembershipIdByName($membershipLevelName){
        global $wpdb;
        $wpdb->pmpro_membership_level = $wpdb->prefix . self::PMPRO_MEMBERSHIP_LEVELS;
        $sql = "SELECT id FROM $wpdb->pmpro_membership_level WHERE `name`= '".$membershipLevelName."'";
        $response =  $wpdb->get_var($sql);
        if($response == 0){
            return 1;
        }
        return $response;
    }
    
    /**
     * 
     * @param array $userIds
     */
    private function updateToMembershipLevel($userIds){
        if($userIds !== null && $userIds !== ""){
            foreach ($userIds as $userId){
                pmpro_changeMembershipLevel($this->getStoredMembershipLevel($userId)->id, $userId);
                if(!empty($userId)){
                    $this->updateExpirationDate($userId);
                }
            }   
        }
    }
    
    /**
     * 
     * @param array $member
     * @param number $level
     */
    public function createMember($member, $level = 1, $isMain = false){
        $userId = wp_get_current_user()->ID;
        $this->isNewUser = false;
        if($userId == 0){
            $userId = wp_create_user($member["email"], $member["password"], $member["email"]);
            $this->isNewUser = true;
        }
        
        pmpro_changeMembershipLevel($level, $userId);
        $user = array(
            "ID" => $userId,
            "user_email" => $member["email"],
            "first_name" => $member["first_name"],
            "last_name" => $member["last_name"],
        );
        wp_update_user($user);
        $this->setAdditionalInfoToUser($userId, $member);
        
        if($isMain === true){
            $creds = array();
            $creds['user_login'] = $member["email"];
            $creds['user_password'] = $member["password"];
            $creds['remember'] = true;
            
            update_user_meta($userId, "isAccount", "true");
            wp_signon($creds, false);
        }
        else{
            update_user_meta($userId, "isAccount", "false");
        }
        return $userId;
    }

    /**
     * 
     * @param int $userId
     * @param array $member
     */
    private function setAdditionalInfoToUser($userId, $member)
    {
        $pac = false;
        if($_SESSION["pac"] === true){
            $pac = true;
        }
        
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
        update_user_meta($userId, "PAC"                 , $pac);
        update_user_meta($userId, "payment_weblink"     , $member["payment_weblink"]);
        update_user_meta($userId, "affilates_number"    , $member["affilates_number"]);
        update_user_meta($userId, "total_amount"        , $member["total_amount"]);
        update_user_meta($userId, "payment_received"    , $member["payment_received" ]);
        update_user_meta($userId, "payment_method"      , $member["payment_method"]);
        update_user_meta($userId, "cost_per_affiliate"  , $member["cost_per_affiliate"]);
        update_user_meta($userId, "membership_base_cost", $member["membership_base_cost"]);
        update_user_meta($userId, "business_category", $member["business_category"]);
        update_user_meta($userId, "business_category2", $member["business_category2"]);
        update_user_meta($userId, "membership_total_cost", $_SESSION["amount"]);
        update_user_meta($userId, "tmp_membership_level", $member["membership_level"]);
        
        $accountId = $this->getZohoAccountId($member["company_name"]);
        update_user_meta($userId, "account_id", $accountId);
        
        $contactId = $this->getZohoContactId($member["email"]);
        update_user_meta($userId, "contact_id", $contactId);
    }
    
    /**
     * 
     * @param array $user
     * @param int $level
     */
    public function createAMember($user, $level = 1, $additionalInfo){
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
        $this->setAdditionalInfoToUser($userId, $additionalInfo);
        
        return $userId;
    }
    
    /**
     * 
     * @return multitype:boolean
     */
    public function checkAction(){
        if(username_exists($this->getPost("email"))){
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
        
        if(isset($_SESSION["pac"])){
            unset($_SESSION["pac"]);
        }
        
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
        if($status === true && !isset($status["status"])){
            $order->user_id = $user->ID;
            $order->status = self::SUCCESS_STATUS;
            $order->payment_type = "Credit Card";
            $order->membership_id = $this->getStoredMembershipLevel($user->ID)->id;
            
            pmpro_changeMembershipLevel($this->getStoredMembershipLevel($user->ID)->id, $user->ID);
            
            $this->updateToMembershipLevel(get_user_meta($user->ID, 
                self::ADDITIONAL_USERS_ARRAY, true)
            );
            $this->sendOrderEmail($order, $user, $this->getPost("isRenewal"));
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
    private function sendOrderEmail(\MemberOrder $order, $user, $isRenewal = false){
        if(!$isRenewal){
            $content = "Thank you for joining DCBIA! A DCBIA ambassador will reach out to you shortly to outline the many benefits of membership from an individual and company perspective.
            \nIn the meantime, please peruse our website to learn of the many ways you can build with us!";
            $content .= "\nYour Order Details\n\n";
            
            $content .="Description: Registration to DCBIA\n";
            $content .="Payment Type: ".$order->payment_type."\n\n";
            $content .="Total: $ ".$order->InitialPayment." US\n";
            
            //EmailHelper::sendEmail($user->user_email, "Registration with DCBIA", null, $content, null);
        }
        else{
            $content = "Thank you for renewing you DCBIA membership! DCBIA will reach out to you shortly to get your opinion on membership benefits. 
                \nIn the meantime, please peruse our website to continue to build your company, community, partnerships, and the economy with us!";
            
            $content .= "\nYour Order Details\n\n";
            
            $content .="Description: Renewal to DCBIA\n";
            $content .="Payment Type: ".$order->payment_type."\n\n";
            $content .="Total: $ ".$order->InitialPayment." US\n";
            
            //EmailHelper::sendEmail($user->user_email, "Renewal with DCBIA", null, $content, null);
        }
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
            $amount = $this->getStoredMembershipLevel($user->ID)->initial_payment + count($addUserIds) * self::ADDITIONAL_USER_COST;
            update_user_meta($user->ID, self::ADDITIONAL_USERS_ARRAY, $addUserIds);
            update_user_meta($user->ID, "membership_total_cost", $amount);
            return array("message" => "success");
        }
        else{
            return MemberFacade::getSingleton()->getAffiliates($this->getAdditionalUserIds($user->ID));
        }
    }
   
    
    public function indexAction(){
        $mS = MemberService::getSingleton();
        
        if(!is_null($this->getPost("resultsPerPage"))){
            $userPerPage = $this->getPost("resultsPerPage");
        }
        else{
            $userPerPage = 20;
        }
        
        if(!is_null($this->getPost("page"))){
            $mS->setOffset(($this->getPost("page") - 1) * $userPerPage);
        }
        else{
            $mS->setOffset(0);
        }
        
        $today = new \DateTime();
        $today = date("Y-m-d", $today->getTimestamp());
        
        //query search and business categories
        $query = $this->getPost("query");
        $distinct = array(
            'key' => 'isAccount',
            'value' => 'true'
        );
        $city = array(
            'key' => 'city',
            'value' => '',
            'compare' => '!='
        );
        $date = array(
            'key' => 'expiration_date',
            'value' => $today,
            'compare' => '>=',
            'type' => 'DATE'
        );
        
        $metaQueryOrRelation = array(
            'relation' => 'OR',
            array(
                'key' => 'first_name',
                'value' => $query, 
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'last_name', 
                'value' => $query, 
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'description',
                'value' => $query,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'company_description',
                'value' => $query,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'company_name',
                'value' => $query,
                'compare' => 'LIKE'
            )
        );
        
        if(!is_null($this->getPost("business_category")) && $this->getPost("business_category") != ''){
            $metaQuery = array(
                "relation" => "AND",
                $metaQueryOrRelation,
                array(
                    'key' => 'business_category',
                    'value' => $this->getPost("business_category")
                ),
                $distinct,
                $city,
                $date
            );
        }
        else{
            $metaQuery = array(
                "relation" => "AND",
                $metaQueryOrRelation,
                $distinct,
                $city,
                $date
            );
        }
        
        $mS->setMetaQuery($metaQuery);
        //end of query search
        
        
        if(!is_null($this->getPost("order"))){
            $mS->setOrder($this->getPost("order"));
        }
        
        if(!is_null($this->getPost("orderby"))){
            if($this->getPost("orderby") == "company_name"){
                $mS->setOrderby("meta_value");
                $mS->setMetaKey("company_name");
            }
            else{
                $mS->setOrderby($this->getPost("orderby"));
            }
        }
        
        $mS->setNumber($userPerPage);
        
        $users = $mS->getUsers();
        return MemberFacade::getSingleton()->formatResults($users);
    }
    
    /**
     * 
     * @return multitype:string
     */
    public function currentAction(){
        return MemberFacade::getSingleton()->formatCurrentUserForRegister();
    }
    
    /**
     * 
     * @param string $accountName
     * @return string
     */
    public function getZohoAccountId($email){
        $zohoUrl = str_replace("xml/", "", self::ZOHO_URL)."json/Contacts/searchRecords?authtoken=".self::ZOHO_TOKEN
        ."&scope=crmapi&wfTrigger=true&version=".self::ZOHO_API_VERSION
        ."&newFormat=1&criteria=(Email:".$email.")";
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $zohoUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::ZOHO_TIMEOUT);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
    
        if(!isset($response->response->nodata)){
            $accountId = $response->response->result->Contacts->row->FL[5]->content;
        }
        else{
            $accountId = "";
        }
        
        return $accountId;
    }
    
    /**
     * 
     * @param string $email
     * @return string
     */
    public function getZohoContactId($email){
        $zohoUrl = str_replace("xml/", "", self::ZOHO_URL)."json/Contacts/searchRecords?authtoken=".self::ZOHO_TOKEN
        ."&scope=crmapi&wfTrigger=true&version=".self::ZOHO_API_VERSION
        ."&newFormat=1&criteria=(Email:".$email.")";
    
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $zohoUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::ZOHO_TIMEOUT);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
    
        if(!isset($response->response->nodata)){
            $contactId = $response->response->result->Contacts->row->FL[0]->content;
        }
        else{
            $contactId = "";
        }
        
        return $contactId;
    }
    
    public function importaccountsAction(){
        ini_set('disable_functions','mail');
        
        $file = __DIR__."/import/accounts.csv";
        $accounts = array_map('str_getcsv', file($file));
        unset($accounts[0]);
        foreach ($accounts as $account){
            $pac = false;
            if($account[33] == "true"){
                $pac = true;
            }
            $account[6] = str_replace("/", "", $account[6]);
            $accountId = str_replace("zcrm_", "", $account[0]);
            $userId = wp_create_user($accountId, $accountId);
            
            $user = array(
                "ID" => $userId,
                "first_name" => $account[3]
            );
            
            wp_update_user($user);
            update_user_meta($userId, "address1", $account[16]);
            update_user_meta($userId, "city", $account[18]);
            update_user_meta($userId, "state", $account[20]);
            update_user_meta($userId, "zip", $account[22]);
            update_user_meta($userId, "telephone", $account[4]);
            update_user_meta($userId, "company_name", $account[3]);
            update_user_meta($userId, "company_website", $account[6]);
            update_user_meta($userId, "company_description", $account[26]);
            update_user_meta($userId, "membership_type"     , $account[29]);
            update_user_meta($userId, "business_category", $account[30]);
            update_user_meta($userId, "account_id", $accountId);
            update_user_meta($userId, "PAC", $pac);
            update_user_meta($userId, "isAccount", "true");
            $membershipLevelId = $this->getMembershipIdByName($account[29]);
            pmpro_changeMembershipLevel($membershipLevelId, $userId);
            $this->updateExpirationDate($userId, $account[28]);
        }
        return array("message" => "done");
    }
    
    public function importcontactsAction(){
        ini_set('disable_functions','mail');
        global $wpdb;
        
        $file = __DIR__."/import/contacts.csv";
        $contacts = array_map('str_getcsv', file($file));
        unset($contacts[0]);
        foreach ($contacts as $contact){

            $contactId = str_replace("zcrm_", "", $contact[0]);
            $accountId = str_replace("zcrm_", "", $contact[7]);
            $account = get_user_by("login", $accountId);
            $isReplacing = false;
            
            if($contact[4] == "" && $contact[5] == ""){
                $contact[4] = $contact[6];
            }
            
            if($account !== false){
                $user = array(
                    "ID" => $account->ID,
                    "first_name" => $contact[4],
                    "last_name" => $contact[5],
                    "user_email" => $contact[8],
                    "user_login" => $contact[8],
                    "user_pass" => $contact[8]
                );
                wp_update_user($user);
                $wpdb->update($wpdb->users, array('user_login' => $contact[8]), array('ID' => $account->ID));
                update_user_meta($account->ID, "isAccount", "true");
                $isReplacing = true;
            }
            else{
                $args = array(
                    'meta_key' => 'account_id',
                    'meta_value' => $accountId
                );
                $results = get_users($args);
                $account = $results[0];
            }
            
            $account->membership_level = pmpro_getMembershipLevelForUser($account->ID);
            $pac = get_user_meta($account->ID, "pac", true);
            $website = get_user_meta($account->ID, "company_website", true);
            $description = get_user_meta($account->ID, "company_description", true);
            $mType = get_user_meta($account->ID, "membership_type", true);
            $bCats = get_user_meta($account->ID, "business_category", true);
            
            if($isReplacing === false){
                $user = array(
                    "user_email" => $contact[8],
                    "user_login" => $contact[8],
                    "user_pass" => $contact[8]
                );
                $userId = wp_create_user($user["user_login"], $user["user_pass"], $user["user_email"]);
                update_user_meta($userId, "isAccount", "true");
                $user = array(
                    "ID" => $userId,
                    "first_name" => $contact[4],
                    "last_name" => $contact[5],
                );
                wp_update_user($user);
                $accountAdditionalUsers = get_user_meta($account->ID, self::ADDITIONAL_USERS_ARRAY, true);
                if($accountAdditionalUsers === ''){
                    $accountAdditionalUsers = array();
                }
                $accountAdditionalUsers[] = $userId;
                update_user_meta($account->ID, self::ADDITIONAL_USERS_ARRAY, $accountAdditionalUsers);
            }
            else{
                $userId = $account->ID;
            }
    
            if(is_int($userId)){
                update_user_meta($userId, "contact_id", $contactId);
                update_user_meta($userId, "address1", $contact[19]);
                update_user_meta($userId, "city", $contact[21]);
                update_user_meta($userId, "state", $contact[23]);
                update_user_meta($userId, "zip", $contact[25]);
                update_user_meta($userId, "telephone", $contact[9]);
                update_user_meta($userId, "phone", $contact[9]);
                update_user_meta($userId, "company_name", $contact[6]);
                update_user_meta($userId, "company_website", $website);
                update_user_meta($userId, "company_description", $description);
                update_user_meta($userId, "membership_type"     , $mType);
                update_user_meta($userId, "business_category", $bCats);
                update_user_meta($userId, "account_id", $accountId);
                update_user_meta($userId, "PAC", $pac);
                pmpro_changeMembershipLevel($account->membership_level->ID, $userId);
                $this->updateExpirationDate($userId, gmdate("Y-m-d", $account->membership_level->enddate));
            }
        }
        return array("message" => "done");
    }
    
    public function updateAction(){
        $address1 = $_POST["address1"];
        $address2 = $_POST["address2"];
        $address3 = $_POST["address3"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $telephone = $_POST["telephone"];
        
        $userId = wp_get_current_user()->ID;
        update_user_meta($userId, "address1", $address1);
        update_user_meta($userId, "address2", $address2);
        update_user_meta($userId, "address3", $address3);
        update_user_meta($userId, "city", $city);
        update_user_meta($userId, "state", $state);
        update_user_meta($userId, "telephone", $telephone);
        update_user_meta($userId, "phone", $telephone);
        
        return array("message" => "user updated");
    }
    
    public function exportUserToZoho($userId, $oldData){
        $user = get_user_by("ID", $userId);
        $this->updateZohoContact($user);
    }
    
    /**
     * 
     * @param \WP_User $user
     */
    public function updateZohoContact($user){
        $userId = $user->ID;
        
        $user->membership_level = pmpro_getMembershipLevelsForUser($userId);
        $endDate = gmdate("m/d/Y", $user->membership_level[0]->enddate);
        
        $address1 = get_user_meta($userId, "address1", true);
        $address2 = get_user_meta($userId, "address2", true);
        if($address2 !== null){
            $address = $address1." ".$address2;
        }
        else{
            $address = $address1;
        }
        
        $contactId = get_user_meta($userId, "contact_id", true);
        $params = "authtoken=".self::ZOHO_TOKEN."&scope=".self::ZOHO_CRM."&newFormat=1&wfTrigger=true";
        $params .= "&id=".$contactId."&xmlData=";
        
        $params .= "<Contacts><row no='1'>";
        $params .= '<FL val="First Name">'.$user->first_name.'</FL>';
        $params .= '<FL val="Last Name">'.$user->last_name.'</FL>';
        $params .= '<FL val="Email">'.$user->user_email.'</FL>';
        $params .= '<FL val="Phone">'.get_user_meta($userId, "telephone", true).'</FL>';
        $params .= '<FL val="Membership Expiration Date">'.$endDate.'</FL>';
        $params .= '<FL val="Mailing Street">'.$address.'</FL>';
        $params .= '<FL val="Mailing City">'.get_user_meta($userId, "city", true).'</FL>';
        $params .= '<FL val="Mailing State">'.get_user_meta($userId, "state", true).'</FL>';
        $params .= '<FL val="Mailing Zip">'.get_user_meta($userId, "zip", true).'</FL>';
        $params .= '<FL val="Billing Street">'.$address.'</FL>';
        $params .= '<FL val="Billing City">'.get_user_meta($userId, "city", true).'</FL>';
        $params .= '<FL val="Billing State">'.get_user_meta($userId, "state", true).'</FL>';
        $params .= '<FL val="Billing Code">'.get_user_meta($userId, "zip", true).'</FL>';
        $params .= '</row></Contacts>';
        
        //header("Content-type: application/xml");
        $url =  self::ZOHO_URL."Contacts/updateRecords?";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
        curl_setopt($ch, CURLOPT_POST, 1);//Regular post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    
    /**
     * 
     * @param string $accountId
     * @return multitype:\WP_User
     */
    public function getUsersByAccountId($accountId){
        $args = array(
            'meta_key'     => 'account_id',
            'meta_value'   => $accountId,
            'orderby'      => 'login',
            'order'        => 'ASC',
            'fields'       => 'all'
        );
        
        return get_users($args);
    }
}
