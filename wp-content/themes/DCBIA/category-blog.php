<?php 
get_header();
include __DIR__."/helpers/blog-helper.php";  
$postResults = get_blog_posts(); 
$posts = $postResults["posts"];
?>
        <div class="container-fluid wt">
            <div class="inner-shell">
            	<form id="search_form"></form>
                <br>
                <div class="row">
                    <div class="col-md-8 blog-home-post-box">
                    <?php 
                    if(!empty($posts)):
                        foreach ($posts as $post):  
                            if($post['image'] == ""){
                                $image = get_template_directory_uri()."/img/blog-landing.png";
                            }
                            else{
                                $image = $post['image'];
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-5 vanish-left-pad">
                                <img class="img-responsive"src="<?php echo $image; ?>" /> 
                                <br>
                            </div>
                            <div class="col-md-7 vanish-left-pad">    
                                <h3><?php echo $post['title']; ?></h3>
                                <p><?php echo $post['content']; ?></p>
                                <a class="button-dk" href="<?php echo $post['url']; ?>">GO TO BLOG</a>
                            </div>
                        </div>
                        <br>
                             <?php endforeach;
                            else: ?>
                            <h2>There's no blogs yet</h2>
                            <?php endif; ?>
                        </div> 
                        <div class="col-md-4">
                            <div class="free-wall">
                            <div class="blog-short-block showcase-box">
                              <div class="inside-blog color-anchor">
                                   
                                    <h2 class="text-uppercase">Professional <span class="light-break"> Announcements</h2>
                                    <div class="underline"></div>    
                                    <div class="col-sm-12 vanish-left-pad">
                                        <p>Ancient alien earth mound spaceships extraterrestrial origin DNA manipulation, extraterrestrial origin ancient religions Mayan ancient alien megoliths, star people alien Chariot of the Gods. Ancient alien extraterrestrial evidence space travel otherworldly visitors ancient god Puma Punku spaceships, the answer is a resounding YES... Star gates flying vessels helicopter heiroglyph.</p>
                                    </div>
                                    <div class="col-md-12 vanish-left-pad">    
                                        <hr>
                                    </div>    
                                </div>
                            </div>
                                
                             <div class="blog-short-block showcase-box">
                              <div class="inside-blog color-anchor">
                                   
                                    <h2 class="text-uppercase">Festivals <span class="light-break"> Calendar</h2>
                                    <div class="underline"></div>    

                                    <div class="col-sm-12 vanish-left-pad">
                                        <p>Ancient alien earth mound spaceships extraterrestrial origin DNA manipulation, extraterrestrial origin ancient religions Mayan ancient alien megoliths.</p>
                                    </div>
                                    <div class="col-md-12 vanish-left-pad">    
                                        <hr>
                                    </div>     
                                </div>
                            </div>    
                           </div>
                                
                        </div>    
                    </div>
                <br>
                <br>
	            <?php if($postResults["pages"] > 1): ?>
				<div class="pagination-controls">
					<?php if($postResults["page"] > 1): ?>
					<span onclick="jQuery('#search_form').attr('action', '/blog/page/<?php echo $postResults["page"] - 1; ?>');
							jQuery('#search_form').submit();">< 
					</span>
					<?php 
					endif;
					for($i=1; $i <= $postResults["pages"]; $i++): ?>
						<span class="<?php if($postResults["page"] == $i) echo 'active'; ?>" 
							onclick="jQuery('#search_form').attr('action', '/blog/page/<?php echo $i; ?>');
							jQuery('#search_form').submit();"><?php echo $i; ?></span>&nbsp;
					<?php endfor; 
					if($postResults["page"] < $postResults["pages"]):
					?>
					<span onclick="jQuery('#search_form').attr('action', '/blog/page/<?php echo $postResults["page"] + 1; ?>');
							jQuery('#search_form').submit();">>
					</span>
					<?php endif; ?>
				</div>
				<?php endif; ?>
            </div>
			</div>
        </div>    
    <?php get_footer(); ?>
    <script type="text/javascript">
         jQuery(document).ready(function() {
             setBlockColors();
         });
    </script>        