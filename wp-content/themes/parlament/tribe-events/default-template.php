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

<!-- START #main-container -->
<section class="row-fluid main-container">

	<section class="wrapper primary">

		<section class="span12 content">		

			<div id="tribe-events-pg-template" class="wrapper">
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div> <!-- #tribe-events-pg-template -->

		</section>

	</section>

</section>
<?php get_footer(); ?>