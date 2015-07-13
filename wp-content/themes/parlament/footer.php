<?php
/**
 * File: footer.php
 * This file is used to display the footer widget zones.
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */
?>
</section>

    <!-- START .footer-container -->
    <footer class="footer-container row-fluid">                                
        <div class="wrapper">
            <section id="footer-widgets">

                <section class="span4 social">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 1' ) ) ?>
                </section>                  

                <section class="span4">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 2' ) ) ?>
                </section>        

                <section class="span4">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 3' ) ) ?>
                </section>

            </section>            
        </div>
    <!-- END .footer-container -->
    </footer>

    <!-- START .secondary-footer -->
    <footer class="secondary-footer row-fluid">
        <div class="wrapper">

            <section class="paid-for span4">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Secondary Footer 1' ) ) ?>
            </section>

            <section class="span4 copyright">
                <?php 
                global $icy_options;
                
                    $footer_copyright = $icy_options['footer_copyright'];
                
                    if($footer_copyright) { ?>
                        &copy; Copyright  - <a href="http://parlament.icypixels.com/" title="Political WordPress Theme">Parlament Theme Demo</a> - <a href="http://www.icypixels.com" title="Premium WordPress Theme Icy Pixels">Parlament Theme by Icy Pixels</a>
                    <?php } ?>
            </section>

            <section class="span4">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Secondary Footer 2' ) ) ?>
            </section>

        </div>
    <!-- END .secondary-footer -->
    </footer>

    <!-- Theme Hook -->
	<?php wp_footer(); ?>
<!--END body-->
</body>        
<!--END html-->
</html>