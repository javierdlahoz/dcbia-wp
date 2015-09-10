<?php get_header(); ?>
<div class="container all-pad-gone">
    <?php echo getTopMenu(); ?>
</div> 
<p>&nbsp;</p>
    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h3>Password Recovery</h3>
                <?php echo do_shortcode("[wppb-recover-password]"); ?>
                <br>
            </div>
        </div>
    </div>

<p>&nbsp;</p>
<?php get_footer(); 