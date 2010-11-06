<?php

function get_all_posts() {
	$myposts = get_posts('numberposts=9999');

	$last_post_year = '';

	foreach ($myposts as $post) {
		$post_url  = get_permalink($post	);
		$post_year = date('Y', strtotime($post->post_date));
		$post_title = $post->post_title;

		if ($last_post_year != $post_year) {
			if ($last_post_year == '') {
				$output = $output . '<h2 class="post-listing-header">Recent Posts</h2>';
			} else {
				$output = $output . '</ul><h2 class="post-listing-header">' . $post_year . '</h2>';
			}
			$output = $output . '<ul class="posts">';
		}

		$last_post_year = $post_year;

		$output = $output . get_archives_link($post_url, $post_title);
	}

	if ($last_post_year != '') {
		$output = $output . '</ul>';
	}
	
	echo $output;
}

?>
