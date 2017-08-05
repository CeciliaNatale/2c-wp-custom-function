<?php
/**
 * Plugin Name: 2c WP Custom Functions
 * Plugin URI: http://www.cecilianatale.it
 * Description: Custom functions that I use.
 * Author: Cecilia Natale
 * Author URI: http://www.cecilianatale.it
 * Version: 0.1.0
 */

// Put your code snippets below this line.

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function __2c_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', '__2c_add_excerpt_support_for_pages' );


/**
 * Add custom post content
 * @param [type] $content [description]
 */

function __2c_add_post_content($content) {
	if(!is_feed() && !is_home()) {
		$content .= '<p>This article is copyright &copy; '.date('Y').'&nbsp;'.bloginfo('name').'</p>';
	}
	return $content;
}
//add_filter('the_content', '__2c_add_post_content');

/**
 * customize admin footer text with link of developer team
 * @return [type] [description]
 */
function __2c_custom_admin_footer() {
	echo '<a href="http://www.cecilianatale.it/" target="_blank" title="CeciliaNatale.it">Website Design by Cecilia Natale.it</a>';
}
add_filter('admin_footer_text', '__2c_custom_admin_footer');


/**
 * Function that hide update notice to all users but no admin users]
 * @return [type] [description]
 */
function __2c_hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', '__2c_hide_update_notice_to_all_but_admin_users', 1 );
