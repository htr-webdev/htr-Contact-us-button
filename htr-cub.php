<?php
/**
 * Plugin Name:       HTR Contact Us Button
 * Plugin URI:        https://example.com/htr-contact-us-button
 * Description:       A professional and standard WordPress plugin to display customizable "Contact Us" buttons.
 * Version:           1.0.0
 * Author:            Your Name
 * Author URI:        https://example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       htr-cub
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'HTR_CUB_VERSION', '1.0.0' );
define( 'HTR_CUB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HTR_CUB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once HTR_CUB_PLUGIN_DIR . 'includes/class-htr-contact-us-button.php';

// Initialize the plugin
function run_htr_contact_us_button() {
    $plugin = new HTR_Contact_Us_Button();
    $plugin->run();
}
run_htr_contact_us_button();
