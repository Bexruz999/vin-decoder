jQuery(document).ready(function($) {

    $('.vin_submit').on('click', function (event) {

        event.preventDefault();

        $(this).html('Recheck');

        vin_submit();

    });

    function vin_submit() {

        $vin = $('.vin').val();

        if ($vin.length === 17) {

            let data = {action: 'vin', vin: $vin};

            jQuery.post( myajax.url, data, (response) => vd_set_values(response));

        } else { alert('vin not correctly');}
    }

    function isJson(str) {

        try { JSON.parse(str); }

        catch (e) { return false; }

        return true;

    }

    function vd_set_values(response) {

        if ( isJson(response) ) {

            response = JSON.parse(response);

            console.log(response);

            let manafactured_id = response['VIN'].slice(11, 15);
            let boody_class =     response['Body_Style']['value'].split(' ')[0];
            let doors =           response['Body_Style']['value'].split(' ')[1];

            $('#vd-manafacturer-id')    .html(manafactured_id);
            $('#vd-body-class')         .html(boody_class);
            $('#vd-doors')              .html(doors);

            $('#vd-fuel-type-primary')  .html(response['Fuel_Type']['value']);
            $('#vd-manafacture-name')   .html(response['Make']['value']);
            $('#vd-displacement-c')     .html(response['Engine_Displacement']['value']);
            $('#vd-plant-country')      .html(response['Manufactured_in']['value']);
            $('#vd-vehicle-type')       .html(response['Vehicle_Type']['value']);
            $('#vd-model-year')         .html(response['Model_Year']['value']);
            $('#vd-model')              .html(response['Model']['value']);
            $('#vd-make')               .html(response['Make']['value']);

        }

        else if (response.length === 0) { alert('error');}

        else { alert(response);}

    }
});