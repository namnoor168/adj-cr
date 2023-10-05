<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $smof_data, $post, $product;

get_header( $smof_data['ftc_header_layout'] ); 

$extra_class = "";
$page_column_class = ftc_page_layout_columns_class($smof_data['ftc_prod_layout']);

$show_page_title = $smof_data['ftc_prod_title'];
ftc_breadcrumbs_title(true, $show_page_title, get_the_title());

?>
<div class="page-container <?php echo esc_attr($extra_class) ?>">
	
	<div id="main-content" class="container">
		<div class="row">
			<div id="primary" class="site-content col-sm-9">
				<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
				?>  
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>
				<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
				?>

			</div>
			<div class="col-md-3">
				<ul class="ybc-widget-ybc-custom-2">
					<li class="ybc-widget-item">
						<div class="content_toggle ybc_links_page_home">
								<h4 class="ybc-widget-title">Dịch vụ sau mua<h4>
						<div class="ybc-widget-description">
							<ul style="padding-top: 30px;">
								<li class="item"><img data-src="" src="https://www.pnj.com.vn/images/image-update/2021/detail-bhtd/icon-baohanh.svg">&nbsp;Bảo hành miễn phí trọn đời: Lỗi kỹ thuật, nước xi...</li>
								<li class="item"><img class="img-lazyload img" data-src="" src="https://www.pnj.com.vn/images/image-update/2021/detail-bhtd/icon-sieuamdanhbong.svg" alt="" style="opacity: 1;"> <span class="text"> Miễn phí siêu âm và đánh bóng bằng máy chuyên dụng trọn đời </span></li>
								<li class="item"><img class="img-lazyload img" data-src="" src="https://www.pnj.com.vn/images/image-update/2021/detail-bhtd/icon-baohanh.svg" alt=""> <span class="text"> Miễn phí thay đá CZ và đá tổng hợp</span></li>
							</ul>
							<p>&nbsp;</p></div>
						</div>
					</li>
				</ul>
			</div>
			<div class="popup-add-to-cart">
				<div class="content-popup">
					<p>Sản phẩm đã được thêm vào giỏ hàng</p>
					<div class="row">
						<p><?php the_title() ?></p>
						<?php	
							if ( has_post_thumbnail() ) {
								$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
								$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
								$attributes = array(
									'title'                   => get_post_field( 'post_excerpt', $post_thumbnail_id ),
									'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
									'data-src'                => $full_size_image[0],
									'data-large_image'        => $full_size_image[0],
									'data-large_image_width'  => $full_size_image[1],
									'data-large_image_height' => $full_size_image[2],
								);
						
								
									$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
									$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
									$html .= '</a></div>';
								
							} else {
								$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
								$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'lolo' ) );
								$html .= '</div>';
							}
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
						?>
					</div>
				</div>
			</div>
			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'ftc_after_single_product_summary' );
				?>
			</div>
			
		</div>
	</div>
	<?php get_footer( 'shop' ); ?>
