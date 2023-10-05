<?php 
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array(
	'0'	=> esc_html__('Default', 'lolo')
);
foreach( $ftc_default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

$options[] = array(
	'id'		=> 'prod_layout_heading'
	,'label'	=> esc_html__('Product Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_layout'
	,'label'	=> esc_html__('Product Layout', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0'			=> esc_html__('Default', 'lolo')
		,'0-1-0'  	=> esc_html__('Fullwidth', 'lolo')
		,'1-1-0' 	=> esc_html__('Left Sidebar', 'lolo')
		,'0-1-1' 	=> esc_html__('Right Sidebar', 'lolo')
		,'1-1-1' 	=> esc_html__('Left & Right Sidebar', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'prod_left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'prod_right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'prod_custom_tab_heading'
	,'label'	=> esc_html__('Custom Tab', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_custom_tab'
	,'label'	=> esc_html__('Custom Tab', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0'		=> esc_html__('Default', 'lolo')
		,'1'	=> esc_html__('Override', 'lolo')
	)
);

$options[] = array(
	'id'		=> 'prod_custom_tab_title'
	,'label'	=> esc_html__('Custom Tab Title', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'prod_custom_tab_content'
	,'label'	=> esc_html__('Custom Tab Content', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'textarea'
);

$options[] = array(
	'id'		=> 'prod_breadcrumb_heading'
	,'label'	=> esc_html__('Breadcrumbs', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);
$options[] = array(
	'id' => 'prod_size_chart_heading'
	,'label' => esc_html__('Product Size Chart', 'lolo')
	,'desc' => ''
	,'type' => 'heading'
);

$options[] = array(
	'id' => 'prod_size_chart'
	,'label' => esc_html__('Size Chart Image', 'lolo')
	,'desc' => esc_html__('You can upload size chart image for all product on Theme Option', 'lolo')
	,'type' => 'upload'
);
$options[] = array(
	'id'		=> 'prod_video_heading'
	,'label'	=> esc_html__('Video', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_video_url'
	,'label'	=> esc_html__('Video URL', 'lolo')
	,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'lolo')
	,'type'		=> 'text'
);		
?>