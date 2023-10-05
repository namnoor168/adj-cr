<?php

//Sản Phẩm
function producttt_post_type() {

    $label = array(
        'name'                  => _x( 'Sản Phẩm', 'Post Type General Name', 'crismaster' ),
        'singular_name'         => _x( 'Sản Phẩm', 'Post Type Singular Name', 'crismaster' ),
        'menu_name'             => __( 'Sản Phẩm', 'crismaster' ),
        'name_admin_bar'        => __( 'Sản Phẩm', 'crismaster' ),
        'parent_item_colon'     => __( 'Sản Phẩm Gốc:', 'crismaster' ),
        'all_items'             => __( 'Tất cả Sản Phẩm', 'crismaster' ),
        'add_new_item'          => __( 'Thêm Mới Sản Phẩm', 'crismaster' ),
        'add_new'               => __( 'Thêm Mới', 'crismaster' ),
        'new_item'              => __( 'Sản Phẩm Mới', 'crismaster' ),
        'edit_item'             => __( 'Sửa Sản Phẩm', 'crismaster' ),
        'update_item'           => __( 'Cập Nhật Sản Phẩm', 'crismaster' ),
        'view_item'             => __( 'Xem Sản Phẩm', 'crismaster' ),
        'search_items'          => __( 'Tìm kiếm Sản Phẩm', 'crismaster' ),
        'not_found'             => __( 'Không tìm thấy', 'crismaster' ),
        'not_found_in_trash'    => __( 'Không tìm thấy trong thùng rác', 'crismaster' ),
        'featured_image'        => __( 'Ảnh sản phẩm (930 x 650)', 'crismaster' ),
        'set_featured_image'    => __( 'Chọn ảnh đại diện sản phẩm', 'crismaster' ),
        'remove_featured_image' => __( 'Xóa ảnh đại diện', 'crismaster' ),
        'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'crismaster' ),
        'insert_into_item'      => __( 'Chèn thêm sản phẩm', 'crismaster' ),
        'uploaded_to_this_item' => __( 'Cập nhật', 'crismaster' ),
        'items_list'            => __( 'List Sản Phẩm', 'crismaster' ),
        'items_list_navigation' => __( 'Navigation Sản Phẩm', 'crismaster' ),
        'filter_items_list'     => __( 'Lọc Sản Phẩm', 'crismaster' ),
    );
    $args3 = array(
        'label'                 => __( 'Sản Phẩm', 'crismaster' ),
        'description'           => __( 'Miêu tả Sản Phẩm', 'crismaster' ),
        'labels'                => $label,
        'supports'              => array( 'title', 'thumbnail', 'editor', 'post-formats','comments' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'menu_icon'             => 'dashicons-admin-customizer', 
        'query_var'             => true,
        'rewrite'               => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'productt', $args3 );

}
add_action( 'init', 'producttt_post_type', 0 );

add_action( 'init', 'producttt_taxonomy', 0 );
function producttt_taxonomy() {

    $label2 = array(
        'name'              => __( 'Danh Mục Sản Phẩm', 'crismaster' ),
        'singular_name'     => __( 'Danh Mục', 'crismaster' ),
        'search_items'      => __( 'Tìm Danh Mục','crismaster' ),
        'all_items'         => __( 'Tất Cả Danh Mục','crismaster' ),
        'parent_item'       => __( 'Danh Mục Cha','crismaster' ),
        'parent_item_colon' => __( 'Danh Mục Cha:','crismaster' ),
        'edit_item'         => __( 'Sửa Danh Mục','crismaster' ),
        'update_item'       => __( 'Cập Nhật Danh Mục','crismaster' ),
        'add_new_item'      => __( 'Thêm mới Danh mục','crismaster' ),
        'new_item_name'     => __( 'Danh Mục Mới','crismaster' ),
        'menu_name'         => __( 'Danh Mục','crismaster' ),
    );

// Now register the taxonomy

    register_taxonomy('productt_taxonomy',array('productt'), array(
        'hierarchical'      => true,
        'labels'            => $label2,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'productt_taxonomy' ),
    ));

}
?>