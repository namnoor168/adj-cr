<?php 
global $smof_data;
if( !isset($data) ){
	$data = $smof_data;
}

$data = ftc_array_atts(
 array(
    /* FONTS */
    'ftc_body_font_enable_google_font'					=> 1
    ,'ftc_body_font_family'								=> "Arial"
    ,'ftc_body_font_google'								=> "Poppins"

    ,'ftc_secondary_body_font_enable_google_font'		=> 1
    ,'ftc_secondary_body_font_family'					=> "Arial"
    ,'ftc_secondary_body_font_google'					=> "Open Sans"

    /* COLORS */
    ,'ftc_primary_color'									=> "#222"

    ,'ftc_secondary_color'								=> "#999"

    ,'ftc_body_background_color'								=> "#ffffff"
    /* RESPONSIVE */
    ,'ftc_responsive'									=> 1
    ,'ftc_layout_fullwidth'								=> 0
    ,'ftc_enable_rtl'									=> 0

    /* FONT SIZE */
    /* Body */
    ,'ftc_font_size_body'								=> 12
    ,'ftc_line_height_body'								=> 24

    /* Custom CSS */
    ,'ftc_custom_css_code'								=> ''
), $data);		

/* Filter [site_url] */
$data = apply_filters('ftc_custom_style_data', $data);

extract( $data );

/* font-body */
if( $data['ftc_body_font_enable_google_font'] ){
	$ftc_body_font				= $data['ftc_body_font_google']['font-family'];
}
else{
	$ftc_body_font				= $data['ftc_body_font_family'];
}

if( $data['ftc_secondary_body_font_enable_google_font'] ){
	$ftc_secondary_body_font		= $data['ftc_secondary_body_font_google']['font-family'];
}
else{
	$ftc_secondary_body_font		= $data['ftc_secondary_body_font_family'];
}

?>	

/*
1. FONT FAMILY
2. GENERAL COLORS
*/


/* ============= 1. FONT FAMILY ============== */

body{
line-height: <?php echo esc_html($ftc_line_height_body)."px"?>;
}

html, 
body,.widget-title.heading-title,
.widget-title.product_title,.newletter_sub_input .button.button-secondary,
.mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text
, .widget_shopping_cart .total, .widget_shopping_cart .buttons a.button
, .mobile-wishlist .tini-wishlist, .mobile-wishlist .tini-wishlist span
, .product-slider5 .woocommerce .product .item-description span.price
, .woocommerce .products.list .product h3.product-name
, .tx-bn1-h1
, .tx-bn2-h1
, .tx2-bn1-h1
, .tx2-bn2-h1
, .all-karo p
, .ftc-elements-blogs .post .post-text h4
, .elementor-widget-ftc-blog-timeline .post-text h4
, input::placeholder
, textarea::placeholder
{
  font-family: <?php echo esc_html($ftc_body_font) ?>;
}

