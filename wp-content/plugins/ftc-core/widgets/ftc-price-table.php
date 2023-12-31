<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class Ftc_Pricing_Table extends Widget_Base {


    public function get_name() {
        return 'ftc-pricing-table';
    }

    public function get_title() {
        return esc_html__( 'FTC - Pricing Table', 'ftc-element' );
    }

    public function get_icon() {
        return 'ftc-icon';
    }

    public function get_categories() {
        return ['ftc-elements'];
    }


    protected function _register_controls() {

        /**
         * Pricing Table Settings
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_settings',
            [
                'label' => esc_html__( 'Settings', 'ftc-element' ),
            ]
        );

        $pricing_style = apply_filters(
            'ftc_pricing_table_styles',
            [
                'styles'     => [
                    'style-1' => esc_html__( 'Default', 'ftc-element' ),
                    'style-2' => esc_html__( 'Pricing Style 2', 'ftc-element' ),
                    'style-3' => esc_html__( 'Pricing Style 3', 'ftc-element' ),
                    'style-4' => esc_html__( 'Pricing Style 4', 'ftc-element' ),
                    'style-5' => esc_html__( 'Pricing Style 5', 'ftc-element' ),
                ],
                
            ]
        );

        $this->add_control(
            'ftc_pricing_table_style',
            [
                'label'       => esc_html__( 'Pricing Style', 'ftc-element' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'style-1',
                'label_block' => false,
                'options'     => $pricing_style['styles'],
            ]
        );



        do_action( 'ftc_pricing_table_after_pricing_style', $this );

        /**
         * Condition: 'ftc_pricing_table_featured' => 'yes'
         */
        $this->add_control(
            'ftc_pricing_table_icon_enabled',
            [
                'label'        => esc_html__( 'List Icon', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'show',
                'default'      => 'show',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_title',
            [
                'label'       => esc_html__( 'Title', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Startup', 'ftc-element' ),
            ]
        );

        /**
         * Condition: 'ftc_pricing_table_style' => 'style-2'
         */
        $subtitles_fields = apply_filters( 'pricing_table_subtitle_field_for', ['style-2'] );
        $this->add_control(
            'ftc_pricing_table_sub_title',
            [
                'label'       => esc_html__( 'Sub Title', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'A tagline here.', 'ftc-element' ),
                'condition'   => [
                    'ftc_pricing_table_style' => $subtitles_fields,
                ],
            ]
        );

        /**
         * Condition: 'ftc_pricing_table_style' => 'style-2'
         */
        $this->add_control(
            'ftc_pricing_table_style_2_icon_new',
            [
                'label'            => esc_html__( 'Icon', 'ftc-element' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'ftc_pricing_table_style_2_icon',
                'default'          => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'ftc_pricing_table_style' => apply_filters( 'ftc_pricing_table_icon_supported_style', ['style-2'] ),
                ],
            ]
        );

        do_action( 'add_pricing_table_settings_control', $this );

        $this->end_controls_section();

        /**
         * Pricing Table Price
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_price',
            [
                'label' => esc_html__( 'Price', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_price',
            [
                'label'       => esc_html__( 'Price', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '99', 'ftc-element' ),
            ]
        );
        $this->add_control(
            'ftc_pricing_table_onsale',
            [
                'label'        => __( 'On Sale?', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => __( 'Yes', 'ftc-element' ),
                'label_off'    => __( 'No', 'ftc-element' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'ftc_pricing_table_onsale_price',
            [
                'label'       => esc_html__( 'Sale Price', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '89', 'ftc-element' ),
                'condition'   => [
                    'ftc_pricing_table_onsale' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'ftc_pricing_table_price_cur',
            [
                'label'       => esc_html__( 'Price Currency', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '$', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_price_cur_placement',
            [
                'label'       => esc_html__( 'Currency Placement', 'ftc-element' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'left',
                'label_block' => false,
                'options'     => [
                    'left'  => esc_html__( 'Left', 'ftc-element' ),
                    'right' => esc_html__( 'Right', 'ftc-element' ),
                ],
            ]
        );

        do_action( 'pricing_table_currency_position', $this );

        $this->add_control(
            'ftc_pricing_table_price_period',
            [
                'label'       => esc_html__( 'Price Period (per)', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'month', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_period_separator',
            [
                'label'       => esc_html__( 'Period Separator', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '/', 'ftc-element' ),
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing Table Feature
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_feature',
            [
                'label' => esc_html__( 'Feature', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'seperator'   => 'before',
                'default'     => [
                    ['ftc_pricing_table_item' => 'Unlimited calls'],
                    ['ftc_pricing_table_item' => 'Free hosting'],
                    ['ftc_pricing_table_item' => '500 MB of storage space'],
                    ['ftc_pricing_table_item' => '500 MB Bandwidth'],
                    ['ftc_pricing_table_item' => '24/7 support'],
                ],
                'fields'      => [
                    [
                        'name'        => 'ftc_pricing_table_item',
                        'label'       => esc_html__( 'List Item', 'ftc-element' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Pricing table list item', 'ftc-element' ),
                    ],
                    [
                        'name'             => 'ftc_pricing_table_list_icon_new',
                        'label'            => esc_html__( 'List Icon', 'ftc-element' ),
                        'type'             => Controls_Manager::ICONS,
                        'fa4compatibility' => 'ftc_pricing_table_list_icon',
                        'default'          => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'name'         => 'ftc_pricing_table_icon_mood',
                        'label'        => esc_html__( 'Item Active?', 'ftc-element' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ],
                    [
                        'name'    => 'ftc_pricing_table_list_icon_color',
                        'label'   => esc_html__( 'Icon Color', 'ftc-element' ),
                        'type'    => Controls_Manager::COLOR,
                        'default' => '#00C853',
                    ],
                    [
                        'name'         => 'ftc_pricing_item_tooltip',
                        'label'        => esc_html__( 'Enable Tooltip?', 'ftc-element' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default'      => false,
                    ],
                    [
                        'name'      => 'ftc_pricing_item_tooltip_content',
                        'label'     => esc_html__( 'Tooltip Content', 'ftc-element' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( "I'm a awesome tooltip!!", 'ftc-element' ),
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'      => 'ftc_pricing_item_tooltip_side',
                        'label'     => esc_html__( 'Tooltip Side', 'ftc-element' ),
                        'type'      => Controls_Manager::CHOOSE,
                        'options'   => [
                            'left'   => [
                                'title' => __( 'Left', 'ftc-element' ),
                                'icon'  => 'eicon-h-align-left',
                            ],
                            'top'    => [
                                'title' => __( 'Top', 'ftc-element' ),
                                'icon'  => 'eicon-v-align-top',
                            ],
                            'right'  => [
                                'title' => __( 'Right', 'ftc-element' ),
                                'icon'  => 'eicon-h-align-right',
                            ],
                            'bottom' => [
                                'title' => __( 'Bottom', 'ftc-element' ),
                                'icon'  => 'eicon-v-align-bottom',
                            ],
                        ],
                        'default'   => 'top',
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'      => 'ftc_pricing_item_tooltip_trigger',
                        'label'     => esc_html__( 'Tooltip Trigger', 'ftc-element' ),
                        'type'      => Controls_Manager::SELECT2,
                        'options'   => [
                            'hover' => __( 'Hover', 'ftc-element' ),
                            'click' => __( 'Click', 'ftc-element' ),
                        ],
                        'default'   => 'hover',
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'      => 'ftc_pricing_item_tooltip_animation',
                        'label'     => esc_html__( 'Tooltip Animation', 'ftc-element' ),
                        'type'      => Controls_Manager::SELECT2,
                        'options'   => [
                            'fade'  => __( 'Fade', 'ftc-element' ),
                            'grow'  => __( 'Grow', 'ftc-element' ),
                            'swing' => __( 'Swing', 'ftc-element' ),
                            'slide' => __( 'Slide', 'ftc-element' ),
                            'fall'  => __( 'Fall', 'ftc-element' ),
                        ],
                        'default'   => 'fade',
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'      => 'pricing_item_tooltip_animation_duration',
                        'label'     => esc_html__( 'Animation Duration', 'ftc-element' ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => 300,
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'         => 'ftc_pricing_table_toolip_arrow',
                        'label'        => esc_html__( 'Tooltip Arrow', 'ftc-element' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default'      => 'yes',
                        'condition'    => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                    [
                        'name'      => 'ftc_pricing_item_tooltip_theme',
                        'label'     => esc_html__( 'Tooltip Theme', 'ftc-element' ),
                        'type'      => Controls_Manager::SELECT2,
                        'options'   => [
                            'default'    => __( 'Default', 'ftc-element' ),
                            'noir'       => __( 'Noir', 'ftc-element' ),
                            'light'      => __( 'Light', 'ftc-element' ),
                            'punk'       => __( 'Punk', 'ftc-element' ),
                            'shadow'     => __( 'Shadow', 'ftc-element' ),
                            'borderless' => __( 'Borderless', 'ftc-element' ),
                        ],
                        'default'   => 'noir',
                        'condition' => [
                            'ftc_pricing_item_tooltip' => 'yes',
                        ],
                    ],
                ],
                'title_field' => '{{ftc_pricing_table_item}}',
            ]
        );

$this->end_controls_section();

        /**
         * Pricing Table Footer
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_footerr',
            [
                'label' => esc_html__( 'Button', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_button_show',
            [
                'label'        => __( 'Display Button', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'ftc-element' ),
                'label_off'    => __( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'selectors'    => [
                    '{{WRAPPER}} .ftc-pricing-button' => 'display: inline-block;',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_button_icon_new',
            [
                'label'            => esc_html__( 'Button Icon', 'ftc-element' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'ftc_pricing_table_button_icon',
                'condition'        => [
                    'ftc_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_button_icon_alignment',
            [
                'label'     => esc_html__( 'Icon Position', 'ftc-element' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'  => esc_html__( 'Before', 'ftc-element' ),
                    'right' => esc_html__( 'After', 'ftc-element' ),
                ],
                'condition' => [
                    'ftc_pricing_table_button_icon_new!' => '',
                    'ftc_pricing_table_button_show'      => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_button_icon_indent',
            [
                'label'     => esc_html__( 'Icon Spacing', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 60,
                    ],
                ],
                'condition' => [
                    'ftc_pricing_table_button_icon_new!' => '',
                    'ftc_pricing_table_button_show'      => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-button i.fa-icon-left'  => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing-button i.fa-icon-right' => 'margin-left: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn',
            [
                'label'       => esc_html__( 'Button Text', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Choose Plan', 'ftc-element' ),
                'condition'   => [
                    'ftc_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_link',
            [
                'label'         => esc_html__( 'Button Link', 'ftc-element' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'condition'     => [
                    'ftc_pricing_table_button_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing Table Rebon
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_featured',
            [
                'label' => esc_html__( 'Ribbon', 'ftc-element' ),
            ]
        );

        $this->add_control(
            'ftc_pricing_table_featured',
            [
                'label'        => esc_html__( 'Featured?', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_featured_styles',
            [
                'label'     => esc_html__( 'Ribbon Style', 'ftc-element' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ribbon-1',
                'options'   => [
                    'ribbon-1' => esc_html__( 'Style 1', 'ftc-element' ),
                    'ribbon-2' => esc_html__( 'Style 2', 'ftc-element' ),
                    'ribbon-3' => esc_html__( 'Style 3', 'ftc-element' ),
                    'ribbon-4' => esc_html__( 'Style 4', 'ftc-element' ),
                ],
                'condition' => [
                    'ftc_pricing_table_featured' => 'yes',
                ],
            ]
        );

        /**
         * Condition: 'ftc_pricing_table_featured_styles' => [ 'ribbon-2', 'ribbon-3', 'ribbon-4' ], 'ftc_pricing_table_featured' => 'yes'
         */
        $this->add_control(
            'ftc_pricing_table_featured_tag_text',
            [
                'label'       => esc_html__( 'Featured Tag Text', 'ftc-element' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Featured', 'ftc-element' ),
                'selectors'   => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.featured:before' => 'content: "{{VALUE}}";',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.featured:before' => 'content: "{{VALUE}}";',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.featured:before' => 'content: "{{VALUE}}";',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.featured:before' => 'content: "{{VALUE}}";',
                ],
                'condition'   => [
                    'ftc_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3', 'ribbon-4'],
                    'ftc_pricing_table_featured'        => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_ribbon_alignment',
            [
                'label'     => __( 'Ribbon Alignment', 'ftc-element' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'  => [
                        'title' => __( 'Left', 'ftc-element' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ftc-element' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'right',
                'condition' => [
                    'ftc_pricing_table_featured_styles' => ['ribbon-4'],
                    'ftc_pricing_table_featured'        => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Pricing Table Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_style_settings',
            [
                'label' => esc_html__( 'Pricing Table Style', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_pricing_table_border',
                'label'    => esc_html__( 'Border Type', 'ftc-element' ),
                'selector' => '{{WRAPPER}} .ftc-pricing .ftc-pricing-item',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 4,
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'ftc_pricing_table_shadow',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_content_alignment',
            [
                'label'        => esc_html__( 'Content Alignment', 'ftc-element' ),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => true,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'ftc-element' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ftc-element' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'ftc-element' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'      => 'center',
                'prefix_class' => 'ftc-pricing-content-align%s-',
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_content_button_alignment',
            [
                'label'        => esc_html__( 'Button Alignment', 'ftc-element' ),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => true,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'ftc-element' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ftc-element' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'ftc-element' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'      => 'center',
                'prefix_class' => 'ftc-pricing-button-align%s-',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Style (Header)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_header_style_settings',
            [
                'label' => esc_html__( 'Header', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'ftc_pricing_table_heading_padding',
            [
                'label'       => esc_html__( 'Padding', 'ftc-element' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => 'px',
                'description' => __( 'Refresh your browser after saving the padding value for see changes.', 'ftc-element' ),
                'selectors'   => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item .header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ftc_pricing_table_title_heading',
            [
                'label' => esc_html__( 'Title Style', 'ftc-element' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_title_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .header .title'                            => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item:hover .header:after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_style_2_title_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#C8E6C9',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .header' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item .header' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_style' => ['style-2'],
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_style_1_title_line_color',
            [
                'label'     => esc_html__( 'Line Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#dbdbdb',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item .header:after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_style' => ['style-1'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_title_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .header .title',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_subtitle_heading',
            [
                'label'     => esc_html__( 'Subtitle Style', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ftc_pricing_table_style!' => 'style-1',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_subtitle_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .header .subtitle' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_style!' => 'style-1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ftc_pricing_table_subtitle_typography',
                'selector'  => '{{WRAPPER}} .ftc-pricing-item .header .subtitle',
                'condition' => [
                    'ftc_pricing_table_style!' => 'style-1',
                ],
            ]

        );

        $this->add_control(
            'ftc_pricing_table_header_bg_heading',
            [
                'label'     => esc_html__( 'Background', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'transparent',
                'condition' => [
                    'ftc_pricing_table_style!' => apply_filters( 'ftc_pricing_table_header_bg_supported_style', ['style-2'] ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .header' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ftc_pricing_table_header_radius',
            [
                'label'      => __( 'Radius', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'ftc_pricing_table_style' => apply_filters( 'ftc_pricing_table_header_radius_supported_style', [] ),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'ftc_pricing_table_header_bg',
                'label'     => __( 'Background', 'ftc-element' ),
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item .header, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .header',
                'condition' => [
                    'ftc_pricing_table_style' => apply_filters( 'ftc_pricing_table_header_bg_supported_style', ['style-4'] ),
                ],
            ]
        );

        $this->end_controls_section();

        do_action( 'ftc_pricing_table_control_header_extra_layout', $this );

        /**
         * -------------------------------------------
         * Style (Pricing)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_title_style_settings',
            [
                'label' => esc_html__( 'Pricing', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        // original price
        $this->add_control(
            'ftc_pricing_table_price_tag_onsale_heading',
            [
                'label'     => esc_html__( 'Original Price', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_pricing_onsale_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price, {{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price .price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_price_tag_onsale_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_original_price_currency_heading',
            [
                'label'     => esc_html__( 'Original Price Currency', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_original_price_currency_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price .price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_original_price_currency_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price .price-currency',
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_original_price_currency_margin',
            [
                'label'      => esc_html__( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .original-price .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // sale price
        $this->add_control(
            'ftc_pricing_table_price_tag_heading',
            [
                'label'     => esc_html__( 'Sale Price', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_pricing_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price, {{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price .price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_price_tag_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_price_currency_heading',
            [
                'label'     => esc_html__( 'Sale Price Currency', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_pricing_curr_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price .price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_price_cur_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price .price-currency',
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_price_cur_margin',
            [
                'label'      => esc_html__( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing-item .ftc-pricing-tag .price-tag .sale-price .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_pricing_period_heading',
            [
                'label'     => esc_html__( 'Pricing Period', 'ftc-element' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_pricing_period_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .price-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_price_preiod_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .price-period',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Style (Feature List)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_style_featured_list_settings',
            [
                'label' => esc_html__( 'Feature List', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_list_item_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .body ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_list_disable_item_color',
            [
                'label'     => esc_html__( 'Disable item color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item ul li.disable-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_list_item_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing-item .body ul li .li-icon img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ftc-pricing-item .body ul li .li-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_list_item_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing-item .body ul li',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Style (Ribbon)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_style_3_featured_tag_settings',
            [
                'label' => esc_html__( 'Ribbon', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_style_1_featured_bar_color',
            [
                'label'     => esc_html__( 'Line Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => 'ribbon-1',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_style_1_featured_bar_height',
            [
                'label'     => esc_html__( 'Line Height', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 3,
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
                ],
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => 'ribbon-1',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_featured_tag_font_size',
            [
                'label'     => esc_html__( 'Font Size', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 10,
                ],
                'range'     => [
                    'px' => [
                        'max' => 18,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',

                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item.ribbon-4:before'         => 'font-size: {{SIZE}}px;',

                ],
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3', 'ribbon-4'],
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_featured_tag_text_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item.ribbon-4:before'         => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3', 'ribbon-4'],
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_featured_tag_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-2:after'  => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-1 .ftc-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-2:after'  => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-2:after'  => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-3 .ftc-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-2:after'  => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .ftc-pricing.style-4 .ftc-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-item.ribbon-4:before'         => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3', 'ribbon-4'],
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'ftc_pricing_table_featured_tag_bg_shadow',
                'label'     => __( 'Shadow', 'ftc-element' ),
                'selector'  => '{{WRAPPER}} .ftc-pricing .ftc-pricing-item.ribbon-4:before',
                'condition' => [
                    'ftc_pricing_table_featured'        => 'yes',
                    'ftc_pricing_table_featured_styles' => ['ribbon-4'],
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Tooltip Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_tooltip_style',
            [
                'label' => esc_html__( 'Tooltip', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'div.tooltipster-base.tooltipster-sidetip .tooltipster-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_arrow_bg',
            [
                'label'     => esc_html__( 'Arrow Background', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3d3d3d',
                'selectors' => [
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-top .tooltipster-arrow-border,
                    div.tooltipster-base.tooltipster-sidetip.tooltipster-top .tooltipster-arrow-background'                                                                                  => 'border-top-color: {{VALUE}};',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-right .tooltipster-arrow-border, .tooltipster-base.tooltipster-sidetip.tooltipster-right .tooltipster-arrow-background' => 'border-right-color: {{VALUE}};',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-left .tooltipster-arrow-border,
                    div.tooltipster-base.tooltipster-sidetip.tooltipster-left .tooltipster-arrow-background'                                                                                 => 'border-left-color: {{VALUE}};',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-border,
                    div.tooltipster-base.tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-background'                                                                               => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_color',
            [
                'label'     => esc_html__( 'Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    'div.tooltipster-base.tooltipster-sidetip .tooltipster-box .tooltipster-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_tooltip_padding',
            [
                'label'       => esc_html__( 'Padding', 'ftc-element' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => 'px',
                'description' => __( 'Refresh your browser after saving the padding value for see changes.', 'ftc-element' ),
                'selectors'   => [
                    'div.tooltipster-base.tooltipster-sidetip .tooltipster-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_pricing_table_tooltip_border',
                'label'    => esc_html__( 'Border Type', 'ftc-element' ),
                'selector' => '.tooltipster-base.tooltipster-sidetip .tooltipster-box',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ftc-element' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '.tooltipster-base.tooltipster-sidetip .tooltipster-box' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_arrow_heading',
            [
                'label'     => __( 'Tooltip Arrow', 'ftc-element' ),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ftc_pricing_table_tooltip_arrow_size',
            [
                'label'     => esc_html__( 'Arrow Size', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 45,
                        'step' => 1,
                    ],
                ],
                'selectors' => [

                    // Right Position Arrow
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-right .tooltipster-arrow'                                                                             => 'width: calc( {{SIZE}}px * 2); height: calc( {{SIZE}}px * 2); margin-top: calc( (-{{SIZE}}px * 2) / 2 ); left: calc( (-{{SIZE}}px * 2) / 2 );',
                    'div.tooltipster-sidetip.tooltipster-right .tooltipster-box'                                                                                                => 'margin-left: calc({{SIZE}}px - 10px);',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-right .tooltipster-arrow-background,.tooltipster-sidetip.tooltipster-right .tooltipster-arrow-border' => 'border: {{SIZE}}px solid transparent;',

                    // Left Position Arrow
                    '.tooltipster-sidetip.tooltipster-base.tooltipster-left .tooltipster-arrow'                                                                                 => 'width: calc( {{SIZE}}px * 2); height: calc( {{SIZE}}px * 2); margin-top: calc( (-{{SIZE}}px * 2) / 2 ); right: calc( (-{{SIZE}}px * 2) / 2 );',
                    'div.tooltipster-sidetip.tooltipster-left .tooltipster-box'                                                                                                 => 'margin-right: calc({{SIZE}}px - 1px);',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-left .tooltipster-arrow-background, .tooltipster-sidetip.tooltipster-left .tooltipster-arrow-border'  => 'border: {{SIZE}}px solid transparent;',

                    // Top Position Arrow
                    '.tooltipster-sidetip.tooltipster-base.tooltipster-top .tooltipster-arrow'                                                                                  => 'width: calc( {{SIZE}}px * 2); height: calc( {{SIZE}}px * 2); margin-left: calc( (-{{SIZE}}px * 2) / 2 ); left: 40%;top: 100%;',
                    'div.tooltipster-sidetip.tooltipster-top .tooltipster-box'                                                                                                  => 'margin-bottom: -1px;',
                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-top .tooltipster-arrow-background, .tooltipster-sidetip.tooltipster-top .tooltipster-arrow-border'    => 'border: {{SIZE}}px solid transparent;',

                    // Bottom Position Arrow
                    '.tooltipster-sidetip.tooltipster-base.tooltipster-bottom .tooltipster-arrow'                                                                               => 'width: calc( {{SIZE}}px * 2); height: calc( {{SIZE}}px * 2); margin-left: calc( (-{{SIZE}}px * 2) / 2 ); left: 40%; top: auto; bottom: 88%;',

                    'div.tooltipster-base.tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-background,
                    .tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-border'                                                                                     => 'border: {{SIZE}}px solid transparent;',

                ],
            ]
        );
        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Pricing Table Icon Style)
         * Condition: 'ftc_pricing_table_style' => 'style-2, style-5'
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_icon_settings',
            [
                'label'     => esc_html__( 'Icon Settings', 'ftc-element' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ftc_pricing_table_style' => apply_filters( 'ftc_pricing_table_icon_supported_style', ['style-2'] ),
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_icon_bg_show',
            [
                'label'        => __( 'Show Background', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __( 'Show', 'ftc-element' ),
                'label_off'    => __( 'Hide', 'ftc-element' ),
                'return_value' => 'yes',
            ]
        );

        /**
         * Condition: 'ftc_pricing_table_icon_bg_show' => 'yes'
         */
        $this->add_control(
            'ftc_pricing_table_icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_icon_bg_show' => 'yes',
                ],
            ]
        );

        /**
         * Condition: 'ftc_pricing_table_icon_bg_show' => 'yes'
         */
        $this->add_control(
            'ftc_pricing_table_icon_bg_hover_color',
            [
                'label'     => esc_html__( 'Background Hover Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item:hover .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item:hover .ftc-pricing-icon .icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_icon_bg_show' => 'yes',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_icon_settings',
            [
                'label'     => esc_html__( 'Icon Size', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 30,
                ],
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon i, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon i'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon img, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_icon_area_width',
            [
                'label'      => esc_html__( 'Icon Area Width', 'ftc-element' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'    => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'range'      => [
                    'px' => [
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_icon_area_height',
            [
                'label'     => esc_html__( 'Icon Area Height', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 80,
                ],
                'range'     => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon' => 'height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon i, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Hover Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item:hover .ftc-pricing-icon .icon i, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item:hover .ftc-pricing-icon .icon i' => 'color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_pricing_table_icon_border',
                'label'    => esc_html__( 'Border', 'ftc-element' ),
                'selector' => '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_icon_border_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item:hover .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item:hover .ftc-pricing-icon .icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_pricing_table_icon_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_icon_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 50,
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing.style-2 .ftc-pricing-item .ftc-pricing-icon .icon, {{WRAPPER}} .ftc-pricing.style-5 .ftc-pricing-item .ftc-pricing-icon .icon' => 'border-radius: {{SIZE}}%;',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Button Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'ftc_section_pricing_table_btn_style_settings',
            [
                'label' => esc_html__( 'Button', 'ftc-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ftc_pricing_table_btn_margin',
            [
                'label'      => esc_html__( 'Margin', 'ftc-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ftc_pricing_table_btn_typography',
                'selector' => '{{WRAPPER}} .ftc-pricing .ftc-pricing-button',
            ]
        );

        $this->add_control(
            'ftc_is_button_gradient_background',
            [
                'label'        => __( 'Button Gradient Background', 'ftc-element' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'ftc-element' ),
                'label_off'    => __( 'No', 'ftc-element' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_controls_tabs( 'ftc_cta_button_tabs' );

        // Normal State Tab
        $this->start_controls_tab( 'ftc_pricing_table_btn_normal', ['label' => esc_html__( 'Normal', 'ftc-element' )] );

        $this->add_control(
            'ftc_pricing_table_btn_normal_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_normal_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#00C853',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_is_button_gradient_background' => '',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'ftc_pricing_table_btn_normal_bg_gradient',
                'label'     => __( 'Background', 'ftc-element' ),
                'types'     => ['gradient'],
                'selector'  => '{{WRAPPER}} .ftc-pricing .ftc-pricing-button',
                'condition' => [
                    'ftc_is_button_gradient_background' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ftc_pricing_table_btn_border',
                'label'    => esc_html__( 'Border', 'ftc-element' ),
                'selector' => '{{WRAPPER}} .ftc-pricing .ftc-pricing-button',
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'ftc-element' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab( 'ftc_pricing_table_btn_hover', ['label' => esc_html__( 'Hover', 'ftc-element' )] );

        $this->add_control(
            'ftc_pricing_table_btn_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#03b048',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ftc_is_button_gradient_background' => '',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'ftc_pricing_table_btn_hover_bg_gradient',
                'label'     => __( 'Background', 'ftc-element' ),
                'types'     => ['gradient'],
                'selector'  => '{{WRAPPER}} .ftc-pricing .ftc-pricing-button:hover',
                'condition' => [
                    'ftc_is_button_gradient_background' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ftc_pricing_table_btn_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'ftc-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ftc-pricing .ftc-pricing-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]

        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'ftc_cta_button_shadow',
                'selector'  => '{{WRAPPER}} .ftc-pricing .ftc-pricing-button',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    public function render_feature_list( $settings, $obj ) {
        if ( empty( $settings['ftc_pricing_table_items'] ) ) {
            return;
        }

        $counter = 0;
        ?>
        <ul>
            <?php
            foreach ( $settings['ftc_pricing_table_items'] as $item ):

                if ( 'yes' !== $item['ftc_pricing_table_icon_mood'] ) {
                    $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'class', 'disable-item' );
                }

                if ( 'yes' === $item['ftc_pricing_item_tooltip'] ) {
                    $obj->add_render_attribute(
                        'pricing_feature_item' . $counter,
                        [
                            'class' => 'tooltip',
                            'title' => $item['ftc_pricing_item_tooltip_content'],
                            'id'    => $obj->get_id() . $counter,
                        ]
                    );
                }

                if ( 'yes' == $item['ftc_pricing_item_tooltip'] ) {

                    if ( $item['ftc_pricing_item_tooltip_side'] ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-side', $item['ftc_pricing_item_tooltip_side'] );
                    }

                    if ( $item['ftc_pricing_item_tooltip_trigger'] ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-trigger', $item['ftc_pricing_item_tooltip_trigger'] );
                    }

                    if ( $item['ftc_pricing_item_tooltip_animation'] ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-animation', $item['ftc_pricing_item_tooltip_animation'] );
                    }

                    if ( !empty( $item['pricing_item_tooltip_animation_duration'] ) ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-animation_duration', $item['pricing_item_tooltip_animation_duration'] );
                    }

                    if ( !empty( $item['ftc_pricing_table_toolip_arrow'] ) ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-arrow', $item['ftc_pricing_table_toolip_arrow'] );
                    }

                    if ( !empty( $item['ftc_pricing_item_tooltip_theme'] ) ) {
                        $obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-theme', $item['ftc_pricing_item_tooltip_theme'] );
                    }
                }
                ?>
                <li <?php echo $obj->get_render_attribute_string( 'pricing_feature_item' . $counter ); ?>>
                    <?php if ( 'show' === $settings['ftc_pricing_table_icon_enabled'] ): ?>
                        <span class="li-icon" style="color:<?php echo esc_attr( $item['ftc_pricing_table_list_icon_color'] ); ?>">
                            <?php if ( isset( $item['__fa4_migrated']['ftc_pricing_table_list_icon_new'] ) || empty( $item['ftc_pricing_table_list_icon'] ) ) {?>
                                <?php if ( isset( $item['ftc_pricing_table_list_icon_new']['value']['url'] ) ): ?>
                                    <img src="<?php echo $item['ftc_pricing_table_list_icon_new']['value']['url']; ?>" alt="<?php echo esc_attr( get_post_meta( $item['ftc_pricing_table_list_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                    <?php else: ?>
                                        <i class="<?php echo $item['ftc_pricing_table_list_icon_new']['value']; ?>"></i>
                                    <?php endif;?>
                                <?php } else {?>
                                    <i class="<?php echo $item['ftc_pricing_table_list_icon']; ?>"></i>
                                <?php }?>
                            </span>
                        <?php endif;?>
                        <?php echo $item['ftc_pricing_table_item']; ?>
                    </li>
                    <?php
                    $counter++;
                endforeach;
                ?>
            </ul>
            <?php
        }

        protected function render() {
            $settings = $this->get_settings();
            $target = $settings['ftc_pricing_table_btn_link']['is_external'] ? 'target="_blank"' : '';
            $nofollow = $settings['ftc_pricing_table_btn_link']['nofollow'] ? 'rel="nofollow"' : '';
            $featured_class = ( 'yes' === $settings['ftc_pricing_table_featured'] ? 'featured ' . $settings['ftc_pricing_table_featured_styles'] : '' );
            $featured_class .= ( $settings['ftc_pricing_table_ribbon_alignment'] === 'left' ? ' ribbon-left' : '' );
            $inline_style = ( $settings['ftc_pricing_table_featured_styles'] === 'ribbon-4' && 'yes' === $settings['ftc_pricing_table_featured'] ? ' style="overflow: hidden;"' : '' );

            if ( 'yes' === $settings['ftc_pricing_table_onsale'] ) {
                if ( $settings['ftc_pricing_table_price_cur_placement'] == 'left' ) {
                    $pricing = '<del class="original-price">
                    <span class="price-currency">'
                    . $settings['ftc_pricing_table_price_cur'] .
                    '</span>' .
                    $settings['ftc_pricing_table_price'] .
                    '</del>
                    <span class="sale-price">
                    <span class="price-currency">' .
                    $settings['ftc_pricing_table_price_cur'] .
                    '</span>' .
                    $settings['ftc_pricing_table_onsale_price'] .
                    '</span>';
                } else if ( $settings['ftc_pricing_table_price_cur_placement'] == 'right' ) {
                    $pricing = '<del class="original-price">' .
                    $settings['ftc_pricing_table_price'] .
                    '<span class="price-currency">' .
                    $settings['ftc_pricing_table_price_cur'] . '</span></del> ' .
                    '<span class="sale-price">' .
                    $settings['ftc_pricing_table_onsale_price'] .
                    '<span class="price-currency">' .
                    $settings['ftc_pricing_table_price_cur'] . '</span>
                    </span>';
                }
            } else {
                if ( $settings['ftc_pricing_table_price_cur_placement'] == 'left' ) {
                    $pricing = '<span class="original-price">' .
                    '<span class="price-currency">' .
                    $settings['ftc_pricing_table_price_cur'] . '</span>' .
                    $settings['ftc_pricing_table_price'] .
                    '</span>';
                } else if ( $settings['ftc_pricing_table_price_cur_placement'] == 'right' ) {
                    $pricing = '<span class="original-price">' .
                    $settings['ftc_pricing_table_price'] .
                    '<span class="price-currency">' . $settings['ftc_pricing_table_price_cur'] . '</span>
                    </span>';
                }
            }
            ?>
            <?php if ( 'style-2' != $settings['ftc_pricing_table_style'] && 'style-3' != $settings['ftc_pricing_table_style'] ) : ?>
                <div class="ftc-pricing style-1" <?php echo $inline_style; ?>>
                    <div class="ftc-pricing-item <?php echo esc_attr( $featured_class ); ?>">
                        <div class="header">
                            <h2 class="title"><?php echo $settings['ftc_pricing_table_title']; ?></h2>
                        </div>
                        <div class="ftc-pricing-tag">
                            <span class="price-tag"><?php echo $pricing; ?></span>
                            <span class="price-period"><?php echo $settings['ftc_pricing_table_period_separator']; ?> <?php echo $settings['ftc_pricing_table_price_period']; ?></span>
                        </div>
                        <div class="body">
                            <?php $this->render_feature_list( $settings, $this );?>
                        </div>
                        <div class="footer">
                            <a href="<?php echo esc_url( $settings['ftc_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="ftc-pricing-button">
                                <?php if ( 'left' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                    <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                        <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?>
                                            <img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-left" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                            <?php else: ?>
                                                <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-left"></i>
                                            <?php endif;?>
                                        <?php } else {?>
                                            <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
                                        <?php }?>
                                        <?php echo $settings['ftc_pricing_table_btn']; ?>
                                        <?php elseif ( 'right' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                            <?php echo $settings['ftc_pricing_table_btn']; ?>
                                            <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                                <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?>
                                                    <img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-right" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                                    <?php else: ?>
                                                        <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-right"></i>
                                                    <?php endif;?>
                                                <?php } else {?>
                                                    <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
                                                <?php }?>
                                            <?php endif;?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if ( 'style-2' === $settings['ftc_pricing_table_style'] ): ?>
                            <div class="ftc-pricing style-2" <?php echo $inline_style; ?>>
                                <div class="ftc-pricing-item <?php echo esc_attr( $featured_class ); ?>">
                                    <div class="ftc-pricing-icon">
                                        <span class="icon" style="background:<?php if ( 'yes' != $settings['ftc_pricing_table_icon_bg_show'] ): echo 'none';
                                        endif;?>;">
                                        <?php if ( empty( $settings['ftc_pricing_table_style_2_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_style_2_icon_new'] ) ) {?>
                                            <?php if ( isset( $settings['ftc_pricing_table_style_2_icon_new']['value']['url'] ) ): ?>
                                                <img src="<?php echo esc_attr( $settings['ftc_pricing_table_style_2_icon_new']['value']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_style_2_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                                <?php else: ?>
                                                    <i class="<?php echo esc_attr( $settings['ftc_pricing_table_style_2_icon_new']['value'] ); ?>"></i>
                                                <?php endif;?>
                                            <?php } else {?>
                                                <i class="<?php echo esc_attr( $settings['ftc_pricing_table_style_2_icon'] ); ?>"></i>
                                            <?php }?>
                                        </span>
                                    </div>
                                    <div class="header">
                                        <h2 class="title"><?php echo $settings['ftc_pricing_table_title']; ?></h2>
                                        <span class="subtitle"><?php echo $settings['ftc_pricing_table_sub_title']; ?></span>
                                    </div>
                                    <div class="ftc-pricing-tag">
                                        <span class="price-tag"><?php echo $pricing; ?></span>
                                        <span class="price-period"><?php echo $settings['ftc_pricing_table_period_separator']; ?> <?php echo $settings['ftc_pricing_table_price_period']; ?></span>
                                    </div>
                                    <div class="body">
                                        <?php $this->render_feature_list( $settings, $this );?>
                                    </div>
                                    <div class="footer">
                                        <a href="<?php echo esc_url( $settings['ftc_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="ftc-pricing-button">
                                            <?php if ( 'left' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                                <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                                    <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?><img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-left" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>"></i>
                                                    <?php else: ?>
                                                        <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-left"></i>
                                                    <?php endif;?>
                                                <?php } else {?>
                                                    <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
                                                <?php }?>
                                                <?php echo $settings['ftc_pricing_table_btn']; ?>
                                                <?php elseif ( 'right' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                                    <?php echo $settings['ftc_pricing_table_btn']; ?>
                                                    <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                                        <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?>
                                                            <img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-right" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>">
                                                            <?php else: ?>
                                                                <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-right"></i>
                                                            <?php endif;?>
                                                        <?php } else {?>
                                                            <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
                                                        <?php }?>
                                                    <?php endif;?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <?php if ( 'style-3' == $settings['ftc_pricing_table_style'] ): ?>
                                    <div class="ftc-pricing style-1 style-3" <?php echo $inline_style; ?>>
                                        <div class="ftc-pricing-item <?php echo esc_attr( $featured_class ); ?>">
                                            <div class="header">
                                                <h2 class="title"><?php echo $settings['ftc_pricing_table_title']; ?></h2>
                                            </div>
                                            <div class="ftc-pricing-tag">
                                                <span class="price-tag"><?php echo $pricing; ?></span>
                                                <span class="price-period"><?php echo $settings['ftc_pricing_table_period_separator']; ?> <?php echo $settings['ftc_pricing_table_price_period']; ?></span>
                                            </div>
                                            <div class="body">
                                                <?php $this->render_feature_list( $settings, $this );?>
                                            </div>
                                            <div class="footer">
                                                <a href="<?php echo esc_url( $settings['ftc_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="ftc-pricing-button">
                                                    <?php if ( 'left' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                                        <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                                            <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?>
                                                                <img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-left" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                                                <?php else: ?>
                                                                    <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-left"></i>
                                                                <?php endif;?>
                                                            <?php } else {?>
                                                                <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
                                                            <?php }?>
                                                            <?php echo $settings['ftc_pricing_table_btn']; ?>
                                                            <?php elseif ( 'right' == $settings['ftc_pricing_table_button_icon_alignment'] ): ?>
                                                                <?php echo $settings['ftc_pricing_table_btn']; ?>
                                                                <?php if ( empty( $settings['ftc_pricing_table_button_icon'] ) || isset( $settings['__fa4_migrated']['ftc_pricing_table_button_icon_new'] ) ) {?>
                                                                    <?php if ( isset( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ) ): ?>
                                                                        <img src="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value']['url'] ); ?>" class="fa-icon-right" alt="<?php echo esc_attr( get_post_meta( $settings['ftc_pricing_table_button_icon_new']['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
                                                                        <?php else: ?>
                                                                            <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon_new']['value'] ); ?> fa-icon-right"></i>
                                                                        <?php endif;?>
                                                                    <?php } else {?>
                                                                        <i class="<?php echo esc_attr( $settings['ftc_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
                                                                    <?php }?>
                                                                <?php endif;?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                            <?php
                                            do_action( 'add_pricing_table_style_block', $settings, $this, $pricing, $target, $nofollow, $featured_class );
                                        }
                                    }
                                    Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Pricing_Table() );
