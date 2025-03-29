<?php
/*
 * Template Name: Home Page
 */
get_header();
global $educate_options; ?>
<section>    
    <div id="educatecarousel" class="carousel slide carousel-fade educate-slider" data-interval="3000" data-ride="carousel">       
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            $educate_slider_count = 0;
            for ($educate_loop = 0; $educate_loop < 5; $educate_loop++):
                $sliderimage_image = get_theme_mod ( 'educate_homepage_sliderimage'.$educate_loop.'_image');

                $sliderimage_title = get_theme_mod ( 'educate_homepage_sliderimage'.$educate_loop.'_title',$educate_options['slider-title-' . $educate_loop]);
                $sliderimage_content = get_theme_mod ( 'educate_homepage_sliderimage'.$educate_loop.'_content',$educate_options['slidercontent-' . $educate_loop]);

               if($sliderimage_image!=''){
                $educate_slider_count++;
                $sliderimage_image_url = wp_get_attachment_image_src($sliderimage_image,'educate-full-width');
                    ?>
                    <div class="item <?php if($educate_slider_count == 1) { echo "active"; } ?>">
                        <span class="mask-overlay"></span>
                        <img src="<?php echo esc_url($sliderimage_image_url[0]); ?>" alt="<?php echo esc_attr($educate_loop);?>" />
                        <?php if ($sliderimage_title!='' ||$sliderimage_content!=''): ?>
                            <div class="carousel-caption">
                                <h3><?php echo esc_html($sliderimage_title); ?></h3>
                                <p><?php echo esc_html($sliderimage_content);?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php }
         endfor; ?>
        </div>
        <!-- Carousel nav -->
        <?php if ($educate_slider_count > 1) { ?>
            <a class="carousel-control left" href="#educatecarousel" data-slide="prev"><i class="fa fa-chevron-left"></i> </a> <a class="carousel-control right" href="#educatecarousel" data-slide="next"> <i class="fa fa-chevron-right"></i></a>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for ($educate_loop = 0; $educate_loop <$educate_slider_count; $educate_loop++):?>              
                    <li data-target="#educatecarousel" data-slide-to="<?php echo esc_attr($educate_loop); ?>" class="<?php echo ($educate_loop<1)?'active':''; ?>"></li>
                <?php endfor;  ?>
            </ol>
        <?php }  ?>
    </div>
    <?php if(get_theme_mod ( 'educate_homepage_first_sectionswitch',1)==1):
         if(get_theme_mod ( 'educate_homepage_section_title',$educate_options['about-title'])!='' || get_theme_mod ( 'educate_homepage_section_subtitle',$educate_options['about-sub-title'])!='' || get_theme_mod ( 'educate_homepage_section_desc',$educate_options['about-detail'] )!='' ) { ?>
        <!--about-us start-->
        <div class="educate-container container">
            <div class="about-us">
                <div class="title-box">
                    <?php
                    if (get_theme_mod ( 'educate_homepage_section_title',$educate_options['about-title'])!='') {
                        echo '<h2 class="content-heading"> <span> ' . esc_attr(get_theme_mod ( 'educate_homepage_section_title',$educate_options['about-title'])) . ' </span> </h2>';
                    }
                    if (get_theme_mod ( 'educate_homepage_section_subtitle',$educate_options['about-sub-title'])!='') {
                        echo '<p class="sub-content">' . esc_attr(get_theme_mod ( 'educate_homepage_section_subtitle',$educate_options['about-sub-title'])) . '</p>';
                    }
                    if (get_theme_mod ( 'educate_homepage_section_desc',$educate_options['about-detail'] )!='' ) {
                        echo '<p class="aboutus-detail">' . esc_attr(get_theme_mod ( 'educate_homepage_section_desc',$educate_options['about-detail'] )) . '</p>';
                    };
                    ?>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="educate-container container">
        <div class="about-us-content" id="about-slider">
        <?php for ($educate_j = 1; $educate_j <= 5; $educate_j++):
                if(get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_icon',$educate_options['about-icon-' . $educate_j])!='' || get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_title',$educate_options['abouttitle-' . $educate_j])!='' || get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_desc',$educate_options['aboutdesc-' . $educate_j] )!='' ) : ?>
                    <div class="owl-item">
                        <div class="about-us-box item">
                            <div class="col-md-9 col-xs-8 about-info">
                               <h2><?php echo esc_html(get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_title',$educate_options['abouttitle-' . $educate_j])) ?></h2>
                                <p><?php echo esc_html(get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_desc',$educate_options['aboutdesc-' . $educate_j] )); ?></p>
                            </div>
                            <div class="col-md-3 col-xs-4 about-info-icon">
                                <span class="fa <?php echo esc_attr(get_theme_mod ( 'educate_homepage_first_section'.$educate_j.'_icon',$educate_options['about-icon-' . $educate_j])); ?>"></span>
                            </div>
                        </div>
                    </div>
                <?php endif;
            endfor; ?>
        </div>
    </div>
<?php endif; ?>
    <!--about-us end-->
<?php  if(get_theme_mod ( 'educate_homepage_second_sectionswitch',1)==1):
    
    if(get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-title'])!='' || get_theme_mod ( 'educate_homepage_second_section_desc',$educate_options['blog-sub-title'])!=''){  ?>
        <!--blog start-->
        <div class="educate-container container">
            <div class="home-page-blog">
                <?php
                if (get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-title'])!='' || get_theme_mod ( 'educate_homepage_second_section_desc',$educate_options['blog-sub-title'])!='') {
                    echo '<div class="title-box">';
                    if (get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-title'])!='') {
                        echo '<h2 class="content-heading"> <span> ' . esc_attr(get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-title'])) . ' </span> </h2>';
                    }
                    if (get_theme_mod ( 'educate_homepage_second_section_desc',$educate_options['blog-sub-title'])!='') {
                        echo'<p class="sub-content">' . esc_attr(get_theme_mod ( 'educate_homepage_second_section_desc',$educate_options['blog-sub-title'])) . '</p>';
                    }
                    echo '</div>';
                }
                ?>
                <div class="blog-slider-details" id="blog-slider">
                    <?php
                    if (get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-category'])!='' ) :
                        $educate_per_page =(get_option('posts_per_page'))?get_option('posts_per_page'):5;
                        $educate_args = array(
                            'posts_per_page' => $educate_per_page,
                            'cat' => get_theme_mod ( 'educate_homepage_second_section_title',$educate_options['blog-category']),
                            'meta_query' => array(array('key' => '_thumbnail_id',
                                    'compare' => 'EXISTS')
                                )
                            );
                        $educate_loop = new WP_Query($educate_args);
                        if ($educate_loop->have_posts()) : while ($educate_loop->have_posts()) : $educate_loop->the_post();
                                $educate_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'educate-blog-image');
                                ?>
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="view-box item">
                                        <div class="view-effect"> <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php the_post_thumbnail('educate-blog-image');?>
                                            </a>
                                            <div class="view-hover-effect"> <a href="<?php echo the_permalink(); ?>" class="hover-icon"> <i class="fa fa-arrows"></i> </a> </div>
                                        </div>
                                        <div class="blog-discription row">
                                            <div class="col-md-3 col-sm-3 blog-date">
                                                <?php educate_entry_meta_date(); ?>
                                            </div>
                                            <div class="col-md-9 col-sm-9 blog-meta"> <a href="<?php echo esc_url(get_permalink()); ?>" class="blog-title">
                                                    <?php echo esc_html(mb_strimwidth(get_the_title(), 0, 30, '...')); ?>
                                                </a>
                                                <?php educate_entry_meta(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            endwhile;
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!--blog end-->
    <?php }  endif; 
    if(get_theme_mod ( 'educate_our_mission_sectionswitch',1)==1):
    if(get_theme_mod ( 'educate_our_mission_section_title',$educate_options['mission-title'])!='' || get_theme_mod ( 'educate_our_mission_section_subtitle',$educate_options['mission-sub-title'])!='' || get_theme_mod ( 'educate_our_mission_section_desc',$educate_options['mission-detail'])!='' ) {   ?>
        <!--our-mission start-->
        <div class="our-mission-bg"> <span class="site-color-mask"></span>
            <div class="mountain-container container">
                <div class="our-mission-wrap">
                    <div class="title-box">
                        <?php
                        if (get_theme_mod ( 'educate_our_mission_section_title',$educate_options['mission-title'])!='' ) {
                            ?>
                            <h2 class="content-heading"> <span> <?php echo esc_attr(get_theme_mod ( 'educate_our_mission_section_title',$educate_options['mission-title'])); ?></span> </h2>
                            <?php
                        }
                        if (get_theme_mod ( 'educate_our_mission_section_subtitle',$educate_options['mission-sub-title'])!='') { ?>
                            <p class="sub-content"><?php echo esc_html(get_theme_mod ( 'educate_our_mission_section_subtitle',$educate_options['mission-sub-title'])); ?></p>
                        <?php  } ?>
                    </div>
                    <?php if(get_theme_mod ( 'educate_our_mission_section_desc',$educate_options['mission-detail'])!='') { ?>
                        <div class="slide-box"><p><?php echo esc_html(get_theme_mod ( 'educate_our_mission_section_desc',$educate_options['mission-detail'])); ?></p>
                        </div>
                     <?php  }
                    if (get_theme_mod ( 'educate_our_mission_section_link',$educate_options['mission-link'])!='' && get_theme_mod ( 'educate_our_mission_section_link_name',$educate_options['mission-link-name'])!='') { ?>
                        <div class="join-us-btn"> <a href="<?php echo esc_url(get_theme_mod ( 'educate_our_mission_section_link',$educate_options['mission-link'])); ?>" class="site-btn"><?php echo esc_html(get_theme_mod ( 'educate_our_mission_section_link_name',$educate_options['mission-link-name'])); ?></a> </div>
                     <?php } ?>
                </div>
            </div>
        </div>
        <!--our-mission end-->
    <?php }
    endif; ?>
</section>
<?php get_footer(); 