<?php
get_header(); ?>
<p>&nbsp;</p>
<div class="container inside-pages">
   <p>&nbsp;</p>
    <div class="container inside-pages">
        <div class="row">
            <div class="col-md-12">
                <h3><?php the_title(); ?></h3>
                <?php echo do_shortcode("[wppb-login]"); ?>
                <br>
            </div>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php get_footer();