<?php

class  VinDecoderAdmin {

	/**
	 * @var string
	 */
	protected string $vinDecoder;

	/**
	 * @var string
	 */
	protected string $version;

	/**
	 * @param $vinDecoder
	 * @param $version
	 */
	public function __construct($vinDecoder, $version) {

		$this->vinDecoder = $vinDecoder;
		$this->version = $version;

	}

	/**
	 * @return void
	 */
	public function enqueue_styles (): void {
		wp_enqueue_style($this->vinDecoder, plugin_dir_url(__FILE__) .'css/vin-decoder-admin.css', [], $this->version );
	}

	/**
	 * @return void
	 */
	public function enqueue_scripts(): void {

		wp_enqueue_script($this->vinDecoder, plugin_dir_url(__FILE__) . 'js/vin-decoder-admin.js', ['jquery'], $this->version, true);

	}

    /**
     * @return void
     */
    public function register_menu (): void
    {

		add_menu_page(
			__('VD settings', 'plugin-name'),
			'Vin Decoder',
			'manage_options',
			'vd_settings',
			[$this, 'vd_settings_page'],
			'dashicons-car',
			90
		);

	}

    /**
     * @return void
     */
    public function vd_settings_page(): void
    {

		require_once plugin_dir_path(__FILE__) . 'partials/vin-decoder-admin-display.php';

    }

    /**
     * @return void
     */
    public function vd_settings_init(): void
    {

		register_setting('vd_settings', 'vd_api_key');

		add_settings_section('vd_setting_section', __('Vin Decoder Settings', 'vin-decoder'), [$this, 'vd_api_key_section_html'], 'vd_settings');

		add_settings_field('vd_api_key_field', 'api_key', [$this,'vd_api_key_field'], 'vd_settings','vd_setting_section');

	}

    /**
     * @return void
     */
    public function vd_api_key_section_html (): void
    {
		echo esc_html__('Vin decoder description', 'vin-decoder');
	}

    /**
     * @return void
     */
    public function vd_api_key_field(): void
    {

		$options = get_option('vd_api_key');?>
		<label>
			<input type="text" name="vd_api_key[vd_api_key_field]" value="<?= (isset($options) && $options) ? $options['vd_api_key_field'] : '' ?>">
		</label>

		<?php
	}
}