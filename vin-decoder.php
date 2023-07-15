<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Vin Decoder
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Author
 * Text Domain:       vin-decoder
 * Domain Path:       /vin-decoder
 */

if (!defined('ABSPATH')) {
	die;
}

define('VIN_DECODER_VERSION', '1.0.0');

function activate_vin_decoder() {
	require_once plugin_dir_path(__FILE__). 'includes/VinDecoderActivator.php';
	VinDecoderActivator::activate();
}

function deactivate_vin_decoder() {
	require_once plugin_dir_path(__FILE__). 'includes/VinDecoderDeactivator.php';
	VinDecoderDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_vin_decoder');
register_deactivation_hook(__FILE__, 'deactivate_vin_decoder');

// The core plugin class
require plugin_dir_path(__FILE__) .'includes/VinDecoder.php';

function run_vin_decoder() {
	$vin_decoder = new VinDecoder();
	$vin_decoder->run();
}

run_vin_decoder();