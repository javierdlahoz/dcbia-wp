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

    function __construct(){
        $this->JobController = JobController::getSingleton();
        $this->createJobPostType();

        add_action('add_meta_boxes_job', array(&$this, 'addMetaBoxesForJob'));
        add_action('save_post', array(&$this->JobController, 'save'));
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
}