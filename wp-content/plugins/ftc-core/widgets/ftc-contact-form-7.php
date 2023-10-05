<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_CF7_Forms extends Widget_Base {

	public function get_name() {
		return 'ftc-cf7-forms';
	}

	public function get_title() {
		return __( 'FTC - Contact Form 7 Forms', 'ftc-element' );
	}

	public function get_icon() {
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Contact Form 7', 'ftc-element' ),   //section name for controler view
			]
		);

		$this->add_control(
			'cf7_slug',
			[
				'label'       => esc_html__( 'Select Contact Form', 'ftc-element' ),
				'description' => esc_html__( 'Contact form 7 - Plugin must be installed' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => apply_filters( 'ftc_posts_array', 'wpcf7_contact_form' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
		$cf7_slug = $settings['cf7_slug'];

		if ( ! empty( $cf7_slug ) ) {

			if ( $post = get_page_by_path( $cf7_slug, OBJECT, 'wpcf7_contact_form' ) ) {
				$id = $post->ID;
			} else {
				$id = 0;
			}

			echo'<div class="ftc-contact-form">';

				echo do_shortcode( '[contact-form-7 id="' . $id . '"]' );

			echo '</div>';
		}

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_CF7_Forms() );
