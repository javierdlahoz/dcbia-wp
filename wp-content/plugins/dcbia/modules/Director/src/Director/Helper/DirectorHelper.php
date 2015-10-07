<?php
namespace Director\Helper;

use INUtils\Helper\PostHelper;
use Director\Service\DirectorService;
use Director\Controller\DirectorController;
use INUtils\Entity\WPPostEntity;
use Director\Entity\DirectorEntity;

class DirectorHelper
{
    const DIRECTOR_SINGULAR = "Media Entry";
    const DIRECTOR_PLURAL = "Media Entries";
    const DIRECTOR_POST_TYPE = "board";
    const TAXONOMY = "board_media_category";
    const TAXONOMY_URL = "board_media_category";

    function __construct(){
        $this->directorController = DirectorController::getSingleton();
        $this->createDirectorPostType();

        add_action('add_meta_boxes_'.self::DIRECTOR_POST_TYPE, array(&$this, 'addMetaBoxes'));
        add_action('save_post', array(&$this->directorController, 'save'));
        //add_filter('manage_board_posts_columns', array(&$this, 'createColumnHead'));
        //add_action('manage_board_posts_custom_column', array(&$this, 'createColumnContent'), 10, 2);
        //$this->createCategoryTaxonomy();
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
    
    public function createColumnHead($defaults){
        $defaults['board_media_category'] = 'Category';
        return $defaults;
    }
    
    public function createColumnContent($columnName, $postId){
        if ($columnName == 'board_media_category') {
            $p = new DirectorEntity($postId);
            $cat = $p->getCategory();
            
            if($cat == "Media"){
                echo "<div style='background-color: rgb(145, 15, 15); color: #fff; padding: 5px; border-radius: 3px; width: 120px; text-align: center;'>".$cat."</div>";
            }
            else{
                echo "<div style='background-color: rgb(15, 130, 145); color: #fff; padding: 5px; border-radius: 3px; width: 120px; text-align: center;'>".$cat."</div>";
            }
        }
    }
}