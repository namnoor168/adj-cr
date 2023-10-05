<?php

/**
 * FTC Theme Options
 */

if (!class_exists('Redux_Framework_smof_data')) {

    class Redux_Framework_smof_data {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {

        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        public function setSections() {

            /* Default Sidebar */
            global $ftc_default_sidebars;
            $of_sidebars    = array();
            if( $ftc_default_sidebars ){
                foreach( $ftc_default_sidebars as $key => $_sidebar ){
                    $of_sidebars[$_sidebar['id']] = $_sidebar['name'];
                }
            }
            $args = array(
                'post_type' => 'ftc_header'
                ,'post_status' => 'publish'
                ,'posts_per_page' => -1
            );

            $posts = new WP_Query($args);
            $header_blocks = array();
            if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
                foreach( $posts->posts as $p ){
                    $header_blocks[$p->ID] = $p->post_title;
                }
            }


            $ftc_layouts = array(
                '0-1-0'     => get_template_directory_uri(). '/admin/images/1col.png'
                ,'0-1-1'    => get_template_directory_uri(). '/admin/images/2cr.png'
                ,'1-1-0'    => get_template_directory_uri(). '/admin/images/2cl.png'
                ,'1-1-1'    => get_template_directory_uri(). '/admin/images/3cm.png'
            );

            /***************************/ 
            /***   General Options   ***/
            /***************************/
            $this->sections[] = array(
                'icon' => 'fa fa-home',
                'icon_class' => 'icon',
                'title' => esc_html__('General', 'lolo'),
                'fields' => array(				
                )
            );	 

            /** Logo - Favicon **/
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Logo - Favicon', 'lolo'),
                'fields' => array(			
                  array(
                    'id'=>'ftc_logo',
                    'type' => 'media',
                    'compiler'  => 'true',
                    'mode'      => false,
                    'title' => esc_html__('Logo Image', 'lolo'),
                    'desc'      => esc_html__('Select an image file for the main logo', 'lolo'),
                    'default' => array(
                        'url' => get_template_directory_uri(). '/assets/images/logo.png'
                    )
                )
                  ,
                  array(
                    'id'=>'ftc_logo_mobile',
                    'type' => 'media',
                    'compiler'  => 'true',
                    'mode'      => false,
                    'title' => esc_html__('Logo Mobile Image', 'lolo'),
                    'desc'      => '',
                    'default' => array(
                        'url' => get_template_directory_uri(). '/assets/images/logo-mobile.png'
                    )
                )  				
                  
                  ,array(
                    'id'=>'ftc_text_logo',
                    'type' => 'text',
                    'title' => esc_html__('Text Logo', 'lolo'),
                    'default' => 'lolo Store'
                )			
              )
            );

            /** Header Options **/
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Header', 'lolo'),
                'fields' => array(	
                 array(
                  'id'=>'ftc_header_layout',
                  'type' => 'image_select',
                  'full_width' => true,
                  'title' => esc_html__('Header Layout', 'lolo'),
                  'subtitle' => esc_html__('This header style will be showed only in inner pages, please go to Pages > Homepage to change header for front page.', 'lolo'),
                  'options' => array(
                    'layout1'   => get_template_directory_uri() . '/admin/images/header/layout1.jpg'
                    ,'template' => get_template_directory_uri() . '/admin/images/header/header-template.jpg'
                ),
                  'default' => 'layout1'
              ),
                 array(
                    'id' => 'ftc_header_template',
                    'type' => 'select',
                    'title' => esc_html__('Select Header Template', 'lolo'),
                    'options' => $header_blocks,
                    'default' => '',
                ),
                 array(
                    'id'=>'ftc_header_contact_information',
                    'type' => 'textarea',
                    'title' => esc_html__('Header nav Information', 'lolo'),
                    'default' => '',
                ),					
                 array(
                    'id'=>'ftc_middle_header_content',
                    'type' => 'textarea',
                    'title' => esc_html__('Header Content - Information', 'lolo'),
                    'default' => '',
                )
                 ,
                 array(   
                    "title"      => esc_html__("Header Sticky", "lolo")
                    ,"desc"     => esc_html__("Add header sticky. Please disable sticky mega main menu", "lolo")
                    ,"id"       => "ftc_enable_sticky_header"
                    ,"std"      => "1"
                    ,"on"       => esc_html__("Enable", "lolo")
                    ,"off"      => esc_html__("Disable", "lolo")
                    ,"type"     => "switch"
                    ,'default' => 1
                )
                 ,
                 array(
                    'id'=>'ftc_header_currency',
                    'type' => 'switch',
                    'title' => esc_html__('Header Currency', 'lolo'),
                    'default' => 1,
                    'on' => esc_html__('Enable', 'lolo'),
                    'off' => esc_html__('Disable', 'lolo'),
                ),
                 array(
                    'id'=>'ftc_header_language',
                    'type' => 'switch',
                    'title' => esc_html__('Header Language', 'lolo'),
                    'desc'     => esc_html__("If you don't install WPML plugin, it will display demo html", "lolo"),
                    'on' => esc_html__('Yes', 'lolo'),
                    'off' => esc_html__('No', 'lolo'),
                    'default' => 1,
                ),
                 array(
                    'id'=>'ftc_enable_tiny_shopping_cart',
                    'type' => 'switch',
                    'title' => esc_html__('Shopping Cart', 'lolo'),
                    'on' => esc_html__('Yes', 'lolo'),
                    'off' => esc_html__('No', 'lolo'),
                    'default' => 1,
                ),
                 array(
                    'id'=>'ftc_enable_search',
                    'type' => 'switch',
                    'title' => esc_html__('Search Bar', 'lolo'),
                    'on' => esc_html__('Yes', 'lolo'),
                    'off' => esc_html__('No', 'lolo'),
                    'default' => 1,
                ),
                 array(
                    'id'=>'ftc_enable_tiny_account',
                    'type' => 'switch',
                    'title' => esc_html__('My Account', 'lolo'),
                    'on' => esc_html__('Yes', 'lolo'),
                    'off' => esc_html__('No', 'lolo'),
                    'default' => 1,
                ),
                 array(
                    'id'=>'ftc_enable_tiny_wishlist',
                    'type' => 'switch',
                    'title' => esc_html__('Wishlist', 'lolo'),
                    'on' => esc_html__('Yes', 'lolo'),
                    'off' => esc_html__('No', 'lolo'),
                    'default' => 1,
                ),

                 array(   "title"      => esc_html__("Check out", "lolo")
                    ,"desc"     => ""
                    ,"id"       => "ftc_enable_tiny_checkout"
                    ,"default"      => "1"
                    ,"on"       => esc_html__("Enable", "lolo")
                    ,"off"      => esc_html__("Disable", "lolo")
                    ,"type"     => "switch"
                ),
                 array(
                    'id'=>'ftc_mobile_layout',
                    'type' => 'switch',
                    'title' => esc_html__('Mobile Layout', 'lolo'),
                    'default' => 1,
                    'on' => esc_html__('Enable', 'lolo'),
                    'off' => esc_html__('Disable', 'lolo'),
                ),
                 array(
                    'id' => 'ftc_cart_layout', 
                    'type' => 'select',
                    'title' => esc_html__('Cart Layout', 'lolo'),
                    'options' => array(
                        'dropdown' => esc_html__('Dropdown', 'lolo') ,
                        'off-canvas'    => esc_html__('Off Canvas', 'lolo')
                    ),
                    'default' => 'off-canvas',
                ),
                 array(
                    'id'         => 'ftc_header_social_editor',
                    'type'       => 'editor',
                    'full_width' => true,
                    'title'      => __( 'Custom content social editor', 'lolo' ),
                    'subtitle'   => __( 'Paste your content here.', 'lolo' ),
                    'mode'       => 'php',
                    'desc'       => '',
                    'default'    => ''
                ),
                 array(
                    'id'=>'ftc_mobile_header_layout',
                    'type' => 'switch',
                    'title' => esc_html__('Mobile Header Layout', 'lolo'),
                    'default' => 1,
                    'on' => esc_html__('Enable', 'lolo'),
                    'off' => esc_html__('Disable', 'lolo'),
                )
             )
);	

$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Breadcrumb', 'lolo'),
    'fields' => array(
        array(
            'id'=>'ftc_bg_breadcrumbs',
            'type' => 'media',
            'title' => esc_html__('Breadcrumbs Background Image', 'lolo'),
            'desc'     => esc_html__("Select a new image to override current background image", "lolo"),
            'default'   =>array(
                'url' => get_template_directory_uri(). '/assets/images/breadcrumb.jpg'
            )
        ),
        array(
            'id'=>'ftc_enable_breadcrumb_background_image',
            'type' => 'switch',
            'title' => esc_html__('Enable Breadcrumb Background Image', 'lolo'),
            'desc'     => esc_html__("You can set background color by going to Color Scheme tab > Breadcrumb Colors section", "lolo"),
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
            'default' => 1,
        ),
        array(
            'id'=>'ftc_enable_breadcrumb_title',
            'type' => 'switch',
            'title' => esc_html__('Enable Breadcrumb Title', 'lolo'),
            'desc'     => esc_html__("You can choose option", "lolo"),
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
            'default' => 0,
        ),                   
    )
);

