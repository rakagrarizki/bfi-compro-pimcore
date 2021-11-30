$('.radio-group').click(function(){
    var est;
    if($('#option-one').is(':checked')){
        est = '400.000.000';
    }else if($('#option-two').is(':checked')){
        est = '300.000.000';
    }else if($('#option-three').is(':checked')){
        est = '200.000.000';
    }else if($('#option-four').is(':checked')){
        est = '100.000.000';
    }
    $('#result-estimasi').html('Rp '+est);
});