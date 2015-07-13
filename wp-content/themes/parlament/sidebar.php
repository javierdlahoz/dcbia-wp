
<?php
/**
 * File: sidebar.php
 * This file is used to display a the video of the post.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman 
 *
 * @since		Icy Framework 1.0
 */
?>

		<!--BEGIN .sidebar-->
		<aside class="sidebar span4">		 	
			
			<?php 			
			/* Widgetised Area */ 
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Main Sidebar') ) : ?>                
                <?php
				endif;			
			?>		
		<!--END .sidebar-->
		</aside>