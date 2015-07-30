<?php
use INUtils\Service\PostService;
use Category\Service\CategoryService;

$postService = PostService::getSingleton();
$postService->setOrderby("post_date");
$postService->setOrder("DESC");
$postService->setPostsPerPage(5);

$posts = $postService->getPosts();

$categorieService = CategoryService::getSingleton();
$categories = $categorieService->getTerms();
?>
<div class="col-sm-3 left-pad-gone">
<div class="audiences-widget purplish">
	<h3>Blog Categories</h3>
	<ul>
	   <?php foreach($categories as $category): ?>
	   <?php if($category->getName() !== "Uncategorized"): ?>
	   <li>
	       <a href="<?php echo $category->getPermalink(); ?>"><?php echo $category->getName(); ?></a>
	   </li>
	   <?php endif; ?>
	   <?php endforeach; ?>
	</ul>
	<br>
</div>
<div class="audiences-widget orangish">
	<h3>Recent Posts</h3>
	<ul>
	<?php foreach($posts as $post): ?>
         <li>
            <a style="color:#ffffff;" href="<?php 
                echo $post->getPermalink(); ?>">
                <span><?php echo $post->getTitle(); ?></span>
            </a>

         </li>
	<?php endforeach; ?>
	</ul>
	<br>
</div>
</div>
