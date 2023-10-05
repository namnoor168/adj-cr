<?php
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array();
foreach( $ftc_default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

/* Get list menus */
$menus = array('0' => esc_html__('Default', 'lolo'));
$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
if( is_array($nav_terms) ){
	foreach( $nav_terms as $term ){
		$menus[$term->term_id] = $term->name;
	}
}

$options[] = array(
	'id'		=> 'page_layout_heading'
	,'label'	=> esc_html__('Page Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'layout_style'
	,'label'	=> esc_html__('Layout Style', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'lolo')
		,'boxed' 	=> esc_html__('Boxed', 'lolo')
		,'wide' 	=> esc_html__('Wide', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'page_layout'
	,'label'	=> esc_html__('Page Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0-1-0'  => esc_html__('Fullwidth', 'lolo')
		,'1-1-0' => esc_html__('Left Sidebar', 'lolo')
		,'0-1-1' => esc_html__('Right Sidebar', 'lolo')
		,'1-1-1' => esc_html__('Left & Right Sidebar', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'left_right_padding'
	,'label'	=> esc_html__('Left Right Padding', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'lolo')
		,'0'	=> esc_html__('No', 'lolo')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'full_page'
	,'label'	=> esc_html__('Full Page', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'lolo')
		,'0'	=> esc_html__('No', 'lolo')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'header_breadcrumb_heading'
	,'label'	=> esc_html__('Header - Breadcrumb', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'header_layout'
	,'label'	=> esc_html__('Header Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'lolo')
		,'layout1'  		=> esc_html__('Header Layout 1', 'lolo')
	)
);
$header_blocks = array('0' => '');

$args = array(
	'post_type'			=> 'ftc_header'
	,'post_status'	 	=> 'publish'
	,'posts_per_page' 	=> -1
);

$posts = new WP_Query($args);

if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
	foreach( $posts->posts as $p ){
		$header_blocks[$p->ID] = $p->post_title;
	}
}
$options[] = array(
	'id'		=> 'page_header_template'
	,'label'	=> esc_html__('Header Template', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $header_blocks
);


$options[] = array(
	'id'		=> 'header_transparent'
	,'label'	=> esc_html__('Transparent Header', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'lolo')
		,'0'	=> esc_html__('No', 'lolo')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'header_text_color'
	,'label'	=> esc_html__('Header Text Color', 'lolo')
	,'desc'		=> esc_html__('Only available on transparent header', 'lolo')
	,'type'		=> 'select'
	,'options'	=> array(
		'default'	=> esc_html__('Default', 'lolo')
		,'light'	=> esc_html__('Light', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'menu_id'
	,'label'	=> esc_html__('Primary Menu', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $menus
);

$options[] = array(
	'id'		=> 'show_page_title'
	,'label'	=> esc_html__('Show Page Title', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'lolo')
		,'0'	=> esc_html__('No', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'show_breadcrumb'
	,'label'	=> esc_html__('Show Breadcrumb', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'lolo')
		,'0'	=> esc_html__('No', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_layout'
	,'label'	=> esc_html__('Breadcrumb Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'lolo')
		,'v1'  		=> esc_html__('Breadcrumb Layout 1', 'lolo')
		,'v2' 		=> esc_html__('Breadcrumb Layout 2', 'lolo')
		,'v3' 		=> esc_html__('Breadcrumb Layout 3', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_bg_parallax'
	,'label'	=> esc_html__('Breadcrumb Background Parallax', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'lolo')
		,'1'		=> esc_html__('Yes', 'lolo')
		,'0'		=> esc_html__('No', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);	

$options[] = array(
	'id'		=> 'logo'
	,'label'	=> esc_html__('Logo', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo_mobile'
	,'label'	=> esc_html__('Mobile Logo', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo_sticky'
	,'label'	=> esc_html__('Sticky Logo', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'primary_color'
	,'label'	=> esc_html__('Primary Color', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'colorpicker'
);


$options[] = array(
	'id'		=> 'secondary_color'
	,'label'	=> esc_html__('Secondary Color', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'colorpicker'
);


$options[] = array(
	'id'	=>'body_font_google'
	,'label' => esc_html__('Body Font - Google Font', 'lolo')
	,'desc'	=> ''
	,'type' => 'text'
);

$options[] = array(
	'id'	=>'secondary_body_font_google'
	,'label' => esc_html__('Secondary Body Font - Google Font', 'lolo')
	,'desc'	=> ''
	,'type' => 'text'
);


if( !class_exists('Ftc_Demo') ){			
	$footer_blocks = array('0' => '');
	
	$args = array(
		'post_type'			=> 'ftc_footer'
		,'post_status'	 	=> 'publish'
		,'posts_per_page' 	=> -1
	);
	
	$posts = new WP_Query($args);
	
	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$footer_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();
	
	$options[] = array(
		'id'		=> 'page_footer_heading'
		,'label'	=> esc_html__('Page Footer', 'lolo')
		,'desc'		=> esc_html__('You also need to add the FTC - Footer widget into Footer widget', 'lolo')
		,'type'		=> 'heading'
	);

	$options[] = array(
		'id'		=> 'footer_center'
		,'label'	=> esc_html__('Footer Center', 'lolo')
		,'desc'		=> ''
		,'type'		=> 'select'
		,'options'	=> $footer_blocks
	);

	$options[] = array(
		'id'		=> 'footer_bottom'
		,'label'	=> esc_html__('Footer Bottom', 'lolo')
		,'desc'		=> ''
		,'type'		=> 'select'
		,'options'	=> $footer_blocks
	);
}
?>