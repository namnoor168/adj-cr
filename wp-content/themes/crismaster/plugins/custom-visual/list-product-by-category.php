<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'List sản phẩm theo ID Danh Mục','crismaster'),
        'base' => 'list_product_by_category',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'ID Danh Mục', 'crismaster' ),
                'param_name' => 'id_cate',
                'value'       => '',
                'description' => esc_html__('Nhập những ID Danh mục mà bạn muốn show (ví dụ: 107,108,109,..)', 'crismaster')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Nhập số lượng bài muốn hiện thị trên 1 trang', 'crismaster' ),
                'param_name' => 'number_pro',
                'value'       => '',
                'description' => esc_html__('Nhập 1 ID Danh mục mà bạn muốn show', 'crismaster')
            ),
        )
    ));
}
add_shortcode('list_product_by_category','list_product_by_category_func');
function list_product_by_category_func($atts,$content = null){
    extract(shortcode_atts(array(
        'id_cate' => '',
        'number_pro' => '',
        'link' => ''
    ),$atts));
    ob_start();
    ?>
    <section id="home-product" class="default">
        <?php if (isset($id_cate) ) {
            $id_cate = explode(',', $id_cate);
        }else{ $id_cate = ''; }
        if (!isset($number_pro) || $number_pro == '') {
            $number_pro = -1;
        }
        foreach ($id_cate as $cat) {
        //$image_thumbnail_jobtype = get_field('image_taxonomy_product','category_'. $cat);
        $cat_name = get_term($cat,'productt_taxonomy');
        ?>
        <div class="wrap">
            <div class="content">
                <div class="home-product">
                    <div class="nav clearfix">
                        <div class="title-cate">
                            <?php echo esc_html($cat_name->name); ?>
                        </div>
                    </div>
                    <div class="list-product clearfix">
                        <?php
                        $query = new WP_Query(array(
                            'post_type'      => 'productt',
                            'post_status'    => 'publish',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'productt_taxonomy',
                                    'field' => 'term_id',
                                    'terms' => $cat,
                                ),
                            ),
                            'posts_per_page' => $number_pro,
                        )  );
                        if ($query->have_posts()) :
                            while ( $query->have_posts() ) : $query->the_post();
                                $popular_product = get_post_meta(get_the_ID(),'_cmb_popular_product',true);
                                $price_product = get_post_meta(get_the_ID(),'_cmb_price_product',true);
                                $price_product_km = get_post_meta(get_the_ID(),'_cmb_price_product_2',true);
                                $size_product = get_post_meta(get_the_ID(),'_cmb_size_product',true);
                        ?>
                                <div class="product">
                                    <div class="img">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($popular_product); ?>" alt=""></a>
                                    </div>
                                    <div class="info">
                                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                        <div class="box-price">
                                        <?php if(isset($price_product_km) && !empty($price_product_km)){ ?>
                                            <p class="price"><?php echo $price_product_km; ?></p>
                                            <?php if(isset($price_product) && !empty($price_product)){ ?>
                                                <p class="price-old"><?php echo $price_product; ?></p>
                                            <?php } ?>
                                        <?php }elseif (isset($price_product) && !empty($price_product)){ ?>
                                            <p class="price"><?php echo $price_product; ?></p>
                                        <?php } ?>
                                        </div>
                                        <?php if(isset($size_product) && !empty($size_product)){ ?>
                                            <p class="des clearfix"><i></i><?php echo $size_product; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endwhile;wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <a href="<?php echo get_term_link( $cat_name->slug, 'productt_taxonomy' ); ?>" class="see_more">Xem thêm</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <?php
    return ob_get_clean();
}
?>