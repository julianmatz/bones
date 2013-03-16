<?php

namespace cleanup;

// More cleanup functions to follow...

// Filters
add_filter( 'embed_oembed_html', '\cleanup\_embed_wrap', 10, 4 );
add_filter( 'embed_googlevideo', '\cleanup\_embed_wrap', 10, 2 );
add_filter( 'oembed_dataparse', '\cleanup\_oembed_dataparse', 10, 3 );

/**
 * Wrap embedded media as suggested by Readability.com
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function _embed_wrap( $cache, $url, $attr = '', $post_ID = '' )
{
	return '<div class="entry-content-asset">' . $cache . '</div>';
}

/**
 * Replace deprecated/invlaid attributes with CSS to allow HTML5 validation
 * Currently, only for YouTube embeds
 */
function _oembed_dataparse( $return, $data, $url )
{
	if ( $data->provider_name === 'YouTube' )
	{
		$return = '<iframe style="width: ' . $data->width . 'px; height: ' . $data->height . 'px; border: none;" src="' . $url . '"></iframe>';
	}
	return $return;
}
