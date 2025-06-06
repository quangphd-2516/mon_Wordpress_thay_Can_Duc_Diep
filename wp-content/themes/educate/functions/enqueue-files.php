<?php
/*
 * Educate Enqueue css and js files
 */
function educate_enqueue() {
    
    wp_enqueue_style('educate-google-fontapi-lato', '//fonts.googleapis.com/css?family=Lato',array());

    wp_enqueue_style('bootstrap', get_template_directory_uri() .'/css/bootstrap.css', array());
    wp_enqueue_style('font-awesome', get_template_directory_uri() .'/css/font-awesome.css', array());
    if (is_page_template('page-templates/front-page.php')) {
        wp_enqueue_style('owl-carousel', get_template_directory_uri() .'/css/owl.carousel.css', array());
    }    
    wp_enqueue_style('educate-menustyle', get_template_directory_uri() .'/css/menustyle.css', array());
    
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
    if (is_page_template('page-templates/front-page.php')) {
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));
    }    

	wp_enqueue_script('jquery-masonry');
    wp_enqueue_script('educate-defaultjs', get_template_directory_uri() . '/js/default.js', array('jquery'));
    if (is_singular())
        wp_enqueue_script("comment-reply");
    educate_custom_css();
}
add_action('wp_enqueue_scripts', 'educate_enqueue');