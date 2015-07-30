<?php

namespace Member\Controller;

use Member\Entity\MemberEntity;
use Member\Entity\Multiselect\MultiselectEntity;
use INUtils\Controller\AbstractController;
use Member\Helper\MemberHelper;
use INUtils\Helper\TextHelper;
use Member\Service\MemberService;
use INUtils\Helper\FileHelper;
use INUtils\Entity\PostEntity;
use INUtils\Service\PostService;
use INUtils\Controller\PostController;

class MemberController extends AbstractController{
    
    /**
     *
     * @throws \Exception
     * @return boolean
     */
    public function save($postId)
    {
    	$post = get_post($postId);

    	if($post->post_type == MemberHelper::POST_TYPE && isset($_POST["authors"]))
    	{
	        $resourceEntity = new MemberEntity();
	        $resourceEntityTmp = MemberService::getSingleton()->findResourceById($postId);
	        $postEntity = new PostEntity($postId);

	        if(isset($_FILES) && $_FILES["file"]["name"] != ""){	            
	            $fileInfo = FileHelper::uploadFile("file");
	            
	            $resourceEntity->setFileUrl($fileInfo["fileUrl"]);
	            $resourceEntity->setFileSize($fileInfo["fileSize"]);
	            $resourceEntity->setFileName($fileInfo["fileName"]);
	        }
	        elseif($resourceEntityTmp != null){
	            $resourceEntity->setFileUrl($resourceEntityTmp->getFileUrl());
	            $resourceEntity->setFileSize($resourceEntityTmp->getFileSize());
	            $resourceEntity->setFileName($resourceEntityTmp->getOldFileName());
	        }

			if($resourceEntityTmp != null){
	           	MemberService::getSingleton()->delete($resourceEntityTmp, false);
	       	}

	       	$resourceEntity->setId($postId);
	        $resourceEntity->setTitle($post->post_title);
	        $resourceEntity->setDescription($post->post_content);
	        $resourceEntity->setStatus($post->post_status);
	        $resourceEntity->setVideo($this->getPost("video"));
	        $resourceEntity->setTags($postEntity->getTagsAsString());

	        $authors = new MultiselectEntity();
	        $institutionNames = new MultiselectEntity();

        	if(isset($_POST['authors'])){
		        for ($i = 0; $i < count($_POST['authors']); $i++) {
		            $authors->addOption($_POST['authors'][$i]);
		            $institutionNames->addOption($_POST['institution_name'][$i]);
		        }
        	}

	        $resourceEntity->setAuthors($authors);
	        $resourceEntity->setOrganizationNames($institutionNames);

	        if (isset($_POST ['date']) && $_POST['date'] != "") {
	            $resourceEntity->setDate($_POST["date"]);
	        }

            if (isset($_POST['url'])) {
                $resourceEntity->setUrl($_POST['url']);
            }


	        /* Copyright options */
	        $license = new MultiselectEntity();
	        foreach (MemberHelper::getCopyRight() as $optionKey => $optioValue) {
	            if (isset($_POST[$optionKey])) {
	                $license->addOption($_POST[$optionKey]);
	            }
	        }
	        $resourceEntity->setCopyright($license);

	        /* resource types */
	        $type = new MultiselectEntity();
	        foreach (MemberHelper::getResourceTypes() as $optionKey => $optioValue) {
	            if (isset($_POST [$optionKey])) {
	                $type->addOption($_POST[$optionKey]);
	                $resourceEntity->setTypeInWP($_POST[$optionKey]);
	            }
	        }
	        $resourceEntity->setType($type);

	        /* areas of focus */
	        $areasOfFocus = new MultiselectEntity();
	        foreach (MemberHelper::getAreasOfFocus() as $optionKey => $optioValue) {
	            if (isset($_POST [$optionKey])) {
	                $areasOfFocus->addOption($_POST[$optionKey]);
	                $resourceEntity->setAreasOfFocusInWP($_POST[$optionKey]);
	            }
	        }
	        $resourceEntity->setAreasOfFocus($areasOfFocus);

	        /* stakeholders */
	        $stakeholders = new MultiselectEntity();
	        foreach (MemberHelper::getStakeholders() as $optionKey => $optioValue) {
	            if (isset($_POST [$optionKey])) {
	                $stakeholders->addOption($_POST[$optionKey]);
	            }
	        }

	        $resourceEntity->setStakeholders($stakeholders);

	        /* resource formats */
            if (isset($_POST ["resource_format"])) {
                $format = $_POST["resource_format"];
            }
	        $resourceEntity->setResourceFormat($format);

	        try {
	            MemberService::getSingleton()->save($resourceEntity);
	        }
	        catch (\Exception $e) {
	            throw new \Exception($e->getMessage());
	        }
    	}
    }

