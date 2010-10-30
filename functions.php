<?php

function adrian_get_archives($args = '') {
	global $wpdb, $wp_locale;

	$defaults = array(
		'type' => 'monthly', 'limit' => '',
		'format' => 'html', 'before' => '',
		'after' => '', 'show_post_count' => false,
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( '' == $type )
		$type = 'monthly';

	if ( '' != $limit ) {
		$limit = absint($limit);
		$limit = ' LIMIT '.$limit;
	}

	// this is what will separate dates on weekly archive links
	$archive_week_separator = '&#8211;';

	// over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
	$archive_date_format_over_ride = 0;

	// options for daily archive (only if you over-ride the general date format)
	$archive_day_date_format = 'Y/m/d';

	// options for weekly archive (only if you over-ride the general date format)
	$archive_week_start_date_format = 'Y/m/d';
	$archive_week_end_date_format	= 'Y/m/d';

	if ( !$archive_date_format_over_ride ) {
		$archive_day_date_format = get_option('date_format');
		$archive_week_start_date_format = get_option('date_format');
		$archive_week_end_date_format = get_option('date_format');
	}

	//filters
	$where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
	$join = apply_filters('getarchives_join', "", $r);

	$output = '';

	$orderby = ('alpha' == $type) ? "post_title ASC " : "post_date DESC ";
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
	
	$last_post_year = '';
	$orig_before = $before;

	if ( $arcresults ) {
		foreach ( (array) $arcresults as $arcresult ) {
			if ( $arcresult->post_date != '0000-00-00 00:00:00' ) {
				$before = $orig_before;
				$url  = get_permalink($arcresult);
				$arc_title = $arcresult->post_title;
				$post_year = date('Y', strtotime($arcresult->post_date));
				if ( $post_year != $last_post_year ) {
					$before = '<h1 class="archive_year">' . $post_year . '</h1>' . $orig_before;
					$last_post_year = $post_year;
				}
				if ( $arc_title )
					$text = strip_tags(apply_filters('the_title', $arc_title));
				else
					$text = $arcresult->ID;
				$output .= get_archives_link($url, $text, $format, $before, $after);
			}
		}
	}

	if ( $echo )
		echo $output;
	else
		return $output;
}

?>
