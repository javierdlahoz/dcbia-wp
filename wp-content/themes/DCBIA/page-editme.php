<?php
get_header(); ?>
<p>&nbsp;</p>
<div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit my profile</h2>
                <?php echo do_shortcode("[wppb-edit-profile]"); ?>
                <br>
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