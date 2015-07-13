<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

$event_id = get_the_ID();

?>

<div class="events-meta-section">
    <?php
        // Getting all the Meta Information to be displayed
        $start_day      = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'l jS');    
        $start_day_r2   = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'F Y'); 
        if (!tribe_event_is_all_day()) {
            $end_day        = tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'l jS');    
            $end_day_r2     = tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'F Y'); 
            $hour_start     = tribe_get_start_date($event = null, $displayTime = true, $dateFormat = 'h:i A');   
            $hour_end       = tribe_get_end_date($event = null, $displayTime = true, $dateFormat = 'h:i A');
        }

        $address = tribe_get_address(); 
        $city    = tribe_get_city();
        $country = tribe_get_country();    
        $cost    = tribe_get_cost(null, true);               
    ?>

    <ul class="events-wrapper row-fluid">
        <li class="span3">
            <span class="icy-button icon-calendar"></span>
            <p class="first-row"><?php echo $start_day; ?></p>
            <p class="second-row"><?php echo $start_day_r2; ?></p>
        <li class="span3">
            <span class="icy-button icon-clock"></span>

            <?php
            if (!tribe_event_is_all_day()) { ?>
                <p class="first-row"><?php _e('From', 'framework'); ?> <?php echo $hour_start; ?></p>
                <p class="second-row"><?php _e('To', 'framework'); ?> <?php echo $hour_end; ?></p>
            <?php } else { ?>
                <p class="first-row"><?php _e('All Day', 'framework'); ?></p>
                <p class="second-row"><?php _e('event', 'framework'); ?></p>
            <?php } ?>
        <li class="span3">
            <span class="icy-button icon-location"></span>
            <p class="first-row"><?php echo $address; ?></p>
            <p class="second-row"><?php echo $city . ', ' . $country; ?></p>
        <li class="span3">
            <span class="icy-button icon-pricetag"></span>
            <p class="first-row"><?php _e('Ticket price', 'framework'); ?></p>
            <p class="second-row"><?php echo $cost; ?></p>
    </ul>

</div>

<div id="tribe-events-content" class="tribe-events-single"> 

    <?php the_title( '<h2 class="tribe-events-single-event-title summary">', '</h2>' ); ?>  

    <?php $event_id = get_the_ID();
        // if (tribe_embed_google_map( $event_id )) {
        //     $venue_details = tribe_get_meta( 'tribe_venue_map' );
        //     if ( !empty($venue_details) ) {
        //         echo tribe_get_embedded_map( $event_id, '1260', '300', false);
        //     }
        // }

        //tribe_get_template_part( 'modules/meta/map' );
        ?>

        <div class="tribe-events-venue-map">
            <?php
            // do_action( 'tribe_events_single_meta_map_section_start' );
            // echo tribe_get_embedded_map( $event_id, '1260', '300', false);
            // do_action( 'tribe_events_single_meta_map_section_end' );
            ?>
        </div>

    <?php while ( have_posts() ) :  the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('vevent'); ?>>                   
            <!-- Event meta -->            

            <!-- Event meta -->
            <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
            <?php
            /**
             * The tribe_events_single_event_meta() function has been deprecated and has been
             * left in place only to help customers with existing meta factory customizations
             * to transition: if you are one of those users, please review the new meta templates
             * and make the switch!
             */
            if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
                tribe_get_template_part( 'modules/meta' );
            } else {
                echo tribe_events_single_event_meta();
            }
            ?>
            <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

            <!-- Event content -->
            <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
            <div class="tribe-events-single-event-description tribe-events-content entry-content description">
                <?php the_content(); ?>
            </div><!-- .tribe-events-single-event-description -->
            <?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

        </div><!-- .hentry .vevent -->
        <?php if( get_post_type() == TribeEvents::POSTTYPE && tribe_get_option( 'showComments','no' ) == 'yes' ) { comments_template(); } ?>
    <?php endwhile; ?>

    <!-- Event footer -->
    <div id="tribe-events-footer">
        <!-- Navigation -->
        <!-- Navigation -->
        <h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
        <ul class="tribe-events-sub-nav">
            <li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '&laquo; %title%' ) ?></li>
            <li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% &raquo;' ) ?></li>
        </ul><!-- .tribe-events-sub-nav -->
    </div><!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->