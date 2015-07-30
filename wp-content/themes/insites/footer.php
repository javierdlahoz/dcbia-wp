</div>
<!--main-container-->
<div class="foot-break"></div>
<footer>
	<div class="container">
		<div class="inside-footer">
			<div class="row">
				<div class="col-md-12">
					<a href="" class="back-to-top"><img
						src="<?php echo get_template_directory_uri() ;?>/img/back-to-top.png" /></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container all-pad-gone">
		<div class="col-md-4">
            <p>&nbsp;</p>
			<img class="img-responsive"
				src="<?php echo get_template_directory_uri() ;?>/img/footer-logo.png" />
		</div>
		<div class="col-md-4">
			<p>&nbsp;</p>
			<h6>
				<b>Our Mission</b>
			</h6>
			<p>InSites, a Colorado-based nonprofit organization, promotes learning, growth, and change through inquiry and collaboration. We help people build relationships, and change social systems based on results, values, and attention to a desired and sustainable, fair future for all.</p>
			
		</div>
		<div class="col-md-4 no-border">
			<p>&nbsp;</p>
			<h6>
				<b>Contact us!</b>
			</h6>
            <p>
				 	<span>Address: 1307 Sanford Drive,<br> Fort
					Collins, CO 80526</span> <span>Phone: 970-226-1003</span>
			<a href="mailto:bparsons@insites.org">Email: Beverly Parsons | bparsons@insites.org</a>
			</p>

<!--			<div class="small-social-icons">
				<a href='/contact/' class="" href="mailto:"><img
					src="<?php echo get_template_directory_uri() ;?>/img/email-small.png" /></a>
				 <a class="" href=""><img
					src="<?php echo get_template_directory_uri() ;?>/img/twitter-small.png" /></a>
				<a class="" href=""><img
					src="<?php echo get_template_directory_uri() ;?>/img/facebook-small.png" /></a>
				<a class="" href=""><img
					src="<?php echo get_template_directory_uri() ;?>/img/linkedin-small.png" /></a>
				<p style="clear: both;">&nbsp;</p>
			</div> 
		</div>-->
	</div>
	<div class="container">
		<div class="col-md-12">
			<p class="centered">&copy; 2015 InSites All Rights Reserved</p>
		</div>
		<p>&nbsp;</p>
	</div>
</footer>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/global.js"></script>
<script
	src="<?php echo get_template_directory_uri(); ?>/js/typeahead.js"></script>
<script
	src="<?php echo get_template_directory_uri(); ?>/js/autocomplete_files.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/tabs.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/dropit.js"></script>

<!-- Angular Stuffs -->
<script type="text/javascript" 
    src="<?php echo get_template_directory_uri(); ?>/js/infinitescroll/inifinetscroll.min.js"></script>
<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/js/angular/services/EmailService.js"></script>
<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/js/angular/controllers/EmailController.js"></script>
<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/js/angular/directives/shareThisDirective.js"></script>

<script type="text/javascript">
	    	jQuery(".wp-caption").css({"width": "100%", "height": "auto"});
	   		jQuery(".size-full").css({"width": "100%", "height": "auto"});
	   		jQuery(".attachment-thumbnail").each(function(){
    	   		 var src = jQuery(this).attr("src");
    	   		 jQuery(this).parent().attr("href", src);
	   		});
		</script>
<script>
            jQuery(document).ready(function() {
                jQuery('.menu').dropit();
            });
        </script>
</div>
<!--wrapper-->
</body>
</html>