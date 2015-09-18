<?php
namespace Director\Helper;

use INUtils\Helper\PostHelper;
use Director\Service\DirectorService;
use Director\Controller\DirectorController;

class DirectorHelper
{
    const DIRECTOR_SINGULAR = "Board or Media Entry";
    const DIRECTOR_PLURAL = "Board Entries & Media";
    const DIRECTOR_POST_TYPE = "board";
    const TAXONOMY = "board_media_category";
    const TAXONOMY_URL = "board_media_category";

    function __construct(){
        $this->directorController = DirectorController::getSingleton();
        $this->createDirectorPostType();

        add_action('add_meta_boxes_'.self::DIRECTOR_POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->directorController, 'save'));
        $this->createCategoryTaxonomy();
    }

    /**
     * It creates the Staff post type
     */
    public function createDirectorPostType(){
        PostHelper::createPostType(self::DIRECTOR_POST_TYPE,
            self::DIRECTOR_SINGULAR,
            self::DIRECTOR_PLURAL
        );
    }

    public function addMetaBoxes(){
        add_meta_box( self::DIRECTOR_POST_TYPE.'_more_info', 'info',
        array(&$this, 'getDirectorMetaBoxForMoreInfo'),
        self::DIRECTOR_POST_TYPE, 'advanced');
    }

    public function getDirectorMetaBoxForMoreInfo(){
        include __DIR__."/../views/admin/edit-form.php";
    }
    
    public function createCategoryTaxonomy(){
        $labels = array(
            'name'              => "Category",
            'singular_name'     => "Category",
            'update_item'       => "Update Category",
            'add_new_item'      => "Add a new Category",
            'new_item_name'     => "New Category Name",
        );
    
        register_taxonomy(
            self::TAXONOMY,
            array(self::DIRECTOR_POST_TYPE),
            array( 'hierarchical' => true,
                'labels' => $labels,
                'query_var' => self::TAXONOMY,
                'rewrite' => array('slug' => self::TAXONOMY_URL)
            )
        );
        
        wp_insert_term(
           "Board",
            self::TAXONOMY,
            array(
                "description" => "this is for board entries",
                "slug" => "board"
            )
        );
        
        wp_insert_term(
            "Media",
            self::TAXONOMY,
            array(
                "description" => "this is for media releases",
                "slug" => "media"
            )
        );
    }
}