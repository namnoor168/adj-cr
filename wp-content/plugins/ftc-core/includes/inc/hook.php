<?php
/**
 * hook functions
 *
 * @since 1.0.0
 * @package WordPress
 * @subpackage FTC Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * COLUMN CSS SELECTORS FOR FLEX GRID
 *
 * @param integer $items_desktop - number of items in row on desktop.
 * @param integer $items_tablet - number of items in row on tablet.
 * @param integer $items_mobile - number of items in row on mobile.
 * @param boolean $no_margin - to show margin or not.
 * @return selector
 */
function ftc_grid_class( $items_desktop = 3, $items_tablet = 1, $items_mobile = 1, $no_margin = false ) {

	$style_class   = '';
	$desktop_class = '';
	$tablets_class = '';
	$mobiles_class = '';

	$no_margin = ftc_elements_to_boolean( $no_margin ); // make sure it is not string.

	$column_desktop = array(
		1  => 'col-md-12',
		2  => 'col-md-6',
		3  => 'col-md-4',
		4  => 'col-md-3',
		6  => 'col-md-2',
		12 => 'col-md-1',
	);
	$column_tablet  = array(
		1  => 'col-sm-12',
		2  => 'col-sm-6',
		3  => 'col-sm-4',
		4  => 'col-sm-3',
		6  => 'col-sm-2',
		12 => 'col-sm-1',
	);
	$column_mobile  = array(
		1  => 'col-xs-12',
		2  => 'col-xs-6',
		3  => 'col-xs-4',
		4  => 'col-xs-3',
		6  => 'col-xs-2',
		12 => 'col-xs-1',
	);

	// Generate class selector for desktop.
	if ( array_key_exists( $items_desktop, $column_desktop ) && ! empty( $column_desktop[ $items_desktop ] ) ) {
		$desktop_class = $column_desktop[ $items_desktop ];
	}
	// Generate class selector for tablets.
	if ( array_key_exists( $items_tablet, $column_tablet ) && ! empty( $column_tablet[ $items_tablet ] ) ) {
		$tablets_class = $column_tablet[ $items_tablet ];
	}
	// Generate class selector for mobiles.
	if ( array_key_exists( $items_mobile, $column_mobile ) && ! empty( $column_mobile[ $items_mobile ] ) ) {
		$mobiles_class = $column_mobile[ $items_mobile ];
	}

	$style_class = $no_margin ? ( $desktop_class . ' ' . $tablets_class . ' ' . $mobiles_class . ' no-margin' ) : ( $desktop_class . ' ' . $tablets_class . ' ' . $mobiles_class );

	// Added fixed full width to small screen - to do controls for small devices (?).
	return $style_class;
}
/*get Footer*/

/**
 * Converting string to boolean
 *
 * @param string $value - may be a boolean.
 * @return $value
 */
function ftc_elements_to_boolean( $value ) {
	if ( ! isset( $value ) ) {
		return false;
	}
	if ( 'true' === $value || '1' === $value ) {
		$value = true;
	} elseif ( 'false' === $value || '0' === $value ) {
		$value = false;
	}

	return (bool) $value; // Make sure you do not touch the value if the value is not a string.
}
/**
 * POSTED META ( posted in / post date / post author )
 *
 * @param string $taxonomy Parameter_Description.
 * @return void
 * echo string html term links list for current post/taxonomy.
 */
function ftc_elements_posted_in( $taxonomy ) {

	$terms     = get_the_terms( get_the_ID(), $taxonomy );
	$posted_in = '';

	if ( $terms && ! is_wp_error( $terms ) ) {

		$posted_in = '<span class="posted_in ftc_elements-terms">';

		$posted_in_terms = array();
		$last_term       = end( $terms );
		foreach ( $terms as $term ) {

			$separator  = ( $term == $last_term ) ? '' : ', ';
			$posted_in .= '<a href="' . esc_url( get_term_link( $term->slug, $taxonomy ) ) . '" rel="tag" tabindex="0">' . esc_html( $term->name . ' ' . $term->ID ) . '</a>' . esc_html( $separator );
		}

		$posted_in .= '</span>';
	}

	echo wp_kses_post( $posted_in );

}

