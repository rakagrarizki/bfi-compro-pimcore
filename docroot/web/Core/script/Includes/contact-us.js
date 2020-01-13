$(document).ready(function(){

    var type_message_placeholder = $('#type_message').attr('placeholder');
    $('#type_message').select2({
        placeholder: type_message_placeholder,
        dropdownParent: $('#type_message').parent()
    });

    $('select').on('change', function (e) {
        $('label[for="type_message"]').css('visibility', 'visible');
    });

    $('select.type-message').on('change', function(){
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('select.type-message').on('click', function(){
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('input[type="radio"]#type').on('change', function(){
        var value = $("input[name='personal[identity]']:checked").val();
        if (value === 'nasabah'){
            $('input#no_kontrak').prop( "disabled", false );
        }else if (value === 'non-nasabah'){
            $('input#no_kontrak').prop( "disabled", true );
        }
    })

    if($('textarea#message').val() != ''){
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
    }else{
        $('textarea#message').css('padding-top', '20px');
    }

    $('textarea#message').on('change', function(){ 
        $('label[for="message"]').css('display', 'block').css('padding', '15px 15px 5px');
        $('textarea#message').css('padding-top', '35px');
    })
});