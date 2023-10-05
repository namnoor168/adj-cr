<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Lolo
 * @since 1.0
 * @version 1.0
 */

?>

<div class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_attr( 'Nothing Found', 'lolo' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lolo' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_attr( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lolo' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
