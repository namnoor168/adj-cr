<?php
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';
require_once get_template_directory() . '/plugins/redux/ReduxCore/framework.php';
require_once get_template_directory() . '/plugins/redux/sample/sample-config.php';
//require_once get_template_directory() . '/plugins/custom-post-type/crismaster_post_type.php';
//require_once get_template_directory() . '/plugins/cmb2/init.php';
//require_once get_template_directory() . '/plugins/cmb2/example-functions.php';
//require_once get_template_directory() . '/plugins/widget/widgets.php';
//require_once get_template_directory() . '/plugins/custom-visual/home-slider.php';




// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '300' );
//Theme Set up:
function crismaster_theme_setup() {
	add_theme_support( 'custom-header' ); 
	add_theme_support( 'custom-background' );
//	add_theme_support ('title-tag');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list','gallery', ) );

	register_nav_menus( array(
		'primary' => esc_html__('Menu sử dụng cho tất cả các page','crismaster'),
//		'second' => esc_html__('Second Navigation Menu (Menu For Home Page With Scroll menu)','crismaster'),
    ) );
   add_theme_support( 'woocommerce' );

}
add_action( 'after_setup_theme', 'crismaster_theme_setup' );

function crismaster_theme_scripts_styles(){
    $theme_option = get_option('theme_option');
    $mobile = wp_is_mobile();
    /**** Theme Specific CSS ****/
    $protocol = is_ssl() ? 'https' : 'http';


//    wp_enqueue_style( 'bootstrap-min-css', get_template_directory_uri() .'/assets/css/bootstrap.min.3x.css',array());
//    wp_enqueue_style( 'bootstrap-cs-css', get_template_directory_uri() .'/assets/css/cs.bootstrap.3x.css',array());
    wp_enqueue_style( 'base-css', get_template_directory_uri() .'/assets/css/theme.css',array());
    wp_enqueue_style( '1-css', get_template_directory_uri() .'/assets/css/font_megamenu.css',array());
    wp_enqueue_style( 'font-awesome-css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',array());
    wp_enqueue_style( '2-css', get_template_directory_uri() .'/assets/css/owl.carousel.css',array());
    wp_enqueue_style( '3-css', get_template_directory_uri() .'/assets/css/owl.theme.css',array());
    wp_enqueue_style( '4-css', get_template_directory_uri() .'/assets/css/owl.transitions.css',array());
    wp_enqueue_style( '5-css', get_template_directory_uri() .'/assets/css/fix17.css',array());
    wp_enqueue_style( '6-css', get_template_directory_uri() .'/assets/css/blog_home.css',array());
    wp_enqueue_style( '7-css', get_template_directory_uri() .'/assets/css/widget.css',array());
    wp_enqueue_style( '8-css', get_template_directory_uri() .'/assets/css/newsletter.css',array());
    wp_enqueue_style( '9-css', get_template_directory_uri() .'/assets/css/flaticon.css',array());
    wp_enqueue_style( '10-css', get_template_directory_uri() .'/assets/css/flickity.css',array());
    wp_enqueue_style( '11-css', get_template_directory_uri() .'/assets/css//style.css',array());
    wp_enqueue_style( '12-css', get_template_directory_uri() .'/assets/css/custom.css',array());
    wp_enqueue_style( '13-css', get_template_directory_uri() .'/assets/css/advancecategories.css',array());
    wp_enqueue_style( '14-css', get_template_directory_uri() .'/assets/css/productcomments.all.css',array());
    wp_enqueue_style( '15-css', get_template_directory_uri() .'/assets/css/jquery-ui.min.css',array());
    wp_enqueue_style( '16-css', get_template_directory_uri() .'/assets/css/jquery.ui.theme.min.css',array());
    wp_enqueue_style( '17-css', get_template_directory_uri() .'/assets/css/homeslider.css',array());
    if($mobile){
    }else{
    }
    wp_enqueue_style( 'mystyle', get_template_directory_uri() .'/style.css',array());


    /**** Start Jquery ****/
    wp_enqueue_script("jquery-min", get_template_directory_uri()."/assets/js/jquery-3.1.1.js",array(),true,false);
    wp_enqueue_script("script-js", get_template_directory_uri()."/assets/js/script.js",array(),true,false);
//    wp_enqueue_script("script-js", get_template_directory_uri()."/assets/js/bk2.js",array(),true,false);
    wp_script_add_data( 'crismaster-html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'crismaster_theme_scripts_styles' );

function crismaster_breadcrumbs() {
    // / === OPTIONS === /
    $text['home']     = esc_html__('Trang chủ','crismaster'); // text for the 'Home' link
    $text['category'] = esc_html__('%s','crismaster'); // text for a category page
    $text['tax']      = esc_html__('%s','crismaster'); // text for a taxonomy page
    $text['search']   = esc_html__('Tìm kiếm "%s"','crismaster'); // text for a search results page
    $text['tag']      = esc_html__('Tags "%s"','crismaster'); // text for a tag page
    $text['author']   = esc_html__('Articles Posted by %s','crismaster'); // text for an author page
    $text['404']      = esc_html__('Error 404','crismaster'); // text for the 404 page

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = ''; // tag before the current crumb
    $after       = ''; // tag after the current crumb
    // / === END OF OPTIONS === /
    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '';
    $linkAfter = '';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a><span>/</span>' . $linkAfter;
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<span class=""><a href="' . $homeLink . '" class="pathway"><i class=""></i>' . $text['home'] . '</a></span>';
    } else {
        echo '' . sprintf($link, $homeLink, '<i class="fa fa-home"></i> '.$text['home']) . $delimiter;
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<span><a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a></span>' . $linkAfter, $cats);
                echo wp_specialchars_decode($cats);
            }
            echo wp_specialchars_decode($before .'<h1>'. sprintf($text['category'].'</h1>', single_cat_title('', false)) . $after);
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo wp_specialchars_decode($cats);
            }
            echo wp_specialchars_decode($before . sprintf($text['tax'], single_cat_title('', false)) . $after);
        }elseif ( is_search() ) {
            echo wp_specialchars_decode($before . sprintf($text['search'], get_search_query()) . $after);
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo wp_specialchars_decode($before . get_the_time('d') . $after);
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo wp_specialchars_decode($before . get_the_time('F') . $after);
        } elseif ( is_year() ) {
            echo wp_specialchars_decode($before . get_the_time('Y') . $after);
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo wp_specialchars_decode($delimiter . $before .'' . $after);
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, FALSE, '');
                // $cats2 = explode(',',$cats);
                // $cats = $cats2[0];
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<span><a', $linkBefore . '<span><a' . $linkAttr, $cats);
                $cats = str_replace('</a></span>', '</a></span>' . $linkAfter, $cats);
                echo '<span class="cus-span">'.$cats.'</span>';
                if ($showCurrent == 1) echo wp_specialchars_decode($before . $after);
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo wp_specialchars_decode($before . $post_type->labels->singular_name . $after);
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo wp_specialchars_decode($cats);
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo wp_specialchars_decode($delimiter . $before . get_the_title() . $after);
        } elseif ( is_page() && !$post->post_parent ) {

            if ($showCurrent == 1) echo wp_specialchars_decode($before . get_the_title() . $after);
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo wp_specialchars_decode($breadcrumbs[$i]);
                if ($i != count($breadcrumbs)-1) echo wp_specialchars_decode($delimiter);
            }
            if ($showCurrent == 1) echo wp_specialchars_decode($delimiter . $before . get_the_title() . $after);
        } elseif ( is_tag() ) {
            echo wp_specialchars_decode($before . sprintf($text['tag'], single_tag_title('', false)) . $after);
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo wp_specialchars_decode($before . sprintf($text['author'], $userdata->display_name) . $after);
        } elseif ( is_404() ) {
            echo wp_specialchars_decode($before .'<span>'. $text['404'].'</span>' . $after);
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
    }
}

