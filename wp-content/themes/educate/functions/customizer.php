<?php
/**
* Good News Plus Customization options
**/

function educate_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function educate_field_sanitize_input_choice( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function educate_posts_category(){
  $args = array('parent' => 0);
  $categories = get_categories($args);
  $category = array();
  $i = 0;
  foreach($categories as $categorys){
      if($i==0){
          $default = $categorys->slug;
          $i++;
      }
      $category[$categorys->term_id] = $categorys->name;
  }
  return $category;
}


function educate_customize_register( $wp_customize ) {
$educate_options = get_option( 'educate_theme_options' );


  $wp_customize->add_panel(
    'general',
    array(
        'title' => __( 'General', 'educate' ),
        'description' => __('styling options','educate'),
        'priority' => 20, 
    )
  );
  
   //All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'TopHeaderSocialLinks',
    array(
      'title' => __('Site Social Accounts', 'educate'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find ' ,  'educate').'<a target="_blank" href="'.esc_url('https://fortawesome.github.io/Font-Awesome/icons/').'">'.__('here' ,  'educate').'</a>'.__(' and in second input box, you need to add your social media profile URL.', 'educate').'<br />'.__(' Enter the URL of your social accounts. Leave it empty to hide the icon.' ,  'educate'),
      'panel' => 'general'
    )
  );

$TopHeaderSocialIconDefault = array(
  array('url'=>$educate_options['fburl'],'icon'=>'fa-facebook'),
  array('url'=>$educate_options['twitter'],'icon'=>'fa-twitter'),
  array('url'=>$educate_options['youtube'],'icon'=>'fa-youtube'),
  array('url'=>$educate_options['rss'],'icon'=>'fa-rss'),
  );

$TopHeaderSocialIcon = array();
  for($i=1;$i <= 4;$i++):  
    $TopHeaderSocialIcon[] =  array( 'slug'=>sprintf('TopHeaderSocialIcon%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['icon'],   
      'label' => esc_html__( 'Social Account ', 'educate') .$i,   
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIcon as $TopHeaderSocialIcons){
    $wp_customize->add_setting(
      $TopHeaderSocialIcons['slug'],
      array( 
       'default' => $TopHeaderSocialIcons['default'],       
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIcons['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','educate') ),
        'label'      =>   $TopHeaderSocialIcons['label'],
        'priority' => $TopHeaderSocialIcons['priority']
      )
    );
  }
  $TopHeaderSocialIconLink = array();
  for($i=1;$i <= 4;$i++):  
    $TopHeaderSocialIconLink[] =  array( 'slug'=>sprintf('TopHeaderSocialIconLink%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['url'],   
      'label' => esc_html__( 'Social Link ', 'educate' ) .$i,
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIconLink as $TopHeaderSocialIconLinks){
    $wp_customize->add_setting(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'default' => $TopHeaderSocialIconLinks['default'],
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'priority' => $TopHeaderSocialIconLinks['priority'],
        'input_attrs' => array( 'placeholder' => esc_html__('Enter URL','educate')),
      )
    );
  }
  
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('title_tagline')->title = __('Header & Logo','educate');
  
$wp_customize->add_section(
  'headerNlogo',
  array(
    'title' => __('Header & Logo','educate'),
    'panel' => 'general'
  )
);

$wp_customize->add_setting(
  'theme_logo_height',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'theme_logo_height',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'educate'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 20 (default: 10px)",'educate'),
    'type'       => 'text',
    'priority'    => 50,
    )
  );
$wp_customize->add_setting(
    'scroll_logo',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'scroll_logo', array(
    'section'     => 'title_tagline',
    'label'       => __( 'Upload Scroll Logo' ,'educate'),
    'description' => __('Logo Size (120 * 60)','educate'),
    'flex_width'  => true,
    'flex_height' => true,
    'width'       => 120,
    'height'      => 50,
    'priority'    => 10,
    'default-image' => '',
) ) );
$wp_customize->add_setting('header_fix', array(
        'default' => false,  
        'sanitize_callback' => 'educate_sanitize_checkbox',
  ));
  $wp_customize->add_control('header_fix', array(
      'label'   => esc_html__('Header Fix','educate'),
      'section' => 'title_tagline',
      'type'    => 'checkbox',
      'priority' => 20
  )); 

/*-------------------- Home Page Option Setting --------------------------*/
$wp_customize->add_panel(
    'frontpage_section',
    array(
        'title' => __( 'Front Page Options', 'educate' ),
        'description' => __('Front Page options','educate'),
        'priority' => 20, 
    )
  );



