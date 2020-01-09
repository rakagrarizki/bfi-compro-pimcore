$(document).ready(function(){
    var token = window.sessionStorage.getItem("token");
    
    // <--- if using param to get contract_number
    var urlParams = new URLSearchParams(location.search);  
    console.log(urlParams.get('contract_number'));
    //--->

    var dataContract = {
        "contract_number" : urlParams.get('contract_number')
    }

    contractDetailTransaction(token, dataContract);
    contractDetailList(token, dataContract);
    contractStatusList(token, dataContract);

    // window.onload = function(){
    //     var elements = document.querySelectorAll('[id="telat"]');
    //     for(var i = 0; i < elements.length; i++) {
    //         elements[i].innerHTML += (
    //             "<div class='outdate'>TELAT BAYAR</div>" +
    //             "<div class='outdate-note'>" +
    //                 "<div class='circle'>" +
    //                     "<i class='fa fa-exclamation'></i>"+
    //                 "</div>"+
    //                 "<span>Anda terlambat membayar 5 hari</span>"+
    //             "</div>"
    //         );
    //     }
    // }

});

function contractDetailTransaction(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/contract-detail-transaction',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data)
                $('.total-installment').text("Rp. "+ (convertInttoCurrency(data[0].angsuran_telah_dibayar+data[0].sisa_angsuran)));
                $('.remaining-installment').text("Rp. "+ convertInttoCurrency(data[0].sisa_angsuran));
                $('.have-paid-installment').text("Rp. "+ convertInttoCurrency(data[0].angsuran_telah_dibayar));
                $('.due-date').text(data[0].tanggal_jatuh_tempo);
                $('.installment-per-month').text("Rp. "+ convertInttoCurrency(data[0].angsuran_per_bulan));
                $('.late-charge').text("Rp. "+ convertInttoCurrency(data[0].denda_keterlambatan));
            }
        }
    })
}

function convertInttoCurrency(int){
    var currency = int.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.');
    return currency
}

function contractDetailList(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/contract-detail-list',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data);
                $('article.title > h3').text(data.category_desc+" "+data.product_desc);
                $('.product').text(data.product_desc);
                $('.contract-number').text(data.contract_number);
                $('.name').text(data.nama_pemohon);
                $('.total-installment-contract').text("Rp. "+ convertInttoCurrency(data.pembiayaan));
                $('.due-date-contract').text(data.tanggal_jatuh_tempo);
                $('.installment-per-month-contract').text("Rp. "+ convertInttoCurrency(data.angsuran_per_bulan));
                $('.jangka-on-month').text(data.jangka_waktu_on_month+" Bulan");
                $('.cabang-pencairan').text(data.cabang_pencairan_desc);
                var product_desc = "Alat Berat & Mesin Refinancing";

                if(product_desc == "Sertipikat Rumah"){
                    $('.land-certificate').removeClass('hide');
                    detailAgunanRumah(token, dataContract);
                }else if(product_desc == "BPKB Mobil"){
                    $('.vehicle').removeClass('hide');
                    detailAgunanMobil(token, dataContract);
                }else if(product_desc == "BPKB Motor"){
                    $('.vehicle').removeClass('hide');
                    detailAgunanMotor(token, dataContract);
                }else if(product_desc == "Alat Berat & Mesin Refinancing"){
                    $('.asset').removeClass('hide');
                    detailAgunanAlatBerat(token, dataContract);
                }
            }
        }
    })
}

function detailAgunanRumah(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/detail-agunan-rumah',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data);
                $('.address').text(data.alamat);
                $('.building-area').text(data.luas_bangunan).append("m<sup>2</sup>");
                $('.surface-area').text(data.luas_tanah).append("m<sup>2</sup>");
                $('.price').text("Rp. "+data.harga_pasar_saat_ini);
            }
        }
    })
}

function detailAgunanMobil(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/detail-agunan-mobil',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data);
                $('.brand').text(data.merk_desc);
                $('.type').text(data.tipe_desc);
                $('.model').text(data.model_desc);
                $('.year').text(data.tahun);
                $('.color').text(data.warna);
                $('.vehicle-number').text(data.no_polisi);
            }
        }
    })
}

function detailAgunanMotor(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/detail-agunan-motor',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data);
                $('.brand').text(data.merk_desc);
                $('.type').text(data.tipe_desc);
                $('.model').text(data.model_desc);
                $('.year').text(data.tahun);
                $('.color').text(data.warna);
                $('.vehicle-number').text(data.no_polisi);
            }
        }
    })
}

function detailAgunanAlatBerat(token, dataContract) {
    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/detail-agunan-alat-berat',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                console.log(data);
                $('.asset-brand').text(data.merk_desc);
                $('.asset-type').text(data.tipe_desc);
                $('.asset-model').text(data.model_desc);
                $('.asset-year').text(data.tahun);
                $('.asset-color').text(data.warna);
                $('.made-in').text(data.buatan);
            }
        }
    })
}

function contractStatusList(token, dataContract) {
    var dataContract = {
        'started_index': 10,
        'length': 11
    }

    $.ajax({
        type: 'POST',
        url: 'https://bfi.staging7.salt.id/user/contract-status-list',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token},

        error: function (data) {
            console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function (dataObj) {
            var data = dataObj.result.data
            if (dataObj.success === true) {
                $('a.contract-box').removeClass('hide');
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#contract0').clone();
                    newel.attr('id', 'contract'+i);
                    $(newel).insertAfter(".contract-box:first");
                }
                $.each(data, function( index, value ) {
                    console.log(value)
                    $('#contract'+index).find('h5.category').text(value.category_desc);
                    $('#contract'+index).find('h5.product').text(value.product_desc);
                    $('#contract'+index).find('p.contract_number').text(value.contract_number);
                    $('#contract'+index).find('p.angsuran_perbulan').text(value.angsuran_perbulan);
                    $('#contract'+index).find('p.tanggal_jatuh_tempo').text(value.tanggal_jatuh_tempo);
                    
                    //just example if status != telat
                    if(value.contract_number == '21231213'){
                        $('#contract'+index).find('.status').css('visibility', 'hidden');
                        $('#contract'+index).find('.warning').css('visibility', 'hidden');
                    }
                })
                $('.contract-box:nth-last-child(2)').remove()
            }
        }
    })
}