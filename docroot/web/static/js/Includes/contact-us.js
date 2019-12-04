(function ($) {
    $('select.type-message').on('change', function(){
        console.log($(this).children("option:selected"). val())
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('select.type-message').on('click', function(){
        $('.select2-selection__rendered').css('line-height', '45px');
    });

    $('input[type="radio"]#type').on('change', function(){
        var value = $("input[name='tipe_nasabah']:checked").val();
        console.log(value);
        if (value === 'nasabah'){
            console.log(value);
            $('input#no_kontrak').prop( "disabled", false );
        }else if (value === 'non-nasabah'){
            console.log(value);
            $('input#no_kontrak').prop( "disabled", true );
        }
    })

})(jQuery);