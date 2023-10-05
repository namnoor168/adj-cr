<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'Tin Tức Giới thiệu Trang Chủ','crismaster'),
        'base' => 'home_news_2',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'crismaster' ),
                'param_name' => 'title_hn',
                "value"       => "",
                "description" => esc_html__("Nhập title cho element tin tức giới thiệu về cty (Ví dụ: Sự khác biệt đến từ Caro VietNam", 'crismaster')
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Show 4 bài viết gần nhất', 'crismaster' ),
                'param_name' => 'all',
                'value' => '',
                'description' =>'Check nếu bạn muốn show 4 bài viết gần nhất'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Hoặc IDs Tin Tức', 'crismaster' ),
                'param_name' => 'id_news',
                "value"       => "",
                "description" => esc_html__("Nhập ID của bài viết tin tức mà bạn muốn (nên nhập 4 Id, ví dụ: 11,12,14", 'crismaster')
            ),
        )
    ));
}
add_shortcode('home_news_2','home_news_2_func');
function home_news_2_func($atts,$content = null){
    extract(shortcode_atts(array(
        'title_hn' => '',
        'id_news' => '',
        'all' => ''
    ),$atts));
    ob_start(); ?>

    <section id="news-hot" class="default">
        <div class="wrap">
            <div class="content">
                <?php if (isset($title_hn) && $title_hn !=''){ ?>
                    <div class="home-title"><?php echo $title_hn; ?></div>
                <?php } ?>
                <div class="slides-news owl-carousel slider-4-item slider">
                <?php
                if(isset($all) && $all = true) {
                    $query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'order' => 'DESC',
                        'orderby' => 'date'
                    ));
                }
                if (isset($id_news) && $id_news !='' ) {
                    $p_id_news = explode(',', $id_news);
                    $query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'post__in' => $p_id_news
                    ));
                }
                if ($query->have_posts()) :
                    while ( $query->have_posts() ) : $query->the_post();?>
                        <div class="item-news">
                            <div class="content">
                                <div class="img">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" alt=""></a>
                                </div>
                                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                            </div>
                        </div>
                    <?php endwhile;wp_reset_postdata();
                endif;
                ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
?>