    /**
     * 
     * @throws \Exception
     */
    public function delete_fileAction(){
        $pathToRoot = __DIR__."/../../../../../../../..";
        $resourceId = $this->getPost("id");
        $resource = MemberService::getSingleton()->findResourceById($resourceId);
        
        try{
            $filePath = $pathToRoot.$resource->getFileUrl();
            unlink($filePath);
            $resource->setFileUrl("");
        }
        catch(\Exception $ex){
            return array("message" => $ex->getMessage());
        }
        
        return array("message" => $filePath);
    }
    
    /**
     *
     * @return array
     */
    public function searchAction(){

    	if($this->getPost("paged") != ""){
    		$paged = $this->getPost("paged");
    	}
    	else{
    		$paged = 1;
    	}

        $facetsArray = array(
        	"areas_of_focus" => MemberEntity::AREA_OF_FOCUS,
            "stakeholders" => MemberEntity::STAKEHOLDERS,
        	"resource_type_facets" => MemberEntity::RESOURCE_TYPE
        );

    	$orderBy = array("score" => "DESC");
    	if($this->getPost("orderby") != ""){
        	$order = $this->getPost("orderby");
        	switch ($order){
        		case "title":
        			$orderBy = array("title_copy" => "ASC");
        			break;
        		case "date":
        			$orderBy = array("date_dt" => "DESC");
        			break;
        	}
        }

        $filterTypes = array(
            MemberEntity::AREA_OF_FOCUS => $_POST["areas-of-focus"],
            MemberEntity::STAKEHOLDERS => $_POST["stakeholders"],
            MemberEntity::RESOURCE_TYPE => $_POST["resource-types"]
        );
       
        
        $resources = MemberService::getSingleton()->findResourcesBy(
                    $this->getQuery($this->getPost("query"), $this->getPost("audience"), $filterTypes),
        			$orderBy,
        			$paged,
        			$facetsArray,
                    true
        		);

        $count = MemberService::getSingleton()->getQueryCount();
        $numberOfPages = MemberService::getSingleton()->getNumberOfPages();
        $facets = MemberService::getSingleton()->getFacetResults();
        $pages = $numberOfPages;

        return array(
            "resources" => $resources,
            "pages" => $pages,
            "count" => $count,
        	"facets" => MemberHelper::formatFacetsAsArray($facets),
        	"page" => $paged
        );
    }

    /**
     *
     * @return multitype:string
     */
    public function areasoffocusAction(){
        $areasOfFocus = array();
        foreach(MemberHelper::getAreasOfFocus() as $key => $value){
            array_push($areasOfFocus, $value);
        }

        return $areasOfFocus;
    }

    /**
     *
     * @return multitype:string
     */
    public function stakeholdersAction(){
        $stakeholders = array();
        foreach(MemberHelper::getStakeholders() as $key => $value){
            array_push($stakeholders, $value);
        }

        return $stakeholders;
    }


    /**
     *
     * @return multitype:string
     */
    public function typesAction(){
        $resourceTypes = array();
        foreach(MemberHelper::getResourceTypes() as $key => $value){
            array_push($resourceTypes, $value);
        }

        return $resourceTypes;
    }

    /**
     *
     * @return multitype:string
     */
    public function formatsAction(){
        $formats = array();
        foreach(MemberHelper::getResourceFormats() as $key => $value){
            array_push($formats, $value);
        }

        return $formats;
    }

    /**
     *
     * @param string $expression
     * @param string $audience
     * @param array $filterTypes
     * @param string $subOptions
     * @return string
     */
    private function getQuery($expression, $audience = "", $filterTypes = null, $subOptions = null) {
        return self::constructQuery($expression, $audience, $filterTypes, $subOptions);
    }

