<?php
/**
 * File: post-image.php
 * This file is used to display a lightbox gallery inside a post.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 * @uses 		icy_lightbox() 		details here: /functions/theme-functions.php
 *
 * @since		Icy Framework 1.0
 */
?>
<!--BEGIN .post-media -->
<div class="post-media">

    <?php 	
		icy_lightbox($post->ID, 'thumbnail-events-slider'); 
    ?>
    
<!--END .post-media -->
</div>


