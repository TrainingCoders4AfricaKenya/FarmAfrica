function loadErrors(modelErrors) {
    /*{"userName":["User Name cannot be blank."],"firstName":["First Name cannot be blank."],"lastName":["Last Name cannot be blank."]}*/
    
    $.each(modelErrors, function(key, value) {
        $('#' + key).parent().addClass('control-group').addClass('error');
        var errorSpan = $('<span/>', {
            'class': 'help-inline',
            'text':value
        });
        $('#' + key).parent().append(errorSpan);
    });
    
}

function loadValues(model){
    console.log('model here: ' + JSON.stringify(model));
    $.each(model, function(key, value) {
//        console.log('this key: ' + key + ' | this value: ' + value);
        $('#' + key).val(value);
        if(key === 'group'){
            if(value === 'buyer'){
                $('#seller').removeAttr('checked');
                $('#buyer').attr('checked', true);
            }
            else if(value === 'seller'){
                $('#buyer').removeAttr('checked');
                $('#seller').attr('checked', true);
                
            }
        }
    });
}

