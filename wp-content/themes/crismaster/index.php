<?php
get_header();?>
    <section id="cate-des" class="default">
        <div class="wrap">
            <div class="clearfix">
                <div class="title-news">Tin tức</div>
                <div class="des-left">
                    <div class="content">
                        <div class="clearfix">
                            <div class="list-news">
                                <?php
                                if(have_posts()):
                                    while ( have_posts() ) : the_post(); ?>
                                        <div class="news-item clearfix">
                                            <div class="news-content clearfix">
                                                <div class="img">
                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())); ?>" alt="<?php the_title(); ?>"></a>
                                                </div>
                                                <div class="info">
                                                    <div class="info-content">
                                                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                        <p class="des"><?php echo crismaster_excerpt(350); ?></p>
                                                        <div class="user">
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
                        Sidebar
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
?>