$('.tenor-item').click(function(el){
    var est = el.target.value;
    $('#result-estimasi').html('Rp '+ currency(parseInt(est)));
});

function currency(x) {
    var x = new Intl.NumberFormat("id-Id").format(x);
    return x;
}