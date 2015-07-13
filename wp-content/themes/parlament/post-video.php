<?php
/**
 * File: post-video.php
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


<!--BEGIN .post-media -->
<div class="post-media icy_video">

    <?php 
        $embed = get_post_meta($post->ID, '_icy_video_embed', true);
        if( !empty( $embed ) ) {
            echo stripslashes(htmlspecialchars_decode($embed));
        }
    ?>
    
<!--END .post-media -->
</div>