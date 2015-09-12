<?php
namespace Home\Service;

use INUtils\Service\WPPostService;

class NewsService extends WPPostService
{
   public function init(){
       $this->setEntityClass("\\Home\\Entity\\NewsEntity");
   }
}