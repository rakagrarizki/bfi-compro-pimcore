$(document).ready(function(){
    var token = window.localStorage.getItem("token");
    var lang = document.documentElement.lang

    if(token == null){
        window.location = "/" + lang + "/login";
    }

    contractStatusList(lang, token);
    dataCustomer(token);
    checkStatusVerify(token);
});

function contractStatusList(lang, token) {
    var dataContract = {
        'started_index': 1,
        'length': 100
    }

    $.ajax({
        type: 'POST',
        url: '/user/contract-status-list',
        data: dataContract,
        crossDomain: true,
        dataType: 'json',
        headers: {
            'sessionId': token
        },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                $.each(data, function (index, value) {
                    // console.log(value)
                    var item = "<li><a href='/" + lang + "/user/profile/detail-kontrak?contract_number=" + value.contract_number + "'>" + value.contract_number + " " + value.category_desc + " - " + value.product_desc + "</a></li>"
                    $(".contract > ol").append(item);
                });
            }
        }
    })
}

function dataCustomer(token) {
    $.ajax({
        type: 'GET',
        url: '/user/data-customer',
        crossDomain: true,
        dataType: 'json',
        headers: {
            'sessionId': token
        },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data;
                // console.log(data)
                $('.profile').find('.name').text(data.full_name);
                $('.profile').find('.email').text(data.email);
                $('.profile').find('.phone').text(data.phone_number);
                if (data.no_ktp === null) {
                    $('.profile').find('.identity-number').text('-');
                } else {
                    $('.profile').find('.identity-number').text(data.no_ktp);
                }
                // $('.profile').find('.identity-img').text(data.photo_ktp);

                $('.profile-address').find('.province').text(data.province);
                $('.profile-address').find('.city').text(data.city);
                $('.profile-address').find('.district').text(data.district);
                $('.profile-address').find('.subdistrict').text(data.subdistrict);
                $('.profile-address').find('.zip-code').text(data.zip_code);
                $('.profile-address').find('.address').text(data.full_address);
            }
        }
    });
}

function checkStatusVerify(token) {
    $.ajax({
        type: 'GET',
        url: '/user/check-verify-status',
        crossDomain: true,
        dataType: 'json',
        headers: {
            'sessionId': token
        },

        error: function (data) {
            // console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
            // console.log('request failed')
        },

        success: function (dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data
                if (data.is_ktp_verify === false) {
                    $('.profile').find('.verified-false').show();
                } else {
                    $('.profile').find('.verified-true').show();
                }
                // console.log(data)
            }
        }
    })
}