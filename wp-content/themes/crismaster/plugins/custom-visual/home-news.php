<?php
$pre_text = 'VG ';
if(function_exists('vc_map')){
    vc_map(array(
        'name' => esc_html__($pre_text.'Tin Tức Trang Chủ','crismaster'),
        'base' => 'home_news',
        'class' => '',
        'icon' => 'icon-st',
        'category' => 'Content',
        'params' => array(
            array(
                'type' => 'checkbox',
                'heading' => __('Show 3 bài viết gần nhất', 'crismaster' ),
                'param_name' => 'all',
                'value' => '',
                'description' =>'Check nếu bạn muốn show 3 bài viết gần nhất'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'IDs Tin Tức', 'crismaster' ),
                'param_name' => 'id_news',
                "value"       => "",
                "description" => esc_html__("Nhập ID của bài viết tin tức mà bạn muốn (nên nhập 3 Id, ví dụ: 11,12,14", 'crismaster')
            ),
        )
    ));
}
add_shortcode('home_news','home_news_func');
function home_news_func($atts,$content = null){
    extract(shortcode_atts(array(
        'id_news' => '',
        'all' => ''
    ),$atts));
    ob_start(); ?>
    <section id="home-news" class="default">
        <div class="wrap">
            <div class="clearfix">
                <div class="home-news-title">Tin tức <a href="<?php echo esc_url( get_page_link( 9 ) ); ?>"><span>Xem thêm</span> <i></i></a></div>
                <div class="content list-item clearfix">
                <?php
                if(isset($all) && $all = true) {
                    $query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'order' => 'DESC',
                        'orderby' => 'date'
                    ));
                }
                if (isset($id_news) && $id_news !='' ) {
                    $p_id_news = explode(',', $id_news);
                    $query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'post__in' => $p_id_news
                    ));
                }
                if ($query->have_posts()) :
                    while ( $query->have_posts() ) : $query->the_post();?>
                        <div class="item">
                            <div class="clearfix">
                                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                            </div>
                            <div class="clearfix">
                                <div class="img">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" alt=""></a>
                                </div>
                                <div class="info">
                                    <div class="info-content">
                                        <p class="des"><?php echo crismaster_excerpt(350); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="more"><i></i>Đọc Ngay</a>
                                    </div>
                                </div>
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