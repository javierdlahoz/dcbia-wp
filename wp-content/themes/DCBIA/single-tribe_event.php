<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template' 
 * is selected in Events -> Settings -> Template -> Events Template.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php get_header(); ?>
<div class="container all-pad-gone">      
    <?php echo getTopMenu(); ?>  
</div>

<!-- START main-container -->
<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12">
            <section class="main-container">

                <section class="wrapper primary">

                    <section class="content">		

                        <div style="width: 100%;" id="tribe-events-pg-template" class="">
                            <?php tribe_events_before_html(); ?>
                            <?php tribe_get_view(); ?>
                            <?php tribe_events_after_html(); ?>
                        </div> <!-- #tribe-events-pg-template -->

                    </section>

                </section>

            </section>
        </div>    
    </div>    
</div>    
<?php get_footer(); ?>