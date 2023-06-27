<?php
add_filter( 'isc_overlay_html_source', function( $source = '', $image_id = 0 ) {
	return '<span class="image-source">' . $source. '</span>';
}, 10, 2 );