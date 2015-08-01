<?php
namespace Job\Helper;

use INUtils\Helper\PostHelper;
use Job\Service\JobService;
use Job\Controller\JobController;

class JobHelper
{
    const JOB_SINGULAR = "Job";
    const JOB_PLURAL = "Jobs";
    const JOB_POST_TYPE = "job";
    const COMPANY_TAXONOMY = "company";
    const TAXONOMY_URL = "company";

    function __construct(){
        $this->JobController = JobController::getSingleton();
        $this->createJobPostType();

        add_action('add_meta_boxes_job', array(&$this, 'addMetaBoxesForJob'));
        add_action('save_post', array(&$this->JobController, 'save'));
        $this->createCompanyTaxonomy();
    }

    /**
     * It creates the Job post type
     */
    public function createJobPostType(){
        PostHelper::createPostType(self::JOB_POST_TYPE,
            self::JOB_SINGULAR,
            self::JOB_PLURAL
        );
    }

    public function addMetaBoxesForJob(){
        add_meta_box( 'job_more_info', 'info',
        array(&$this, 'getPublicationMetaBoxForMoreInfo'),
        self::JOB_POST_TYPE, 'advanced');
    }

    public function getPublicationMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
    
    public function createCompanyTaxonomy(){
        $labels = array(
            'name'              => "Company",
            'singular_name'     => "Company",
            'update_item'       => "Update Company",
            'add_new_item'      => "Add a new Company",
            'new_item_name'     => "New Company Name",
        );
        
        register_taxonomy(
            self::COMPANY_TAXONOMY,
            array(self::JOB_POST_TYPE),
            array(
                'hierarchical' => false,
                'labels' => $labels,
                'query_var' => self::COMPANY_TAXONOMY,
                'rewrite' => array('slug' => self::TAXONOMY_URL)
            )
        );
    }
}