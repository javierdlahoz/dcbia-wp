<?php
namespace Member\Facade;

use INUtils\Singleton\AbstractSingleton;
use INUtils\Helper\TextHelper;

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
        
        return array(
            "name" => $user->first_name." ".$user->last_name,
            "cropBio" => TextHelper::cropText($description),
            "permalink" => $user->user_url,
            "picture" => get_avatar_url($user->ID),
            "email" => $user->user_login
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
}