/**
 * Date for post meta function
 *
 * @return void
 */
function ftc_elements_date() {
	$date =''; 
	if(get_the_time('j') < 10){
		$date .= '<span class="published"><time datetime="' . sprintf( get_the_time( esc_html__( 'Y-m-d', 'ftc-element' ) ) ) . '">' . sprintf( get_the_time( get_option( 'date_format', 'M d, Y' ) ) ) . '</time></span>';

		$date .= '<div class="element-date-timeline"><div class="day">0' . sprintf( get_the_time('j') ) . ' </div><div class="month"> '. sprintf( get_the_time('M') ) . ' </div></div> ' ;
	}else{
		$date .= '<span class="published"><time datetime="' . sprintf( get_the_time( esc_html__( 'Y-m-d', 'ftc-element' ) ) ) . '">' . sprintf( get_the_time( get_option( 'date_format', 'M d, Y' ) ) ) . '</time></span>';

		$date .= '<div class="element-date-timeline"><div class="day"> ' . sprintf( get_the_time('j') ) . ' </div><div class="month"> '. sprintf( get_the_time('M') ) . ' </div></div> ' ;
	}
	echo wp_kses_post( $date );
}

/**
 * Author for post meta
 *
 * @return void
 */
function ftc_elements_author() {
	$author = '<span class="author vcard">' . esc_html__( 'By ', 'ftc-element' ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author_meta( 'display_name' ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>';

	echo wp_kses_post( $author );
}

/**
 * Post meta ordering (using WP hook priorities)
 *
 * @param array $meta_ordering - array created with Elementor Repeater Control
 * @return void
 */
function ftc_elements_postmeta_order( $meta_ordering ) {

	foreach ( $meta_ordering as $key => $single_meta ) {

		$label    = $single_meta['meta_sorter_label'];
		$enabled  = $single_meta['meta_part_enabled'];
		$priority = $key . '0';

		if ( 'Date' === $label && $enabled ) {
			add_action( 'ftc_elements_postmeta', 'ftc_elements_date', $priority );
		} elseif ( 'Author' === $label && $enabled ) {
			add_action( 'ftc_elements_postmeta', 'ftc_elements_author', $priority );
		} elseif ( 'Posted in' === $label && $enabled ) {
			add_action( 'ftc_elements_postmeta', 'ftc_elements_posted_in', $priority, 1 );
		}
	}

}

/**
 * PLACEHOLDER IMAGE
 *
 * @param string $placeholder_img_url - url string.
 * @return $placeholder_img_url
 */
function ftc_elements_no_image_func( $placeholder_img_url ) {
	$placeholder_img_url = FTC_ELEMENTS_URL . 'assets/images/no-image.jpg';
	return $placeholder_img_url;
}
add_filter( 'ftc_elements_no_image', 'ftc_elements_no_image_func' );


/**
 * POST THUMB BACKGROUND
 *
 * @param string $img_format - image format string.
 * @return void
 */
function ftc_elements_thumb_back_f() {
	global $product, $smof_data;

	$placeholder_img_src = isset($smof_data['ftc_prod_placeholder_img']['url']) ? $smof_data['ftc_prod_placeholder_img']['url'] : wc_placeholder_img_src();

	$prod_galleries = $product->get_gallery_image_ids();

	$back_image = (isset($smof_data['ftc_effect_product']) && (int) $smof_data['ftc_effect_product'] == 0) ? false : true;

	if ( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 )) {
		$back_image = false;
	}

	$image_size = apply_filters('ftc_loop_product_thumbnail', 'shop_catalog');

	echo '<span class="' . (($back_image) ? 'cover_image' : 'no-image') . '">';
	echo woocommerce_get_product_thumbnail($image_size);
	echo '</span>';
	if ( $back_image ) {
		echo '<span class="hover_image">';
		echo wp_get_attachment_image($prod_galleries[0], $image_size, 0, array('class' => 'product-hover-image'));
		echo '</span>';
	}

}
add_action( 'ftc_elements_thumb_back', 'ftc_elements_thumb_back_f', 10, 1 );
/**
 * GET GALLERY IMAGES ID's
 * get id's from WP gallery shortcode
 *
 * @return $ids
 */
function ftc_elements_gallery_ids_func() {
	global $post;
	if ( ! $post ) {
		return;
	}
	$attachment_ids = array();
	$pattern        = get_shortcode_regex();
	$ids            = array();

	//finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3].
	if ( preg_match_all( '/' . $pattern . '/s', $post->post_content, $matches ) ) {
		$count = count( $matches[3] ); //in case there is more than one gallery in the post.
		for ( $i = 0; $i < $count; $i++ ) {
			$atts = shortcode_parse_atts( $matches[3][ $i ] );
			if ( isset( $atts['ids'] ) ) {
				$att_ids = explode( ',', $atts['ids'] );
				$ids     = array_merge( $ids, $att_ids );
			}
		}
	}
	return $ids;
}
add_filter( 'ftc_elements_gallery_ids', 'ftc_elements_gallery_ids_func' );

/**
 * POSTS QUERY ARGS
 *
 * @param integer $posts_per_page - posts per query.
 * @param array   $categories - categories to filter posts.
 * @param boolean $sticky - to show sticky or not.
 * @param integer $offset - posts offset.
 * @return $args
 * arguments for get_posts() - DRY effort, mostly because of ajax posts
 */
function ftc_elements_query_args_post_func( $posts_per_page = 3, $categories = array(), $sticky = false, $offset = 0 ) {

	// Defaults.
	$args = array(
		'posts_per_page'   => $posts_per_page,
		'post_type'        => 'post',
		'offset'           => $offset,
		'order'            => 'DESC',
		'suppress_filters' => false,
	);

	$args['orderby'] = 'menu_order date';

	if ( ! empty( $categories ) ) {
		$args['tax_query'][] = array(
			'taxonomy'         => 'category',
			'field'            => 'slug',
			'operator'         => 'IN',
			'terms'            => $categories,
			'include_children' => true,
		);
	}

	if ( $sticky ) {
		$sticky_array = get_option( 'sticky_posts' );
		if ( ! empty( $sticky_array ) ) {
			$args['post__in'] = $sticky_array;
		}
	}

	// Polylang (and WPML) support.
	if ( function_exists( 'pll_current_language' ) ) {
		$current_lang = pll_current_language();
		$args['lang'] = $current_lang;
	} elseif ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		$current_lang = ICL_LANGUAGE_CODE;
		$args['lang'] = $current_lang;
	}

	return $args;

}
add_filter( 'ftc_elements_query_args_post', 'ftc_elements_query_args_post_func', 10, 4 );

