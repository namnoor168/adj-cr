<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'Danh Mục Sản Phẩm','crismaster'),
        'base' => 'list_cate',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Nhập ID Danh Mục', 'crismaster' ),
                'param_name' => 'id_cat_listing',
                'value'       => '',
                'description' => esc_html__('Nhập ID Danh mục mà bạn muốn hiển thị ra trang chủ (nên nhập 4 danh mục, ví dụ: 1,2,3,4)', 'crismaster')
            ),
        )
    ));
}
add_shortcode('list_cate','list_cate_func');
function list_cate_func($atts,$content = null){
    extract(shortcode_atts(array(
        'all' => '',
        'id_cat_listing' => ''
    ),$atts));
    ob_start();
    $mobile = wp_is_mobile();
    ?>
    <section id="home-cate" class="default">
        <div class="wrap">
            <div class="content">
                <div class="title">Danh mục nổi bật</div>
                <div class="list-cate clearfix <?php if ($mobile){ echo 'owl-carousel slider'; } ?>" style="display: flex;justify-content: center;">
                    <?php if (isset($id_cat_listing) ) {
                    $id_cat_listing = explode(',', $id_cat_listing);
                    }else{ $id_cat_listing = ''; }
                    foreach ($id_cat_listing as $cate) {
                    $cat_name = get_term($cate,'productt_taxonomy');
                    $image_thumbnail_cate = get_field('image_taxonomy_product','category_'. $cate); ?>
                    <div class="home-cate">
                        <div class="home-cate-content">
                            <div class="img">
                                <a href="<?php echo get_term_link( $cat_name->slug, 'productt_taxonomy' ); ?>">
                                    <img src="<?php echo esc_url($image_thumbnail_cate); ?>" alt=""></a>
                            </div>
                            <a href="<?php echo get_term_link( $cat_name->slug, 'productt_taxonomy' ); ?>"><h3><?php echo substr($cat_name->name,0,44); ?></h3></a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
?>