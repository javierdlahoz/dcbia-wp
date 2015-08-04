<?php
namespace Job\Entity;

use INUtils\Entity\WPPostEntity;
use Job\Helper\JobHelper;

class JobEntity extends WPPostEntity
{
    const LINK = "link";
    
    /**
     * 
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getCompanies(){
        return $this->getTermList(JobHelper::COMPANY_TAXONOMY);
    }
}