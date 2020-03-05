function sendLeadData2() {
    if (form.valid() || localStorage.getItem('token') != null) {
      var currentStep = form.steps("getCurrentIndex");
      var _url = "";
      var _data = {};
  
      switch (currentStep) {
        case 0:
          _url = "/credit/save-edu-leads1";
          _data = {
            "submission_id": "",
            "name": $("#nama_lengkap").val(),
            "email": $("#email_pemohon").val(),
            "phone_number": $("#no_handphone").val(),
            "path_ktp": $("#ktp").val()
          }
          break;
      }
      var sendData = postData(_url, _data);
      if (currentStep === 0) {
        submission_id = sendData.data.submission_id; 
      }
      if (sendData.success === "1") {
        if (currentStep === 1) {
          if (sendData.data.is_branch === false) {
            $("#modal-branch").modal('show');
          }
          return sendData.data.is_branch
        } else {
          return true;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

function pushGeneralOTP(cb) {
    submission_id = "";
    var _URL = "";
    var _data = {};
    var nama_lengkap = $("#nama_lengkap").val(),
        email_pemohon = $("#email_pemohon").val(),
        no_telepon = $("#no_handphone").val(),
        currentStep = $("#jenis_form").val();

        switch (currentStep) {
            case 0:
              _url = "/credit/save-machinery-leads1";
              _data = {
                "submission_id": "",
                "name": $("#nama_lengkap").val(),
                "email": $("#email_pemohon").val(),
                "phone_number": $("#no_handphone").val()
              }
              break;
            case 1:
              _url = "/credit/save-machinery-leads2";
              _data = {
                "submission_id": submission_id,
                "province_id": $("#provinsi").val()[0],
                "city_id": $("#kota").val()[0],
                "district_id": $("#kecamatan").val()[0],
                "subdistrict_id": $("#kelurahan").val()[0],
                "zipcode_id": $('#kode_pos').data('value'),
                "address": $("#alamat_lengkap").val()
              }
              break;
            case 2:
              _url = "/credit/save-machinery-leads3";
              _data = {
                "submission_id": submission_id,
                "machinery_service_id": $("#layanan").val()[0],
                "machinery_industry_id": $("#industri").val()[0],
                "machinery_type_id": $("#type").val()[0],
                "machinery_brand_id": $("#brand").val()[0],
                "machinery_model_id": $('#model').val()[0],
                "machinery_year_id": $("#year").val()[0],
                "machinery_total": $("#machine_qty").val(),
                "estimated_price": $("#machine_estimated").val().replace(/[.]/g, "")
              }
              break;
            case 3:
              _url = "/credit/save-machinery-leads4";
              _data = {
                "submission_id": submission_id
              }
              break;
            case 4:
              _url = "/credit/save-machinery-leads5";
              _data = {
                "submission_id": submission_id
              }
              break;
          }

    if (_URL !== "") {
        _data = Object.assign(_data, {
            submission_id: submission_id,
            name: nama_lengkap,
            email: email_pemohon,
            phone_number: no_telepon
        });

        $.ajax({
            type: "POST",
            url: _URL,
            data: _data,
            dataType: "json",
            tryCount: 0,
            retryLimit: retryLimit,
            error: function(xhr, textStatus, errorThrown) {
                retryAjax(this, xhr);
            },
            fail: function(xhr, textStatus, error) {
                retryAjax(this, xhr);
            },
            success: function(result) {
                if (result.success === "1") {
                    submission_id = result.data.submission_id;
                    credits.angunan.jenis_angunan = htmlEntities(
                        jenis_kredit
                    );
                    credits.pemohon.nama = htmlEntities(nama_lengkap);
                    credits.pemohon.email = htmlEntities(email_pemohon);
                    credits.pemohon.no_handphone = htmlEntities(no_telepon);
                    cb();
                } else {
                    console.log("error" + result.message);
                }
            }
        });
    }
}

function checkLogin(){
   
    var dataPhone = {
      phone_number: $("#no_handphone").val()
    };
    $.ajax({
      type: "POST",
      url: "user/login",
      data: dataPhone,
      dataType: "json",
      success: function(data) {
          if (data.success === true) {
              if (data.result.header.status === 200 ) {
                $("#otp").removeClass("hide");
                $("#getCredit-p-0").hide();
                $(".steps").hide();
                  console.log(dataPhone);
                  requestOTP(dataPhone);
                  $("#phone-input").val($("#no_handphone").val());
                  console.log("checklogin true");
                  otp();
              }else{
                sendLeadData2();
                console.log("checklogin false");
                // return true;
                // sendLeadData2(function() {
                //     console.log("checkLogin error");
                //     // sendLeadData();
                //     $("#otp").addClass("hide");
                //     $("#getCredit-p-0").hide();
                //     $("#getCredit-p-1").show();
                //     // $(".steps").show();
                //     // $("li:nth-child(2)").removeClass("disabled");
                //     // $("li:nth-child(2)").addClass("current");
                //     // $("li:nth-child(1)").addClass("done");
                //     // $("li:nth-child(1)").removeClass("error");
                //     // $("li:nth-child(1)").addClass("current");
                //     });
                }
            }
         }
      });
   }

   function byCheckLogin(){
    var dataPhone = {
      phone_number: $("#no_handphone").val()
    };
    $.ajax({
      type: "POST",
      url: "user/login",
      data: dataPhone,
      dataType: "json",
      success: function(data) {
          if (data.success === true) {
            var token = localStorage.getItem("token");
              if (data.result.header.status != 200 && token != null) {
                   pushGeneralOTP(function() {
                    console.log("next step");
                    $(".steps").show();
                    // $("#getCredit-p-1").hide();
                    $(".nav-item-1").addClass("active");
                    $(".nav-item-2").addClass("diabled");
                    $("#getCredit-p-0").show();
                });
                //   $("#otp").removeClass("hide");
                //   $("#getCredit-p-0").hide();
                //   $("#getCredit-p-1").hide();
                //   $(".steps").hide();
                //   console.log(dataPhone);
                //   requestOTP(dataPhone);
                //   $("#phone-input").val($("#no_handphone").val());
              } else {
                  console.log("failed by checklogin");
                
                    // console.log("next step");
                    // $(".steps").show();
                    // $("#getCredit-p-1").show();
                    // $(".nav-item-1").addClass("active");
                    // $(".nav-item-2").addClass("diabled");
                // pushGeneralOTP(function() {
                //     console.log("next step");
                //     $(".steps").show();
                //     $("#getCredit-p-1").hide();
                //     $(".nav-item-1").addClass("active");
                //     $(".nav-item-2").addClass("diabled");
                //     $("#getCredit-p-1").show();
                // });
            }
          }
        }
      });
   }

   function loginCustomer() {
    var dataPhone = {
        phone_number: $("#phone-input").val()
    };
    console.log(dataPhone);
    $.ajax({
        type: "POST",
        url: "/user/login",
        data: dataPhone,
        dataType: "json",
        error: function(data) {
            console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            console.log("request failed");
        },
  
        success: function(dataObj) {
            if (dataObj.success === true) {
                if(dataObj.result.header.status == 200){
                    console.log("berhasil login");
                    requestOTP(dataPhone);
                    $("#login").addClass("hide");
                    $("#otp").removeClass("hide");
                    otp();
                }else{
                    var lang = document.documentElement.lang;
                    var errorMsg;
                    if (lang == "id") {
                        errorMsg = "Nomor Handphone Belum Terdaftar.";
                    } else {
                        errorMsg = "Phone Number Not Registered.";
                    }
                    $(".error-wrap").html(
                        '<label id="login-error" class="error" for="login" style="display: inline-block;">' +
                            errorMsg +
                            "</label>"
                    );
                    console.log("gagal login");
                }
            }
        }
    });
  }
  
  function otp() {
    var timeleft = 90;
    var timer = setInterval(function() {
        document.getElementById("resend").innerHTML =
            "Mohon menunggu <b>" +
            timeleft +
            " seconds </b> untuk mengirim ulang";
        timeleft -= 1;
        if (timeleft <= 0) {
            clearInterval(timer);
            document.getElementById("resend").innerHTML =
                "Tidak menerima 4-digit kode ? <a onclick='resendOTP()'><b>Kirim Ulang</b></a>";
        }
    }, 1000);
  }
  
  function resendOTP() {
    var dataPhone = {
        phone_number: $("#phone-input").val()
    };
    otp();
    requestOTP(dataPhone);
    document.getElementById("resend-notice").textContent =
        "4-digit kode telah dikirimkan ke nomor handphone anda";
  }
  
  function requestOTP(phone) {
    $.ajax({
        type: "POST",
        url: "/user/otp-request",
        data: phone,
        dataType: "json",
        error: function(data) {
            console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            console.log("request failed");
        },
  
        success: function(dataObj) {
            console.log(dataObj.result.data);
        }
    });
  }
  
  function verified(language) {
    var otpInput = $("input[name='digit[]']")
        .map(function() {
            return $(this).val();
        })
        .get();
    otpInput = otpInput.join("");
  
    var dataOTP = {
        phone_number: $("#phone-input").val(),
        otp_code: otpInput
    };

    console.log(dataOTP);
    verifiedOTP(language, dataOTP);
    
  }
  
  function verifiedOTP(language, dataOTP) {
    $.ajax({
        type: "POST",
        url: "/user/otp-confirm",
        data: dataOTP,
        dataType: "json",
        error: function(data) {
            console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            console.log("request failed");
        },
  
        success: function(dataObj) {
            if (dataObj.success === true) {
                console.log("berhasil verified otp");
                var token = dataObj.result.data.customer_token;
                localStorage.setItem("token", token);
                console.log("token : " + token);
                getCustomer(token);
                window.location = "/" + language + "/user/dashboard";
            } else {
                console.log("otp salah, masukkan otp yang valid");
            }
        }
    });
  }
  
  function verifiedOTPCredit() {
    var otpInput = $("input[name='digit[]']").map(function() {
            return $(this).val();
        }).get();
        otpInput = otpInput.join("");

        var dataOTP = {
            phone_number: $("#phone-input").val(),
            otp_code: otpInput
        };
        console.log(dataOTP);
        
    $.ajax({
        type: "POST",
        url: "/user/otp-confirm",
        data: dataOTP,
        dataType: "json",
        error: function(data) {
            console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            console.log("request failed");
        },
  
        success: function(dataObj) {
            if (dataObj.success === true) {
                console.log("berhasil verified otp");
                var token = dataObj.result.data.customer_token;
                localStorage.setItem("token", token);
                console.log("token : " + token);
                getCustomer(token);
                $("#otp").addClass("hide");
                $("#getCredit-p-1").hide();
                $("#getCredit-p-0").show();
                $(".nav-item-1").addClass("active");
                $(".nav-item-2").addClass("diabled");
                $("#nama_lengkap").attr('disabled','disabled');
                $("#email_pemohon").attr('disabled','disabled');
                $("#no_handphone").attr('disabled','disabled');
                $("#upload-ktp-button").attr('disabled','disabled');
                $("#upload-ktp-button").css("background-color", "#dddddd");
                $("#upload-ktp-button").css("border-color", "#dddddd");
                $("input[type=radio]").attr('disabled','disabled');
                $(".label-cekLogin").removeClass('hide');
                $(".notif-ktp").addClass('hide');
                $(".steps").show();
            } else {
                console.log("otp salah, masukkan otp yang valid");
            }
        }
    });
  }
  
  function getCustomer(token) {
    $.ajax({
        type: "GET",
        url: "/user/data-customer",
        crossDomain: true,
        dataType: "json",
        async: false,
        headers: { sessionId: token },
  
        error: function(data) {
            console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            console.log("request failed");
        },
  
        success: function(dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data;
                console.log(data.full_name);
                document.cookie = "customer=" + data.full_name + "; path=/";
            }
        }
    });
  }