<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_WC_Single_Product extends Widget_Base {

	public function get_name() {
		return 'ftc-single-product';
	}

	public function get_title() {
		return __( 'FTC - Single Product', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_my_custom',
			[
				'label' => esc_html__( 'FTC Single Product', 'ftc-element' ),
			]
		);

		$this->add_control(
			'post_name',
			[
				'label'   => esc_html__( 'Select a product', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => 3,
				'options' => apply_filters( 'ftc_posts_array', 'product' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout base', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'images_left',
				'options' => [
					'images_left'       => esc_html__( 'Image left', 'ftc-element' ),
					'images_right'      => esc_html__( 'Image right', 'ftc-element' ),
					'vertical'          => esc_html__( 'Vertical', 'ftc-element' ),
					'vertical_reversed' => esc_html__( 'Vertical reversed', 'ftc-element' ),
					'image_background'  => esc_html__( 'Featured image background', 'ftc-element' ),
					'no_image'          => esc_html__( 'No product image', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'img_format',
			[
				'label'   => esc_html__( 'Featured image format', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => apply_filters( 'ftc_elements_image_sizes', '' ),
			]
		);

		$this->add_control(
			'product_data',
			[
				'label'   => esc_html__( 'Product data', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'full',
				'options' => [
					'full'    => esc_html__( 'Full - single product page', 'ftc-element' ),
					'reduced' => esc_html__( 'Reduced - catalog product', 'ftc-element' ),
				],
			]
		);

		$this->add_control(
			'short_desc',
			[
				'label'     => esc_html__( 'Show "Product Short Description"', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ftc-element' ),
				'label_on'  => __( 'Yes', 'ftc-element' ),
				'default'   => 'yes',
				'condition' => [
					'product_data' => 'reduced',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_height',
			[
				'label'     => esc_html__( 'Product height', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_back_product_height',
			[
				'label'     => __( 'Product height', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '450',
				],
				'range'     => [
					'px' => [
						'max'  => 1600,
						'min'  => 0,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.single-product-container ' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'layout' => 'image_background',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Product info settings', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Product info background', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-summary' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Align product info', 'ftc-element' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .entry-summary' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .star-rating'   => 'float: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_box_position',
			[
				'label'      => esc_html__( 'Product info position', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .entry-summary' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label'      => esc_html__( 'Product info padding', 'ftc-element' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .entry-summary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'summary_width',
			[
				'label'     => __( 'Product info width (%)', 'elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 100,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .entry-summary' => 'width: {{VALUE}}%;',
				],
				'condition' => [
					'layout!' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'product_elements_spacing',
			[
				'label'     => __( 'Product info vertical spacing', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'max'  => 200,
						'min'  => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce div.single-product-container div.summary>*' => 'margin-top: {{SIZE}}px;margin-bottom: {{SIZE}}px;',
					'{{WRAPPER}} .woocommerce div.single-product-container div.summary form.cart >*' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_thumb_settings',
			[
				'label'     => __( 'Product image settings', 'ftc-element' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'no_image',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label'     => __( 'Image container width', 'elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 100,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'width: {{VALUE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_height',
			[
				'label'     => esc_html__( 'Image container height', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => '',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'layout!' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_as_back_height',
			[
				'label'     => esc_html__( 'Image container height', 'ftc-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 100,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'height: {{VALUE}}%;',
				],
				'condition' => [
					'layout' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'back_image_position',
			[
				'label'     => esc_html__( 'Image background position', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => [
					'left top'      => esc_html__( 'Top left', 'ftc-element' ),
					'center top'    => esc_html__( 'Top center', 'ftc-element' ),
					'right top'     => esc_html__( 'Top right', 'ftc-element' ),
					'left center'   => esc_html__( 'Center Left ', 'ftc-element' ),
					'center'        => esc_html__( 'Center', 'ftc-element' ),
					'right center'  => esc_html__( 'Center right ', 'ftc-element' ),
					'left bottom'   => esc_html__( 'Bottom left ', 'ftc-element' ),
					'center bottom' => esc_html__( 'Bottom center ', 'ftc-element' ),
					'right bottom'  => esc_html__( 'Bottom right ', 'ftc-element' ),
				],
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'background-position: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_size',
			[
				'label'     => esc_html__( 'Image background size', 'ftc-element' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => [
					'auto'    => esc_html__( 'Auto', 'ftc-element' ),
					'cover'   => esc_html__( 'Cover', 'ftc-element' ),
					'contain' => esc_html__( 'Contain', 'ftc-element' ),
					'custom'  => esc_html__( 'Custom', 'ftc-element' ),
				],
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'background-size: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'image_background',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_background_size_custom',
			[
				'label'     => esc_html__( 'Custom image size', 'ftc-element' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'max'       => 200,
				'step'      => 5,
				'selectors' => [
					'{{WRAPPER}} .product-thumb' => 'background-size: {{VALUE}}% !important;',
				],
				'condition' => [
					'layout'                => 'image_background',
					'thumb_background_size' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		/*
		 * SET OPTIONS FOR TITLE PRICE AND DESCRIPTION
		 */
		$this->start_controls_section(
			'section_title_price_desc',
			[
				'label' => __( 'Title, price, description options', 'ftc-element' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		// Title Options.
		$this->add_control(
			'heading_title',
			[
				'label'     => __( 'Title', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Title Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .entry-summary h3 a, {{WRAPPER}} .entry-summary h4 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .entry-summary h3, {{WRAPPER}} .entry-summary h4',
			]
		);

		// Price options.
		$this->add_control(
			'heading_price',
			[
				'label'     => __( 'Price', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => __( 'Price Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .entry-summary .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .entry-summary .price',
			]
		);
		// Description options.
		$this->add_control(
			'heading_desc',
			[
				'label'     => __( 'Short description', 'ftc-element' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => __( 'Short description Color', 'ftc-element' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .entry-summary .woocommerce-product-details__short-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => __( 'Typography', 'ftc-element' ),
				'selector' => '{{WRAPPER}} .entry-summary .woocommerce-product-details__short-description',
			]
		);

		$this->end_controls_section();

		//Plugin::$instance->controls_manager->add_custom_css_controls( $this );

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();

		$this->add_render_attribute( 'summary', 'class', $settings['align'] . ' summary entry-summary' );

		$post_name    = ! empty( $settings['post_name'] ) ? $settings['post_name'] : '';
		$layout       = ! empty( $settings['layout'] ) ? $settings['layout'] : 'images_left';
		$img_format   = ! empty( $settings['img_format'] ) ? $settings['img_format'] : 'thumbnail';
		$product_data = ! empty( $settings['product_data'] ) ? $settings['product_data'] : 'full';
		$short_desc   = ! empty( $settings['short_desc'] ) ? ( 'yes' === $settings['short_desc'] ) : '';

		if ( is_array( $post_name ) ) {
			$post_name = $post_name;
		} else {
			$post_name = array( $post_name );
		}

		global $post;

		$args = array(
			'posts_per_page'   => 1,
			'post_type'        => 'product',
			'no_found_rows'    => 1,
			'post_status'      => 'publish',
			'post_parent'      => 0,
			'suppress_filters' => false,
			'post_name__in'    => $post_name,
		);

		$product = get_posts( $args );

		if ( ! empty( $product ) ) {
			?>

			<div class="ftc-single-product woocommerce woocommerce-page">	

			<?php
			foreach ( $product as $post ) {
				setup_postdata( $post );
				?>

			<div <?php post_class( esc_attr( $layout . ' single-product-container' ) ); ?>>

				<?php
				$post_id = get_the_ID();

				if ( ( 'no_image' !== $layout ) && has_post_thumbnail( $post_id ) ) {

					$post_thumb_id = get_post_thumbnail_id( $post_id );
					$img_src       = wp_get_attachment_image_src( $post_thumb_id, $img_format );
					$img_url       = $img_src[0];

					echo '<div class="product-thumb" style="background-image: url( ' . esc_url( $img_url ) . ' );"></div>';
				}
				?>

				<div <?php echo $this->get_render_attribute_string( 'summary' ); ?>>
					<?php
					if ( 'full' == $product_data ) {
						// display full single prod. summary.
						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
						do_action( 'woocommerce_single_product_summary' );

					} else {
						// display price / short desc. / button.
						apply_filters( 'ftc_data_single_product', $short_desc );
					}
					?>

				</div>

			</div>

				<?php
			} // end foreach
			?>

			</div>

			<?php
		} // endif

		wp_reset_postdata();

	}

	// protected function content_template() {}

	// public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_WC_Single_Product() );
