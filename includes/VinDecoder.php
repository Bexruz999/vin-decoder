<?php

class VinDecoder {

	/**
	 * @var VinDecoderLoader
	 */
	protected VinDecoderLoader $loader;

	/**
	 * @var string
	 */
	protected string $vinDecoder;

	/**
	 * @var string
	 */
	protected string $version;

	public function __construct() {

		defined('VIN_VERSION') ? $this->version = VIN_VERSION : $this->version = '1.0.0';

		$this->vinDecoder = 'vin_decoder';

		$this->load_dependencies();

		$this->define_admin_hooks();

		$this->define_public_hooks();

	}


	/**
	 * @return void
	 */
	private function load_dependencies(): void {

		require_once plugin_dir_path( __DIR__ ) . 'includes/VinDecoderLoader.php';

		require_once plugin_dir_path( __DIR__ ) . 'admin/VinDecoderAdmin.php';

		require_once plugin_dir_path( __DIR__ ) . 'public/VinDecoderPublic.php';

		$this->loader = new VinDecoderLoader();

	}

	/**
	 * @return void
	 */
	private function define_admin_hooks(): void {

		$vin_decoder_admin = new VinDecoderAdmin($this->get_vin_decoder(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $vin_decoder_admin, 'enqueue_styles');

		$this->loader->add_action('admin_enqueue_scripts', $vin_decoder_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $vin_decoder_admin, 'register_menu');

		$this->loader->add_action('admin_init', $vin_decoder_admin, 'vd_settings_init');

	}

	/**
	 * @return void
	 */
	private function define_public_hooks(): void {

		$vin_decoder_public = new VinDecoderPublic($this->get_vin_decoder(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $vin_decoder_public, 'enqueue_styles');

		$this->loader->add_action('wp_enqueue_scripts', $vin_decoder_public, 'enqueue_scripts');

		$this->loader->add_action('wp_enqueue_scripts', $vin_decoder_public, 'vd_ajax_data');

        $this->loader->add_action('wp_ajax_vin', $vin_decoder_public, 'vd_get_vin');
        $this->loader->add_action('wp_ajax_nopriv_vin', $vin_decoder_public, 'vd_get_vin');

	}

	/**
	 * @return void
	 */
	public function run(): void {

		$this->loader->run();

	}

	/**
	 * @return string
	 */
	public function get_vin_decoder(): string {

		return $this->vinDecoder;

	}

	/**
	 * @return string
	 */
	public function get_version(): string {

		return $this->version;

	}
}