/* Popup Newsletter */
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Popup Newletter', 'lolo'),
    'fields' => array(                    
        array(
            'id'=>'ftc_enable_popup',
            'type' => 'switch',
            'title' => esc_html__('Enable Popup Newletter', 'lolo'),
            'desc'     => '',
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
            'default' => 1,
        ),
        array(
            'id'=>'ftc_bg_popup_image',
            'type' => 'media',
            'title' => esc_html__('Popup Newletter Background Image', 'lolo'),
            'desc'     => esc_html__("Select a new image to override current background image", "lolo"),
            'default'   =>array(
                'url' => get_template_directory_uri(). '/assets/images/pop-up.jpg'
            )
        ),                   
    )
);

/** Back to top **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Back to top', 'lolo'),
    'fields' => array(
        array(
            'id'=>'ftc_back_to_top_button',
            'type' => 'switch',
            'title' => esc_html__('Enable Back To Top Button', 'lolo'),
            'default' => true,
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
        )  
        ,array(
            'id'=>'ftc_back_to_top_button_on_mobile',
            'type' => 'switch',
            'title' => esc_html__('Enable Back To Top Button On Mobile', 'lolo'),
            'default' => true,
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
        )                   
    )
);



// $this->sections[] = array(
//     'icon' => 'icofont icofont-double-right',
//     'icon_class' => 'icon',
//     'subsection' => true,
//     'title' => esc_html__('Google Map API Key', 'lolo'),
//     'fields' => array(
//         array(
//             'id'=>'ftc_gmap_api_key',
//             'type' => 'text',
//             'title' => esc_html__('Enter your API key', 'lolo'),
//             'default' => 'AIzaSyAypdpHW1-ENvAZRjteinZINafSBpAYxDE',
//         )                   
//     )
// );

/* Cookie Notice */
$this->sections[] = array(
    'icon' => 'el el-bell',
    'icon_class' => 'icon',
    'title' => esc_html__('Cookie Notice', 'lolo'),
    'fields' => array(
     array (
        'id'       => 'cookies_info',
        'type'     => 'switch',
        'title'    => esc_html__('Show cookies info', 'lolo'),
        'subtitle' => esc_html__('Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'lolo'),
        'default' => true
    ),
     array (
        'id'       => 'cookies_text',
        'type'     => 'editor',
        'title'    => esc_html__('Popup text', 'lolo'),
        'subtitle' => esc_html__('Place here some information about cookies usage that will be shown in the popup.', 'lolo'),
        'default' => esc_html__('We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'lolo'),
    ),

     array (
        'id'       => 'cookies_version',
        'type'     => 'text',
        'title'    => esc_html__('Cookies version', 'lolo'),
        'subtitle' => esc_html__('If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'lolo'),
        'default' => 1,
    ),              
 )
);
/* * *  Typography  * * */
$this->sections[] = array(
    'icon' => 'icofont icofont-brand-appstore',
    'icon_class' => 'icon',
    'title' => esc_html__('Styling', 'lolo'),
    'fields' => array(				
    )
);	

/** Color Scheme Options  * */
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Color Scheme', 'lolo'),
    'fields' => array(					
       array(
          'id' => 'ftc_primary_color',
          'type' => 'color',
          'title' => esc_html__('Primary Color', 'lolo'),
          'subtitle' => esc_html__('Select a main color for your site.', 'lolo'),
          'default' => '#222',
          'transparent' => false,
      ),				 
       array(
          'id' => 'ftc_secondary_color',
          'type' => 'color',
          'title' => esc_html__('Secondary Color', 'lolo'),
          'default' => '#999',
          'transparent' => false,
      ),
       array(
          'id' => 'ftc_body_background_color',
          'type' => 'color',
          'title' => esc_html__('Body Background Color', 'lolo'),
          'default' => '#ffffff',
          'transparent' => false,
      ),	
   )
);

/** Typography Config    **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Typography', 'lolo'),
    'fields' => array(
        array(
            'id'=>'ftc_body_font_enable_google_font',
            'type' => 'switch',
            'title' => esc_html__('Body Font - Enable Google Font', 'lolo'),
            'default' => 1,
            'folds'    => 1,
            'on' => esc_html__('Yes', 'lolo'),
            'off' => esc_html__('No', 'lolo'),
        ),
        array(
            'id'=>'ftc_body_font_family',
            'type'          => 'select',
            'title'         => esc_html__('Body Font - Family Font', 'lolo'),
            'default'       => 'Poppins',
            'options'            => array(
                "Arial" => "Arial"
                ,"Advent Pro" => "Advent Pro"
                ,"Verdana" => "Verdana, Geneva"
                ,"Trebuchet" => "Trebuchet"
                ,"Georgia" => "Georgia"
                ,"Times New Roman" => "Times New Roman"
                ,"Tahoma, Geneva" => "Tahoma, Geneva"
                ,"Palatino" => "Palatino"
                ,"Poppins" => "Poppins"
                ,"Helvetica" => "Helvetica"
                ,"BebasNeue" => "BebasNeue"


            ),
        ),
        array(
            'id'=>'ftc_body_font_google',
            'type' 			=> 'typography',
            'title' 		=> esc_html__('Body Font - Google Font', 'lolo'),
            'google' 		=> true,
            'subsets' 		=> false,
            'font-style' 	=> false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align' 	=> false,
            'color' 		=> false,
            'output'        => array('body'),
            'default'       => array(
                'color'			=> "#000000",
                'google'		=> true,
                'font-family'	=> 'Poppins'

            ),
            'preview'       => array(
                "text" => esc_html__("This is my font preview!", "lolo")
                ,"size" => "30px"
            )
        ),
        array(
            'id'        =>'ftc_secondary_body_font_enable_google_font',
            'title'     => esc_html__('Secondary Body Font - Enable Google Font', 'lolo'),
            'on'       => esc_html__("Enable", "lolo"),
            'off'      => esc_html__("Disable", "lolo"),
            'type'     => 'switch',
            'default'   => 1
        ),
        array(
            'id'            => 'ftc_secondary_body_font_google',
            'type'          => 'typography',
            'title'         => esc_html__('Body Font - Google Font', 'lolo'),
            'google'        => true,
            'subsets'       => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'color'         => false,
            'output'        => array('body'),
            'default'       => array(
                'color'         =>"#000000",
                'google'        =>true,
                'font-family'   =>'Poppins'                            
            ),
            'preview'       => array(
                "text" => esc_html__("This is my font preview!", "lolo")
                ,"size" => "30px"
            )
        ),
        array(
            'id'        =>'ftc_font_size_body',
            'type'      => 'slider',
            'title'     => esc_html__('Body Font Size', 'lolo'),
            'desc'     => esc_html__("In pixels. Default is 14px", "lolo"),
            'min'      => '10',
            'step'     => '1',
            'max'      => '50',
            'default'   => '14'
        ),	
        array(
            'id'        =>'ftc_line_height_body',
            'type'      => 'slider',
            'title'     => esc_html__('Body Font Line Heigh', 'lolo'),
            'desc'     => esc_html__("In pixels. Default is 24px", "lolo"),
            'min'      => '10',
            'step'     => '1',
            'max'      => '50',
            'default'   => '24'
        )				
    )
);

/*** WooCommerce Config     ** */
if ( class_exists( 'Woocommerce' ) ) :
    $this->sections[] = array(
     'icon' => 'icofont icofont-cart-alt',
     'icon_class' => 'icon',
     'title' => esc_html__('Ecommerce', 'lolo'),
     'fields' => array(				
     )
 );

    /** Woocommerce **/
    $this->sections[] = array(
     'icon' => 'icofont icofont-double-right',
     'icon_class' => 'icon',
     'subsection' => true,
     'title' => esc_html__('Woocommerce', 'lolo'),
     'fields' => array(	
        array(  
            "title"      => esc_html__("Product Label", "lolo")
            ,"desc"     => ""
            ,"id"       => "product_label_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Product Sale Label Text", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_sale_label_text"
            ,"default"      => "Sale"
            ,"type"     => "text"
        ),
        array(  
            "title"      => esc_html__("Product Feature Label Text", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_feature_label_text"
            ,"default"      => "New"
            ,"type"     => "text"
        ),						
        array(  
            "title"      => esc_html__("Product Out Of Stock Label Text", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_out_of_stock_label_text"
            ,"default"      => "Sold out"
            ,"type"     => "text"
        ),           		
        array(   
            "title"      => esc_html__("Show Sale Label As", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_show_sale_label_as"
            ,"default"      => "text"
            ,"type"     => "select"
            ,"options"  => array(
                'text'      => esc_html__('Text', 'lolo')
                ,'number'   => esc_html__('Number', 'lolo')
                ,'percent'  => esc_html__('Percent', 'lolo')
            )
        ),
        array(  
            "title"      => esc_html__("Product Hover Style", "lolo")
            ,"desc"     => ""
            ,"id"       => "prod_hover_style_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Hover Style", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_effect_hover_product_style"
            ,"default"      => "style-1"
            ,"type"     => "select"
            ,"options"  => array(
                'style-1'       => esc_html__('Style 1', 'lolo')
                ,'style-2'      => esc_html__('Style 2', 'lolo')
                ,'style-3'      => esc_html__('Style 3', 'lolo')
            )
        ),
        array(  
            "title"      => esc_html__("Back Product Image", "lolo")
            ,"desc"     => ""
            ,"id"       => "introduction_enable_img_back"
            ,"icon"     => true
            ,"type"     => "info"
        ),					
        array(   
            "title"      => esc_html__("Enable Second Product Image", "lolo")
            ,"desc"     => esc_html__("Show second product image on hover. It will show an image from Product Gallery", "lolo")
            ,"id"       => "ftc_effect_product"
            ,"default"      => "1"
            ,"type"     => "switch"
        ),
        array(  
            "title"      => "Number Of Gallery Product Image"
            ,"id"       => "ftc_product_gallery_number"
            ,"default"      => 3
            ,"type"     => "text"
        ),
        array(  
            "title"      => esc_html__("Lazy Load", "lolo")
            ,"desc"     => ""
            ,"id"       => "prod_lazy_load_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Activate Lazy Load", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_prod_lazy_load"
            ,"default"      => 1
            ,"type"     => "switch"
        ),
        array(
            'id'=>'ftc_prod_placeholder_img',
            'type' => 'media',
            'compiler'  => 'true',
            'mode'      => false,
            'title' => esc_html__('Placeholder Image', 'lolo'),
            'desc'      => '',
            'default' => array(
                'url' => get_template_directory_uri(). '/assets/images/prod_loading.gif'
            )
        ),
        array(  
            "title"      => esc_html__("Quickshop", "lolo")
            ,"desc"     => ""
            ,"id"       => "quickshop_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Activate Quickshop", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_enable_quickshop"
            ,"default"      => 1
            ,"type"     => "switch"
        ),
        array(  
            "title"      => esc_html__("Catalog Mode", "lolo")
            ,"desc"     => ""
            ,"id"       => "introduction_catalog_mode"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Enable Catalog Mode", "lolo")
            ,"desc"     => esc_html__("Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off", "lolo")
            ,"id"       => "ftc_enable_catalog_mode"
            ,"default"      => "0"
            ,"type"     => "switch"
        ),
        array(     
            "title"      => esc_html__("Ajax Search", "lolo")
            ,"desc"     => ""
            ,"id"       => "ajax_search_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(     
            "title"      => esc_html__("Enable Ajax Search", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_ajax_search"
            ,"default"      => "1"
            ,"type"     => "switch"
        ),
        array(     
            "title"      => esc_html__("Number Of Results", "lolo")
            ,"desc"     => esc_html__("Input -1 to show all results", "lolo")
            ,"id"       => "ftc_ajax_search_number_result"
            ,"default"      => -1
            ,"type"     => "text"
        ),
        array(     
            "title"      => esc_html__("Ajax Search", "lolo")
            ,"desc"     => ""
            ,"id"       => "ajax_search_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(     
            "title"      => esc_html__("Enable Ajax Search", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_ajax_search"
            ,"default"      => "1"
            ,"type"     => "switch"
        ),
        array(     
            "title"      => esc_html__("Number Of Results", "lolo")
            ,"desc"     => esc_html__("Input -1 to show all results", "lolo")
            ,"id"       => "ftc_ajax_search_number_result"
            ,"default"      => -1
            ,"type"     => "text"
        ),
        array(  
            "title"      => esc_html__("On/Off Infinite Scroll", "lolo")
            ,"desc"     => ""
            ,"id"       => "prod_infinite_scroll"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Apply Infinite Scroll", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_Infinite_scroll"
            ,"default"      => "0"
            ,"type"     => "select"
            ,"options"  => array(
                '0'       => esc_html__('No', 'lolo')
                ,'1'      => esc_html__('Yes', 'lolo')
            )
        )
    )
);

/*** Product Category ***/
$this->sections[] = array(
 'icon' => 'icofont icofont-double-right',
 'icon_class' => 'icon',
 'subsection' => true,
 'title' => esc_html__( 'Product Category', 'lolo'),
 'fields' => array(
  array(
   'id' => 'ftc_prod_cat_layout',
   'type' => 'image_select',
   'title' => esc_html__('Product Category Layout', 'lolo'),
   'des' => esc_html__('Select main content and sidebar alignment.', 'lolo'),
   'options' => $ftc_layouts,
   'default' => '0-1-0'
),						
  array(    
    "title"      => esc_html__("Left Sidebar", "lolo")
    ,"id"       => "ftc_prod_cat_left_sidebar"
    ,"default"      => "product-category-sidebar"
    ,"type"     => "select"
    ,"options"  => $of_sidebars
),						
  array(    
    "title"      => esc_html__("Right Sidebar", "lolo")
    ,"id"       => "ftc_prod_cat_right_sidebar"
    ,"default"      => "product-category-sidebar"
    ,"type"     => "select"
    ,"options"  => $of_sidebars
),
  array(    
    "title"      => esc_html__("Product Columns", "lolo")
    ,"id"       => "ftc_prod_cat_columns"
    ,"default"      => "3"
    ,"type"     => "select"
    ,"options"  => array(
        3   => 3
        ,4  => 4
        ,5  => 5
        ,6  => 6
    )
),
  array(    
      "title"      => esc_html__("Products Per Page", "lolo")
      ,"desc"     => esc_html__("Number of products per page", "lolo")
      ,"id"       => "ftc_prod_cat_per_page"
      ,"default"      => 9
      ,"type"     => "text"
  ),						
  array(   
    "title"      => esc_html__("Filter attribute Product", "lolo")
    ,"desc"     => esc_html__("Display in Product Category full width", "lolo")
    ,"id"       => "ftc_prod_cat_top_content"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(    
    "title"      => esc_html__("Product Thumbnail", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_thumbnail"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(    
    "title"      => esc_html__("Product Label", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_label"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Categories", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_cat"
    ,"default"      => 0
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Title", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_title"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product SKU", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_sku"
    ,"default"      => 0
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Rating", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_rating"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Price", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_price"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Add To Cart Button", "lolo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_add_to_cart"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(    
   "title"      => esc_html__("Product Short Description - Grid View", "lolo")
   ,"desc"     => esc_html__("Show product description on grid view", "lolo")
   ,"id"       => "ftc_prod_cat_grid_desc"
   ,"default"      => 0
   ,"on"       => esc_html__("Show", "lolo")
   ,"off"      => esc_html__("Hide", "lolo")
   ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Short Description - Grid View - Limit Words", "lolo")
    ,"desc"     => esc_html__("Number of words to show product description on grid view. It is also used for product shortcode", "lolo")
    ,"id"       => "ftc_prod_cat_grid_desc_words"
    ,"default"      => 8
    ,"type"     => "text"
),
  array(     
    "title"      => esc_html__("Product Short Description - List View", "lolo")
    ,"desc"     => esc_html__("Show product description on list view", "lolo")
    ,"id"       => "ftc_prod_cat_list_desc"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "lolo")
    ,"off"      => esc_html__("Hide", "lolo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Short Description - List View - Limit Words", "lolo")
    ,"desc"     => esc_html__("Number of words to show product description on list view", "lolo")
    ,"id"       => "ftc_prod_cat_list_desc_words"
    ,"default"      => 50
    ,"type"     => "text"
)					
)
);
/* Product Details Config  */
$this->sections[] = array(
 'icon' => 'icofont icofont-double-right',
 'icon_class' => 'icon',
 'subsection' => true,
 'title' => esc_html__('Product Details', 'lolo'),
 'fields' => array(
    array(
       'id' => 'ftc_prod_layout',
       'type' => 'image_select',
       'title' => esc_html__('Product Detail Layout', 'lolo'),
       'des' => esc_html__('Select main content and sidebar alignment.', 'lolo'),
       'options' => $ftc_layouts,
       'default' => '0-1-1'
   ),
    array(  
        "title"      => esc_html__("Left Sidebar", "lolo")
        ,"id"       => "ftc_prod_left_sidebar"
        ,"default"      => "product-detail-sidebar"
        ,"type"     => "select"
        ,"options"  => $of_sidebars
    ),
    array(  
        "title"      => esc_html__("Right Sidebar", "lolo")
        ,"id"       => "ftc_prod_right_sidebar"
        ,"default"      => "product-detail-sidebar"
        ,"type"     => "select"
        ,"options"  => $of_sidebars
    ),
    array(  
        "title"      => esc_html__("Product Cloud Zoom", "lolo")
        ,"desc"     => esc_html__("If you turn it off, product gallery images will open in a lightbox. This option overrides the option of WooCommerce", "lolo")
        ,"id"       => "ftc_prod_cloudzoom"
        ,"default"      => 1
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Attribute Dropdown", "lolo")
        ,"desc"     => esc_html__("If you turn it off, the dropdown will be replaced by image or text label", "lolo")
        ,"id"       => "ftc_prod_attr_dropdown"
        ,"default"      => 1
        ,"type"     => "switch"
    ),						
    array(  "title"      => esc_html__("Product Thumbnail", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_thumbnail"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Label", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_label"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Navigation", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_show_prod_navigation"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Title", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_title"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Title In Content", "lolo")
        ,"desc"     => esc_html__("Display the product title in the page content instead of above the breadcrumbs", "lolo")
        ,"id"       => "ftc_prod_title_in_content"
        ,"default"      => 0
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Rating", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_rating"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product SKU", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_sku"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Availability", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_availability"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Excerpt", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_excerpt"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Count Down", "lolo")
        ,"desc"     => esc_html__("You have to activate ThemeFTC plugin", "lolo")
        ,"id"       => "ftc_prod_count_down"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Price", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_price"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Add To Cart Button", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_add_to_cart"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Categories", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_cat"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Tags", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_tag"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Sharing", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_sharing"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Size Chart", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_show_prod_size_chart"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(
        'id'         => 'ftc_content_sizechart',
        'type'       => 'ace_editor',
        'full_width' => true,
        'title'      => __( 'Custom content size chart', 'lolo' ),
        'subtitle'   => __( 'Paste your content here.', 'lolo' ),
        'mode'       => 'php',
        'desc'       => '',
        'default'    => ''
    ),
    array(  "title"      => esc_html__("Size Chart Image", "lolo")
        ,"desc"     => esc_html__("Select an image file for all Product", "lolo")
        ,"id"       => "ftc_prod_size_chart"
        ,"type"     => "media"
        ,'default' => array(
            'url' => get_template_directory_uri(). '/assets/images/size-chart.jpg'
        )
    ),
    array(  "title"      => esc_html__("Product Thumbnails", "lolo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_thumbnails"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Product Thumbnails Style", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_thumbnails_style"
        ,"default"      => "horizontal" 
        ,"type"     => "select"
        ,"options"  => array(
            'vertical'      => esc_html__('Vertical', 'lolo')
            ,'horizontal'   => esc_html__('Horizontal', 'lolo')
        )
    ),
    array(  "title"      => esc_html__("Product Tabs", "lolo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_tabs"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Product Tabs", "lolo")
        ,"desc"     => esc_html__("Enable Product Tabs", "lolo")
        ,"id"       => "ftc_prod_tabs"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Tabs Style", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_style_tabs"
        ,"default"      => "defaut"
        ,"type"     => "select"
        ,"options"  => array(
            'default'       => esc_html__('Default', 'lolo')
            ,'accordion'    => esc_html__('Accordion', 'lolo')
            ,'vertical' => esc_html__('Vertical', 'lolo')
        )
    ),
    array(  "title"      => esc_html__("Product Tabs Position", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_tabs_position"
        ,"default"      => "after_summary" 
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "select"
        ,"options"  => array(
            'after_summary'     => esc_html__('After Summary', 'lolo')
            ,'inside_summary'   => esc_html__('Inside Summary', 'lolo')
        )
    ),
    array(  "title"      => esc_html__("Product Custom Tab", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Custom Tab Title", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab_title"
        ,"default"      => "Custom tab"
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "text"
    ),
    array(  "title"      => esc_html__("Product Custom Tab Content", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab_content"
        ,"default"      => "Your custom content goes here. You can add the content for individual product"
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "textarea"
    ),
    array(  "title"      => esc_html__("Product Ads Banner", "lolo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_ads_banner"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Ads Banner", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_ads_banner"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(     "title"      => esc_html__("Ads Banner Content", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_ads_banner_content"
        ,"default"      => ''
        ,"fold"     => "ftc_prod_ads_banner"
        ,"type"     => "textarea"
    ),
    array(  "title"      => esc_html__("Related - Up-Sell Products", "lolo")
        ,"desc"     => ""
        ,"id"       => "introduction_related_upsell_product"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(     "title"      => esc_html__("Up-Sell Products", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_upsells"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Related Products", "lolo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_related"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "lolo")
        ,"off"      => esc_html__("Hide", "lolo")
        ,"type"     => "switch"
    )					
)
);

endif;


/* Blog Settings */
$this->sections[] = array(
    'icon' => 'icofont icofont-ui-copy',
    'icon_class' => 'icon',
    'title' => esc_html__('Blog', 'lolo'),
    'fields' => array(				
    )
);		

			// Blog Layout
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Blog Layout', 'lolo'),
    'fields' => array(	
        array(
           'id' => 'ftc_blog_layout',
           'type' => 'image_select',
           'title' => esc_html__('Blog Layout', 'lolo'),
           'des' => esc_html__('Select main content and sidebar alignment.', 'lolo'),
           'options' => $ftc_layouts,
           'default' => '0-1-0'
       ),
        array(   "title"      => esc_html__("Left Sidebar", "lolo")
            ,"id"       => "ftc_blog_left_sidebar"
            ,"default"      => "blog-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),				
        array(     "title"      => esc_html__("Right Sidebar", "lolo")
            ,"id"       => "ftc_blog_right_sidebar"
            ,"default"      => "blog-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(    
            "title"      => esc_html__("Blog Columns", "lolo")
            ,"id"       => "ftc_blog_cat_columns"
            ,"default"      => "2"
            ,"type"     => "select"
            ,"options"  => array(
                1   => 1
                ,2  => 2
                ,3  => 3
            )
        ),
        array(   "title"      => esc_html__("Blog Thumbnail", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_thumbnail"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),										
        array(   "title"      => esc_html__("Blog Date", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_date"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Title", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_title"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Author", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_author"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),

        array(  "title"      => esc_html__("Blog Count Comment", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_count_comment"
            ,"default"      => 0
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Read More Button", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_read_more"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Tags", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_tags"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Categories", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_categories"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_excerpt"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt Strip All Tags", "lolo")
            ,"desc"     => esc_html__("Strip all html tags in Excerpt", "lolo")
            ,"id"       => "ftc_blog_excerpt_strip_tags"
            ,"default"      => 0
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt Max Words", "lolo")
            ,"desc"     => esc_html__("Input -1 to show full excerpt", "lolo")
            ,"id"       => "ftc_blog_excerpt_max_words"
            ,"default"      => "-1"
            ,"type"     => "text"
        )					
    )
);				

/** Blog Detail **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Blog Details', 'lolo'),
    'fields' => array(	
        array(
           'id' => 'ftc_blog_details_layout',
           'type' => 'image_select',
           'title' => esc_html__('Blog Detail Layout', 'lolo'),
           'des' => esc_html__('Select main content and sidebar alignment.', 'lolo'),
           'options' => $ftc_layouts,
           'default' => '0-1-0'
       ),
        array(  "title"      => esc_html__("Left Sidebar", "lolo")
            ,"id"       => "ftc_blog_details_left_sidebar"
            ,"default"      => "blog-detail-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(  "title"      => esc_html__("Right Sidebar", "lolo")
            ,"id"       => "ftc_blog_details_right_sidebar"
            ,"default"      => "blog-detail-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(  "title"      => esc_html__("Blog Navigation", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_navigation"
            ,"default"      => 0
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Thumbnail", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_thumbnail"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(     "title"      => esc_html__("Blog Date", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_date"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Title", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_title"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Content", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_content"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Tags", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_tags"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Count Comment", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_count_comment"
            ,"default"      => 0
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Categories", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_categories"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Author Box", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_author_box"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Related Posts", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_related_posts"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Comment Form", "lolo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_comment_form"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "lolo")
            ,"off"      => esc_html__("Hide", "lolo")
            ,"type"     => "switch"
        )				
    )
);		
}


public function setHelpTabs() {

}

public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          => 'smof_data',
                'menu_type'         => 'submenu',
                'allow_sub_menu'    => true,
                'display_name'      => $theme->get( 'Name' ),
                'display_version'   => $theme->get( 'Version' ),
                'menu_title'        => esc_html__('Theme Options', 'lolo'),
                'page_title'        => esc_html__('Theme Options', 'lolo'),
                'templates_path'    => get_template_directory() . '/admin/et-templates/',
                'disable_google_fonts_link' => true,

                'async_typography'  => false,
                'admin_bar'         => false,
                'admin_bar_icon'       => 'dashicons-admin-generic',
                'admin_bar_priority'   => 50,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => false,
                'compiler'          => false,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'smof_data',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,
                'show_options_object' => false,

                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => false,
                'output_tag'        => false,

                'database'              => '',
                'system_info'           => false,

                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                ),
                'use_cdn'                   => true,
            );


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
            }
        }			

    }

    global $redux_ftc_settings;
    $redux_ftc_settings = new Redux_Framework_smof_data();
}
