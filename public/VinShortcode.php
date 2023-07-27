<?php

class VinShortcode {

    public function vd_add_shortcode() {
        ob_start(); ?>

        <div class="vin-content">
            <form>
                <h2>Vin Decoder</h2>
                <p>Enter your VIN to check vehicle details</p>
                <div class="vin_form">
                    <label class="vin_label">
                        <input class="vin" type="text" name="vin" placeholder="vehicle vin code" maxlength="17" minlength="17">
                    </label>
                    <button class="vin_submit" id="vin_submit">check</button>
                </div>
            </form>

            <br>

            <table id="keywords" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td class="vin-td" >MAKE</td>
                    <td class="vin-td vin-value" id="vd-make">-</td>
                    <td class="vin-td" >MANUFACTURER NAME</td>
                    <td class="vin-td vin-value" id="vd-manafacture-name">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >MODEL</td>
                    <td class="vin-td vin-value" id="vd-model">-</td>
                    <td class="vin-td" >MODEL YEAR</td>
                    <td class="vin-td vin-value" id="vd-model-year">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >PLANT CITY</td>
                    <td class="vin-td vin-value" id="vd-plant-city">-</td>
                    <td class="vin-td">SERIESS</td>
                    <td class="vin-td vin-value" id="vd-displacement">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >VEHICLE TYPE</td>
                    <td class="vin-td vin-value" id="vd-vehicle-type">-</td>
                    <td class="vin-td" >PLANT COUNTRY</td>
                    <td class="vin-td vin-value" id="vd-plant-country">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >MANUFACTURER ID</td>
                    <td class="vin-td vin-value" id="vd-manafacturer-id">-</td>
                    <td class="vin-td" >BODY CLASS</td>
                    <td class="vin-td vin-value" id="vd-body-class">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >DOORS</td>
                    <td class="vin-td vin-value" id="vd-doors">-</td>
                    <td class="vin-td" >ENGINE NUMBER</td>
                    <td class="vin-td vin-value" id="vd-engine-number">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >DISPLACEMENT (c)</td>
                    <td class="vin-td vin-value" id="vd-displacement-c">-</td>
                    <td class="vin-td" >DISPLACEMENT (i)</td>
                    <td class="vin-td vin-value" id="vd-displacement-i">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >DISPLACEMENT (l)</td>
                    <td class="vin-td vin-value" id="vd-displacement-l">-</td>
                    <td class="vin-td" >ENGINE MODEL</td>
                    <td class="vin-td vin-value" id="vd-engine-model">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >ENGINE POWER</td>
                    <td class="vin-td vin-value" id="vd-engine-power">-</td>
                    <td class="vin-td" >FUEL TYPE-PRIMARY</td>
                    <td class="vin-td vin-value" id="vd-fuel-type-primary">-</td>
                </tr>
                <tr>
                    <td class="vin-td" >ENGINE BREAK</td>
                    <td class="vin-td vin-value" id="vd-engine-break">-</td>
                    <td class="vin-td" >OTHER ENGINE INFO</td>
                    <td class="vin-td vin-value" id="vd-other-engine-info">-</td>
                </tr>
                </tbody>
            </table>
        </div>

        <?php return ob_get_clean();
    }

    public function vd_get_vin($vin) {

        $api_key = get_option('vd_api_key');

        if(isset($api_key)) {
            $api_key = $api_key['vd_api_key_field'];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://vin-decoder19.p.rapidapi.com/vin_decoder_basic?vin=$vin",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: vin-decoder19.p.rapidapi.com",
                    "X-RapidAPI-Key: $api_key"
                ],
            ]);

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);

            if ($err) { return "cURL Error #:" . $err;}

            else {file_put_contents('file.json', $response); return $response;}
        }
    }
}
?>
