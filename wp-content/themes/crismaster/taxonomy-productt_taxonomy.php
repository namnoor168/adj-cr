<?php
$theme_option = get_option('theme_option');
get_header();
$mobile = wp_is_mobile();?>
    <div class="breadcrumb default" id="breadcrumb">
        <div class="wrap">
            <?php crismaster_breadcrumbs(); ?>
        </div>
    </div>
    <?php
    $t = 1;
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $gallery_images = get_field('gallery_cate','category_'. $term_id);
    if (isset($gallery_images) && $gallery_images!= ''){ ?>
    <section id="category-slider" class="slider default">
        <div class="wrap">
            <div class="content">
                <div class="slider-one-item owl-carousel">
                    <?php
                    for ($t = 1; $t <= 3 ; $t++){ ?>
                        <div class="item">
                            <a href="<?php echo $gallery_images['link_gallery_'.$t]; ?>"><img src="<?php echo esc_url($gallery_images['image_gallery_'.$t]); ?>" alt=""></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section id="category" class="default" style="<?php if ($mobile){echo 'margin-top: 30px';} ?>">
        <div class="wrap">
            <div class="content clearfix">
                <div class="box-left mobile-hide">
                    <div class="box-left-content p-20">
                        <?php if( is_active_sidebar('sidebar-1')){  dynamic_sidebar('sidebar-1');  } ?>
                    </div>
                </div>
                <div class="box-right">
                    <div class="box-right-content">
                        <div class="top-category clearfix">
                            <h2>Danh mục sản phẩm: <?php echo single_cat_title(); ?></h2>
                        </div>
                        <div class="list-product-cate clearfix">
                            <div class="content-list-product-cate clearfix">
                            <?php
                            if(have_posts()):
                                while (have_posts() ) : the_post();
                                    $popular_product = get_post_meta(get_the_ID(),'_cmb_popular_product',true);
                                    $price_product = get_post_meta(get_the_ID(),'_cmb_price_product',true);
                                    $price_product_km = get_post_meta(get_the_ID(),'_cmb_price_product_2',true);
                                    $size_product = get_post_meta(get_the_ID(),'_cmb_size_product',true); ?>
                                 <div class="product">
                                    <div class="img">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($popular_product); ?>" alt=""></a>
                                    </div>
                                    <div class="info">
                                        <a href="<?php the_permalink(); ?>"><h3> <?php the_title(); ?></h3></a>
                                        <div class="box-price">
                                            <?php if(isset($price_product_km) && !empty($price_product_km)){ ?>
                                                <p class="price"><?php echo $price_product_km.'đ'; ?></p>
                                                <?php if(isset($price_product) && !empty($price_product)){ ?>
                                                    <p class="price-old"><?php echo $price_product.'đ'; ?></p>
                                                <?php } ?>
                                            <?php }elseif (isset($price_product) && !empty($price_product)){ ?>
                                                <p class="price"><?php echo $price_product.'đ'; ?></p>
                                            <?php } ?>
                                        </div>
                                        <?php if(isset($size_product) && !empty($size_product)){ ?>
                                            <p class="des clearfix"><i></i><?php echo $size_product; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endwhile;endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
?>