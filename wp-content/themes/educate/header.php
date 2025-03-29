<?php
/**
 * The Header template file
 */
$educate_options = get_option('educate_theme_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open();   }  ?>
        <header>
        <div class="header-top" >
            <div class="container">
                <div class="row">
                    <nav >
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="logo header-logo">
                                    <?php                                
                                    if(has_custom_logo()){
                                        the_custom_logo();            
                                    } 
                                    $dark_logo_id=get_theme_mod('scroll_logo');
                                    $theme_dark_logo=wp_get_attachment_url($dark_logo_id);
                                    if($theme_dark_logo == ''){
                                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                                        $theme_dark_logo = wp_get_attachment_url( $custom_logo_id );
                                    }
                                    if($theme_dark_logo != ''){ ?> 
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" itemprop="url">
                                            <img class="img-responsive logo-dark" src="<?php echo esc_url($theme_dark_logo); ?>" alt="<?php esc_attr_e('Logo','educate'); ?>">
                                        </a>
                                        <?php }
                                         if (display_header_text()==true):?>
                                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" id='brand' class="custom-logo-link"><span class="site-title"><h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4><small class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></small></span></a>   
                                        <?php endif; ?> 
                                </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 mob_nav">
                            <div class="main-menu">  
                                <div id='style-menu'>
                                 <?php
                                    if (has_nav_menu('primary')) {
                                        
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary',
                                            'container'      => 'none', 
                                            'menu_class'    => 'mobilemenu',
                                        ));                                        
                                    } ?>  
                                </div>                            
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>