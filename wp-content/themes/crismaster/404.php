<?php
get_header();
$theme_option = get_option('theme_option');
?>
<div id="content-wrapper-parent " class="error-page" style="clear: both;min-height: 200px">
    <div id="content-wrapper">
        <div id="content" class="clearfix">
            <section class="content">
                <div id="col-main" class="clearfix">
                    <div class="col-lg-12 col-lg-offset-6 error-page-container" style="font-size: 30px; padding-top: 30px;">
                        <div class="wrap">
                            <h2><?php if (isset($theme_option['title_404'])) {
                                    echo esc_attr($theme_option['title_404']);
                                } ?><i class="<?php if(isset($theme_option['icon_404'])){ echo esc_attr($theme_option['icon_404']); } ?>"></i></h2>
                            <p><?php if (isset($theme_option['subtitle_404'])) {
                                    echo esc_attr($theme_option['subtitle_404']);
                                } ?></p>
                            <?php echo  get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer();
?>