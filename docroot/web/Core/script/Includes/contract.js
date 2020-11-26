$(document).ready(function(){
    var token = window.localStorage.getItem("token");
    var lang = document.documentElement.lang

    if(token == null){
        window.location = "/" + lang + "/login";
    }
    
    // <--- if using param to get contract_number
    var urlParams = new URLSearchParams(location.search);  
    // console.log(urlParams.get('contract_number'));
    //--->

    var dataContract = {
        "contract_number" : urlParams.get('contract_number')
    }

    $('.button-detail').attr('href', '/'+lang+'/user/profile/detail-kontrak/detail-transaksi?contract_number='+urlParams.get('contract_number'));

    contractDetailList(token, dataContract);
    contractStatusList(lang, token);
    contractDetailTransactionAll(lang, token, dataContract);

});

function contractDetail(data) {
    // console.log(data)
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var date = new Date(data.tanggal_jatuh_tempo);
    var lang = document.documentElement.lang
    var due_date = date.toLocaleDateString(lang+'-'+lang, options);

    $('.total-installment').text("Rp. "+ (convertInttoCurrency(data.pembiayaan)));
    $('.remaining-installment').text("Rp. "+ convertInttoCurrency(data.sisa_angsuran));
    $('.this-month-bill').text("Rp. "+ convertInttoCurrency(data.tagihan_bulan_ini));
    $('.due-date').text(due_date);
    $('.installment-per-month').text("Rp. "+ convertInttoCurrency(data.angsuran_per_bulan));
    $('.late-charge').text("Rp. "+ convertInttoCurrency(data.denda_keterlambatan));
}

function contractDetailTransactionAll(lang, token, dataContract){
    $.ajax({
        type: 'POST',
        url: '/user/contract-detail-transaction',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
                var total_installments = 0
                var total_late_charge = 0
                $.each(data, function( index, value ) {
                    var dueDateRaw = new Date(value.tanggal_jatuh_tempo);
                    var paymentDateRaw = new Date(value.tanggal_pembayaran); 
                    var due_date = dueDateRaw.toLocaleDateString(lang+'-'+lang, options);
                    var payment_date = paymentDateRaw.toLocaleDateString(lang+'-'+lang, options);
                    var transaction_row="<tr> <td class='installment_no'></td><td class='tanggal_jatuh_tempo'></td><td class='angsuran_per_bulan'></td><td class='angsuran_telah_dibayar'></td> <td class='tanggal_pembayaran'></td> <td class='denda_keterlambatan'></td> <td class='sisa_angsuran'></td> </tr>"

                    $('tbody').append(transaction_row);
                    $('td.installment_no').last().text(value.installment_no);
                    $('td.tanggal_jatuh_tempo').last().text(due_date);
                    $('td.angsuran_per_bulan').last().text(convertInttoCurrency(value.angsuran_per_bulan));
                    $('td.angsuran_telah_dibayar').last().text(convertInttoCurrency(value.angsuran_telah_dibayar));
                    $('td.tanggal_pembayaran').last().text(payment_date);
                    $('td.denda_keterlambatan').last().text(convertInttoCurrency(value.denda_keterlambatan));
                    $('td.sisa_angsuran').last().text(convertInttoCurrency(value.sisa_angsuran));
                    
                    total_installments += value.angsuran_per_bulan;
                    total_late_charge += value.denda_keterlambatan;
                })
                var total_transaction_row="<tr class='total'> <td></td><td>Total</td><td class='total_installment'></td><td></td><td></td><td class='total_late_charge'></td><td></td></tr>";
                $('tbody').append(total_transaction_row);

                $('td.total_installment').text(convertInttoCurrency(total_installments));
                $('td.total_late_charge').text(convertInttoCurrency(total_late_charge));
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
        url: '/user/contract-detail-list',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // console.log(data);
                contractDetail(data);
                var due_date = new Date(data.tanggal_jatuh_tempo);

                $('article.title > h3').text(data.category_desc+" "+data.product_desc);
                $('.product').text(data.product_desc);
                $('.contract-number').text(data.contract_number);
                $('.name').text(data.nama_pemohon);
                $('.total-installment-contract').text("Rp. "+ convertInttoCurrency(data.pembiayaan));
                $('.due-date-contract').text(due_date.getDate());
                $('.installment-per-month-contract').text("Rp. "+ convertInttoCurrency(data.angsuran_per_bulan));
                $('.jangka-on-month').text(data.jangka_waktu_on_month+" Bulan");
                $('.cabang-pencairan').text(data.cabang_pencairan_desc);

                if(data.product_desc == "Sertifikat Rumah"){
                    $('.land-certificate').removeClass('hide');
                    detailAgunanRumah(token, dataContract);
                }else if(data.product_desc == "BPKB Mobil"){
                    $('.vehicle').removeClass('hide');
                    detailAgunanMobil(token, dataContract);
                }else if(data.product_desc == "BPKB Motor"){
                    $('.vehicle').removeClass('hide');
                    detailAgunanMotor(token, dataContract);
                }else if(data.product_desc == "Alat Berat & Mesin Refinancing"){
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
        url: '/user/detail-agunan-rumah',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // console.log(data);
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
        url: '/user/detail-agunan-mobil',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // console.log(data);
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
        url: '/user/detail-agunan-motor',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // console.log(data);
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
        url: '/user/detail-agunan-alat-berat',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: { 'sessionId': token },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                // console.log(data);
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

function contractStatusList(lang, token) {
    var dataInput = {
        'started_index': 1,
        'length': 100
    }

    $.ajax({
        type: 'POST',
        url: '/user/contract-status-list',
        data: dataInput,
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token},

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                $('a.contract-box').removeClass('hide');
                for(var i=0; i < data.length; i++){ 
                    var newel = $('#contract').clone();
                    newel.attr('id', 'contract'+i);
                    $(newel).insertAfter(".contract-box:first");
                }
                $.each(data, function( index, value ) {
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var date = new Date(value.tanggal_jatuh_tempo);
                    var now = new Date();
                    now.setHours(0,0,0,0);

                    var due_date = date.toLocaleDateString(lang+'-'+lang, options);
                    var difference_in_ms = Math.abs(now - date);
                    var difference_in_days = difference_in_ms / (1000 * 3600 * 24);
                    
                    $('#contract'+index).attr('href', '/'+lang+'/user/profile/detail-kontrak?contract_number='+value.contract_number);
                    $('#contract'+index).find('h5.category').text(value.category_desc);
                    $('#contract'+index).find('h5.product').text(value.product_desc);
                    $('#contract'+index).find('p.contract_number').text(value.contract_number);
                    $('#contract'+index).find('p.angsuran_perbulan').text(value.angsuran_perbulan);
                    $('#contract'+index).find('p.tanggal_jatuh_tempo').text(due_date);

                    if(value.product_desc == "Sertifikat Rumah"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Rumah.png');
                    }else if(value.product_desc == "BPKB Mobil"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Mobil.png');
                    }else if(value.product_desc == "BPKB Motor"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/Motor.png');
                    }else if(value.product_desc == "Alat Berat & Mesin Refinancing"){
                        $('#contract'+index).find('.icon > img').attr('src', '/_default_upload_bucket/form_credit/D_alat%20berat.png');
                    }
                    
                    if(difference_in_days > 0){
                        $('#contract'+index).find('.warning > span').text("Anda terlambat membayar "+ difference_in_days +" hari");
                    }else{
                        $('#contract'+index).find('.status').css('visibility', 'hidden');
                        $('#contract'+index).find('.warning').css('visibility', 'hidden');
                    }
                })
                $('.contract-box:first').hide()
            }
        }
    })
}