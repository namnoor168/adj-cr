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

global $smof_data;

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
