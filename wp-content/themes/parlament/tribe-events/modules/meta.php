<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );

if (tribe_embed_google_map()) {
	tribe_get_template_part( 'modules/meta/map' );
}

?>


<div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">

	<?php
	do_action( 'tribe_events_single_event_meta_primary_section_start' );

		// Always include the main event details in this first section
		tribe_get_template_part( 'modules/meta/details' );

		// Include organizer meta if appropriate
		if ( tribe_has_organizer() ) {
			tribe_get_template_part( 'modules/meta/organizer' );
		}

		do_action( 'tribe_events_single_event_meta_primary_section_end' );
		?>

</div>

<div class="tribe-events-single-section tribe-events-event-meta secondary tribe-clearfix">
<?php 
	do_action( 'tribe_events_single_event_meta_secondary_section_start' );

		tribe_get_template_part( 'modules/meta/venue' );

	do_action( 'tribe_events_single_event_meta_secondary_section_end' );
	?>	
</div>
	
<?php
do_action( 'tribe_events_single_meta_after' );
?>