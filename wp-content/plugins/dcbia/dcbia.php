<?php

/**
* Plugin Name: DCBIA Backend
* Description: Backend for DCBIA
* Version: 1.0
* Author: inNuevo
* License: GPL2
*/
require __DIR__ . '/config/autoloader.php';

use INUtils\Helper\InterceptorHelper;
use INUtils\Helper\AdminPanelHelper;
use Home\Helper\HomeHelper;
use Staff\Helper\StaffHelper;
use Director\Helper\DirectorHelper;
use Committee\Helper\CommitteeHelper;
use Job\Helper\JobHelper;
use INUtils\Helper\PluginHelper;
use Member\Helper\MemberHelper;
use Resource\Helper\ResourceHelper;
use Issue\Helper\IssueHelper;

if (!class_exists("dcbia")) {

    class dcbia extends PluginHelper{

        const ADDRESS = "admin_address";
        const PHONE = "admin_phone";
        const DIRECT = "admin_direct";
        const DESCRIPTION = "site_description";

        /**
         *
         * @var InterceptorHelper
         */
        private $interceptors;
        
        /**
         * 
         * @var HomeHelper
         */
        private $homeHelper;
        
        /**
         * 
         * @var StaffHelper
         */
        private $staffHelper;
        
        /**
         * 
         * @var DirectorHelper
         */
        private $directorHelper;
        
        /**
         * 
         * @var CommitteeHelper
         */
        private $committeeHelper;
        
        /**
         * 
         * @var ResourceHelper
         */
        private $resourceHelper;
        
        /**
         * 
         * @var JobHelper
         */
        private $jobHelper;

        function __construct() {
            $this->interceptors = new InterceptorHelper();
            add_action('init', array(&$this, 'init' ));
            add_action('post_edit_form_tag' , array(&$this, 'EditFormTag'));
            add_action('admin_init', array(&$this, 'adminFeatures'));
        }

        public function init(){
            $this->homeHelper = HomeHelper::getSingleton();
            $this->staffHelper = new StaffHelper();
            $this->directorHelper = new DirectorHelper();
            $this->committeeHelper = new CommitteeHelper();
            $this->jobHelper = new JobHelper();
            $this->memberHelper = new MemberHelper();
            $this->resourceHelper = new ResourceHelper();
            $this->issueHelper = new IssueHelper();
        }

        public function adminFeatures(){
            AdminPanelHelper::getSingleton()->addSettingsTextField(self::ADDRESS, "Address");
            AdminPanelHelper::getSingleton()->addSettingsTextField(self::PHONE, "Phone");
            AdminPanelHelper::getSingleton()->addSettingsTextField(self::DIRECT, "Direct");
            AdminPanelHelper::getSingleton()->addSettingsTextArea(self::DESCRIPTION, "Site Description");
        }

        /**
         *
         * @return \stdClass
         */
        public function getResultsFromPostAction(){
            return $this->interceptors->getResults();
        }

        /*
         * It allows to upload files
         */
        public function EditFormTag(){
            echo ' enctype="multipart/form-data"';
        }
    }
}

$dcbia = new dcbia();