<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/framework/cmb2/init.php' ) ) {
	require_once  get_template_directory() . '/framework/cmb2/init.php';
} elseif ( file_exists(  get_template_directory() . '/framework/includes/CMB2/init.php' ) ) {
	require_once  get_template_directory() . '/framework/includes/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'details_product_metabox' );
function details_product_metabox() {
	$prefix = '_cmb_';

	$cmb_crismaster = new_cmb2_box( array(
		'id'            => $prefix . 'details_product',
		'title'         => __( 'Chi tiết sản phẩm', 'cmb2' ),
		'object_types'  => array( 'productt'), // Post type
		'fields' => array(					            
			array(
				'name' => esc_html__( 'Giá Sản Phẩm', 'cmb2' ),
				'desc' => '',
				'id'   => $prefix . 'price_product',
				'type' => 'text',
			),
//            array(
//                'name' => esc_html__( 'Giá Khuyễn Mãi', 'cmb2' ),
//                'desc' => '',
//                'id'   => $prefix . 'price_product_2',
//                'type' => 'text',
//            ),
//            array(
//                'name' => esc_html__( 'Kích thước sản phẩm', 'cmb2' ),
//                'desc' => '',
//                'id'   => $prefix . 'size_product',
//                'type' => 'text',
//            ),
//            array(
//                'name' => esc_html__( 'Gallery cho sản phẩm', 'cmb2' ),
//                'desc' => esc_html__( 'Có thể nhập nhiều ảnh có kích thước 930 x 650', 'cmb2' ),
//                'id'   => $prefix . 'list_image_product',
//                'type' => 'file_list',
//                'text' => array(
//                    'add_upload_files_text' => 'Thêm hoặc Upload File', // default: "Add or Upload Files"
//                    'remove_image_text' => 'Xóa File', // default: "Remove Image"
//                    'file_text' => 'File', // default: "File:"
//                    'file_download_text' => 'Download File', // default: "Download"
//                    'remove_text' => 'Xóa', // default: "Remove"
//                ),
//            ),


            array(
                'name' => __( 'Ảnh Thumbnail Sản Phẩm', 'cmb' ),
                'desc' => __( 'Upload ảnh thumbnail cho sản phẩm (hiển thị ở trang chủ hoặc các danh mục khác, nên có kích thước 300 x 300)', 'cmb2' ),
                'id'   => $prefix . 'popular_product',
                'type' => 'file',
            ),
		),
	) );

//    $group_param_id = $cmb_crismaster->add_field( array(
//        'name'        => esc_html__( 'Nhập các thông số sản phẩm', 'cmb2' ),
//        'id'          => $prefix.'group_paramter',
//        'type'        => 'group',
//        'description' => __( 'Có thể nhập nhiều option', 'cmb2' ),
//        'options'     => array(
//            'group_title'       => __( 'Thông số {#}', 'cmb2' ),
//            'add_button'        => __( 'Thêm', 'cmb2' ),
//            'remove_button'     => __( 'Xóa', 'cmb2' ),
//            //'sortable'          => true,
//             'closed'         => false,
//            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ),
//        ),
//    ) );
//
//    $cmb_crismaster->add_group_field( $group_param_id, array(
//        'name' => 'Thông Số Chi Tiết',
//        'des' => __( 'Ví dụ: Nguồn gốc: Nhập khẩu 100%,..', 'cmb2' ),
//        'id'   =>  'param_product',
//        'type' => 'text',
//        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
//    ) );

//    $cmb_crismaster->add_field(
//        array(
//            'name' => __( 'Mô Tả Sản Phẩm', 'cmb' ),
//            'desc' => __( 'Miêu tả về sản phẩm (bài viết có thể có hình ảnh,..)', 'cmb2' ),
//            'id'   => $prefix . 'des_product',
//            'type' => 'textarea',
//        )
//    );
}

add_action( 'cmb2_admin_init', 'single_post_metabox' );
function single_post_metabox() {
    $prefix = '_cmb_';

    $cmb_crismaster = new_cmb2_box( array(
        'id'            => $prefix . 'single_post',
        'title'         => __( 'Thêm thông tin cho tin tức', 'cmb2' ),
        'object_types'  => array( 'post'), // Post type
        'fields' => array(

//            array(
//                'name' => __( 'Ảnh "Danh sách tin tức"', 'cmb' ),
//                'desc' => __( 'Upload ảnh cho tin tức hiển thị ở trang danh sách tin tức (880x580)', 'cmb2' ),
//                'id'   => $prefix . 'single_image',
//                'type' => 'file',
//            ),
            array(
                'name' => __( 'Ảnh Thu nhỏ tin tức trên sidebar', 'cmb' ),
                'desc' => __( 'Upload ảnh thu nhỏ cho tin tức hiển thị trên sidebar (nên có kích thước 150 x 105)', 'cmb2' ),
                'id'   => $prefix . 'single_image',
                'type' => 'file',
            ),
        ),
    ) );
}