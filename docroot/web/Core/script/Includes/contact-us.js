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

    $('.file-input').on('change', function(e) { 
        const sizeLimit = 500000;
        const parent = $(this).parents(".upload-image");
        const iptFrm = $(this).data("id");
        const label = parent.find("b")[0];
        const preview = parent.find("img")[0];
        const file = e.target.files[0];

        if (file.size > sizeLimit) { 
            console.log('if')
            var errorMsg = '';
            errorMsg = 'File size must be less than 500 KB.';
            parent.find(".error-wrap").show();
            parent.find(".error-wrap").html('<label id="img-error" class="error" for="img" style="display: inline-block;">' + errorMsg + '</label>');
        } else {
            console.log('else')
            var reader = new FileReader();
            reader.addEventListener("load", function () {
                if (typeof (preview) !== "undefined") {
                // $("#" + iptFrm).val(reader.result).trigger("change");
                $("#" + iptFrm).val("/test/test.png").trigger("change");
                $(label).text(file.name);
                preview.src = reader.result;
                }
            }, false);

            if (file) {
                $(preview).show();
                reader.readAsDataURL(file);
            } else {
                $(preview).hide();
            } 
            parent.find(".error-wrap").hide();
        } 
    });
});