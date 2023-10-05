<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'Slider Khách Hàng Thực Tế','crismaster'),
        'base' => 'customer_actualy',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Tạo Slide cho Khách Hàng thực tế','crismaster'),
                'param_name' => 'details_ca',
                'value' => '',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image','crismaster'),
                        'param_name' => 'image_ca',
                        'value' => '',
                        'description' => esc_html__('Nên nhập ảnh có kích thước 950 x 630',"crismaster")
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title','crismaster'),
                        'param_name' => 'title_ca',
                        'value' => '',
                        'description' => esc_html__('Nhập title của ảnh',"crismaster")
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('SubTitle','crismaster'),
                        'param_name' => 'subtitle_ca',
                        'value' => '',
                        'description' => esc_html__('Nhập subtitle của ảnh',"crismaster")
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Đi đến Link','crismaster'),
                        'param_name' => 'link_ca',
                        'value' => '',
                        'description' => esc_html__('Nhập vào link trang page mà bạn muốn đến',"crismaster")
                    ),

                ),
                'description' => esc_html__('Cấu hình slider',"crismaster")
            ),
        )
    ));
}
add_shortcode('customer_actualy','customer_actualy_func');
function customer_actualy_func($atts,$content = null){
    extract(shortcode_atts(array(
        'details_ca' => '',
    ),$atts));
    ob_start();
    $mobile = wp_is_mobile();
    ?>
    <section id="image-customer" class="default">
        <?php if (!$mobile){ ?>
        <div class="wrap">
        <?php } ?>
            <div class="content">
                <div class="home-title">
                    Hình ảnh khách hàng thực tế
                </div>
                <div class="slides-customer slider slider-center owl-carousel">
                <?php if(isset($details_ca)&&$details_ca != ''){
                    $details_ca = vc_param_group_parse_atts($details_ca,'');
                    foreach ($details_ca as $dca ) {
                        if(isset($dca['image_ca']) && $dca['image_ca']!='') {
                            $dca['image_ca'] = wp_get_attachment_image_src($dca['image_ca'], '');
                        }
                        ?>
                        <div class="item" style="<?php if ($mobile){ echo 'width: 300px'; }else{ echo 'width: 507px'; } ?>">
                            <div class="img">
                                <img src="<?php echo esc_url($dca['image_ca'][0]); ?>" alt="">
                            </div>
                            <div class="info">
                                <p class="name"><?php echo $dca['title_ca'] ?></p>
                                <p class="des"><?php echo $dca['subtitle_ca'] ?></p>
                                <a href="<?php echo esc_url($dca['link_ca']); ?>"><i></i> <span>Xem chi tiết</span></a>
                            </div>
                        </div>
                    <?php  } } ?>
                </div>
            </div>
            <?php if (!$mobile){ ?>
            </div>
            <?php } ?>
    </section>
    <?php
    return ob_get_clean();
}
?>