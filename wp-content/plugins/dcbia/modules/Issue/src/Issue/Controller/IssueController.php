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
            
        }
    }
    
    /**
     * 
     * @return multitype:\Director\Entity\DirectorEntity
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
}