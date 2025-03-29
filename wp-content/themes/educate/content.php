<?php
/**
 * The default template for displaying content
 */
?>
<div class="educate-container container">
    <div class="posts-wrap">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="row">
                <div class="masonry-container">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 blog-post box'); ?>>
                                <div class="view-box">
                                    <?php
                                    $educate_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'educate-blog-image');
                                    if (has_post_thumbnail()) {
                                        ?>
                                        <div class="view-effect"> 
                                            <?php the_post_thumbnail('educate-blog-image'); ?>                                           
                                            <div class="view-hover-effect"> <a class="hover-icon" href="<?php the_permalink(); ?>"> <i class="fa fa-arrows"></i> </a> </div>
                                        </div>
                                    <?php } ?>
                                    <div class="blog-discription row">
                                        <div class="col-md-3 col-sm-3 blog-date">
                                            <?php educate_entry_meta_date(); ?>
                                        </div>
                                        <div class="col-md-9 col-sm-9 blog-meta"> <a class="blog-title" href="<?php the_permalink(); ?>">
                                                <?php echo esc_html(mb_strimwidth(get_the_title(), 0, 30, '...')); ?>
                                            </a>
                                            <ul>
                                                <li><?php printf(/* translators: 1 is author , 2 is author url. */'<a href="%1$s" title="%2$s" >%3$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'educate'), get_the_author())), get_the_author()); ?></li>
                                            </ul>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    else:
                        ?>
                        <div class="col-md-12 blog-post">
                            <h4><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'educate'); ?> </h4>
                            <?php get_search_form(); ?>
                        </div>
                    <?php
                    endif;
                    ?>
                    </div>
                </div>
                <div class="site-pagination col-md-12">
                    <nav role="navigation" class="navigation pagination">
                        <?php
                        // Previous/next page navigation.
                        the_posts_pagination(array(
                            'prev_text' => __('Previous page', 'educate'),
                            'next_text' => __('Next page', 'educate'),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'educate') . ' </span>',
                        ));
                        ?>
                    </nav>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
