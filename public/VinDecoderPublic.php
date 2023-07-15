<?php

class  VinDecoderPublic {

	/**
	 * @var string
	 */
	protected string $vinDecoder;

	/**
	 * @var string
	 */
	protected string $version;


	protected $shortcode;

	/**
	 * @param $vinDecoder
	 * @param $version
	 */
	public function __construct($vinDecoder, $version) {

		$this->vinDecoder = $vinDecoder;

		$this->version = $version;

        require_once plugin_dir_path(__FILE__) . 'VinShortcode.php';

        $this->shortcode = new VinShortcode;

	}

	/**
	 * @return void
	 */
	public function enqueue_styles(): void {

		wp_enqueue_style($this->vinDecoder, plugin_dir_url(__FILE__) . 'css/vin-decoder-public.css', [], $this->version );

	}

	/**
	 * @return void
	 */
	public function enqueue_scripts(): void {

		wp_enqueue_script($this->vinDecoder, plugin_dir_url(__FILE__) . 'js/vin-decoder-public.js', ['jquery'], $this->version, true);

	}

    /**
     * @return void
     */
    public function vd_ajax_data() {

        wp_localize_script( $this->vinDecoder, 'myajax', ['url' => admin_url('admin-ajax.php')]);

        add_shortcode('vin-decoder', [$this->shortcode, 'vd_add_shortcode']);

    }

    /**
     * @return void
     */
    public function vd_get_vin() {

        $vin = $_POST['vin'];
        
        //$response = $this->shortcode->vd_get_vin($vin);

        $data = file_get_contents('data.json');

        echo $data;

        die();

    }
}