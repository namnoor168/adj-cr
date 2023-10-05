<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
global $smof_data;
if(isset($smof_data['ftc_prod_tabs']) && $smof_data['ftc_prod_tabs']){

	$is_accordion =  isset($smof_data['ftc_prod_style_tabs']) && $smof_data['ftc_prod_style_tabs'] == 'accordion';

	if ( ! empty( $tabs ) ) : ?>

		<?php if( !$is_accordion ): ?>

			<div class="woocommerce-tabs wc-tabs-wrapper">
				<ul class="tabs wc-tabs">
					<?php foreach ( $tabs as $key => $tab ) : ?>

						<li class="<?php echo esc_attr( $key ); ?>_tab">
							<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
						</li>

					<?php endforeach; ?>
				</ul>
				<?php foreach ( $tabs as $key => $tab ) : ?>

					<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
						<?php call_user_func( $tab['callback'], $key, $tab ) ?>
					</div>

				<?php endforeach; ?>
			</div>

			<?php else: ?>

				<div class="woocommerce-tabs accordion-tabs">
					<?php $counter = 1; ?>
					<ul class="tabs-nav">
						<?php foreach ( $tabs as $key => $tab ) : ?>
							<li class="<?php echo esc_attr( $key ); ?>_tab tab-<?php echo esc_attr( $counter); ?> tab-title" data-tab="<?php echo esc_attr( $counter); ?>">
								<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
							</li>
							<div class="tab-content tab-<?php echo esc_attr( $counter); ?>" id="tab-<?php echo esc_attr( $key ); ?>">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
							</div>
							<?php $counter++; ?>
						<?php endforeach; ?>
					</ul>

				</div>

			<?php endif; ?>

		<?php endif; ?>
	<?php }
