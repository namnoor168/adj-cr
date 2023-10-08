<?php

/* Popup Newsletter */
if ( ! function_exists( 'ftc_popup_newsletter' ) ) {
    function ftc_popup_newsletter() {
     global $smof_data; 
     if(isset($smof_data['ftc_bg_popup_image']['url']) && !empty($smof_data['ftc_bg_popup_image']['url']))
        echo '<div class="popupshadow" style="display:none"></div>';
    echo '<div class="newsletterpopup" style="display:none; background-image: url('. esc_url($smof_data['ftc_bg_popup_image']['url']) .')">';
    echo '<span class="close-popup"></span>
    <div class="wp-newletter">';
    dynamic_sidebar('popup-newletter');
    echo '</div>';
    echo '<span class="dont_show_popup"><input id="ftc_dont_show_again" type="checkbox"><label for="ftc_dont_show_again">' .esc_attr__('Don\'t show popup again', 'lolo'). '</label></span>';
    echo '</div>';
}
}
/* * * Tiny account ** */
if (!function_exists('ftc_tiny_account')) {

    function ftc_tiny_account() {
        global $wp;
        $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        $logout_url = wp_logout_url(get_permalink());

        if (ftc_has_woocommerce()) { /* Active woocommerce */
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        }



        $_user_logged = is_user_logged_in();
        ob_start();
        ?>
        <div class="ftc-account">
            <div class="ftc_login">
                <?php if (!$_user_logged): ?>
                    <a  class="login" href="#" title="<?php echo esc_html__('Login', 'lolo'); ?>"><span><?php echo esc_html__('Login', 'lolo'); ?></span></a>
                    / 
                    <a class="ftc_sign_up" href="<?php echo esc_url($register_url); ?>" title="<?php echo esc_html__('Create New Account', 'lolo'); ?>"><span><?php echo esc_html__('Sign up', 'lolo'); ?></span></a>
                    <?php else: ?>
                        <a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php echo esc_html__('My Account', 'lolo'); ?>"><span><?php echo esc_html__('My Account', 'lolo'); ?></span></a> / 
                        <a class="log-out" href="<?php echo esc_url($logout_url); ?>" title="<?php echo esc_html__('Logout', 'lolo'); ?>"><span><?php echo esc_html__('Logout', 'lolo'); ?></span></a>
                    <?php endif; ?>
                </div>
                <?php if (!$_user_logged): ?>
                    <div class="ftc_account_form dropdown-container">
                        <form name="ftc-login-form" class="ftc-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">

                            <p class="login-username">
                                <label><?php echo esc_html__('Username', 'lolo'); ?></label>
                                <input type="text" name="log" class="input" value="" size="20" autocomplete="off">
                            </p>
                            <p class="login-password">
                                <label><?php echo esc_html__('Password', 'lolo'); ?></label>
                                <input type="password" name="pwd" class="input" value="" size="20">
                            </p>

                            <p class="login-submit">
                                <input type="submit" name="wp-submit" class="button-secondary button" value="<?php echo esc_html__('Login', 'lolo'); ?>">
                                <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()) ?>">
                            </p>

                        </form>

                        <p class="ftc_forgot_pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php echo esc_html__('Forgot Your Password?', 'lolo'); ?>"><?php echo esc_html__('Forgot Your Password?', 'lolo'); ?></a></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            return ob_get_clean();
        }

    }

    /* * * Tiny Cart ** */
    if (!function_exists('ftc_tiny_cart')) {

        function ftc_tiny_cart() {
            if (!ftc_has_woocommerce()) {
                return '';
            }
            global $smof_data;
            ob_start();
            ?>
            <div class="ftc-tini-cart">
                <div class="cart-item">
                    <a class="ftc-cart-tini <?php if(isset($smof_data['ftc_cart_layout']) && $smof_data['ftc_cart_layout'] == 'off-canvas') {
                        echo "cart-item-canvas";
                    } ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <?php print_r(ftc_cart_total()); ?>
                </a>
            </div>
            <?php if(isset($smof_data['ftc_cart_layout']) && $smof_data['ftc_cart_layout'] == 'dropdown'): ?>
                <div class="tini-cart-inner">
                    <div class="woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                            <?php print_r(woocommerce_mini_cart()); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

add_action('wp_footer', 'ftc_popup_cart');
function ftc_popup_cart(){
    if (!ftc_has_woocommerce()) {
        return '';
    }
    ?>
    <div id="blockcart-modal" class="popup-add-to-cart d-none">
        <div class="content-popup">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="đóng">
                <span aria-hidden="true"><i class="material-icons">close</i></span>
                </button>
                <h4 class="modal-title h6 text-sm-center" id="myModalLabel"><i class="material-icons rtl-no-flip"></i>Sản phẩm đã được thêm vào giỏ hàng</h4>
            </div>
            <div class="woocommerce widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <?php print_r(woocommerce_mini_cart()); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'ftc_login_form');
function ftc_login_form(){
    $login_url = '#';
    $register_url = '#';
    if (ftc_has_woocommerce()) { /* Active woocommerce */
        $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        if ($myaccount_page_id) {
            $login_url = get_permalink($myaccount_page_id);
            $register_url = $login_url;
        }
    } else {
        $login_url = wp_login_url();
        $register_url = wp_registration_url();
    }
    ?>
    <div class="ftc-header-login ftc-header-template">
        <div class="ftc-header-login-overlay"></div>
        <div class="ftc-account">
            <div class="ftc_account_form dropdown-container">
                <p class="login-tx1"><?php echo esc_html__('Already have an account?', 'lolo'); ?></p>
                <h2 class="login-tx2"><?php echo esc_html__('Login', 'lolo'); ?></h2>
                <form name="ftc-login-form" class="ftc-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">

                    <p class="login-username">
                        <input type="text" name="log" class="input" value="" size="20" autocomplete="off" placeholder="User Name *">
                    </p>
                    <p class="login-password">
                        <input type="password" name="pwd" class="input" value="" size="20" placeholder="Password *">
                    </p>
                    <label class="checkbox-login woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span><?php echo esc_html__('Remember me', 'lolo'); ?></span>
                    </label>
                    <p class="login-submit">
                        <input type="submit" name="wp-submit" class="button-secondary button" value="<?php echo esc_attr('Login', 'lolo'); ?>">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()) ?>">
                    </p>

                </form>

                <p class="ftc_forgot_pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php echo esc_attr('Forgot Your Password?', 'lolo'); ?>"><?php echo esc_html__('Forgot Your Password?', 'lolo'); ?></a></p>
                <p class="call-signup"><a href="<?php echo esc_url($register_url); ?>" title="<?php echo esc_attr('Create New Account', 'lolo'); ?>"><span><?php echo esc_html__('Sign up', 'lolo'); ?></span></a></p>
            </div>
        </div>
    </div>
    
    
    <?php

}
function ftc_cart_total() {

    ob_start();
    if(!WC()->cart ){
        return;
    }
    ?>
    <div class="cart-total">
        <span class="cart-numb"><?php echo WC()->cart->get_cart_contents_count() ?></span>
        <span class="i-tems"><?php echo esc_html__(' Item - ', 'lolo'); ?></span>

        <div class="sub-cart-total ">
            <?php print_r(WC()->cart->get_cart_subtotal()); ?>
            <span class=" fa fa-caret-down"></span>
        </div> 
    </div>

    
    <?php
    return ob_get_clean();
}
add_filter('woocommerce_add_to_cart_fragments', 'ftc_tiny_cart_filter');

function ftc_tiny_cart_filter($fragments) {
    $fragments['.cart-total'] = ftc_cart_total();
    return $fragments;
}

function ftc_remove_cart_item() {
    check_ajax_referer( 'platform_security', 'security' );
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    if ($cart_item = WC()->cart->get_cart_item($cart_item_key)) {
        WC()->cart->remove_cart_item($cart_item_key);
    }
    WC_AJAX::get_refreshed_fragments();
}

add_action('wp_ajax_ftc_remove_cart_item', 'ftc_remove_cart_item');
add_action('wp_ajax_nopriv_ftc_remove_cart_item', 'ftc_remove_cart_item');

/** Tini wishlist * */
function ftc_tini_wishlist() {
    if (!(ftc_has_woocommerce() && class_exists('YITH_WCWL'))) {
        return;
    }

    ob_start();

    $wishlist_page_id = get_option('yith_wcwl_wishlist_page_id');
    if (function_exists('wpml_object_id_filter')) {
        $wishlist_page_id = wpml_object_id_filter($wishlist_page_id, 'page', true);
    }
    $wishlist_page = get_permalink($wishlist_page_id);

    $count = yith_wcwl_count_products();
    ?>

    <a title="<?php echo esc_html__('Wishlist', 'lolo'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist">
      <i class="fa fa-heart"></i>  
      <?php echo esc_html__('Wishlist', 'lolo'); ?>
      <span class="count-wish">
        <?php echo esc_html__('(' . ($count > 0 ? zeroise($count, 1) : '0') . ')'); ?>
    </span>
</a>

<?php
$tini_wishlist = ob_get_clean();
return $tini_wishlist;
}
/*Cart footer*/
add_filter('woocommerce_add_to_cart_fragments', 'ftc_cart_filter');
function ftc_cart_filter($fragments) {
    ob_start();
    ftc_cart_subtotal();
    $subtotal = ob_get_clean();
    $fragments['span.footer-cart-number'] = $subtotal;

    return $fragments;
}

if( ! function_exists( 'ftc_cart_subtotal' ) ) {
    function ftc_cart_subtotal() {
        ?>
        <span class="footer-cart-number"> <?php echo "(". WC()->cart->get_cart_contents_count().  ")"?></span>
        <?php
    }
}

function ftc_update_tini_wishlist() {
    check_ajax_referer( 'platform_security', 'security' );
    wp_die(ftc_tini_wishlist());
}

add_action('wp_ajax_update_tini_wishlist', 'ftc_update_tini_wishlist');
add_action('wp_ajax_nopriv_update_tini_wishlist', 'ftc_update_tini_wishlist');

if (!function_exists('ftc_woocommerce_multilingual_currency_switcher')) {

    function ftc_woocommerce_multilingual_currency_switcher() {
        if (class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress')) {
            global $sitepress, $woocommerce_wpml;

            if (!isset($woocommerce_wpml->multi_currency)) {
                return;
            }

            $settings = $woocommerce_wpml->get_settings();

            $format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template'] : '%code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }

            $selected_html = '';
            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1) {
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'), array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($currency == $woocommerce_wpml->multi_currency->get_client_currency()) {
                        $selected_html = '<a href="javascript: void(0)" class="ftc-currency-selector">' . $currency_format . '</a>';
                        break;
                    }
                }
            }

            echo '<div class="ftc-currency">';
            print_r($selected_html);
            echo '<ul>';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1) {
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'), array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
                    echo '<li rel="' . $currency . '" >' . $currency_format . '</li>';
                }
            }

            echo '</ul>';
            echo '</div>';
        } else if (class_exists('WOOCS') && class_exists('WooCommerce')) { /* Support WooCommerce Currency Switcher */
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            if (!is_array($currencies)) {
                return;
            }
            ?>
            <div class="ftc-currency">
                <a href="javascript: void(0)" class="ftc-currency-selector"><?php echo esc_html__($WOOCS->current_currency); ?></a>
                <ul>
                    <?php
                    foreach ($currencies as $key => $currency) {
                        $link = add_query_arg('currency', $currency['name']);
                        echo '<li rel="' . $currency['name'] . '"><a href="' . esc_url($link) . '">' . esc_html__($currency['name']) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
        } else {/* Demo html */
            ?>
            <div class="ftc-currency">
                <a href="javascript: void(0)" class="ftc-currency-selector">USD</a>
                <ul>
                    <li rel="USD">Dollar (USD)</li>
                    <li rel="EUR">Euro (EUR)</li>
                </ul>
            </div>
            <?php
        }
    }

}

if (!function_exists('ftc_wpml_language_selector')) {

    function ftc_wpml_language_selector() {
        if (class_exists('SitePress')) {
            global $sitepress;
            if (method_exists($sitepress, 'get_mobile_language_selector')) {
                print_r($sitepress->get_mobile_language_selector());
            }
        } else { /* Demo html */
            ?>
            <div id="ftc_language" class="ftc_language">
                <ul>
                    <li>
                        <a href="#" class="ftc_lang icl-en"><?php echo esc_html__('English', 'lolo') ?></a>
                        <ul style="visibility: hidden;">
                            <li class="icl-fr"><a rel="alternate" href="#"><span class="icl_lang_sel_native"><?php echo esc_html__('Francais', 'lolo') ?></span></a></li>
                            <li class="icl-de"><a rel="alternate" href="#"><span class="icl_lang_sel_native"><?php echo esc_html__('Espanol', 'lolo') ?></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
    }

}
?>