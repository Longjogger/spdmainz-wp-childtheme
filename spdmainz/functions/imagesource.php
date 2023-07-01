<?php
add_filter( 'isc_overlay_html_source', function( $source = '', $image_id = 0 ) {
	return '<div class="image-source">' . $source. '</div>';
}, 10, 2 );