if (!function_exists('ftc_string_limit_words_element')) {
	function ftc_string_limit_words_element($string, $word_limit)
	{
		$words = explode(' ', $string, ($word_limit + 1));
		if(count($words) > $word_limit) {
			array_pop($words);
   //add a ... at last article when more than limit word count
			echo implode(' ', $words)." "; } else {
   //otherwise
				echo implode(' ', $words); }
			}
		}

/**
 * POST TEMPLATE FOR LOOP
 *
 * @param string  $style - posts style.
 * @param string  $grid - posts grid.
 * @param string  $show_thumb - to show featured thumb image od not.
 * @param string  $img_format - image format.
 * @param boolean $meta - to show post meta or not.
 * @param boolean $meta_ordering - array of meta for display.
 * @param boolean $excerpt - to show excerpt or not.
 * @param integer $excerpt_limit - excerpt length.
 * @param string  $css_class - additional css selector.
 * @return void
 * DRY effort, mostly because of ajax posts.
 */
function ftc_elements_loop_post_func($style = 'style_1', $grid = '', $show_thumb = true, $img_format = 'thumbnail', $meta = true, $meta_ordering = [], $excerpt = true, $excerpt_limit = 20, $show_com = false, $css_class = '' ) {
	?>
	<div class="ftc-blogs post <?php echo esc_attr( $grid ); ?> ">

		<div class="inner-wrap">
			<?php 
			global $post;
			$post_format = get_post_format(); ?>
			<?php
			if ( $show_thumb ) {

				if ( 'style_100' === $style || 'style_200' === $style ) {
					do_action( 'ftc_elements_thumb_back', $img_format );
				} else {
					if( $post_format == 'gallery' ){
						echo '<div class="blog gallery">';
						$gallery = get_post_meta($post->ID, 'ftc_gallery', true);
						$gallery_ids = explode(',', $gallery);
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						// foreach( $gallery_ids as $gallery_id ){
						// 	echo '<div class="image-blog">';
						// 	echo wp_get_attachment_image( $gallery_id, 'ftc_blog_shortcode_thumb' );
						// 	echo '</div>';

						// }
						?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
						echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
						?> </a> <?php


						echo '</div>';

					}
					if( $post_format === false || $post_format == 'standard' ){
						if( has_post_thumbnail() ){
							?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
							echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
							?> </a> <?php
						}
						else{
							?>
							<img title="noimage" src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image-blog.jpg" alt="" />
							<?php 
						}
					}
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ftc_video_url', true);
						echo do_shortcode('[ftc_video src="'.$video_url.'"]');
					}
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ftc_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
							}
							else{
								echo do_shortcode('[ftc_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
							}
						}
					}


				}
			} else {
				echo '<div class="post-overlay"></div>';
			}
			?>
				<div class="element-date-timeline">
					<div class="day">
						<?php if(get_the_time('j') < 10){ echo '0'; } ?><?php echo get_the_time('j'); ?>	
					</div>
					<div class="month"><?php echo get_the_time('M'); ?></div>
				</div>
			<div class="post-text">

				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

				<?php
				if ( $meta ) {
					?>
					<div class="meta">

						<?php ftc_elements_postmeta_order( $meta_ordering ); ?>
						<?php do_action( 'ftc_elements_postmeta', 'category' ); ?>

					</div>
				<?php } ?>

				<?php
				if ( $excerpt ) {
					?>
					<p>
						<?php do_action( 'ftc_elements_excerpt', $excerpt_limit ); ?>
					</p>

					<?php
					echo '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="ftc-readmore '. esc_attr( $css_class ).'">' . esc_html__('Read more', 'ftc-element' ) . '</a>';
					?>

				<?php } ?>
				<?php if($show_com == 'yes'){ ?>
					<div class="tab-blog-content"> 
						<div class="social-share-blog"><span class="fa fa-share"></span>
							<ul class="ftc-social-sharing">
								<li class="facebook">
									<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li class="twitter">
									<a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
							</ul>
						</div>
						<span class="comment-count">

							<span class="number">
								<?php 
								$comments_count = wp_count_comments($post->ID); 
								$comment_number = $comments_count->approved;
								if( $comment_number > 0 ){
									echo zeroise($comment_number, 2); 

								}else{ 
									echo "0";
								} 
								?>
							</span>
						</span>			
					</div>
				<?php } ?>
			</div>
		</div>

	</div>
	<?php
}
add_filter( 'ftc_elements_loop_post', 'ftc_elements_loop_post_func', 10, 9 );

