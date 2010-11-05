<?php

function adrian_get_archives() {
	global $wpdb;

	$where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
	$join = apply_filters('getarchives_join', "", $r);

	$output = '';

	$orderby = "post_date DESC ";
	$query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
	$key = md5($query);
	$cache = wp_cache_get( 'wp_get_archives' , 'general');
	if ( !isset( $cache[ $key ] ) ) {
		$arcresults = $wpdb->get_results($query);
		$cache[ $key ] = $arcresults;
		wp_cache_set( 'wp_get_archives', $cache, 'general' );
	} else {
		$arcresults = $cache[ $key ];
	}
	
	if ( $arcresults ) {
		foreach ( (array) $arcresults as $arcresult ) {
			if ( $arcresult->post_date != '0000-00-00 00:00:00' ) {
				$url  = get_permalink($arcresult);
				$arc_title = $arcresult->post_title;
				$post_year = date('Y', strtotime($arcresult->post_date));
				if ( $post_year != $last_post_year ) {
					if ( $last_post_year != '' ) {
						$before = '</ul>';
					}
					if ( $post_year != date('Y') ) { 
						$before = $before . '<div class="year-heading">' . $post_year . '</div>';
					} else {
						$before = $before . '<div class="year-heading">Recent Posts</div>';
					}
					$before = $before . '<ul><li>';
					$last_post_year = $post_year;
				} else {
					$before = '<li>';
				}
				$after = '</li>';
				if ( $arc_title )
					$text = strip_tags(apply_filters('the_title', $arc_title));
				else
					$text = $arcresult->ID;
				$output .= get_archives_link($url, $text, $format, $before, $after);
			}
		}
	}

	echo $output;
}

?>
