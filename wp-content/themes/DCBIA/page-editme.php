<?php
get_header(); ?>
<p>&nbsp;</p>
<div class="container inside-pages">
   <p>&nbsp;</p>
    <div class="container inside-pages">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit my profile</h3>
                <?php echo do_shortcode("[wppb-edit-profile]"); ?>
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#edit_profile").click(function(){
	    	jQuery("#wppb-edit-user").submit();
	    });
	});
</script>