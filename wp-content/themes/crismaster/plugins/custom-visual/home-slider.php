<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'Slider Trang chủ','crismaster'),
        'base' => 'home_slide',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Tạo Slide','crismaster'),
                'param_name' => 'details_hs',
                'value' => '',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image Background','crismaster'),
                        'param_name' => 'image_hs',
                        'value' => '',
                        'description' => esc_html__('Nên nhập ảnh có kích thước 1920 x 600',"crismaster")
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Đi đến Link','crismaster'),
                        'param_name' => 'link_hs',
                        'value' => '',
                        'description' => esc_html__('Nhập vào link trang page mà bạn muốn đến',"crismaster")
                    ),

                ),
                'description' => esc_html__('Cấu hình slider',"crismaster")
            ),
        )
    ));
}
add_shortcode('home_slide','home_slide_func');
function home_slide_func($atts,$content = null){
    extract(shortcode_atts(array(
        'details_hs' => '',
    ),$atts));
    ob_start();
    ?>
    <section id="home-slider" class="slider default">
        <div class="content">
            <div class="slider-one-item owl-carousel">
            <?php if(isset($details_hs)&&$details_hs != ''){
                $details_hs = vc_param_group_parse_atts($details_hs,'');
                foreach ($details_hs as $dhs ) {
                    if(isset($dhs['image_hs'])&&$dhs['image_hs']!='') {
                        $dhs['image_hs'] = wp_get_attachment_image_src($dhs['image_hs'], '');
                    }
                    ?>
                    <div class="item">
                        <a href="<?php echo esc_url($dhs['link_hs']); ?>"><img src="<?php echo esc_url($dhs['image_hs'][0]); ?>" alt=""></a>
                    </div>
            <?php  } } ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
?>