<?php
namespace Director\Entity;

use INUtils\Entity\WPPostEntity;
use Committee\Helper\CommitteeHelper;

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
}