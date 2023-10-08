(function($) {
    "use strict";

    $(document).on('click', '.single-product .single_add_to_cart_button', function(e) {
        e.preventDefault();

        var $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            id = $thisbutton.val(),
            product_qty = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };
        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function(response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function(response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function(response) {

                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        return false;
    });

    /* * * Tiny Cart ** */
    function ftc_popup_cart() {
        var body = $('body');
        body.on("click", ".ftc-close-popup", function(t) {
            body.find('.popup-add-to-cart').find('.close').click();
        });
        body.on("click", ".back-to-shop", function(t) {
            body.find('.popup-add-to-cart').find('.close').click();
        });
        body.on("click", ".popup-add-to-cart .close", function(t) {
            body.find('.popup-add-to-cart').addClass('d-none');
            body.removeClass('popup-cart');
        });
        $('body').on('added_to_cart', function(event, fragments, cart_hash) {
            var id = $('body').find('.product.type-product').attr('id');
            body.addClass('popup-cart');
            body.find('.popup-add-to-cart').removeClass('d-none');
            body.find('.popup-add-to-cart').find('.content-popup').attr('id', id);
        });
    }
    ftc_popup_cart();
    setInterval(function() {
        var id = $('.popup-add-to-cart').find('.content-popup').attr('id');
        $('.woocommerce-mini-cart-item').each(function() {
            if ($(this).hasClass(id)) {
                $(this).removeClass('d-none');
            }
        });
    }, 500);

    $(document).on('click', '.tab_title', function(e) {
        e.preventDefault();
        var tab_active = $(this).attr('href');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(tab_active).removeClass('active')
        } else {
            $('.description_tabs_item .tab_title').removeClass('active');
            $('.description_tabs_item .tab-pane').removeClass('active');
            $(this).addClass('active');
            $(tab_active).addClass('active')
        }
    });

    $(window).on('load', function() {
        $('.archive #primary > .woocommerce:first-child > div:first-child').removeClass();
        $('.archive #primary > .woocommerce:first-child > div:first-child > div').removeClass('products').addClass('products-cate');
    });
    $(window).on('load', function() {
        setTimeout(function() {
            jQuery("header.site-header").fadeIn(100).attr('style', 'opacity:1');
        }, 200);
    });
    // Show hide popover
    $(".dropdown-button > span").on('click', function() { $(".dropdown-button").find("#dropdown-list").slideToggle("fast"); });

    $(".menu-ftc").on('click', function() {
        $('#primary-menu').slideToggle("fast");
    });
    $('.mega_main_menu').parent().addClass('menu-fix');


    $('img.ftc-image').each(function() {
        if ($(this).data('src')) {
            $(this).attr('src', $(this).data('src'));
        }
    });

    /*read more short_description*/
    jQuery(function($) {
        $(document).ready(function() {
            $("#readMore, #readless").on('click', function() {
                $(".collapsed-content").toggle('slow', 'swing');
                $(".full-content").toggle('slow', 'swing');
                $("#readMore").toggle(); // "read more link id"
                $("#readless").toggle();
                return false;
            });
        });
    });
    /*end*/

    $('.blog-image.gallery,.ftc-image-slider .ftc__slider__image').each(function() {
        $(this).addClass('loaded').removeClass('loading');
        $(this).owlCarousel({
            items: 1,
            loop: true,
            nav: false,
            dots: true,
            navText: [, ],
            navSpeed: 1000,
            slideBy: 1,
            rtl: $('body').hasClass('rtl'),
            margin: 10,
            navRewind: false,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            autoplaySpeed: 4000,
            autoHeight: true,
            responsive: {
                0: {
                    items: 1
                }
            }

        });

    });
    /* Single Product Video */
    jQuery('a.ftc-single-video').prettyPhoto({
        deeplinking: false,
        opacity: 0.9,
        social_tools: false,
        default_width: 800,
        default_height: 506,
        theme: 'ftc-product-video',
        changepicturecallback: function() {
            jQuery('.ftc-product-video').addClass('loaded');
        }
    });

    /* Infinite-Shop */
    function ftc_infinite_shop() {
        var container = $('.archive.infinite .woocommerce .products, .archive.term-dresses .woocommerce .products'),
            paginationNext = '.woocommerce-pagination li a.next';
        if (container.length === 0 || $(paginationNext).length === 0) {
            return;
        }
        var loadProduct = container.infiniteScroll({
            path: paginationNext,
            append: '.product',
            checkLastPage: true,
            status: '.page-load-status',
            hideNav: '.woocommerce-pagination',
            history: 'push',
            debug: false,
            scrollThreshold: 400,
            loadOnScroll: true
        });
        loadProduct.on('append.infiniteScroll', function(event, response, path, items) {
            $('img.ftc-image').on('load', function() {
                $(this).parents('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
            });
            $('img.ftc-image').each(function() {
                if ($(this).data('src')) {
                    $(this).attr('src', $(this).data('src'));
                }
            });
            if ($('.wcvendors_sold_by_in_loop').length) {
                $('.product .item-description').addClass('wc-vendor');
            }
            ftc_quickshop_process_action();
        })
    }
    ftc_infinite_shop();

    /* Product  360*/
    $('a.ftc-video360').magnificPopup({
        type: 'inline',
        mainClass: 'product-360',
        preloader: false,
        fixedContentPos: false,
        callbacks: {
            open: function() {
                $(window).resize()
            },
        },
    });


    /* Popup Newsletter */
    $(document).ready(function() {
        $('.newsletterpopup .close-popup, .popupshadow').on('click', function() {
            $('.newsletterpopup').hide();
            $('.popupshadow').hide();
        });
    });
    $(window).on('load', function() {
        if ($('.newsletterpopup').length) {
            var cookieValue = $.cookie("ftc_popup");
            if (cookieValue == 1) {
                $('.newsletterpopup').hide();
                $('.popupshadow').hide();
            } else {
                $('.newsletterpopup').show();
                $('.popupshadow').show();
            }
        }
    });
    $(document).on('change', '#ftc_dont_show_again', function() {
        if ($(this).is(':checked')) {
            $.cookie("ftc_popup", 1, { expires: 24 * 60 * 60 * 1000 });
        }
    });

    /* Product Category Show Top Content Widget Area */
    $('.prod-cat-show-top-content-button').on('click', function() {
        $(this).toggleClass('active');
        $('.product-category-top-content').slideToggle();
        return false;
    });

    /* Cookie Notice */
    function ftc_cookie_popup() {
        var cookies_version = ftc_shortcode_params.cookies_version;
        if ($.cookie('ftc_cookies_' + cookies_version) == 'accepted') return;
        var popup = $('.ftc-cookies-popup');

        setTimeout(function() {
            popup.addClass('popup-display');
            popup.on('click', '.cookies-accept-btn', function(e) {
                e.preventDefault();
                acceptCookies();
            })
        }, 2500);

        var acceptCookies = function() {
            popup.removeClass('popup-display').addClass('popup-hide');
            $.cookie('ftc_cookies_' + cookies_version, 'accepted', { expires: 60, path: '/' });
        };
    }
    ftc_cookie_popup();


    /* Ajax Remove Cart */
    if ($('ftc-shop-cart')) {
        $(document).on('click', '.cart-item-wrapper .remove', function(event) {
            event.preventDefault();
            $(this).closest('li').addClass('loading');

            jQuery.ajax({
                type: 'POST',
                url: ftc_shortcode_params.ajax_uri,
                data: {
                    action: 'ftc_remove_cart_item',
                    cart_item_key: $(this).data('key'),
                    security: ftc_platform.ajax_nonce
                },
                success: function(data) {
                    if (data && data.fragments) {

                        $.each(data.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                }
            });
        });
    }


    /* Single Product Size Chart */
    jQuery('a.ftc-size_chart').prettyPhoto({
        deeplinking: false,
        opacity: 0.9,
        social_tools: false,
        default_width: 800,
        default_height: 506,
        theme: 'ftc-size_chart',
        changepicturecallback: function() {
            jQuery('.ftc-size-chart').addClass('loaded');
        }
    });
    /* Ajax Search */
    if (typeof ftc_shortcode_params._ftc_enable_ajax_search != 'undefined' && ftc_shortcode_params._ftc_enable_ajax_search == 1) {
        ftc_ajax_search();
    }

    /** Ajax search **/
    function ftc_ajax_search() {
        var search_string = '';
        var search_previous_string = '';
        var search_timeout;
        var search_input;
        var search_cache_data = {};
        jQuery('.ftc_search_ajax').append('<div class="ftc-enable-ajax-search"></div>');
        var ftc_enable_ajax_search = jQuery('.ftc-enable-ajax-search');

        jQuery('.header-ftc .ftc_search_ajax input[name="s"], .header-ftc-element .ftc_search_ajax input[name="s"],.ftc-search-form .ftc_search_ajax input[name="s"]').on('keyup', function(e) {
            search_input = jQuery(this);
            ftc_enable_ajax_search.hide();

            search_string = jQuery.trim(jQuery(this).val());
            if (search_string.length < 2) {
                search_input.parents('.ftc_search_ajax').removeClass('loading');
                return;
            }

            if (search_cache_data[search_string]) {
                ftc_enable_ajax_search.html(search_cache_data[search_string]);
                ftc_enable_ajax_search.show();
                search_previous_string = '';
                search_input.parents('.ftc_search_ajax').removeClass('loading');

                ftc_enable_ajax_search.find('.view-all a').on('click', function(e) {
                    e.preventDefault();
                    search_input.parents('form').submit();
                });

                return;
            }

            clearTimeout(search_timeout);
            search_timeout = setTimeout(function() {
                if (search_string == search_previous_string || search_string.length < 2) {
                    return;
                }
                search_previous_string = search_string;
                search_input.parents('.ftc_search_ajax').addClass('loading');

                /* check category */
                var category = '';
                var select_category = search_input.parents('.ftc_search_ajax').siblings('.select-category');
                if (select_category.length > 0) {
                    category = select_category.find(':selected').val();
                }

                jQuery.ajax({
                    type: 'POST',
                    url: ftc_shortcode_params.ajax_uri,
                    data: {
                        action: 'ftc_ajax_search',
                        search_string: search_string,
                        category: category,
                        security: ftc_platform.ajax_nonce
                    },
                    error: function(xhr, err) {
                        search_input.parents('.ftc_search_ajax').removeClass('loading');
                    },
                    success: function(response) {
                        if (response != '') {
                            response = JSON.parse(response);
                            if (response.search_string == search_string) {
                                ftc_enable_ajax_search.html(response.html);
                                search_cache_data[search_string] = response.html;

                                ftc_enable_ajax_search.css({
                                    'position': 'absolute',
                                    'display': 'block',
                                    'z-index': '9999'
                                });

                                search_input.parents('.ftc_search_ajax').removeClass('loading');

                                ftc_enable_ajax_search.find('.view-all a').on('click', function(e) {
                                    e.preventDefault();
                                    search_input.parents('form').submit();
                                });
                            }
                        } else {
                            search_input.parents('.ftc_search_ajax').removeClass('loading');
                        }
                    }
                });
            }, 500);
        });

        ftc_enable_ajax_search.on('mouseenter', function() {}, function() { ftc_enable_ajax_search.show(); });

        jQuery('body').on('click', function() {
            ftc_enable_ajax_search.hide();
        });

        jQuery('.ftc-search-product select.select-category').on('change', function() {
            search_previous_string = '';
            search_cache_data = {};
            jQuery(this).parents('.ftc-search-product').find('.ftc_search_ajax input[name="s"]').trigger('keyup');
        });
    }
    /* Mobile Navigation */
    function ftc_open_menu() {
        var body = $('body');

        body.on("click", ".mobile-nav", function() {
            if (body.hasClass("has-mobile-menu")) {
                body.removeClass("has-mobile-menu");
            } else {
                body.addClass("has-mobile-menu");
            }
        });
        body.on("click", ".btn-toggle-canvas", function() {
            body.removeClass("has-mobile-menu");
        });
        body.on("click touchstart", ".ftc-close-popup", function() {
            body.removeClass("has-mobile-menu");
        });
    }
    ftc_open_menu();

    // FTC Owl slider
    $('.ftc-sb-blogs,.ftc-sb-brandslider,.ftc-product-slider,.ftc-list-category-slider,.ftc-product-time-deal').each(function() {
        var margin = $(this).data('margin');
        var columns = $(this).data('columns');
        var nav = $(this).data('nav') == 1;
        var auto_play = $(this).data('auto_play') == 1;
        var slider = $(this).data('slider') == 1;
        var desksmall_items = $(this).data('desksmall_items');
        var tabletmini_items = $(this).data('tabletmini_items');
        var tablet_items = $(this).data('tablet_items');
        var mobile_items = $(this).data('mobile_items');
        var mobilesmall_items = $(this).data('mobilesmall_items');

        if (slider) {
            var _slider_data = {
                loop: true,
                nav: nav,
                dots: false,
                navSpeed: 1000,
                navText: [, ],
                rtl: $('body').hasClass('rtl'),
                margin: margin,
                autoplay: auto_play,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                responsiveBaseElement: $('body'),
                responsiveRefreshRate: 400,
                responsive: {
                    0: {
                        items: mobilesmall_items
                    },
                    480: {
                        items: mobile_items
                    },
                    640: {
                        items: tabletmini_items
                    },
                    768: {
                        items: tablet_items
                    },
                    991: {
                        items: desksmall_items
                    },
                    1199: {
                        items: columns
                    }
                },
                onInitialized: function() {
                    $(this).addClass('loaded').removeClass('loading');
                }
            };
            $(this).find('.meta-slider > div').owlCarousel(_slider_data);
        }

    });

    // Woocommerce Quantity on GitHub
    $(document).on('click', '.plus, .minus', function() {

        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {

            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        // Trigger change event
        $qty.trigger('change');

    });

    if ($('.single-product').length > 0) {
        $('.single-product .product .thumbnails.loading').each(function() {
            $(this).find('.details_thumbnails').owlCarousel({
                loop: true,
                nav: true,
                navText: [, ],
                dots: false,
                navSpeed: 1000,
                rtl: $('body').hasClass('rtl'),
                margin: 16,
                autoplaySpeed: 1000,
                responsiveRefreshRate: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    100: {
                        items: 2
                    },
                    290: {
                        items: 3
                    }
                }
            });
        });
    }

    $('.single-product .related .products').each(function() {
        $(this).addClass('loaded').removeClass('loading');
        $(this).owlCarousel({
            loop: true,
            nav: false,
            navText: [, ],
            dots: false,
            navSpeed: 1000,
            slideBy: 1,
            rtl: jQuery('body').hasClass('rtl'),
            margin: 30,
            autoplayTimeout: 5000,
            responsiveRefreshRate: 400,
            responsive: {
                0: {
                    items: 2
                },
                640: {
                    items: 3
                },
                736: {
                    items: 3
                },
                800: {
                    items: 4
                },
                1400: {
                    items: 4
                }
            }
        });

    });


    $('.single-post .related-posts.loading .meta-slider .blogs').each(function() {
        $(this).addClass('loaded').removeClass('loading');
        $(this).owlCarousel({
            loop: true,
            nav: false,
            navText: [, ],
            dots: false,
            navSpeed: 1000,
            slideBy: 1,
            rtl: jQuery('body').hasClass('rtl'),
            margin: 30,
            autoplayTimeout: 5000,
            responsiveRefreshRate: 400,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 2
                },
                1400: {
                    items: 2
                }
            }
        });

    });


    $(document).on('click', '.widget_categories span.icon-toggle', function() {
        if (!$(this).parent().hasClass('active')) {
            $(this).parent().find('ul.children:first').slideDown(300);
            $(this).parent().addClass('active');
        } else {
            $(this).parent().find('ul.children').slideUp(300);
            $(this).parent().removeClass('active');
            $(this).parent().find('li.cat-parent').removeClass('active');
        }
    });
    $('.widget_categories li.current-cat').siblings('.icon-toggle').parents('ul.children').trigger('click').slideUp(300);

    $(document).on('click', '.widget-container.ftc-product-categories-widget .icon-toggle', function() {

        if (!$(this).parent().hasClass('active')) {
            $(this).parent().addClass('active');
            $(this).parent().find('ul.children:first').slideDown(300);
        } else {
            $(this).parent().find('ul.children').slideUp(300);
            $(this).parent().removeClass('active');
            $(this).parent().find('li.cat-parent').removeClass('active');
        }
    });

    $('.widget-container.ftc-product-categories-widget').each(function() {
        $(this).find('ul.children').parent('li').addClass('cat-parent');
        $(this).find('li.current').parents('ul.children').siblings('.icon-toggle').trigger('click');
    });


    $('.widget-title-wrapper a.block-control').on('click', function(e) {
        e.preventDefault();
        $(this).parent().siblings().slideToggle(400);
        $(this).toggleClass('active');
    });

    ftc_widget_on_off();


    $('form.woocommerce-ordering ul.orderby ul a').on('click', function(e) {
        e.preventDefault();
        if ($(this).hasClass('current')) {
            return;
        }
        $(this).closest('form.woocommerce-ordering').find('select.orderby').val($(this).attr('data-orderby'));
        $(this).closest('form.woocommerce-ordering').submit();
    });

    function ftc_slider_products_categorytabs_is_slider(element, show_nav, auto_play, columns, responsive, margin) {
        if (element.find('.products .ftc-products').length > 0) {
            show_nav = (show_nav == 1) ? true : false;
            auto_play = (auto_play == 1) ? true : false;
            columns = parseInt(columns);
            var _slider_data = {
                loop: true,
                nav: show_nav,
                navText: [, ],
                dots: false,
                navSpeed: 1000,
                slideBy: 1,
                rtl: $('body').hasClass('rtl'),
                margin: 0,
                navRewind: false,
                autoplay: auto_play,
                autoplayTimeout: 5000,
                autoplayHoverPause: false,
                autoplaySpeed: 1000,
                mouseDrag: true,
                touchDrag: true,
                responsiveBaseElement: $('body').find('.products'),
                responsiveRefreshRate: 400,
                responsive: {
                    0: {
                        items: 1
                    },
                    320: {
                        items: 2
                    },
                    470: {
                        items: 3
                    },
                    670: {
                        items: 4
                    },
                    870: {
                        items: 5
                    },
                    1100: {
                        items: columns
                    }
                },
                onInitialized: function() {

                }
            };

            if (responsive != undefined) {
                _slider_data.responsive = responsive;
            }

            if (margin != undefined) {
                _slider_data.margin = margin;
            }

            element.find('.products').owlCarousel(_slider_data);
        }
    }

    var ftc_type_of_products_data = [];

    $('.ftc-products-category .row-tabs .tab-item').on('click', function() {
        /* Tab */
        if ($(this).hasClass('current') || $(this).parents('.ftc-products-category').find('.row-content').hasClass('loading')) {
            return;
        }
        $(this).parents('.ftc-products-category').find('.row-tabs .tab-item').removeClass('current');
        $(this).addClass('current')

        var element = $(this).parents('.ftc-products-category');
        var atts = element.data('atts');
        var margin = 30;
        var responsive = {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            900: {
                items: 3
            },
            1000: {
                items: atts.columns
            }
        };
        if (ftc_type_of_products_data[$(this).parents('.ftc-products-category').attr('id')] != undefined) {
            if (typeof ftc_quickshop_process_action == 'function') {
                ftc_quickshop_process_action();
            }
            $(this).parents('.ftc-products-category').find('.lazy-loading img').each(function() {
                if ($(this).data('src')) {
                    $(this).attr('src', $(this).data('src'));
                }
            });
            $(this).parents('.ftc-products-category').find('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
        }
        $(this).parents('.ftc-products-category').find('.row-content').addClass('loading');

        $.ajax({
            type: "POST",
            timeout: 30000,
            url: ftc_shortcode_params.ajax_uri,
            data: {
                action: 'ftc_get_product_content_in_category_tab_2',
                atts: atts,
                product_cat: $(this).data('product_cat'),
                security: ftc_platform.ajax_nonce
            },
            error: function(xhr, err) {},
            success: function(response) {
                if (response) {
                    element.find('.column-products .products.owl-carousel').owlCarousel('destroy');
                    element.find('.row-content > div').remove();
                    element.find('.row-content').append(response);
                    if (typeof ftc_quickshop_process_action == 'function') {
                        ftc_quickshop_process_action();
                    }
                    ftc_countdown(element.find('.product .counter-wrapper'));
                    ftc_slider_products_categorytabs_is_slider(element, atts.show_nav, atts.auto_play, atts.columns, responsive, margin);
                }
                element.find('.row-content').removeClass('loading');
            }
        });
    });

    $('.ftc-products-category').each(function() {
        var current_tab = 1;
        var count_tab = $(this).find('.row-tabs .tab-item').length;
        var atts = $(this).data('atts');
        if (atts.current_tab != undefined) {
            var defined_current_tab = parseInt(atts.current_tab);
            if (defined_current_tab > 1 && defined_current_tab <= count_tab) {
                current_tab = defined_current_tab;
            }
        }

        $(this).find('.row-tabs .tab-item').eq(current_tab - 1).trigger('click');
    });

    $(document).on('change', '#ftc_dont_show_again', function() {
        if ($(this).is(':checked')) {
            $.cookie("ftc_popup", 1, { expires: 24 * 60 * 60 * 1000 });
        }
    });

    function ftc_countdown(countdown) {
        if (countdown.length > 0) {
            var interval = setInterval(function() {
                countdown.each(function(index, countdown) {
                    var day = 0;
                    var hour = 0;
                    var minute = 0;
                    var second = 0;

                    var delta = 0;
                    var time_day = 60 * 60 * 24;
                    var time_hour = 60 * 60;
                    var time_minute = 60;

                    $(countdown).find('.days .number-wrapper .number').each(function(i, e) {
                        day = parseInt($(e).text());
                    });
                    $(countdown).find('.hours .number-wrapper .number').each(function(i, e) {
                        hour = parseInt($(e).text());
                    });
                    $(countdown).find('.minutes .number-wrapper .number').each(function(i, e) {
                        minute = parseInt($(e).text());
                    });
                    $(countdown).find('.seconds .number-wrapper .number').each(function(i, e) {
                        second = parseInt($(e).text());
                    });

                    if (day != 0 || hour != 0 || minute != 0 || second != 0) {
                        delta = (day * time_day) + (hour * time_hour) + (minute * time_minute) + second;
                        delta--;

                        day = Math.floor(delta / time_day);
                        delta -= day * time_day;

                        hour = Math.floor(delta / time_hour);
                        delta -= hour * time_hour;

                        minute = Math.floor(delta / time_minute);
                        delta -= minute * time_minute;

                        if (delta > 0) {
                            second = delta;
                        } else {
                            second = '0';
                        }

                        day = (day < 10) ? ftc_start_number_timer(day, 2) : day.toString();
                        hour = (hour < 10) ? ftc_start_number_timer(hour, 2) : hour.toString();
                        minute = (minute < 10) ? ftc_start_number_timer(minute, 2) : minute.toString();
                        second = (second < 10) ? ftc_start_number_timer(second, 2) : second.toString();

                        $(countdown).find('.days .number-wrapper .number').each(function(i, e) {
                            $(e).text(day);
                        });

                        $(countdown).find('.hours .number-wrapper .number').each(function(i, e) {
                            $(e).text(hour);
                        });

                        $(countdown).find('.minutes .number-wrapper .number').each(function(i, e) {
                            $(e).text(minute);
                        });

                        $(countdown).find('.seconds .number-wrapper .number').each(function(i, e) {
                            $(e).text(second);
                        });
                    }

                });
            }, 1000);
        }
    }


    ftc_countdown($('.product .counter-wrapper, .ftc-countdown .counter-wrapper'));

    function ftc_start_number_timer(str, max) {
        str = str.toString();
        return str.length < max ? ftc_start_number_timer('0' + str, max) : str;
    }


    //Testimonial Home 5

    $('.testimonial-h5 .ftc-sb-testimonial.ftc-slider').each(function() {
        var slider = true;
        if ($(this).find('.item').length <= 1) {
            slider = false;
        }

        if (slider) {
            var nav = $(this).data('nav') == 1;
            var dots = $(this).data('dots') == 1;
            var autoplay = $(this).data('autoplay') == 1;
            $(this).addClass('loaded').removeClass('loading');
            $(this).owlCarousel({
                items: 1,
                loop: true,
                nav: nav,
                dots: dots,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                navText: [, ],
                navSpeed: 1000,
                rtl: $('body').hasClass('rtl'),
                margin: 0,
                autoplay: autoplay,
                autoplayTimeout: 5000,
                center: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    }
                }
            });
        }
    });

    // Testimonial 

    $('.ftc-sb-testimonial.ftc-slider').each(function() {
        var slider = true;
        if ($(this).find('.item').length <= 1) {
            slider = false;
        }

        if (slider) {
            var nav = $(this).data('nav') == 1;
            var dots = $(this).data('dots') == 1;
            var autoplay = $(this).data('autoplay') == 1;
            $(this).addClass('loaded').removeClass('loading');
            $(this).owlCarousel({
                items: 1,
                loop: true,
                nav: nav,
                dots: dots,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                navText: [, ],
                navSpeed: 1000,
                rtl: $('body').hasClass('rtl'),
                margin: 0,
                autoplay: autoplay,
                autoplayTimeout: 5000,
                center: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    }
                }
            });
        }
    });


    function ftc_googlemap_start_up(map_content_obj, address, zoom, map_type, title) {
        var geocoder, map;
        geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var _ret_array = new Array(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    title: title,
                    position: results[0].geometry.location
                });
            }
        });

        var mapCanvas = map_content_obj.get(0);
        var mapOptions = {
            center: new google.maps.LatLng(44.5403, -78.5463),
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId[map_type],
            scrollwheel: false,
            zoomControl: true,
            panControl: true,
            scaleControl: true,
            streetViewControl: false,
            overviewMapControl: true,
            disableDoubleClickZoom: false
        }
        map = new google.maps.Map(mapCanvas, mapOptions)
    }

    $(window).on('load resize', function() {
        $('.google-map-container').each(function() {
            var element = $(this);
            var map_content = $(this).find('> div');
            var address = element.data('address');
            var zoom = element.data('zoom');
            var map_type = element.data('map_type');
            var title = element.data('title');
            ftc_googlemap_start_up(map_content, address, zoom, map_type, title);
        });
    });


    $('.ftc-product-items-widget.ftc-slider').each(function() {
        var nav = $(this).data('nav') == 1;
        var auto_play = $(this).data('auto_play') == 1;
        var columns = $(this).data('columns');
        var margin = $(this).data('margin');

        $(this).owlCarousel({
            loop: true,
            items: 1,
            nav: nav,
            navText: [, ],
            dots: false,
            navSpeed: 1000,
            slideBy: 1,
            rtl: $('body').hasClass('rtl'),
            navRewind: false,
            columns: columns,
            margin: margin,
            autoplay: auto_play,
            autoplayTimeout: 5000,
            responsiveRefreshRate: 1000,
            responsive: {
                0: {
                    items: columns
                }
            }
        });
    });

    function ftc_update_information_tini_wishlist() {
        if (typeof ftc_shortcode_params.ajax_uri == 'undefined') {
            return;
        }
        var wishlist = jQuery('.ftc-my-wishlist');
        if (wishlist.length == 0) {
            return;
        }

        wishlist.addClass('loading');
        jQuery.ajax({
            type: 'POST',
            url: ftc_shortcode_params.ajax_uri,
            data: {
                action: 'update_tini_wishlist',
                security: ftc_platform.ajax_nonce
            },
            success: function(response) {
                var first_icon = wishlist.children('i.fa:first');
                wishlist.html(response);
                if (first_icon.length > 0) {
                    wishlist.prepend(first_icon);
                }
                wishlist.removeClass('loading');
            }
        });
    }
    $('body').on('added_to_wishlist', function() {
        ftc_update_information_tini_wishlist();
        $('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').closest('.yith-wcwl-add-to-wishlist').addClass('added');
    });
    $(document).on('click', '#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button', function() {
        var old_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
        var count = 1;
        var time_interval = setInterval(function() {
            count++;
            var new_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
            if (old_num_product != new_num_product || count == 20) {
                clearInterval(time_interval);
                ftc_update_information_tini_wishlist();
            }
        }, 500);
    });

    function ftc_quickshop_process_action() {
        jQuery('a.quickview').prettyPhoto({
            deeplinking: false,
            opacity: 0.9,
            social_tools: false,
            default_width: 900,
            default_height: 450,
            theme: 'pp_woocommerce',
            changepicturecallback: function() {
                jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
                jQuery('.pp_inline').find('form.variations_form .variations select').change();
                jQuery('body').trigger('wc_fragments_loaded');

                jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function() {
                    jQuery(this).closest('.variations').find('.ftc-product-attribute .option').removeClass('selected');
                });

                jQuery('.pp_woocommerce').addClass('loaded');

                var _this = jQuery('.ftc-quickshop-wrapper .images-slider-wrapper');

                if (_this.find('.image-item').length <= 1) {
                    return;
                }

                var owl = _this.find('.image-items').owlCarousel({
                    items: 1,
                    loop: true,
                    nav: true,
                    navText: [, ],
                    dots: false,
                    navSpeed: 1000,
                    slideBy: 1,
                    rtl: jQuery('body').hasClass('rtl'),
                    margin: 10,
                    navRewind: false,
                    autoplay: false,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: false,
                    autoplaySpeed: false,
                    mouseDrag: true,
                    touchDrag: true,
                    responsiveBaseElement: _this,
                    responsiveRefreshRate: 1000,
                    onInitialized: function() {
                        _this.addClass('loaded').removeClass('loading');
                    }
                });

            }
        });

    }
    ftc_quickshop_process_action();

    function ftc_widget_on_off() {
        if (typeof ftc_shortcode_params._ftc_enable_responsive != 'undefined' && !ftc_shortcode_params._ftc_enable_responsive) {
            return;
        }
        jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control, .footer-container .widget-title-wrapper a.block-control').remove();
        var window_width = jQuery(window).width();
        window_width += ftc_take_width_of_scrollbar();

        if (window_width >= 991) {
            jQuery(".widget-title-wrapper a.block-control").removeClass("active").hide();
            jQuery(".widget-title-wrapper a.block-control").parent().siblings().show();
        } else if (window_width < 991 && window_width > 740) {
            jQuery(".widget-title-wrapper a.block-control").removeClass("active").show();
            jQuery(".widget-title-wrapper a.block-control").parent().siblings().show();
            jQuery(".archive .widget-title-wrapper a.block-control").addClass("active").show();
            jQuery(".archive .widget-title-wrapper a.block-control").parent().siblings().show();
        } else {
            jQuery(".widget-title-wrapper a.block-control").removeClass("active").show();
            jQuery(".widget-title-wrapper a.block-control").parent().siblings().hide();
            jQuery(".archive .widget-title-wrapper a.block-control").addClass("active").show();
            jQuery(".archive .widget-title-wrapper a.block-control").parent().siblings().show();
            jQuery('.site-footer .wpb_widgetised_column .widget-title-wrapper, .footer-container .widget-title-wrapper').siblings().show();
            jQuery('.site-content .wpb_widgetised_column .widget-title-wrapper').siblings().hide();
        }
    }



    function ftc_take_width_of_scrollbar() {
        var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
            $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
            inner = $inner[0],
            outer = $outer[0];

        jQuery('body').append(outer);
        var width1 = inner.offsetWidth;
        $outer.css('overflow', 'scroll');
        var width2 = outer.clientWidth;
        $outer.remove();

        return (width1 - width2);
    }

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $(".header-content").addClass("header-sticky-hide");
        } else {
            $(".header-content").removeClass("header-sticky-hide");
        }
    });
    "use strict";
    if ($('html').offset().top < 100) {
        $("#to-top").hide().addClass("off");
    }
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $("#to-top").removeClass("off").addClass("on");
        } else {
            $("#to-top").removeClass("on").addClass("off");
        }
    });
    $('#to-top .scroll-button').on('click', function() {
        $('body,html').animate({
            scrollTop: '0px'
        }, 1000);
        return false;
    });

    function ftc_cloud_zoom() {
        jQuery('.cloud-zoom-wrap .cloud-zoom-big').remove();
        jQuery('.cloud-zoom, .cloud-zoom-gallery').unbind('click');
        var clz_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').width();
        var clz_img_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').children('img').width();
        var cl_zoom = jQuery('.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
        var temp = (clz_width - clz_img_width) / 2;
        if (cl_zoom.length > 0) {
            cl_zoom.data('zoom', null).siblings('.mousetrap').unbind().remove();
            // cl_zoom.CloudZoom({ 
            //     adjustX:temp    
            // });
        }
    }

    ftc_cloud_zoom();
    if ($('.cloud-zoom, .cloud-zoom-gallery').length > 0) {
        $('form.variations_form').on('found_variation', function(event, variation) {
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});
        }).on('reset_image', function() {
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});
        });
    }

    if ($(window).width() < 991) {
        $('.ftc-header-template .header-content').removeClass("header-sticky");
    }

    if ($(window).width() > 991) {
        $('.ftc-header-template .header-mobile').remove();
    }

    /*smart Menu*/

    if ($("body").hasClass("mega-menu-primary")) {
        $('#main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8
        });
    }
    $(".ftc_lightbox").on('click', function() {
        $("body").toggleClass("show-lightbox");

    });

    $('.swipebox').swipebox({
        useCSS: true, // false will force the use of jQuery for animations
        useSVG: true, // false to force the use of png for buttons
        initialIndexOnArray: 0, // which image index to init when a array is passed
        hideCloseButtonOnMobile: false, // true will hide the close button on mobile devices
        removeBarsOnMobile: true, // false will show top bar on mobile devices
        hideBarsDelay: 3000, // delay before hiding bars on desktop
        videoMaxWidth: 1140, // videos max width
        beforeOpen: function() {}, // called before opening
        afterOpen: null, // called after opening
        afterClose: function() {}, // called after closing
        loopAtEnd: false // true will return to the first image after the last image is reached 
    });
    $('.details-img').imagesLoaded(function() {
        $(".details_thumbnails li a").on('click', function() {
            var changeSrc = $(this).attr("href");
            $(".attachment-shop_single.size-shop_single").attr("src", changeSrc);
            $(".ftc_lightbox .swipebox").attr("href", changeSrc);
            $(".images .woocommerce-product-gallery__image a.swipebox").attr("href", changeSrc);
            return false;
        });
    });

    function hide_filter() {
        var con = $(".woocommerce .ftc-sidebar");
        if (con.length) {
            con
                .parent()
                .find("#primary")
                .addClass("hide-filter");
        }
    }
    hide_filter();


    // filter by

    $('.button-sidebar').on('click', function() {
        $('body').toggleClass("sidebar-show");
        $('.button-sidebar').toggleClass('active');
        $('.archive .ftc-sidebar').toggleClass("shownow");

        $('body').on("click", ".ftc-close-popup", function() {
            $('.archive .ftc-sidebar').removeClass('shownow');
            $('body').removeClass("sidebar-show");
            $('.button-sidebar').removeClass('active');
        });
        return false;
    });
    $('.ftc-header-template .ftc_login .login-text, .ftc_login a.login').on('click', function(e) {
        $('body').addClass("show-form-login");
        $('body').on("click", ".ftc-header-login-overlay", function() {
            $('body').removeClass('show-form-login');
        });
        event.preventDefault();
    });
    $('.ftc-header-template .ftc-search .search-button, .header-ftc .ftc-search .search-button').on('click', function() {
        $('body').addClass("show-form-search");
        $('body').on("click", ".close-search", function() {
            $('body').removeClass('show-form-search');
        });
        $('body').on("click", ".ftc-close-popup-search", function() {
            $('body').removeClass('show-form-search');
        });
    });

    // filter by
    if ($(window).width() < 768) {
        $('.widget-container.widget_text .widget-title, .widget-container.widget_text a').on('click', function() {
            $('.widget-container.widget_text').toggleClass('active');
            $('.widget-container.widget_layered_nav, .widget-container.widget_price_filter').slideToggle("fast");
            return false;
        });
    }

    if ($(window).width() < 768) {
        $('.widget-container.widget_price_filter a.block-control').on('click', function() {
            $('.widget_price_filter .widget-title').toggleClass('line');
        });
    }


    var top_spacing = 0;
    if (jQuery(window).width() > 300) {
        if (
            jQuery("body").hasClass("logged-in") &&
            jQuery("body").hasClass("admin-bar")
        ) {
            top_spacing = 30;
        }
        var top_begin = jQuery("header.site-header").height() + 30;

        setTimeout(function() {
            jQuery(".header-sticky").sticky({
                topSpacing: top_spacing,
                topBegin: top_begin
            });
        }, 200);
        var old_scroll_top = 0;
        var extra_space = 100 + top_spacing + top_begin;
        jQuery(window).scroll(function() {
            if (jQuery(".is-sticky").length > 0) {
                var scroll_top = jQuery(this).scrollTop();
                if (scroll_top > old_scroll_top && scroll_top > extra_space) {
                    /* Scroll Down */
                    jQuery(".header-sticky").addClass("header-sticky-hide");

                } else {
                    /* Scroll Up */

                    if (jQuery(".header-sticky").hasClass("header-sticky-hide")) {
                        jQuery(".header-sticky").removeClass("header-sticky-hide");
                    }
                }
                old_scroll_top = scroll_top;
            }
        });
    }

    $(".header-ftc-element .ftc-search:not(.ftc-search-click) button.search-button").on('click', function() {
        $(".ftc_search_ajax").slideToggle("fast");
    });

    /*element-gallery*/
    $('.ftc-product').each(function() {
        jQuery('.ftc-product .ftc-thumbnails-gallery ul li span').mouseenter(function(event) {
            jQuery('.selected').removeClass('selected');
            jQuery(this).addClass('selected');
            jQuery(this).closest('.ftc-product').find('.images a .cover_image').addClass('active');
            var changeSrc = jQuery(this).find('img').attr("src");
            jQuery("a .cover_image.active .attachment-shop_catalog").attr("srcset", changeSrc).fadeIn(300);
            event.preventDefault();
        });

        jQuery(".ftc-product .ftc-thumbnails-gallery ul li span").mouseleave(function() {
            jQuery("a .cover_image.active .attachment-shop_catalog").attr("srcset", '').fadeIn(300);
            jQuery(this).closest('.ftc-product').find('.images a .cover_image').removeClass('active');
        });

    });

    var tabs = $('.woocommerce-tabs.accordion-tabs');
    tabs.each(function() {

        var $_Tabs = $(this); // Single tabs holder

        var tabsWrapper = $_Tabs.find('ul.tabs-nav'),
            tabTitles = tabsWrapper.find('.tab-title'),
            content = tabsWrapper.find('.tab-content');

        $('.tab-1').addClass('active');
        $(document).on('click', '.tab-title', function(event) {
            $(this).addClass('active');
            $(this).siblings().removeClass('active');

            // Hide inactive tab titles and show active one and content
            var tab = $(this).data('tab');
            content.not('.tab-' + tab).css('display', 'none').removeClass('active');
            tabsWrapper.find('.tab-content.tab-' + tab).addClass('active').css('display', 'block');
        });

    });

    $(document).ready(function() {
        $('ul.yith-wcan li').on('click', function() {
            $(this).addClass('chosen');
        });
    });


})(jQuery);