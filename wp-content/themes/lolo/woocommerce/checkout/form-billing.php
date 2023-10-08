<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );
		?>
		<div class="block-onepagecheckout block-customer ">
            <div class="title-heading">
                <span class="ets_icon_svg">
                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1536 1399q0 109-62.5 187t-150.5 78h-854q-88 0-150.5-78t-62.5-187q0-85 8.5-160.5t31.5-152 58.5-131 94-89 134.5-34.5q131 128 313 128t313-128q76 0 134.5 34.5t94 89 58.5 131 31.5 152 8.5 160.5zm-256-887q0 159-112.5 271.5t-271.5 112.5-271.5-112.5-112.5-271.5 112.5-271.5 271.5-112.5 271.5 112.5 112.5 271.5z"></path></svg>
                </span>
                Thông tin khách hàng
            </div>
            <div class="block-content">
    			<div id="customer-login" class="type-checkout-option login guest create">        
                    <div class="form-group type-checkout-option guest col-md-12" style="">
					<span id="customer_guest_id_gender" class="form-control-valign">
						<label class="radio-inline">
							<span class="custom-radio">
							<input name="customer_guest[id_gender]" value="1" type="radio">
							<span></span>
							</span>
							Ông
						</label>
						<label class="radio-inline">
							<span class="custom-radio">
							<input name="customer_guest[id_gender]" value="2" type="radio">
							<span></span>
							</span>
							Bà
						</label>
					</span>
                </div>
				<div class="form-group type-checkout-option guest col-md-6" style="">
                    <input placeholder="Tên" id="customer_guest_firstname" class="form-control validate is_required" name="customer_guest[firstname]" value="" type="text" data-validate="isCustomerName" data-validate-errors="Tên không hợp lệ" data-required-errors="Tên là bắt buộc">
            	</div>
				<div class="form-group type-checkout-option guest col-md-6" style="">
					<input placeholder="Họ" id="customer_guest_lastname" class="form-control validate is_required" name="customer_guest[lastname]" value="" type="text" data-validate="isCustomerName" data-validate-errors="Họ không hợp lệ" data-required-errors="Họ là bắt buộc">
				</div>
				<div class="form-group type-checkout-option guest col-md-6" style="">
					<input placeholder="Email" id="customer_guest_email" class="form-control validate is_required" name="customer_guest[email]" value="" type="email" data-validate="isEmail" data-validate-errors="Email không hợp lệ" data-required-errors="Email là bắt buộc">
				</div>
                <div class="row type-checkout-option create guest"></div>	
			</div> 
    	</div>
		<?php
		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
