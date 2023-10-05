<?php
$theme_option = get_option('theme_option');
get_header();?>
<?php get_header(); ?>
    <div class="breadcrumb default" id="breadcrumb">
        <div class="wrap">
            <?php crismaster_breadcrumbs(); ?>
        </div>
    </div>
    <section id="category" class="default">
        <div class="wrap">
            <div class="content clearfix">
                <div class="box-right">
                    <div class="box-right-content">
                        <div class="top-category clearfix">
                            <h2><?php $search_query = new WP_Query( 's='.$s.'&showposts=-1' );
                                $search_keyword = esc_html( $s);
                                printf(__('Kết quả tìm kiếm cho "%s" :'), $search_keyword); ?></h2>
                        </div>
                        <div class="list-product-cate clearfix">
                            <div class="content-list-product-cate clearfix">
                                <?php if(have_posts()):
                                    while ( have_posts() ) : the_post();
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
                <div class="box-left">
                    <div class="box-left-content p-20">
                        <?php if( is_active_sidebar('sidebar-1')){  dynamic_sidebar('sidebar-1');  } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php
get_footer();
?>