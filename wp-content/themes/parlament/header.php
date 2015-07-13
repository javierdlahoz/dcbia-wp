<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Icy Pixels | Powered by WordPress -->

<!-- BEGIN head -->
<head>

    <!-- Retrieve Theme Options for further use -->
    <?php global $icy_options;
    $icy_options = thsp_cbp_get_options_values(); ?>

	<!-- Basic Page Needs -->
    <title><?php
    if (is_home() || is_front_page()) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif(is_page_template('template-home.php')) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_single() || is_page()) { single_post_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_search()) { _e('Search Results', 'framework'); echo " ".wp_specialchars($s); }
    elseif (is_category() || is_tag()) { single_cat_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    else { echo trim(wp_title(' ',false)); }
    ?></title>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- RSS & Pingbacks -->
   	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php 
    $feed = get_option(' icy_feedburner '); if ($feed != ''){echo get_option(' icy_feedburner ');} else {bloginfo('rss2_url');} ?>" />
   	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <!-- Theme Hook -->
    <?php wp_head(); ?> 
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
  
</head>
<!-- END head section -->

<!-- START body -->
<body <?php body_class('body-content'); ?>>

<!-- START #top -->    
<header class="clearfix">

    <!-- START .hello-bar -->
    <section class="hello-bar row-fluid">

        <div class="wrapper">
            
            <?php
            $donate_active = $icy_options['donate_active'];            
            $donate_link = $icy_options['donate_link'];
            if ($donate_active == 'true') { ?>
                <a href="<?php echo $donate_link; ?>" class="icy-button donate icon-card">
                    <?php _e('Donate', 'framework'); ?>
                </a>  
            <?php } ?>


            <div class="icy-language-switcher">
            <?php 
                $language_switcher = $icy_options['language_switcher'];

                if ($language_switcher == 'true') {
                    if (function_exists('languages_list_footer') && function_exists('icl_get_languages')) {
                        languages_list_footer();
                    }
                }                
            ?>   
            </div>  
    
            <div class="span4 social-icons-wrapper">
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Header Right' ) ) ?>
                 <a href="#search" class="search-button">
                    <span class="icy-button icon-search"></span> 
                </a>
            </div> 

            <div class="search-wrapper">
                <!-- #searchbar -->
                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="clearfix" >                    
                    <input type="text" name="s" id="s" placeholder="<?php _e('To search press enter...', 'framework'); ?>"/>
                </form>
                <!-- /#searchbar-->    
            </div>   

            
            <?php
            /*
            * Hook that can be used for plugins and theme extensions (currently:  the woocommerce shopping cart)
            */
            do_action('icy_main_header');

            ?>

        </div><!-- END .wrapper -->

    <!-- END .hello-bar -->
    </section>

</header>
<!-- END header -->

<?php    

    /*
        The machine for the hero area.
    */

    if (function_exists('rwmb_meta')) {    
    $postsID = get_option('page_for_posts '); 
    
        if (is_home()) {            
            // Getting the ID of the Page for Posts (which is the Blog)
                        
            // Now we can retrieve meta box information like page title and subtitle
            $header_type    =    rwmb_meta( '_icy_type_select', '', $postsID );
            $slider         =    rwmb_meta( '_icy_slider_shortcode', '', $postsID ); 
            $page_title     =    rwmb_meta( '_icy_page_title', '', $postsID );    
            $page_pos       =    rwmb_meta( '_icy_pagetitle_position', '', $postsID); 
            $text_fg        =    rwmb_meta( '_icy_title_color', '', $postsID );
            $text_bg        =    rwmb_meta( '_icy_title_bgcolor', '', $postsID );  
            $background     =    rwmb_meta( '_icy_title_background', '', $postsID);     
            $image_array    =    rwmb_meta( '_icy_hero_image', 'type=image_advanced', $postsID);  
            $image_array = array_shift($image_array);
            $image_url      =    $image_array['full_url'];    
            $image_alt      =    $image_array['alt'];          
        } else {
            $header_type    =    rwmb_meta( '_icy_type_select' );
            $slider         =    rwmb_meta( '_icy_slider_shortcode' ); 
            $page_title     =    rwmb_meta( '_icy_page_title' );     
            $page_pos       =    rwmb_meta( '_icy_pagetitle_position' );
            $text_fg        =    rwmb_meta( '_icy_title_color' );
            $text_bg        =    rwmb_meta( '_icy_title_bgcolor' );   
            $background     =    rwmb_meta( '_icy_title_background');            
            $image_array    =    rwmb_meta( '_icy_hero_image', 'type=image_advanced');  
            $image_array = array_shift($image_array);
            $image_url      =    $image_array['full_url'];              
            $image_alt      =    $image_array['alt'];
        }                                    
        if (function_exists('tribe_is_event')) {
            if (tribe_is_event() && !tribe_is_day() && !is_single()) {
                $event_title = $icy_options['events_title'];
                if ($event_title) {
                    $page_title = $event_title;
                } else {
                    $page_title = __('Events', 'framework');    
                }                
                $header_type = 'page-title';
                $text_bg = '#ef3f42';
            }
        }

        if (is_archive()) {
            $page_title = __('Archive', 'framework');
            $header_type = 'page-title';
            $text_bg = '#ef3f42';
        }

        if (function_exists('is_shop')) {
            if (is_shop()) {
                $page_title = __('Shop', 'framework');
                $header_type = 'page-title';
                $text_bg = '#ef3f42';
            }
        }

        if (is_category()) {

            $cur_cat = single_cat_title("", false);

        
            $page_title = $cur_cat;
            $header_type = 'page-title';
            $text_bg = '#ef3f42';
        }

        if ($header_type == 'slider') {        
            
              echo do_shortcode("[template id='". $slider ."']");
        
        } elseif ($header_type == 'image') { 

            echo "<div class='icy-featured-image with-title'>";
                
                echo "<img src='".$image_url."' alt='".$image_alt."' />";
                
                echo "<section class='icy-page-title " . $page_pos . "'>";
                    echo '<div class="flex-caption-wrapper">';
                        echo '<div class="flex-caption">';
                            echo '<div class="flex-caption-content">'; 
                                echo '<h1 class="caption-title"><span style="background-color: '. $text_bg .'; box-shadow: 10px 0 0 '. $text_bg .', -10px 0 0 '. $text_bg .'; color: '. $text_fg .' ;">' . $page_title . '</span></h1>';                            
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo "</section>";

            echo "</div>";

        } elseif ($header_type == 'only-image') { 

            echo "<div class='icy-featured-image'>";
                echo "<img src='".$image_url."' alt='".$image_alt."' />";
            echo "</div>";

        } elseif ( ( $header_type == 'page-title' ) && ( $page_title != '' ) ) {
        
            echo "<section class='icy-page-title only-title " . $page_pos . "' style='background-color: ". $background .";'>";
                echo '<div class="flex-caption-wrapper">';
                    echo '<div class="flex-caption">';
                        echo '<div class="flex-caption-content">'; 
                            echo '<h1 class="caption-title"><span style="background-color: '. $text_bg .'; box-shadow: 10px 0 0 '. $text_bg .', -10px 0 0 '. $text_bg .'; color: '. $text_fg .' ;">' . $page_title . '</span></h1>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo "</section>";
        
        }

    }

?>

<!-- START .row-fluid -->
<section id="top" class="row-fluid">

    <div class="wrapper">

        <div class="logo-wrapper extend">
            <!-- START #logo -->
            <a href="<?php echo home_url(); ?>" class="logo">
                <?php 
                    $logo_type = $icy_options['logo_type'];
                    $logo = $icy_options['logo'];
                    $logo_retina = $icy_options['logo_retina'];
                    $width = $icy_options['logo_width'];
                    $height = $icy_options['logo_height'];
                ?>
                <?php if ($logo_type == 'image-logo') { ?> 
                    <span class="normal_logo">
                        <?php if ($logo == '') { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
                        <?php } else { ?>
                            <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/>    
                        <?php } ?>                    
                    </span>
                    <span class="retina_logo">
                        <?php if ($logo_retina == '') { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2x.png" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php bloginfo('name'); ?>" />
                        <?php } else { ?>
                            <img src="<?php echo $logo_retina; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />    
                        <?php } ?>                    
                    </span>
                    <?php } else { ?>
                    <span class="text_logo">
                        <?php bloginfo('name'); ?>
                    </span>
                    <?php } ?>
            <!-- END #logo -->
            </a>
        <!-- END .logo-wrapper -->
        </div>

        <!-- START #primary-nav -->
        <nav id="primary-nav" class="primary-nav" role="navigation">                
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'main-menu', 
                    'container' => '', 
                    'before' => '',
                ) ); 
            ?>                   
        </nav>
        <!-- END #primary-nav -->   
        <div class="icy-menu-trigger-wrapper">
            <span class="nav-btn icy-menu-trigger"><?php _e('Navigation', 'framework'); ?></span>         
        </div>

    </div>
    
</section>
<nav id="icy-nav" class="mobile-navigation" role="navigation">                
<?php 
    wp_nav_menu( array( 
    'theme_location' => 'main-menu', 
    'container' => '', 
    'before' => '',
) ); 
?>
</nav>   