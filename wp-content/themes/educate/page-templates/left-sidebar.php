<?php
/*
 * Template Name: Left Sidebar
 */
get_header();
?>
<section>
    <!--breadcrumb start-->
    <div class="site-breadcumb-bg">
        <div class="educate-container container">
            <div class="row">
                <div class="site-breadcumb col-sm-8 col-md-9">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    <ol class="breadcrumb breadcrumb-menubar">
                        <?php if (function_exists('educate_custom_breadcrumbs')) educate_custom_breadcrumbs(); ?>
                    </ol>
                </div>
                <div class="col-md-3 col-sm-4 breadcrumb-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb end-->
    <div class="educate-container container">
        <div class="posts-wrap">
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="col-md-8 col-sm-8 col-md-offset-1">
                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class('single-blog-post'); ?>>
                                    <div class="view-box">                                        
                                        <?php if (has_post_thumbnail()): ?>
                                             <div class="blog-post-img"> 
                                                <?php the_post_thumbnail('full'); ?>
                                              </div>
                                        <?php endif; ?>

                                        <div class="blog-discription row">
                                            <div class="col-md-2 col-sm-3 blog-date">
                                                <?php educate_entry_meta_date(); ?>
                                            </div>
                                            <div class="col-md-9 col-sm-9 blog-meta">
                                                <div class="blog-title">
                                                    <?php the_title(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-blog-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                                <div class="comments-article">
                                    <?php if ( comments_open() || get_comments_number() ) {
                                            comments_template();
                                    } ?>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ?> </section>
<?php get_footer(); ?>