function crismaster_widgets_init() {

// sidebar in single blog
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar - Trang tin tức', 'crismaster' ),
        'id'            => 'sidebar-1',
        'class'         => '',
        'description'   => esc_html__( 'Sidebar sẽ xuất hiện ở các trang tin tức.', 'crismaster' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar - Trang Sản Phẩm', 'crismaster' ),
        'id'            => 'sidebar-2',
        'class'         => '',
        'description'   => esc_html__( 'Sidebar sẽ xuất hiện ở các trang sản phẩm.', 'crismaster' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar - Footer', 'crismaster' ),
        'id'            => 'sidebar-3',
        'class'         => '',
        'description'   => esc_html__( 'Sidebar sẽ xuất hiện ở footer.', 'crismaster' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( 'widgets_init', 'crismaster_widgets_init' );

function crismaster_search_form( $form ) {
    $form = '
    <form action="' . esc_attr(home_url( '/' )) .'" method="GET">
	<input type="text" name="s" placeholder="Quý khách tìm gì?" autocomplete="off" value= "' . get_search_query() . '">
	<button type="submit"><i class="fa fa-search"></i></button>
	<input type="hidden" name="post_type" value="productt">
	<div class="suggest-search" style="display: none;">
		<ul class="suggest-search-list">

		</ul>
	</div>
    </form>
    ';
    return $form;
}
add_filter( 'get_search_form', 'crismaster_search_form' );

function crismaster_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt).'...';
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function crismaster_pagination() {
    if( is_singular() )
        return;
    global $wp_query;
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    if ( $paged == 1 && $max > 2 )
        $links[] = $paged + 2 ;
    /** Add the pages around the current page to the array */
    if ( $paged >= 2 ) {
        $links[] = $paged - 1;
    }
    if ( ( $paged + 1 ) <= $max ) {
        $links[] = $paged + 1;
    }
    if ( $paged == $max && $max > 2 )
        $links[] = $paged - 2 ;
    /** Previous Post Link */
    $url_template = get_template_directory_uri();
    if ( get_previous_posts_link() )
        printf( '<li class="page-item page-link">%s</li>' . "\n", get_previous_posts_link('&laquo;') );
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="page-item active"' : '';
        printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="page-item page-link">%s</li>' . "\n", get_next_posts_link('&raquo;') );
}
?>