    /**
     *
     * @param unknown $expression
     * @param string $audience
     * @param array $filterTypes
     * @return string
     */
    public static function constructQuery($expression, $audience = "", $filterTypes = null, $subOptions = null){

        $expressions[0] = $expression;

        $query = "(" . self::queryBuilder("title_s", TextHelper::formatSpaces($expressions), true, true);
        $query .= self::queryBuilder("description_s", TextHelper::formatSpaces($expressions));
        $query .= self::queryBuilder("tags_s", TextHelper::formatSpaces($expressions));
        $query .= self::queryBuilder("organization_name_ss", $expressions);
        $query .= self::queryBuilder("author_ss", TextHelper::formatSpaces($expressions));
        $query .= self::queryBuilder("url_s", $expressions);
        $query .= ")";
        
        
    	if ($filterTypes != null 
    	       && (
    	           (!(count($filterTypes['areas_of_focus_ss']) == 1 && $filterTypes['areas_of_focus_ss'][0] == "*")) 
    	       ||  (!(count($filterTypes['stakeholders_ss']) == 1 && $filterTypes['stakeholders_ss'][0] == "*")) 
    	       ||  (!(count($filterTypes['resource_type_ss']) == 1 && $filterTypes['resource_type_ss'][0] == "*"))
    	          )
    	    ) 
    	{
    	    
    	    foreach($filterTypes as $filterKey => $filterValues){
    	        if($filterValues != "" && $filterValues != "*"){
    	            if(is_string($filterValues)){
    	                $query .= " AND ".$filterKey.":".TextHelper::formatSpaces($filterValues);
    	            }
    	            else{
    	                foreach($filterValues as $filterValue){
    	                    if(is_array($filterValue)){
    	                        foreach ($filterValue as $value){
    	                            $query .= " AND ".$filterKey.":". TextHelper::formatSpaces($value);
    	                        }
    	                    }
    	                    elseif($filterValue != "*"){
    	                        $query .= " AND ".$filterKey.":" . TextHelper::formatSpaces($filterValue);
    	                    }
    	                }
    	            }
    	        }
    	        else{
    	            $query .= " AND ".$filterKey.":*";
    	        }
    	    }
    	}

    	$query .= " AND status_s: publish";
    	return $query;
    }

    /**
     * it deletes the resource and its file
     */
    public function delete($postId)
    {
        $resource = MemberService::getSingleton()->findResourceById($postId);
       	MemberService::getSingleton()->delete($resource, false);
    }

    /**
     *
     * @param string $resourceId
     * @return Ambigous <NULL, \Resource\Service\multiple:>
     */
    public function getResourceById($resourceId) {
        $resource = $this->resourceService->findResourcesBy("id:" . $resourceId);
        return $resource[0];
    }

    /**
     *
     * @param multiple $resourceArray
     * @return multiple
     */
    public function getPublishedResources($resourceArray){
    	$resources = null;
    	if($resourceArray != null)
    	{
	    	foreach ($resourceArray as $resource ) {
				$post = get_post ( $resource->getId () );
				if (is_object ( $post ) && $post->post_status == "publish") {
					$resources [] = $resource;
				}
			}
		}
		return $resources;
	}
	
	/**
	 * 
	 * @return multitype:multitype:
	 */
	public function resourceAction(){
	    $name = $this->getPost("name");
	    if($name === null){
	        throw new \Exception("No url was found");
	    }
	    PostService::getSingleton()->setName($name);
	    PostService::getSingleton()->setPostType(MemberHelper::POST_TYPE);
	    $post = PostService::getSingleton()->getPosts();
	    
	    $postid = $post[0]->getId();
	    $resourceEntity = MemberService::getSingleton()->findResourceById($postid);
	    
	    return array("resource" => $resourceEntity->getAsArray());
	}

    /**
     *
     * @param  $field
     * @param  $expressions
     * @param  boolean $isFirst
     * @return
     */
    public static function queryBuilder($field, $expressions, $isFirst = false, $isStrict = false){
        $query = "";
        foreach ($expressions as $expression) {
            if($expression === ""){
                $expression = "*";
            }

            if($isFirst){
                if($isStrict === true){
                    $query = $field . ':"' . $expression . '"';
                }
                else{
                    $query = $field . ':*' . $expression . '* ';
                }
                $isFirst = false;
            }
            else{
                if($isStrict === true){
                    $query .= "OR ". $field . ':"' . $expression . '"';
                }
                else{
                    $query .= "OR ". $field . ':*' . $expression . '* ';
                }
            }
        }
        return $query;
    }
}
