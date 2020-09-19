<?php
/*
Plugin Name: Elegant Lead Generation
Description: Lead Generation Form for WordPress
Author: Ahmed Hussein
Version: 1.0
Author URI: https://ahmedgeek.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LEADGEN_PATH', __DIR__ );
define( 'LEADGEN_URL', plugin_dir_url( __FILE__ ) );
define( 'LEADGEN_TEXT_DOMAIN', 'elegant_lead' );
define( 'LEADGEN_ASSETS_HANDLE', 'elegant_lead' );
define( 'LEADGEN_CPT_SLUG', 'elegant-customer' );

require "autoload.php";
require LEADGEN_PATH . "/server/bootstrap.php";
