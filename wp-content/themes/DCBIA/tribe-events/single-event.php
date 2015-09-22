<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_id = get_the_ID();
?>

<div class="container all-pad-gone">
    <div class="row">
        <div class="col-md-12 about"> 
            <?php the_title( '<h1>', '</h1>' ); ?>
            <h2><?php echo tribe_events_event_schedule_details( $event_id ); ?></h2>  
            <?php if ( tribe_get_cost() ) : ?>
    			<span class="tribe-events-divider">|</span>
    			<span class="tribe-events-cost"><?php echo "<b>Cost: </b>".tribe_get_cost( null, true ) ?></span>
    		<?php endif; ?>      
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
            <?php while ( have_posts()) :  the_post(); ?>
                <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
                <?php the_content(); ?>
                <?php //do_action( 'tribe_events_single_event_after_the_content' ); ?>
                <?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
                <div class="event-details">
                    <?php tribe_get_template_part('modules/meta'); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
</div>
<script type="text/javascript">
	jQuery(jQuery(".date-start.dtstart")[0]).hide();
	jQuery(jQuery(".event-details")[0]).hide();
</script>