$wp_customize->add_section( 'frontpage_slider_section' ,
   array(
      'title'       => __( 'Front Page : Banner Slider', 'educate' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
 for($i=1;$i <= 3;$i++):  

    $wp_customize->add_setting(
        'educate_homepage_sliderimage'.$i.'_image',
        array(
            'default' => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'educate_homepage_sliderimage'.$i.'_image', array(
        'section'     => 'frontpage_slider_section',
        'label'       => __( 'Upload Slider Image ' ,'educate').$i,
        'flex_width'  => true,
        'flex_height' => true,
        'width'       => 1350,
        'height'      => 550,   
        'default-image' => '',
    ) ) );

    $wp_customize->add_setting( 'educate_homepage_sliderimage'.$i.'_title',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'educate_homepage_sliderimage'.$i.'_title',
        array(
            'default' => esc_html__('Slider Title','educate') . $i,
            'section' => 'frontpage_slider_section',                
            'label'   => __('Enter Slider Title ','educate').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider Title','educate')),
        )
    ); 
    $wp_customize->add_setting( 'educate_homepage_sliderimage'.$i.'_content',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 22, 
        )
    );
    $wp_customize->add_control( 'educate_homepage_sliderimage'.$i.'_content',
        array(
            'default' => esc_html__('Slider Content','educate') . $i,
            'section' => 'frontpage_slider_section',                
            'label'   => __('Enter Slider Content ','educate').$i,
            'type'    => 'textarea',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider Content','educate')),
        )
    );       
 endfor;

//About Us
$wp_customize->add_section( 'frontpage_title_bar_section' ,
   array(
      'title'       => __( 'Front Page : About Us', 'educate' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
$wp_customize->add_setting( 'educate_homepage_section_title',
    array(
        'default' => $educate_options['home-title'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_homepage_section_title',
    array(
        'section' => 'frontpage_title_bar_section',                
        'label'   => __('Enter Title ','educate'),
        'description' => __("Enter home page title for your site , you would like to display in the Home Page.",'educate'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','educate')),
    )
);
$wp_customize->add_setting( 'educate_homepage_section_subtitle',
    array(
        'default' => $educate_options['home-sub-title'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_homepage_section_subtitle',
    array(
        'section' => 'frontpage_title_bar_section',                
        'label'   => __('Enter Sub Title ','educate'),
        'description' => __("Enter home page sub title for your site , you would like to display in the Home Page.",'educate'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title','educate')),
    )
);

$wp_customize->add_setting( 'educate_homepage_section_desc',
    array(  
        'default' => $educate_options['home-content'],    
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_homepage_section_desc',
    array(
        'section' => 'frontpage_title_bar_section',                
        'label'   => __('Enter Short Description ','educate'),
        'description' => __("Enter content for your site , you would like to display in the Home Page.",'educate'),
        'type'    => 'textarea',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','educate')),
    )
); 

/* Front page First section */
$wp_customize->add_section( 'frontpage_first_section' ,
   array(
      'title'       => __( 'Front Page : About Us Below Section', 'educate' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*educate_homepage_sectionswitch*/
$wp_customize->add_setting(
    'educate_homepage_first_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'educate_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'educate_homepage_first_sectionswitch',
    array(
        'section' => 'frontpage_first_section',
        'label'      => __('About us below Section', 'educate'),
        'description' => __('About us below section hide or show .','educate'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'educate' ),
          "2"   => esc_html__( "Hide", 'educate' ),      
        ),
    )
);

for($i=1;$i <= 4;$i++):   

    $wp_customize->add_setting( 'educate_homepage_first_section'.$i.'_icon',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'educate_homepage_first_section'.$i.'_icon',
        array(
            'default' => '',
            'section' => 'frontpage_first_section',                
            'label'   => __('Enter Font Awesome Icon ,Title and Description ','educate').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Font Awesome Icon','educate')),
        )
    ); 
  $wp_customize->add_setting( 'educate_homepage_first_section'.$i.'_title',
      array(
          'default' => $educate_options['section-title-'.$i],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'educate_homepage_first_section'.$i.'_title',
      array(
          'section' => 'frontpage_first_section',               
          
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title','educate')),
      )
  );

  $wp_customize->add_setting( 'educate_homepage_first_section'.$i.'_desc',
      array( 
          'default' => $educate_options['section-content-'.$i],     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'educate_homepage_first_section'.$i.'_desc',
      array(
          'section' => 'frontpage_first_section',                
          
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','educate')),
      )
  );
  
endfor;

/* Front page Second section */
$wp_customize->add_section( 'frontpage_second_section' ,
   array(
      'title'       => __( 'Front Page : Blog', 'educate' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*educate_homepage_sectionswitch*/
$wp_customize->add_setting(
    'educate_homepage_second_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'educate_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'educate_homepage_second_sectionswitch',
    array(
        'section' => 'frontpage_second_section',
        'label'      => __('Blog Section', 'educate'),
        'description' => __('Blog Section hide or show .','educate'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'educate' ),
          "2"   => esc_html__( "Hide", 'educate' ),      
        ),
    )
);

$wp_customize->add_setting( 'educate_homepage_second_section_title',
      array(
          'default' => $educate_options['post-title'],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'educate_homepage_second_section_title',
      array(
          'section' => 'frontpage_second_section',                
          'label'   => __('Enter Title ','educate'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','educate')),
      )
  );

  $wp_customize->add_setting( 'educate_homepage_second_section_desc',
      array( 
          'default' => $educate_options['post-content'],     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'educate_homepage_second_section_desc',
      array(
          'section' => 'frontpage_second_section',                
          'label'   => __('Enter Sub Title','educate'),
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title','educate')),
      )
  );
  $wp_customize->add_setting(
    'educate_homepage_second_section_category',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'educate_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'educate_homepage_second_section_category',
    array(
        'section' => 'frontpage_second_section',
        'label'      => __('Select Category', 'educate'),
        'description' => __('Select Categories of posts for your site , you would like to display in the Home Page.','educate'),
        'type'       => 'select',
        'choices' => educate_posts_category(),
    )
);

/* Our Mission **/
//About Us
$wp_customize->add_section( 'frontpage_our_mission_section' ,
   array(
      'title'       => __( 'Front Page : Our Mission', 'educate' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
/*educate_homepage_sectionswitch*/
$wp_customize->add_setting(
    'educate_our_mission_sectionswitch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'educate_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'educate_our_mission_sectionswitch',
    array(
        'section' => 'frontpage_our_mission_section',
        'label'      => __('Our Mission Section', 'educate'),
        'description' => __('Our Mission Section hide or show .','educate'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'educate' ),
          "2"   => esc_html__( "Hide", 'educate' ),      
        ),
    )
);
$wp_customize->add_setting( 'educate_our_mission_section_title',
    array(
        'default' => $educate_options['mission-title'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_our_mission_section_title',
    array(
        'section' => 'frontpage_our_mission_section',                
        'label'   => __('Enter Title ','educate'),        
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','educate')),
    )
);
$wp_customize->add_setting( 'educate_our_mission_section_subtitle',
    array(
        'default' => $educate_options['mission-sub-title'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_our_mission_section_subtitle',
    array(
        'section' => 'frontpage_our_mission_section',                
        'label'   => __('Enter Sub Title ','educate'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Sub Title','educate')),
    )
);

$wp_customize->add_setting( 'educate_our_mission_section_desc',
    array(  
        'default' => $educate_options['mission-detail'],    
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_our_mission_section_desc',
    array(
        'section' => 'frontpage_our_mission_section',                
        'label'   => __('Enter Short Description ','educate'),
        'type'    => 'textarea',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','educate')),
    )
); 
$wp_customize->add_setting( 'educate_our_mission_section_link',
    array(
        'default' => $educate_options['mission-link'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_our_mission_section_link',
    array(
        'section' => 'frontpage_our_mission_section',                
        'label'   => __('Enter Link ','educate'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Link','educate')),
    )
);
$wp_customize->add_setting( 'educate_our_mission_section_link_name',
    array(
        'default' => $educate_options['mission-link-name'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'educate_our_mission_section_link_name',
    array(
        'section' => 'frontpage_our_mission_section',                
        'label'   => __('Enter Link Title ','educate'),        
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Link Name','educate')),
    )
);


//Footer Section
$wp_customize->add_section( 'footerCopyright' , array(
    'title'       => __( 'Footer', 'educate' ),
    'priority'    => 100,
    'capability'     => 'edit_theme_options',
  ) );

$wp_customize->add_setting(
    'footerCopyright_icon_switch',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'educate_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'footerCopyright_icon_switch',
    array(
        'section' => 'footerCopyright',
        'label'      => __('Footer Social icon show or hide', 'educate'),        
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'educate' ),
          "2"   => esc_html__( "Hide", 'educate' ),      
        ),
    )
);
$wp_customize->add_setting(
    'footertext',
    array(
        'default' => $educate_options['footertext'],
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'footertext',
    array(
        'section' => 'footerCopyright',                
        'label'   => __('Enter Copyright Text','educate'),
        'type'    => 'textarea',
    )
);

// Text Panel Starts Here 

}
add_action( 'customize_register', 'educate_customize_register' );

function educate_custom_css(){
  wp_enqueue_style('educate-style', get_stylesheet_uri(), array());
  $custom_css='';
  
  $theme_logo_height = (get_theme_mod('theme_logo_height'))?(get_theme_mod('theme_logo_height')):50;
  $custom_css.= ".header-logo img{ max-height: ".esc_attr($theme_logo_height)."px;   }
  .header-top.fixed-header{ position: fixed; background:#333333; }";

  wp_add_inline_style( 'educate-style', $custom_css ); 
  $header_fix = get_theme_mod('header_fix',0);
  $script_js = ''; 
  if($header_fix == 1){     
        $script_js .="
      jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 150) {
            jQuery('.header-top').addClass('fixed-header');
        } else {
            jQuery('.header-top').removeClass('fixed-header');
        }
      });
    ";
    }
    wp_add_inline_script( 'educate-defaultjs', $script_js ); 
}