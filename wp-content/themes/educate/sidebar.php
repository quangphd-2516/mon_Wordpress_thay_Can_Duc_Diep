<?php
/**
 * The Sidebar template file
 * */
$educate_sidebar_class = (is_page_template('page-templates/left-sidebar.php'))? '':'';  ?>

<div class="col-md-4 col-sm-4 <?php echo esc_attr($educate_sidebar_class); ?>">
    <div class="sidebar-box">
        <?php if (is_active_sidebar('sidebar-1')) :
            dynamic_sidebar('sidebar-1');
        endif;  ?>
    </div>
</div>