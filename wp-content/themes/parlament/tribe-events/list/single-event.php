<?php 
/**
 * Map View Single Event
 * This file contains one event in the map
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/map/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 

global $post;

$venue_details = array();

if ($venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
    $venue_details[] = $venue_name; 
}

if ($venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
    $venue_details[] = $venue_address;  
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard': '';
$has_venue_address = ( $venue_address ) ? ' location': '';
?>

<?php
    // Getting all the Meta Information to be displayed
    $start_day      = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'j');    
    $start_day_r2   = tribe_get_start_date($event = null, $displayTime = false, $dateFormat = 'M'); 
    if (!tribe_event_is_all_day()) {
        $end_day        = tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'l jS');    
        $end_day_r2     = tribe_get_end_date($event = null, $displayTime = false, $dateFormat = 'F Y'); 
        $hour_start     = tribe_get_start_date($event = null, $displayTime = true, $dateFormat = ' ');   
        $hour_end       = tribe_get_end_date($event = null, $displayTime = true, $dateFormat = ' ');
    }

    $address = tribe_get_address(); 
    $city    = tribe_get_city();
    $country = tribe_get_country();    
    $cost    = tribe_get_cost(null, true);               
?>

<div class="icy-event-details">

    <div class="icy-event-datetime">
        <span class="icy-button icon-calendar"></span>
        <span class="first-row"><?php echo $start_day; ?></span>
        <span class="second-row"><?php echo $start_day_r2; ?></span>
    </div>

    <div class="icy-event-thumbnail">
        <?php the_post_thumbnail( 'thumbnail-events-list' ); ?>
    </div>

    <!-- Event Title -->
    <h2 class="tribe-events-list-event-title summary">
        <a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
            <?php the_title() ?>
        </a>
    </h2>

    <div class="icy-event-price">
        <span class="cost"><?php echo $cost; ?></span>
    </div>

</div>
