<?php
add_shortcode('sitemap', 'wp_sitemap_page');

function wp_sitemap_page(){
	return "<ul>".wp_list_pages('title_li=&echo=0')."</ul>";
}
// [sitemap]
