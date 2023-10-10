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
					<div class="form-group type-checkout-option guest first-line col-md-12" style="">
						<?php
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_first_name'){
									woocommerce_form_field( $key, ['placeholder' => 'Tên', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_last_name'){
									woocommerce_form_field( $key, ['placeholder' => 'Họ', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_email'){
									woocommerce_form_field( $key, ['placeholder' => 'Enail', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_address_1'){
									woocommerce_form_field( $key, ['placeholder' => 'Địa chỉ *', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
						
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_address_2'){
									woocommerce_form_field( $key, ['placeholder' => 'Địa chỉ bổ sung', 'input_class' => ["form-control","validate", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
						
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_city'){
									woocommerce_form_field( $key, ['placeholder' => 'Thành phố *', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							};
						
							foreach ( $fields as $key => $field ) {
								if($key == 'billing_phone'){
									woocommerce_form_field( $key, ['placeholder' => 'Điện thoại', 'input_class' => ["form-control","validate","is_required", "input_text"]] , $checkout->get_value( $key ) );
									break;
								}
							}
						?>
					</div>
                	<div class="row type-checkout-option create guest"></div>
				</div> 
    		</div>
		</div>
		<div class="block-onepagecheckout block-shipping">
            <div class="title-heading">
				<span class="ets_icon_svg">
					<svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M640 1408q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm-384-512h384v-256h-158q-13 0-22 9l-195 195q-9 9-9 22v30zm1280 512q0-52-38-90t-90-38-90 38-38 90 38 90 90 38 90-38 38-90zm256-1088v1024q0 15-4 26.5t-13.5 18.5-16.5 11.5-23.5 6-22.5 2-25.5 0-22.5-.5q0 106-75 181t-181 75-181-75-75-181h-384q0 106-75 181t-181 75-181-75-75-181h-64q-3 0-22.5.5t-25.5 0-22.5-2-23.5-6-16.5-11.5-13.5-18.5-4-26.5q0-26 19-45t45-19v-320q0-8-.5-35t0-38 2.5-34.5 6.5-37 14-30.5 22.5-30l198-198q19-19 50.5-32t58.5-13h160v-192q0-26 19-45t45-19h1024q26 0 45 19t19 45z"></path></svg>
				</span>
				Phương thức vận chuyển
			</div>
			<div class="block-content">
				<div class="delivery-options-list">
					<div class="delivery-options">
						<div class="row delivery-option">
							<div class="delivery-option-info">
								<input id="delivery_option_3" name="delivery_option[0]" value="3," type="radio">
								<label class="delivery-option-2" for="delivery_option_3">
								<div class="col-sm-12 col-xs-12">
									<div class="">
										<span class="h6 carrier-name">Giao hàng  tận nơi </span>
										<span class="carrier-delay">Miễn phí giao hàng toàn quốc </span>
										<span class="carrier-price" style="display: none;">Miễn phí</span>
									</div>
								</div>
								</label>
							</div>
						</div>
                 	</div>
                	<div id="hook-display-after-carrier"></div>
				</div>
        	</div>
    	</div>
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
