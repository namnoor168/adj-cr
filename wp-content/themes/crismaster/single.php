<?php get_header(); ?>
    <div class="breadcrumb default" id="breadcrumb">
        <div class="wrap">
            <?php crismaster_breadcrumbs(); ?>
        </div>
    </div>
<?php
if(have_posts()):
    while ( have_posts() ) : the_post();
        ?>
        <section id="news-detail" class="default">
            <div class="wrap">
                <div class="content clearfix">
                    <div class="news-left">
                        <div class="news-left-content">
                            <div class="top-detail">
                                <h1><?php the_title(); ?></h1>
                                <div class="user clearfix">
                                    <p><i class="fa fa-user-circle-o"></i><span>Đăng bởi :</span><?php the_author_posts_link(); ?></p><span> | Cập nhật lần cuối : </span>
                                    <p><i class="fa fa-calendar"></i><?php the_date('M j, Y'); ?></p>
                                    <div class="box-share">
                                        <div class="button-like">
                                            <div class="addthis_native_toolbox"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="news-right">
                        <?php if( is_active_sidebar('sidebar-1')){  dynamic_sidebar('sidebar-1');  } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endwhile;
endif;
get_footer();
?>