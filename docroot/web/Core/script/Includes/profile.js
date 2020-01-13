$(document).ready(function(){
    var token = window.localStorage.getItem("token");

    contractStatusList(token);
    dataCustomer(token);

    window.onload = function(){
        if(this.localStorage.token == null){
            window.location="/login"
        }else{
            $('.link-log').find('.login').hide();
            $('.link-about-top').hide();
            $('.link-log').find('.user').removeClass('hide');

            if(this.localStorage.full_name != null){
                $('.link-log').find('.full_name').text(this.localStorage.full_name);
            }
        }
    }
});

function contractStatusList(token) {
    var dataContract = {
        'started_index': 10,
        'length': 11
    }

    $.ajax({
        type: 'POST',
        url: '/user/contract-status-list',
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
                $.each(data, function( index, value ) {
                    console.log(value)
                    var item = "<li><a href='/detail?contract_number="+value.contract_number+"'>"+ value.contract_number+" "+value.category_desc+" - "+value.product_desc+"</a></li>"
                    $(".contract > ol").append(item);
                });
            }
        }
    })
}

function dataCustomer(token){
    $.ajax({
        type: 'GET',
        url: '/user/data-customer',
        crossDomain: true,
        dataType: 'json',
        headers: {'sessionId': token},

        error: function(data) {
            console.log('error' + data);
        },

        fail: function(xhr, textStatus, error) {
            console.log('request failed')
        },

        success: function(dataObj){
            var data = dataObj.result.data;
            if(dataObj.success === true) {
                $('.profile').find('.name').text(data.full_name);
                $('.profile').find('.email').text(data.email);
                $('.profile').find('.phone').text(data.phone_number);
                $('.profile').find('.identity-number').text(data.no_ktp);
                $('.profile').find('.identity-img').text(data.photo_ktp);

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