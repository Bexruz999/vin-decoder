jQuery(document).ready(function($) {

    $('.vin_submit').on('click', function (event) {
        event.preventDefault();
        $(this).html('Recheck')
        vin_submit();
    });
    function vin_submit() {

        let data = {action: 'vin', vin: $('.vin').val()};

        jQuery.post( myajax.url, data, function(response) {
            response = JSON.parse(response);
            console.log(response);
            vd_set_values(response);
        });
    }

    function vd_set_values(response) {
        let manafactured_id = response['VIN'].slice(11, 15);
        let doors = response['Body_Style']['value'].split(' ')[1];
        let boody_class = response['Body_Style']['value'].split(' ')[0];

        $('#vd-make').html(response['Make']['value']);
        $('#vd-model').html(response['Model']['value']);
        $('#vd-manafacture-name').html(response['Make']['value']);
        $('#vd-manafacturer-id').html(manafactured_id);
        $('#vd-vehicle-type').html(response['Vehicle_Type']['value']);
        $('#vd-model-year').html(response['Model_Year']['value']);
        $('#vd-plant-country').html(response['Manufactured_in']['value']);
        $('#vd-doors').html(doors);
        $('#vd-body-class').html(boody_class);
        $('#vd-fuel-type-primary').html(response['Fuel_Type']['value']);
        $('#vd-displacement-c').html(response['Engine_Displacement']['value']);
    }
});