/*function filter blog Slider*/
function ftc_elements_loop_post_sliders( $style = 'style_1', $grid = '', $label_readmore = 'Read more', $show_thumb = true, $img_format = 'thumbnail', $meta = true, $meta_ordering = [], $excerpt = true, $excerpt_limit = 20, $css_class = '' ) {
	?>
	<div class="blogs-slider swiper-slide <?php echo esc_attr( $grid ); ?> ">

		<div class="inner-wrap">
			<?php 
			global $post;
			$post_format = get_post_format(); ?>
			<?php
			if ( $show_thumb ) {

				if ( 'style_9' === $style || 'style_10' === $style ) {
					do_action( 'ftc_elements_thumb_back', $img_format );
				} else {
					if( $post_format == 'gallery' ){
						echo '<div class="blog gallery">';
						$gallery = get_post_meta($post->ID, 'ftc_gallery', true);
						$gallery_ids = explode(',', $gallery);
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
						echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
						?> </a> <?php

						echo '</div>';

					}
					if( $post_format === false || $post_format == 'standard' ){
						if( has_post_thumbnail() ){
							?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
							echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
							?> </a> <?php
						}
						else{
							?>
							<img title="noimage" src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image-blog.jpg" alt="" />
							<?php 
						}
					}
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ftc_video_url', true);
						echo do_shortcode('[ftc_video src="'.$video_url.'"]');
					}
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ftc_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
							}
							else{
								echo do_shortcode('[ftc_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
							}
						}
					}


				}
			} else {
				echo '<div class="post-overlay"></div>';
			}
			?>

			<div class="post-text">

				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

				<?php
				if ( $meta ) {
					?>
					<div class="meta">

						<?php ftc_elements_postmeta_order( $meta_ordering ); ?>
						<?php do_action( 'ftc_elements_postmeta', 'category' ); ?>

					</div>
				<?php } ?>

				<?php
				if ( $excerpt ) {
					?>
					<p>
						<?php do_action( 'ftc_elements_excerpt', $excerpt_limit ); ?>
					</p>
				<?php } 

				if($label_readmore){
					echo '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="ftc-readmore ' . esc_attr( $css_class ) . ' ">' . esc_html__($label_readmore, 'ftc-element' ) . '</a>';
				}
				?>

			</div>

		</div>

	</div>
	<?php
}
add_filter( 'ftc_elements_loop_post_slider', 'ftc_elements_loop_post_sliders', 10, 9 );


