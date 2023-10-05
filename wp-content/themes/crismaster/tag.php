<?php 
get_header();
$theme_option = get_option('theme_option');
?>
	<section class="parallax_window_in short" data-parallax="scroll" data-image-src="<?php if(isset($theme_option['image_bg_blog'])){ echo esc_attr($theme_option['image_bg_blog']['url']);} ?>" data-natural-width="1400" data-natural-height="400">

			<div id="sub_content_in">
				<div class="title-archive">
					<h1><?php printf( esc_html__( 'Tag Archives: %s', 'prometeo' ), single_tag_title( '', false ) ); ?></h1>
				</div>
				<div class="container">
					<h1><?php if (isset($theme_option['title_blog'])) {
						echo esc_attr($theme_option['title_blog']);
					} ?></h1>
					<p>"<?php if (isset($theme_option['subtitle_blog'])) {
						echo esc_attr($theme_option['subtitle_blog']);
					} ?>"</p>
				</div>
			</div>
	</section><!-- End section -->
 	
    <div id="position">
		<div class="container">
			<?php if($theme_option['breadcrumb_index_page']==1){?>
					<ul>
						<?php prometeo_breadcrumbs(); ?>
					</ul>
				<?php } ?>
		</div>
	</div><!-- End position -->
    
    <main>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-md-9">
					<?php if ( have_posts() ) : while (have_posts() ) : the_post();      
				$video_post_blog = get_post_meta(get_the_ID(),'_cmb_video_post_blog',true);

				?>
					<article class="blog">
						<div class="row no-gutters">
							<div class="col-md-7">
								<figure>
									<?php 
								if ( isset($video_post_blog) && $video_post_blog != '') {
									echo htmlspecialchars_decode('<iframe width="800px" height="400px" src="'.$video_post_blog.'" frameborder="0" allowfullscreen style=" height: 400px; "></iframe>');
								}
								elseif(has_post_thumbnail()) { ?>
								<a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) ?>" alt=""><div class="preview"><span><?php echo esc_html('Read more','prometeo'); ?></span></div></a>
								<?php }  ?>
								</figure>
							</div>
							<div class="col-md-5">
								<div class="post_info">
									<small><?php the_time('d\.F\.Y') ?></small>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p><?php echo prometeo_excerpt(25); ?></p>
									<ul>
										<li>
											<div class="thumb"><?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?></div>  <?php the_author(); ?>
										</li>
										<li><i class="icon_comment_alt"></i> <?php echo wp_count_comments(get_the_ID())->approved; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</article>
					<!-- /article -->

			<?php endwhile;endif;?>
					<nav aria-label="...">
						<ul class="pagination pagination-sm">
							<?php prometeo_pagination(); ?>
						</ul>
					</nav>
					<!-- /pagination -->
				</div>
				<!-- /col -->

				<aside class="col-md-3">
					 <?php
                  if ( is_active_sidebar('sidebar-1') ) {
                  dynamic_sidebar( 'sidebar-1' );
                  }
                	?>
					<!-- /widget -->
				</aside>
				<!-- /aside -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
    </main><!--/main-->
    
<?php 

get_footer();
?>