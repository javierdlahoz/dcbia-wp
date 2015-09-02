<?php
namespace Member\Facade;

use INUtils\Singleton\AbstractSingleton;

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
}