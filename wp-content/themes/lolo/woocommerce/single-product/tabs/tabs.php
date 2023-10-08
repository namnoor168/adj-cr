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
					
					<div class="description_tabs">
              			<div class="tab-content" id="tab-content">
						  <?php foreach ( $tabs as $key => $tab ) : ?>
							<div class="description_tabs_item">
								<a class="tab_title" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="<?php echo esc_attr( $key ); ?>">
									<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
								</a>
								<div class="tab-pane" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel"> 
									<?php call_user_func( $tab['callback'], $key, $tab ); ?>        
								</div>
							</div>
						<?php endforeach; ?>
    					</div>
					</div>
				</div>

			<?php endif; ?>

		<?php endif; ?>
	<?php }
