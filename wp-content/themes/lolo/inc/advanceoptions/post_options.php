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
				'id'		=> 'post_layout_heading'
				,'label'	=> esc_html__('Post Layout', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);
			
$options[] = array(
				'id'		=> 'post_layout'
				,'label'	=> esc_html__('Post Layout', 'lolo')
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
				'id'		=> 'post_left_sidebar'
				,'label'	=> esc_html__('Left Sidebar', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'post_right_sidebar'
				,'label'	=> esc_html__('Right Sidebar', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> $sidebar_options
			);
			
$options[] = array(
				'id'		=> 'bg_breadcrumbs'
				,'label'	=> esc_html__('Breadcrumb Background Image', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'upload'
			);
			
$options[] = array(
				'id'		=> 'post_audio_heading'
				,'label'	=> esc_html__('Post Audio', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);	
			
$options[] = array(
				'id'		=> 'audio_url'
				,'label'	=> esc_html__('Audio URL', 'lolo')
				,'desc'		=> esc_html__('Enter MP3, OGG, WAV file URL or SoundCloud URL', 'lolo')
				,'type'		=> 'text'
			);

$options[] = array(
				'id'		=> 'post_video_heading'
				,'label'	=> esc_html__('Post Video', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'heading'
			);			
			
$options[] = array(
				'id'		=> 'video_url'
				,'label'	=> esc_html__('Video URL', 'lolo')
				,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'lolo')
				,'type'		=> 'text'
			);			
?>