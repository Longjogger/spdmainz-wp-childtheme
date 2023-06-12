<?php
/**
 * Custom Post Type Meta Sub Head
 *
 * @package Virtue Theme
 */

if ( ( 'post' === get_post_type() && '1' === virtue_premium_get_option( 'hide_postdate' ) ) || ( 'post' !== get_post_type() && '1' === virtue_premium_get_option( 'custom_post_show_postdate' ) ) ) {
	?>
	<div>
		<div>
			<meta itemprop="datePublished" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
			<span class="postday"><?php echo get_the_date( 'j' ); ?></span>
			<?php echo esc_html( get_the_date( 'M Y' ) ); ?>
		</div>
	</div>
	<?php
}