/*Blogs timeline*/

function ftc_elements_loop_post_timeline_func( $style = 'style_1', $grid = '', $show_thumb = true, $img_format = 'thumbnail', $meta = true, $meta_ordering = [], $excerpt = true, $excerpt_limit = 20, $css_class = '') {
	?>
	<div class="ftc-blogs post">
		<div class="element-timeline">
			<div class="image-timeline">
				<?php 
				global $post;
				$post_format = get_post_format(); ?>
				<?php
				if( $post_format == 'gallery' ){
					echo '<div class="blog gallery">';
					$gallery = get_post_meta($post->ID, 'ftc_gallery', true);
					$gallery_ids = explode(',', $gallery);
					if( is_array($gallery_ids) && has_post_thumbnail() ){
						array_unshift($gallery_ids, get_post_thumbnail_id());
					}
						// foreach( $gallery_ids as $gallery_id ){
						// 	echo '<div class="image-blog">';
						// 	echo wp_get_attachment_image( $gallery_id, 'ftc_blog_shortcode_thumb' );
						// 	echo '</div>';

						// }
					the_post_thumbnail( 'thumbnail' );


					echo '</div>';

				}
				if( $post_format === false || $post_format == 'standard' ){
					if( has_post_thumbnail() ){
						the_post_thumbnail( 'thumbnail' );
					}
					else{
						?>
						<img title="noimage" src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image-blog.jpg" alt="" />
						<?php 
					}
				}
				if( $post_format == 'video' ){
					$video_url = get_post_meta($post->ID, 'ftc_video_url', true);
					echo do_shortcode('[ftc_video src="'.$video_url.'"]');
				}
				if( $post_format == 'audio' ){
					$audio_url = get_post_meta($post->ID, 'ftc_audio_url', true);
					if( strlen($audio_url) > 4 ){
						$file_format = substr($audio_url, -3, 3);
						if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
							echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
						}
						else{
							echo do_shortcode('[ftc_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
						}
					}
				}
				?>
			</div>
			<div class="date-timeline-element">
				<div class="day"><?php echo get_the_time('j'); ?></div>
				<div class="month"><?php echo get_the_time('M'); ?></div>
			</div>
		</div>
		<div class="inner-wrap">
			<?php 
			global $post;
			$post_format = get_post_format(); ?>
			<?php
			if ( $show_thumb ) {

				if ( 'style_100' === $style || 'style_200' === $style ) {
					do_action( 'ftc_elements_thumb_back', $img_format );
				} else {
					if( $post_format == 'gallery' ){
						echo '<div class="blog gallery">';
						$gallery = get_post_meta($post->ID, 'ftc_gallery', true);
						$gallery_ids = explode(',', $gallery);
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						// foreach( $gallery_ids as $gallery_id ){
						// 	echo '<div class="image-blog">';
						// 	echo wp_get_attachment_image( $gallery_id, 'ftc_blog_shortcode_thumb' );
						// 	echo '</div>';

						// }
						?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
						echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
						?> </a> <?php


						echo '</div>';

					}
					if( $post_format === false || $post_format == 'standard' ){
						if( has_post_thumbnail() ){
							?> <a href="<?php the_permalink(); ?>" title="image-blog"> <?php
							echo the_post_thumbnail('ftc_blog_shortcode_thumb'); 
							?> </a> <?php 
						}
						else{
							?>
							<img title="noimage" src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image-blog.jpg" alt="" />
							<?php 
						}
					}
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ftc_video_url', true);
						echo do_shortcode('[ftc_video src="'.$video_url.'"]');
					}
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ftc_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
							}
							else{
								echo do_shortcode('[ftc_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
							}
						}
					}
				}
			} else {
				echo '<div class="post-overlay"></div>';
			}
			?>
			<div class="post-text">
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

				<?php
				if ( $meta ) {
					?>
					<div class="meta">

						<?php ftc_elements_postmeta_order( $meta_ordering ); ?>
						<?php do_action( 'ftc_elements_postmeta', 'category' ); ?>

					</div>
				<?php } ?>

				<?php
				if ( $excerpt ) {
					?>
					<p>
						<?php do_action( 'ftc_elements_excerpt', $excerpt_limit ); ?>
					</p>

					<?php
					echo '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="ftc-readmore '. esc_attr( $css_class ).'">' . esc_html__('Read more', 'ftc-element' ) . '</a>';
					?>

				<?php } ?>

			</div>

		</div>

	</div>
	<?php
}
add_filter( 'ftc_elements_loop_post_timeline', 'ftc_elements_loop_post_timeline_func', 10, 9 );

