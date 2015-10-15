<?php
namespace Sponsor\Controller;

use INUtils\Controller\AbstractController;
use Sponsor\Entity\SponsorEntity;
use Sponsor\Helper\SponsorHelper;
use INUtils\Service\TermService;
use Sponsor\Service\SponsorService;

class SponsorController extends AbstractController
{
    public function save($postId){
        $sponsorEntity = new SponsorEntity($postId);
        if($sponsorEntity->getType() == SponsorHelper::POST_TYPE){
            $sponsorEntity->setUrl($this->getPost(SponsorEntity::URL));
        }
    }
    
    /**
     * 
     * @return multitype:\INUtils\Entity\TermEntity
     */
    public function getSponsorTypes(){
        $spt = TermService::getSingleton();
        $spt->setTaxonomy(SponsorHelper::TAXONOMY);
        $spt->setEntityClass("\\INUtils\\Entity\\TermEntity");
        
        return $spt->getTerms();
    }
    
    /**
     * 
     * @param string $typeName
     * @return multitype:\Sponsor\Entity\SponsorEntity
     */
    public function getSponsorsByType($typeName){
        $ss = SponsorService::getSingleton();
        $ss->setTaxonomyFilter(SponsorHelper::TAXONOMY, $typeName);
        return $ss->getPosts();
    }
    
    /**
     *
     * @return multitype:\Sponsor\Entity\SponsorEntity
     */
    public function getStartedSponsors(){
        $ss = SponsorService::getSingleton();
        $ss->setPostsPerPage(2);
        return $ss->getPosts();
    }
}