<?php
/******  Woo shortcodes  ******/
function ftc_remove_product_hooks_shortcode( $options = array() ){
	if( isset($options['show_image']) && !$options['show_image'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'ftc_template_loop_product_thumbnail', 10);
	}
	if( isset($options['show_title']) && !$options['show_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
	}
	if( isset($options['show_sku']) && !$options['show_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_sku', 30);
	}
	if( isset($options['show_price']) && !$options['show_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
	}
	if( isset($options['show_short_desc']) && !$options['show_short_desc'] ){
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_short_description', 40);
	}
	if( isset($options['show_rating']) && !$options['show_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 60);
	}
	if( isset($options['show_label']) && !$options['show_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_product_label', 1);
	}
	if( isset($options['show_categories']) && !$options['show_categories'] ){
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_categories', 10);
	}
	if( isset($options['show_add_to_cart']) && !$options['show_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_add_to_cart', 70);
		remove_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_add_to_cart', 10001 );
	}
}

function ftc_restore_product_hooks_shortcode(){
	add_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_product_label', 1);
	add_action('woocommerce_before_shop_loop_item_title', 'ftc_template_loop_product_thumbnail', 10);

	add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_categories', 10);
	add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_title', 20);
	add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_product_sku', 30);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 60);
	add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_short_description', 40); 
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
	add_action('woocommerce_after_shop_loop_item', 'ftc_template_loop_add_to_cart', 70); 
	add_action('woocommerce_after_shop_loop_item_title', 'ftc_template_loop_add_to_cart', 10001 );
}
if( !function_exists('ftc_template_loop_time_deals') ){
	function ftc_template_loop_time_deals(){
		global $product;
		$date_to = '';
		$date_from = '';
		if( $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				foreach( $children as $children_id ){
					$date_to = get_post_meta($children_id, '_sale_price_dates_to', true);
					$date_from = get_post_meta($children_id, '_sale_price_dates_from', true);
					if( $date_to != '' ){
						break;
					}
				}
			}
		}
		else{
			$date_to = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
			$date_from = get_post_meta($product->get_id(), '_sale_price_dates_from', true);
		}

		$current_time = current_time('timestamp', true);

		if( $date_to == '' || $date_from == '' || $date_from > $current_time || $date_to < $current_time ){
			return;
		}

		$delta = $date_to - $current_time;

		$time_day = 60 * 60 * 24;
		$time_hour = 60 * 60;
		$time_minute = 60;

		$day = floor( $delta / $time_day );
		$delta -= $day * $time_day;

		$hour = floor( $delta / $time_hour );
		$delta -= $hour * $time_hour;

		$minute = floor( $delta / $time_minute );
		$delta -= $minute * $time_minute;

		if( $delta > 0 ){
			$second = $delta;
		}
		else{
			$second = 0;
		}

		$day = zeroise($day, 2);
		$hour = zeroise($hour, 2);
		$minute = zeroise($minute, 2);
		$second = zeroise($second, 2);

		?>
		<div class="counter-wrapper days-<?php echo strlen($day); ?>">
			<div class="days">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($day); ?></span>
					<span class="number-bor"></span>
				</div>
				<div class="countdown-meta">
					<?php esc_html_e('Days', 'themeftc'); ?>
				</div>
			</div>
			<div class="hours">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($hour); ?></span>
				</div>
				<div class="countdown-meta">
					<?php esc_html_e('Hours', 'themeftc'); ?>
				</div>
			</div>
			<div class="minutes">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($minute); ?></span>
				</div>
				<div class="countdown-meta">
					<?php esc_html_e('Mins', 'themeftc'); ?>
				</div>
			</div>
			<div class="seconds">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($second); ?></span>
				</div>
				<div class="countdown-meta">
					<?php esc_html_e('Secs', 'themeftc'); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

function ftc_filter_product_by_product_type( &$args = array(), $product_type = 'recent' ){
	switch( $product_type ){
		case 'sale':
		$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
		case 'featured':
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		);
		break;
		case 'best_selling':
		$args['meta_key'] 	= 'total_sales';
		$args['orderby'] 	= 'meta_value_num';
		$args['order'] 		= 'desc';
		break;
		case 'top_rated':
		$args['meta_key'] = '_wc_average_rating';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';			
		break;
		case 'mixed_order':
		$args['orderby'] 	= 'rand';
		break;
		default: /* Recent */
		$args['orderby'] 	= 'date';
		$args['order'] 		= 'desc';
		break;
	}
}



/* Shortcode SoundCloud */
if( !function_exists('ftc_soundcloud_shortocde') ){
	function ftc_soundcloud_shortocde( $atts, $content ){
		extract(shortcode_atts(array(
			'params'		=> "color=ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"
			,'url'			=> ''
			,'width'		=> '100%'
			,'height'		=> '166'
			,'iframe'		=> 1
		),$atts));

		$atts = compact( 'params', 'url', 'width', 'height', 'iframe' );

		if( $iframe ){
			return ftc_soundcloud_iframe_widget( $atts );
		}
		else{ 
			return ftc_soundcloud_flash_widget( $atts );
		}
	}
}
add_shortcode('ftc_soundcloud','ftc_soundcloud_shortocde');


function ftc_soundcloud_iframe_widget($options) {
	$url = 'https://w.soundcloud.com/player/?url=' . $options['url'] . '&' . $options['params'];
	$unique_class = 'ftc-soundcloud-'.rand();
	$style = '.'.$unique_class.' iframe{width: '.$options['width'].'; height:'.$options['height'].'px;}';
	$style = '<style type="text/css" scoped>'.$style.'</style>';
	return '<div class="ftc-soundcloud '.$unique_class.'">'.$style.'<iframe src="'.esc_url( $url ).'"></iframe></div>';
}

function ftc_soundcloud_flash_widget( $options ){
	$url = 'https://player.soundcloud.com/player.swf?url=' . $options['url'] . '&' . $options['params'];

	return preg_replace('/\s\s+/', '', sprintf('<div class="ftc-soundcloud"><object width="%s" height="%s">
		<param name="movie" value="%s"></param>
		<param name="allowscriptaccess" value="always"></param>
		<embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
		</object></div>', $options['width'], $options['height'], esc_url( $url ), $options['width'], $options['height'], esc_url( $url )));
}

/* Shortcode Video - Support Youtube and Vimeo video */
if( !function_exists('ftc_video_shortcode') ){
	function ftc_video_shortcode($atts){
		extract( shortcode_atts(array(
			'src' 		=> '',
			'height' 	=> '450',
			'width' 	=> '800'
		), $atts
	));
		if( $src == '' ){
			return;
		}

		$extra_class = '';
		if( !isset($atts['height']) || !isset($atts['width']) ){
			$extra_class = 'auto-size';
		}

		$src = ftc_parse_video_link($src);
		ob_start();
		?>
		<div class="ftc-video <?php echo esc_attr($extra_class); ?>" style="height:<?php echo esc_attr($height) ?>px;">
			<iframe width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($src); ?>" allowfullscreen></iframe>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ftc_video', 'ftc_video_shortcode');

if( !function_exists('ftc_parse_video_link') ){
	function ftc_parse_video_link( $video_url ){
		if( strstr($video_url, 'youtube.com') || strstr($video_url, 'youtu.be') ){
			preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
			if( count($match) >= 2 ){
				return '//www.youtube.com/embed/' . $match[1];
			}
		}
		elseif( strstr($video_url, 'vimeo.com') ){
			preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match);
			if( count($match) >= 2 ){
				return '//player.vimeo.com/video/' . $match[1];
			}
			else{
				$video_id = explode('/', $video_url);
				if( is_array($video_id) && !empty($video_id) ){
					$video_id = $video_id[count($video_id) - 1];
					return '//player.vimeo.com/video/' . $video_id;
				}
			}
		}
		return $video_url;
	}
}
 
?>