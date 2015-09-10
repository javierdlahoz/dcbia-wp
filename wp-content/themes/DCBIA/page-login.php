<?php
get_header(); ?>
<p>&nbsp;</p>

    <div class="container all-pad-gone">
        <div class="row">
            <div class="col-md-12">
                <h2><?php the_title(); ?></h2>&nbsp;
                <?php echo do_shortcode("[wppb-login]"); ?>
                <br>
                <?php if(get_current_user_id() == 0): ?>
                    <a href="/password-recovery">I forgot my password</a>
                <?php endif; ?>
                <br>
            </div>
        </div>
    </div>

<p>&nbsp;</p>
<?php get_footer();