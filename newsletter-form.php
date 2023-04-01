<?php 
/**
 * @package newsletterform
 */
/**
 * Plugin Name: Newsletter Form
 * Plugin URI: https://prtech.com
 * Description: This plugin provide a functionality in which newsletter form is saved as a post. And data can store as CSV so we can send the mail from our newsletter form. You can use by "[newsletter_form]" shortcode.
 * Version: 1.0.0
 * Author: Roopamm & Team
 * Author URI: https://roopamm.com
 * License: GPLv2 or Later
 */

if(! defined('ABSPATH')){
	die;
}
 
class AlecadddPlugin
{
	function __construct(){
		add_action( 'init', array($this,'create_subscriber_cpt'));
		add_action( 'init', array($this,'create_subscriber_metabox'));
		add_action( 'wp_enqueue_scripts', array($this,'enqueue'));
	}
	function alecaddd_activate(){
		//generated CPT
		//flush rewrite rules
		flush_rewrite_rules();
	}
	function alecaddd_deactivate(){
		//flush rewrite rules
	}
	function alecaddd_uninstall(){
		//flush rewrite rules	
	}

	// Register Custom Post Type Subscriber

	function create_subscriber_cpt() {
		include( plugin_dir_path( __FILE__ ) . 'inc/post-type.php');
	}
	function create_subscriber_metabox(){
		include( plugin_dir_path( __FILE__ ) . 'inc/meta-box.php');
	}
	function enqueue(){
        //To enqueue Script and styles
        wp_enqueue_style('mypluginstyle', plugins_url('/css/style.css', __FILE__));  
    }

}

if(class_exists('AlecadddPlugin')){
	$alecadddplugin = new AlecadddPlugin();
}

//activation
register_activation_hook( __FILE__, array($alecadddplugin,'alecaddd_activate') );
//deactivation
register_deactivation_hook( __FILE__, array($alecadddplugin,'alecaddd_deactivate'));
//uninstall
register_uninstall_hook( __FILE__, array($alecadddplugin,'alecaddd_uninstall' ));
//Include files
// register_uninstall_hook( __FILE__, array($alecadddplugin,'include_file' ));
include( plugin_dir_path( __FILE__ ) . 'inc/newsletter-popup.php');
/**
 * Add Columns to wp list table of subscriber
 */
include( plugin_dir_path( __FILE__ ) . 'inc/subscriber-columns.php');
/**
 * Add Export button to download posts as csv
 */
include( plugin_dir_path( __FILE__ ) . 'inc/export-columns.php');




