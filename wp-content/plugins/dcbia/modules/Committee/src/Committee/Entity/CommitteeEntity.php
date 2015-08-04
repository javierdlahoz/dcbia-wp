<?php
namespace Committee\Entity;

use INUtils\Entity\WPPostEntity;
use Committee\Helper\CommitteeHelper;

class CommitteeEntity extends WPPostEntity
{
    const JOB_TITLE = "job_title";
    
    /**
     * 
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getCommittes(){
        return $this->getTermList(CommitteeHelper::TAXONOMY);
    }
}