/**
 * Custom post excerpt
 *
 * @param integer $limit - words limit for excerpt.
 * @return void
 */
function ftc_elements_excerpt_content( $limit = 20 ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ', $excerpt ) . ' ';
	} else {
		$excerpt = implode( ' ', $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );
	echo wp_kses_post( $excerpt );
}
add_action( 'ftc_elements_excerpt', 'ftc_elements_excerpt_content', 10, 1 );
/**
 * TERM DATA
 *
 * @param string $taxonomy - taxonomy object.
 * @param string $term - term from taxonomy.
 * @param string $img_format - image format.
 * @return $term_data - array containing: term ID, term title, term link, term image url
 * @details retrieve term data by taxonomy and term slug
 */
function ftc_elements_term_data_cate_f( $taxonomy, $term, $img_format = 'thumbnail' ) {

	if ( ! term_exists( $term, $taxonomy ) ) {
		return array();
	}

	$term_data = array();

	// Term data.
	$term_obj = get_term_by( 'slug', $term, $taxonomy );

	if ( is_wp_error( $term_obj ) || ! is_object( $term_obj ) ) {
		return array();
	}

	// Get term ID for term name, link and term meta for thumbnail ( WC meta "thumbnail_id ").
	$term_id      = $term_obj->term_id;
	$meta         = get_term_meta( $term_id );
	$thumbnail_id = isset( $meta['thumbnail_id'] ) ? $meta['thumbnail_id'][0] : '';

	$term_data['term_id']    = $term_id;
	$term_data['term_title'] = $term_obj->name;

	$term_link = get_term_link( $term_obj->slug, $taxonomy );
	if ( ! is_wp_error( $term_link ) ) {
		$term_data['term_link'] = $term_link;
	} else {
		$term_data['term_link'] = '';
	}

	if ( $thumbnail_id ) {
		$image_atts             = wp_get_attachment_image_src( $thumbnail_id, $img_format );
		$term_data['image_url'] = $image_atts[0];
	} else {
		$term_data['image_url'] = apply_filters( 'ftc_elements_no_image', '' );
	}

	return $term_data;

}
add_filter( 'ftc_elements_term_data_cate', 'ftc_elements_term_data_cate_f', 100, 3 );

