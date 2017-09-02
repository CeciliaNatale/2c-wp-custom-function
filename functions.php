<?php
/**
 * Plugin Name: 2c WP Custom Functions
 * Plugin URI: http://www.cecilianatale.it
 * Description: Custom functions that I use.
 * Author: Cecilia Natale
 * Author URI: http://www.cecilianatale.it
 * Version: 0.3.0
 */


/***************************************************************/
/*											admin panel														*/
/**************************************************************/
add_action('admin_menu', '__2c_wp_custom_function_setup_menu');

function __2c_wp_custom_function_setup_menu(){
        add_menu_page( 'Custom Function plugin', 'Custom Function', 'update_core', 'custom-function-plugin', 'custom_function_admin_panel' );
}


function custom_function_admin_panel(){
	//todo
}


/**************************************************************/
/*										my custom Functions											*/
/**************************************************************/

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
	echo '<span id="footer-thankyou">
			Website Developed by <a href="http://www.cecilianatale.it/" target="_blank" title="CeciliaNatale.it">Cecilia Natale.it</a>
		<span>';
}
add_filter('admin_footer_text', '__2c_custom_admin_footer', 11);

/**
 * remove admin footer version
 * @return [type] [description]
 */
function __2c_custom_admin_footer_version() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}
add_action( 'admin_menu', '__2c_custom_admin_footer_version' );




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

/**
 * Activate WordPress Maintenance Mode
 * @return [type] [description]
 */
function __2c_wp_maintenance_mode(){
    if(!current_user_can('update_core')){
        wp_die('<h1 style="color:red">Website under Maintenance</h1><br />We are performing scheduled maintenance. We will be back on-line shortly!');
    }
}
//add_action('get_header', '__2c_wp_maintenance_mode');
