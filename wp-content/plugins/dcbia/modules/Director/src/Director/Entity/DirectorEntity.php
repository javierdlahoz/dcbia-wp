<?php
namespace Director\Entity;

use INUtils\Entity\WPPostEntity;
use Committee\Helper\CommitteeHelper;
use Director\Helper\DirectorHelper;

class DirectorEntity extends WPPostEntity
{
    const JOB_TITLE = "job_title";
    
    /**
     *
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getCommittes(){
        return $this->getTermList(CommitteeHelper::TAXONOMY);
    }
    
    /**
     * 
     * @return string
     */
    public function getCategory(){
        $cats = $this->getTermList(DirectorHelper::TAXONOMY);
        return $cats[0]->getName();
    }
}