.mega_main_menu.primary ul li .mega_dropdown > li.sub-style > ul.mega_dropdown,
.mega_main_menu li.multicolumn_dropdown > .mega_dropdown > li .mega_dropdown > li,
.mega_main_menu.primary ul li .mega_dropdown > li > .item_link .link_text,
.info-open,
.info-phone,
.ftc-sb-account .ftc_login > a,
.ftc-sb-account,
.ftc-my-wishlist *,
.dropdown-button span > span,
body p,
.wishlist-empty,
div.product .social-sharing li a,
.ftc-search form,
.ftc-shop-cart,
.conditions-box,
.item-description .product_title,
.item-description .price,
.testimonial-content .info,
.testimonial-content .byline,
.widget-container ul.product-categories ul.children li a,
.widget-container:not(.ftc-product-categories-widget):not(.widget_product_categories):not(.ftc-items-widget) :not(.widget-title),
.ftc-products-category ul.tabs li span.title,
.woocommerce-pagination,
.woocommerce-result-count,
.woocommerce .products.list .product .price .amount,
.woocommerce-page .products.list .product .price .amount,
.products.list .short-description.list,
div.product .single_variation_wrap .amount,
div.product div[itemprop="offers"] .price .amount,
.orderby-title,
.blogs .post-info,
.blog .entry-info .entry-summary .short-content,
.single-post .entry-info .entry-summary .short-content,
.single-post article .post-info .info-category,
#comments .comments-title,
#comments .comment-metadata a,
.post-navigation .nav-previous,
.post-navigation .nav-next,
.woocommerce div.product .product_title,
.woocommerce-review-link,
.ftc_feature_info,
.woocommerce div.product p.stock,
.woocommerce div.product .summary div[itemprop="description"],
.woocommerce div.product p.price,
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce div.product form.cart .group_table td.price,
footer,
footer a,
.blogs article .image-eff:before,
.blogs article a.gallery .owl-item:after,
.elementor-widget-ftc-posts-grid .post-text p,
.ftc-elements-blogs-timeline .inner-wrap .post-text p
{
  font-family: <?php echo esc_html($ftc_secondary_body_font) ?>;
}
body,
.site-footer,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce .product .conditions-box span,
.item-description .meta_info .yith-wcwl-add-to-wishlist a,  .item-description .meta_info .compare,
.info-company li i,
.social-icons .ftc-tooltip:before,
.tagcloud a,
.details_thumbnails .owl-nav > div:before,
div.product .summary .yith-wcwl-add-to-wishlist a:before,
.pp_woocommerce div.product .summary .compare:before,
.woocommerce div.product .summary .compare:before,
.woocommerce-page div.product .summary .compare:before,
.woocommerce #content div.product .summary .compare:before,
.woocommerce-page #content div.product .summary .compare:before,
.woocommerce div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label,
.pp_woocommerce div.product form.cart .variations label,
blockquote,
.ftc-number h3.ftc_number_meta,
.woocommerce .widget_price_filter .price_slider_amount,
.wishlist-empty,
.woocommerce div.product form.cart .button,
.woocommerce table.wishlist_table
{
    font-size: <?php echo esc_html($ftc_font_size_body) ?>px;
}
/* ========== 2. GENERAL COLORS ========== */
/* ========== Primary color ========== */
.header-currency:hover .ftc-currency > a,
.ftc-sb-language:hover li .ftc_lang,
.woocommerce a.remove:hover,
.dropdown-container .ftc_cart_check > a.button.view-cart:hover,
.ftc-my-wishlist a:hover,
.ftc-sb-account .ftc_login > a:hover,
.header-currency .ftc-currency ul li:hover,
.dropdown-button span:hover,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
.mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link:hover *,
.mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li.current-menu-item > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *,
.mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
.mega_main_menu.primary .mega_dropdown > li.current-menu-item > .item_link *,
.woocommerce .products .product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating,
.star-rating:before,
div.product div[itemprop="offers"] .price .amount,
div.product .single_variation_wrap .amount,
.pp_woocommerce .star-rating:before,
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce-product-rating .star-rating span,
ins .amount,
.ftc-meta-widget .price ins,
.ftc-meta-widget .star-rating,
.ul-style.circle li:before,
.woocommerce form .form-row .required,
.blogs .comment-count i,
.blog .comment-count i,
.single-post article .post-info .info-category .cat-links a,
.ftc-breadcrumb-title .ftc-breadcrumbs-content a:hover,
.woocommerce .product   .item-description .meta_info a:hover,
.woocommerce-page .product   .item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-color-orange .vc_icon_element-icon,
.comment-reply-link .icon,
body table.compare-list tr.remove td > a .remove:hover:before,
a:hover,
a:focus,
.ftc_products_slider .woocommerce .product .item-description .product_title:hover a,
.ftc_products_slider .woocommerce .product .item-description .meta_info > div span,
.woocommerce .product .item-description .product_title:hover a,
.woocommerce .product .item-description .meta_info > div span,
.ftc-product-tabs .woocommerce .product .item-description .product_title:hover a,
.ftc-product-tabs .woocommerce .product .item-description .meta_info > div span,
.ftc-product-grid.woocommerce .product .item-description .product_title:hover a,
.ftc-product-grid.woocommerce .product .item-description .meta_info > div span,
.h24-copyright .elementor-widget-text-editor a:hover,
.ftc-product-tabs .tabs-wrapper .tab-title.active,
.ftc-blogs-slider.style_1 .inner-wrap .post-text:hover .ftc-readmore,
.hp-h4 .ftc-hot-spot-wrap:before,
.hp-h4 .ftc-element-hotspots .ftc-hot-spot-image .content .item-description .product-title:hover a,
.woocommerce .products.list div.product .item-description .product_title:hover a,
.woocommerce .product .item-description .meta_info .add-to-cart a.added_to_cart,
.woocommerce-page .before-loop-wrapper .prod-cat-show-top-content-button a:hover,
div.product .social-sharing li a:hover,
.woocommerce div.product div.summary form.cart input[type="button"]:hover,
.ftc-header-template .header-mobile .mobile-button:hover .fa-bars:before,
.mobile-wishlist .tini-wishlist:hover i,
.mobile-wishlist .tini-wishlist:hover .count-wish,
.mail-contact:hover,
.elementor-custom-embed-play i:hover,
.elementor-element.toggle-faq02 .elementor-toggle .elementor-tab-title:hover .elementor-toggle-icon i:before,
.toggle-faq02 .elementor-tab-title:hover .elementor-toggle-title,
.woocommerce .woocommerce-ordering .orderby ul li a:hover,
.woocommerce-info::before,
.ftc_blog_widget ul li .ftc-widget-post-content a:hover,
.widget_categories ul li:hover a,
.blogs article h3.product_title a:hover,
.single-post .full-content > p:hover:first-of-type:first-letter,
.accordion-tabs ul li.active a,
.woocommerce #reviews #comments ol.commentlist .star-rating span,
.woocommerce-tabs #reviews #comments .woocommerce-Reviews-title span,
.woocommerce-tabs #review_form_wrapper #review_form .comment-reply-title:hover,
.single-post #comments.comments-area .reply .comment-reply-link:hover,
.contact-ct .ftc-element-image .ftc-image-content .contact-tx2 a:hover,
.single-post .full-content blockquote.wp-block-quote cite,
article .post-info .tag-cate-detail a:hover,
.blog article .post-info a.post-title:hover,
.blog article .post-info .entry-info  span a:hover,
.ftc-elements-blogs-timeline .post .post-text h4 a:hover,
.ftc-elements-blogs.style_1 .post .post-text .meta > span a:hover,
.ftc-header-template .ftc-account .ftc_login .dropdown-container a:hover,
.ftc-header-template .ftc-account .dropdown-container .call-signup a:hover,
article .post-info .tx2-bn1-h1:hover,
article .post-info .tx-bn-pr-h1:hover,
.ftc-simple li.current-menu-ancestor > a,
.ftc-simple li.current-menu-item > a,
.ftc-simple li:hover > a,
.ftc-simple li.current-menu-ancestor > a > .sub-arrow,
.ftc-simple li.current-menu-item > a > .sub-arrow,
.ftc-simple li:hover > a > .sub-arrow,
.ftc-smartmenu ul li .sub-menu > li > a:hover,
.menu-mobile > div:hover a,
.menu-mobile > div:hover a .count-wish,
.ftc-search-form .ftc_search_ajax .ftc-enable-ajax-search .ftc-search-meta a:hover,
.woocommerce table.shop_table td.product-name a:hover
{
    color: <?php echo esc_html($ftc_primary_color) ?>;
}
.woocommerce a.remove:hover{
color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
.dropdown-container .ftc_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
.woocommerce .products.list .product   .item-description .button-in a:hover,
.counter-wrapper > div,
.tp-bullets .tp-bullet:after,
.woocommerce .product .conditions-box .onsale,
.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover,
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
.woocommerce .products .product  .item-image .button-in:hover a:hover,
.woocommerce .products .product  .item-image a:hover,
.vc_color-orange.vc_message_box-solid,
.woocommerce .form-row input.button:hover,
.load-more-wrapper .button:hover,
.woocommerce div.product form.cart .button:hover,
.woocommerce div.product div.summary p.cart a:hover,
div.product .summary .yith-wcwl-add-to-wishlist:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
.woocommerce .wc-proceed-to-checkout a.button.alt:hover,
.woocommerce .wc-proceed-to-checkout a.button:hover,
.woocommerce-cart table.cart input.button:hover,
.owl-dots > .owl-dot span:hover,
.owl-dots > .owl-dot.active span,
body.error404 .page-header a,
body .button.button-secondary,
.pp_woocommerce div.product form.cart .button,
#cboxClose:hover,
body > h1,
table.compare-list .add-to-cart td a:hover,
.vc_progress_bar.wpb_content_element > .vc_general.vc_single_bar > .vc_bar,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-prev:hover,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-next:hover,
ul > .page-numbers.current,
ul > .page-numbers:hover,
.menu-text .btn-danger, .menu-text .btn-danger:hover
,  .menu-text .btn-danger:active:hover,table.compare-list tbody .add-to-cart td a:hover, .woocommerce .actions button.button:hover
, .woocommerce button.button.alt:hover, .woocommerce .wishlist_table td.product-add-to-cart a:hover
, footer .ftc_newletter_sub .newletter_sub .button.button-secondary.transparent
, p.woocommerce-mini-cart__buttons.buttons > a.button.checkout.wc-forward:hover
, .cookies-buttons a:hover, .newsletterpopup .wp-newletter button.button:hover
, .product-slider5 .woocommerce .product .conditions-box span, .blog-home5 .blogs .post-info a.button-readmore:hover
, .details_thumbnails .owl-nav .owl-prev:hover, .details_thumbnails .owl-nav .owl-next:hover
, .woocommerce .product .images .group-button-product .quickview:hover
, .woocommerce .product .images .group-button-product .compare:hover
, .woocommerce .product .images .group-button-product .yith-wcwl-add-to-wishlist:hover a
, .ftc_products_slider .woocommerce .product .images .group-button-product .quickview:hover
, .ftc_products_slider .woocommerce .product .images .group-button-product .compare:hover
, .ftc_products_slider .woocommerce .product .images .group-button-product .yith-wcwl-add-to-wishlist:hover a
, .ftc-product-tabs .woocommerce .product .images .group-button-product .quickview:hover
, .ftc-product-tabs .woocommerce .product .images .group-button-product .compare:hover
, .ftc-product-tabs .woocommerce .product .images .group-button-product .yith-wcwl-add-to-wishlist:hover a
, .ftc-product-grid.woocommerce .product .images .group-button-product .quickview:hover
, .ftc-product-grid.woocommerce .product .images .group-button-product .compare:hover
, .ftc-product-grid.woocommerce .product .images .group-button-product .yith-wcwl-add-to-wishlist:hover a
, .h24-ft-bottom .h24-mail-input input[type="submit"]
, .ftc-product-tabs .tabs-wrapper .tab-title.active:before
, .ftc-product-grid.woocommerce .load-more-product .load-more:hover
, .hp-h4 .ftc-hot-spot-wrap:hover
, .hp-h4 .ftc-hot-spot-wrap:hover .ftc-hot-spot-inner
, .tx3-bn-h4:hover
, .woocommerce .widget_price_filter .ui-slider .ui-slider-range
, .ftc-elements-blogs-timeline .element-timeline .date-timeline-element
, .elementor-widget-ftc-blog-timeline .ftc-loadmore-posts a:hover
, body div.pp_woocommerce.pp_pic_holder .pp_close:hover:before
, .ftc-sidebar > .widget-container.ftc-product-categories-widget h3.widget-title.product_title
, .ftc-sidebar > .widget-container.widget_text
, div#customer_login button.woocommerce-button.button:hover
, .tx2-bn1-h1:hover:before
, .ftc-mobile-wrapper .menu-text
, .woocommerce #payment #place_order:hover
, .woocommerce-page #payment #place_order:hover
{
    background-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.view-cart:hover,
.dropdown-container .ftc_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
.counter-wrapper > div,
#right-sidebar .product_list_widget:hover li,
.woocommerce .product   .item-description .meta_info a:hover,
.woocommerce-page .product   .item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info a:hover,
.ftc-meta-widget.item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.ftc-products-category ul.tabs li:hover,
.ftc-products-category ul.tabs li.current,
body div.pp_details a.pp_close:hover:before,
.woocommerce form .form-row .input-text:focus,
body .button.button-secondary,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
#cboxClose:hover, .woocommerce-account .woocommerce-MyAccount-navigation li.is-active,
.ftc-product-items-widget .ftc-meta-widget.item-description .meta_info .compare:hover,
.ftc-product-items-widget .ftc-meta-widget.item-description .meta_info .add_to_cart_button a:hover,
.woocommerce .product   .item-description .meta_info .add-to-cart a:hover,
.ftc-meta-widget.item-description .meta_info .add-to-cart a:hover,
.ftc-mobile-wrapper .menu-text .btn-toggle-canvas.btn-danger 
, p.woocommerce-mini-cart__buttons.buttons > a.button.checkout.wc-forward:hover
, p.woocommerce-mini-cart__buttons.buttons > a.button.wc-forward:hover
, .newsletterpopup .wp-newletter button.button:hover
, .tx3-bn-h4:hover
, .home24 .tp-bullet.selected
, .woocommerce .wc-proceed-to-checkout a.button.alt:hover
, .woocommerce #payment #place_order:hover
, .woocommerce-page #payment #place_order:hover
{
    border-color: <?php echo esc_html($ftc_primary_color) ?>;
}
#ftc_language ul ul,
.header-currency ul,
.ftc-account .dropdown-container,
.ftc-shop-cart .dropdown-container,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item,
.mega_main_menu > .menu_holder > .menu_inner > ul > li:hover,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
.mega_main_menu > .menu_holder > .menu_inner > ul > li.current_page_item > a:first-child:after,
.mega_main_menu > .menu_holder > .menu_inner > ul > li > a:first-child:hover:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item > .item_link:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .mega_dropdown,
.woocommerce .product .conditions-box .onsale:before,
.woocommerce .product .conditions-box .featured:before,
.woocommerce .product .conditions-box .out-of-stock:before,
.woocommerce-info,
#dropdown-list
{
    border-top-color: <?php echo esc_html($ftc_primary_color) ?>;
}

footer#colophon .ftc-footer .widget-title:before,
.woocommerce div.product .woocommerce-tabs ul.tabs,
#customer_login h2 span:before,
.cart_totals  h2 span:before
{
    border-bottom-color: <?php echo esc_html($ftc_primary_color) ?>;
}

/* ========== Secondary color ========== */
body,
.ftc-shoppping-cart a.ftc_cart:hover,
.woocommerce a.remove,
body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab,
.woocommerce .products .star-rating.no-rating,
.woocommerce-page .products .star-rating.no-rating,
.star-rating.no-rating:before,
.pp_woocommerce .star-rating.no-rating:before,
.woocommerce .star-rating.no-rating:before,
.woocommerce-page .star-rating.no-rating:before,
.woocommerce .product .item-image .group-button-product > div a,
.woocommerce .product .item-image .group-button-product > a, 
.vc_progress_bar .vc_single_bar .vc_label,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline-custom,
.style1 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style2 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style3 .ftc-countdown .counter-wrapper > div .countdown-meta,
.style4 .ftc-countdown .counter-wrapper > div .number-wrapper .number,
.style4 .ftc-countdown .counter-wrapper > div .countdown-meta
{
    color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
.info-company li i,
body .button.button-secondary:hover,
div.pp_default .pp_close, body div.pp_woocommerce.pp_pic_holder .pp_close,
body div.ftc-product-video.pp_pic_holder .pp_close,
body .ftc-lightbox.pp_pic_holder a.pp_close,
#cboxClose
{
    background-color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .ftc_cart_check > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
body .button.button-secondary:hover,
#cboxClose
{
    border-color: <?php echo esc_html($ftc_secondary_color) ?>;
}

/* ========== Body Background color ========== */
body
{
    background-color: <?php echo esc_html($ftc_body_background_color) ?>;
}
@media only screen and (max-width: 767px){
.blog .ftc-sidebar .widget-container:hover .widget-title
, .single-post .ftc-sidebar .widget-container:hover .widget-title
, .sidebar-blog .widget-container:hover .widget-title
, .blog .ftc-sidebar .widget-container:hover .widget-title-wrapper a
, .single-post .ftc-sidebar .widget-container:hover .widget-title-wrapper a
, .sidebar-blog .widget-container:hover .widget-title-wrapper a
{
    color: <?php echo esc_html($ftc_primary_color) ?>;
}

}
/* Custom CSS */
<?php 
if( !empty($ftc_custom_css_code) ){
  echo html_entity_decode( trim( $ftc_custom_css_code ) );
}
?>