<?php 
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array(
	'0'	=> esc_html__('Default', 'lolo')
);
$options[] = array(
	'id'		=> 'prod_custom_tab'
	,'label'	=> esc_html__('Loại chi tiết', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0'		=> esc_html__('Chung', 'lolo')
		,'1'	=> esc_html__('Riêng', 'lolo')
	),
	'default'   => 1,
);

$options[] = array(
	'id'		=> 'prod_custom_tab_content'
	,'label'	=> esc_html__('Chi tiết sản phẩm', 'lolo')
	,'desc'		=> ''
	,'type'		=> 'textarea'
);
?>