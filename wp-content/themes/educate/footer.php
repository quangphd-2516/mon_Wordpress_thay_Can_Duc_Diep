<?php global $educate_options; ?>
<!--Footer-->
<footer>
	<?php $educate_padding = (get_theme_mod ( 'footerCopyright_logo_switch',1)==1)?"footer-bg1":" "; ?>
    <div class="footer-bg <?php echo esc_attr($educate_padding);?>">      
        <?php 
        if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) { ?>
            <div class="footer-widget-wrap footer-sidebar">
                <div class="educate-container container">
                    <div class="row">
                         <?php for( $i=1; $i<=4; $i++) { ?>
                            <?php if (is_active_sidebar('footer-'.$i)) { ?>
                                <aside class="col-md-3 col-sm-6">
                                    <?php dynamic_sidebar('footer-'.$i); ?>
                                </aside>
                            <?php }                          
                        } ?>                        
                    </div>
                </div>
            </div>
        <?php  } ?>
        <div class="educate-container container">
			<?php if(get_theme_mod ( 'footerCopyright_icon_switch',1)==1){ 
                $TopHeaderSocialIconDefault = array(array('url'=>$educate_options['fburl'],'icon'=>'fa-facebook'),array('url'=>$educate_options['twitter'],'icon'=>'fa-twitter'),array('url'=>$educate_options['youtube'],'icon'=>'fa-youtube'),array('url'=>$educate_options['rss'],'icon'=>'fa-rss'),);?>
                <div class="footer-social-icon">
                    <ul>
                        <?php for($i=1; $i<=4; $i++) : 
                                if(get_theme_mod('TopHeaderSocialIconLink'.$i,$TopHeaderSocialIconDefault[$i-1]['url'])!= '' && get_theme_mod('TopHeaderSocialIcon'.$i,$TopHeaderSocialIconDefault[$i-1]['icon'])!= ''){     ?>
                                   <li><a href="<?php echo esc_url(get_theme_mod('TopHeaderSocialIconLink'.$i,$TopHeaderSocialIconDefault[$i-1]['url'])); ?>" class="icon" title="" target="_blank">
                                        <i class="fa <?php echo esc_attr(get_theme_mod('TopHeaderSocialIcon'.$i,$TopHeaderSocialIconDefault[$i-1]['icon'])); ?>"></i>
                                    </a></li>                                            
                        <?php } endfor; ?>
                    </ul>
                </div>
            <?php }  ?>
            <div class="copyright">
                <p><?php echo wp_kses_post(get_theme_mod ( 'footertext',(!empty($educate_options['footertext'])) ? $educate_options['footertext']:''));?></p>
                <p><?php printf( /* translators: 1 is theme url*/ esc_html__( 'Powered by %1$s', 'educate' ), '<a href="'.esc_url("https://fruitthemes.com/wordpress-themes/educate/").'" target="_blank">Educate WordPress Theme</a>' ); ?></p>
            </div>
        </div>
 </div>
</footer>
<?php wp_footer(); ?>
</body></html>