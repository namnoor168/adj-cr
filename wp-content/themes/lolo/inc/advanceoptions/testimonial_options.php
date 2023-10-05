<?php 
$options = array();

$options[] = array(
				'id'		=> 'gravatar_email'
				,'label'	=> esc_html__('Gravatar Email Address', 'lolo')
				,'desc'		=> esc_html__('Enter in an e-mail address, to use a Gravatar, instead of using the "Featured Image". You have to remove the "Featured Image".', 'lolo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'byline'
				,'label'	=> esc_html__('Byline', 'lolo')
				,'desc'		=> esc_html__('Enter a byline for the customer giving this testimonial (for example: "CEO of ThemeFTC").', 'lolo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'url'
				,'label'	=> esc_html__('URL', 'lolo')
				,'desc'		=> esc_html__('Enter a URL that applies to this customer (for example: http://themeftc.com/).', 'lolo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'rating'
				,'label'	=> esc_html__('Rating', 'lolo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
						'-1'	=> esc_html__('no rating', 'lolo')
						,'0'	=> esc_html__('0 star', 'lolo')
						,'0.5'	=> esc_html__('0.5 star', 'lolo')
						,'1'	=> esc_html__('1 star', 'lolo')
						,'1.5'	=> esc_html__('1.5 star', 'lolo')
						,'2'	=> esc_html__('2 stars', 'lolo')
						,'2.5'	=> esc_html__('2.5 stars', 'lolo')
						,'3'	=> esc_html__('3 stars', 'lolo')
						,'3.5'	=> esc_html__('3.5 stars', 'lolo')
						,'4'	=> esc_html__('4 stars', 'lolo')
						,'4.5'	=> esc_html__('4.5 stars', 'lolo')
						,'5'	=> esc_html__('5 stars', 'lolo')
				)
			);
?>