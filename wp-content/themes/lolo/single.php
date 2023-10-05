<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Lolo
 * @since 1.0
 * @version 1.0
 */
global $smof_data, $post;

get_header( $smof_data['ftc_header_layout'] );

$page_column_class = ftc_page_layout_columns_class($smof_data['ftc_blog_details_layout']);
ftc_breadcrumbs_title(true, $smof_data['ftc_blog_details_title'], get_the_title());
$columns_blog = 'col-sm-12';
if(($page_column_class['left_sidebar'] && is_active_sidebar($smof_data['ftc_blog_details_left_sidebar'] )) || ($page_column_class['right_sidebar'] && is_active_sidebar( $smof_data['ftc_blog_details_right_sidebar'] ) ) ){
  $columns_blog = 'col-sm-9';
}
if(($page_column_class['left_sidebar'] && is_active_sidebar($smof_data['ftc_blog_details_left_sidebar'] )) && ($page_column_class['right_sidebar'] && is_active_sidebar( $smof_data['ftc_blog_details_right_sidebar'] ) ) ){
  $columns_blog = 'col-sm-6';
}
?>

<div class="container">
	<div id="primary" class="content-area content-post">
    <div class="row">
      <!-- Left Sidebar -->
      <?php if( $page_column_class['left_sidebar'] && $post->post_type != 'ftc_footer'): ?>
        <aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
          <?php if( is_active_sidebar($smof_data['ftc_blog_details_left_sidebar']) ): ?>
            <?php dynamic_sidebar( $smof_data['ftc_blog_details_left_sidebar'] ); ?>
          <?php endif; ?>
        </aside>
      <?php endif; ?>	
      <!-- end left sidebar -->

      <main id="main" class="site-main single-post-content <?php echo esc_attr($columns_blog) ?>" >

       <?php
       /* Start the Loop */
       while ( have_posts() ) : the_post();

         get_template_part( 'template-parts/post/single-content', get_post_format() );
         if(isset($smof_data['ftc_blog_details_navigation']) && $smof_data['ftc_blog_details_navigation'] ){
           the_post_navigation( array(
            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'lolo' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'lolo' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . ftc_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'lolo' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'lolo' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . ftc_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
          ) );
         }

				endwhile; // End of the loop.
       ?>

     </main><!-- #main -->

     <!-- Right Sidebar -->
     <?php if( $page_column_class['right_sidebar'] && $post->post_type != 'ftc_footer'): ?>
      <aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
        <?php if( is_active_sidebar($smof_data['ftc_blog_details_right_sidebar']) ): ?>
          <?php dynamic_sidebar( $smof_data['ftc_blog_details_right_sidebar'] ); ?>
        <?php endif; ?>
      </aside>
    <?php endif; ?>	
    <!-- end right sidebar -->
  </div>

</div><!-- #primary -->
<?php get_sidebar(); ?>
</div><!-- .container -->

<?php get_footer();
