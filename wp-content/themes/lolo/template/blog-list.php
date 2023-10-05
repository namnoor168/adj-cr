<?php
/*
*Template Name: Danh sách tin tức
*
*/
get_header();
$mobile = wp_is_mobile();?>
    <div class="breadcrumb default" id="breadcrumb">
        <div class="wrap">
            <?php crismaster_breadcrumbs(); ?>
        </div>
    </div>

    <section id="cate-des" class="default">
        <div class="wrap">
            <div class="clearfix">
                <div class="title-news">Tin tức</div>
                <div class="des-left">
                    <div class="content">
                        <div class="clearfix">
                            <div class="list-news">
                            <?php
                            $wp_query = new WP_Query(array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'paged' => $paged
                            ));
                            if($wp_query->have_posts()):
                                while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                    <div class="news-item clearfix">
                                        <div class="news-content clearfix">
                                            <div class="img">
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" alt="<?php the_title(); ?>"></a>
                                            </div>
                                            <div class="info">
                                                <div class="info-content">
                                                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                    <p class="des"><?php if ($mobile){ echo crismaster_excerpt('10');}else{ echo crismaster_excerpt(350); }  ?></p>
                                                    <div class="user" style="<?php if ($mobile){echo 'font-size: 12px';} ?>">
                                                        <p><i class="fa fa-user-circle-o"></i><span>Đăng bởi :</span><?php the_author_posts_link(); ?></p>
                                                        <span> | </span>
                                                        <p><i class="fa fa-calendar"></i><?php the_date('M j, Y'); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;wp_reset_postdata();
                            endif;
                            ?>
                            </div>
                            <div class="pagging">
                                <ul class="pagination" role="navigation">
                                    <?php crismaster_pagination(); ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="des-right">
                    <div class="des-right-content">
                        <?php if( is_active_sidebar('sidebar-1')){  dynamic_sidebar('sidebar-1');  } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
?>