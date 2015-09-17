<?php
namespace Issue\Controller;

use INUtils\Controller\AbstractController;
use Issue\Entity\IssueEntity;
use Issue\Helper\IssueHelper;
use Issue\Service\IssueService;
use INUtils\Service\TermService;

class IssueController extends AbstractController
{
    public function save($postId){
        $issueEntity = new IssueEntity($postId);
        if($issueEntity->getType() == IssueHelper::POST_TYPE){
            $issueEntity->setShortDescription($this->getPost("short_description"));
            if($this->getPost("is_featured") == "on"){
                $issueEntity->setIsFeatured(true);
            }
            else{
                $issueEntity->setIsFeatured(false);
            }
        }
    }

    /**
     * @return array:\Issue\Entity\IssueEntity
     */
    public function getFeatured(){
        $iS = IssueService::getSingleton();
        $iS->setMetaKey("is_featured");
        $iS->setMetaValue(true);
        $iS->setPostsPerPage(2);
        $iS->setOrderby("post_date");
        $iS->setOrder("DESC");
        
        return $iS->getPosts();
    }
    
    /**
     * 
     * @return multitype:\Issue\Entity\IssueEntity
     */
    public function getAll(){
        $issues = IssueService::getSingleton()->getPosts();
        return $issues;
    }
    
    public function getHeadings(){
        $hS = TermService::getSingleton();
        $hS->setEntityClass("\\INUtils\\Entity\\TermEntity");
        $hS->setTaxonomy(IssueHelper::TAXONOMY_NAME);
        return $hS->getTerms();
    }
    
    /**
     * 
     * @return array
     */
    public function indexAction(){
        $iS = IssueService::getSingleton();
        
        $termId = $this->getPost("key_issue");
        if(!is_null($termId)){
            $taxQuery = array(
                array(
                    "taxonomy" => IssueHelper::TAXONOMY_NAME,
                    "field" => "slug",
                    "terms" => array($termId),
                    "operator"  => "IN"
                )
            );
            
            $iS->setTaxQuery($taxQuery);
        }
        
        $issues = array();
        foreach ($iS->getPosts() as $issue){
            $issues[] = $issue->toArray();
        }
        return $issues;
    }
}