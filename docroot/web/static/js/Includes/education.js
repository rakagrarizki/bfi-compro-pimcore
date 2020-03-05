var form, submission_id;
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone", "#ktp"];
formGroup[1] = ["#provinsi", "#kota", "#kecamatan", "#kelurahan", "#kode_pos", "#alamat_lengkap"];
formGroup[2] = ["#ex7SliderVal", "#down_payment", "#jangka_waktu"];
var countCalculate = 0;


function isValidStep() {
  var currentStep = form.steps("getCurrentIndex");
  var isValid = true;
  if (typeof (formGroup[currentStep]) !== "undefined") {
    $.each(formGroup[currentStep], function (idx, item) {
      if ($(item).val() === "") {
        isValid = false;
      }
    });
  }
  return isValid;
}

function checkValid() {
  if (isValidStep()) {
    // do something
    nextButton("active");
  } else {
    nextButton("inactive");
  }
}

function nextButton(action) {
  var nextBtn = $(".actions > ul li a[href$='next']").parent();
  if (action === "active"){
    nextBtn.removeClass("inactive");
  } else{
    if (!nextBtn.hasClass("inactive")) {
      nextBtn.addClass("inactive");
    }
  }
}

function finishButton(action){
  var finishBtn = $(".actions > ul li a[href$='finish']").parent();
  if (action === "active") {
    finishBtn.removeClass("inactive");
  } else {
    if (!finishBtn.hasClass("inactive")) {
      finishBtn.addClass("inactive");
    }
  }
}

function sendLeadData() {
  if (form.valid()) {
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
      case 1:
        _url = "/credit/save-edu-leads2";
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
        _url = "/credit/save-edu-leads3";
        _data = {
          "submission_id": submission_id
        }
        break;
      case 3:
        _url = "/credit/save-edu-leads4";
        _data = {
          "submission_id": submission_id
        }
        break;
      case 4:
        _url = "/credit/save-edu-leads5";
        _data = {
          "submission_id": submission_id
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

function sendLastLeads() {
  _url = "/credit/save-edu-leads5";
  _data = {
    "submission_id": submission_id
  }
  var sendData = postData(_url, _data);
  if (sendData.success === "1") {
    successOTP();
  }
}

function initCalculate() {
  getDataTenor();
  var package = getData("/credit/get-edu-package", {});
  var rawMinPrice = parseInt(package.data.minimum_funding),
    rawMaxPrice = parseInt(package.data.maximum_funding),
    otr_price = parseInt(package.data.minimum_funding);
  
  var rawDownPayment = rawMinPrice * 0.1

  $("#calcSlider").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.max = rawMaxPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.min = rawMinPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.step = 100000;

  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").slider('setValue', rawMinPrice);

  var minprice = separatordot(rawMinPrice),
    maxprice = separatordot(rawMaxPrice),
    downPayment = separatordot(rawDownPayment);

  $("#ex7SliderVal").val(minprice);
  $('#down_payment').val(downPayment);
  $(".valuemin").text(minprice);
  $(".valuemax").text(maxprice);
  $("#otr").val(otr_price);
}

function getDataTenor() {
  var selElm = $("#jangka_waktu");
  var ret = getData("/credit/get-edu-tenor", {});
  var dataArr = [];
  $.each(ret.data, function (idx, item) {
    dataArr.push({
      id: item.tenor,
      text: item.desc
    });
  })
  selElm.empty();
  selElm.select2({
    placeholder: selElm.attr('placeholder'),
    dropdownParent: selElm.parent(),
    data: dataArr
  });
}

function initSummary() {
  // PERSONAL
  $("#showFullName").text($("#nama_lengkap").val());
  $("#showEmail").text($("#email_pemohon").val());
  $("#showPhone").text($("#no_handphone").val());

  // ADDRESS
  $("#showProvinsi").text(getText("#provinsi"));
  $("#showKota").text(getText("#kota"));
  $("#showKecamatan").text(getText("#kecamatan"));
  $("#showKelurahan").text(getText("#kelurahan"));
  $("#showKodePos").text($("#kode_pos").val());
  $("#showAddress").text($("#alamat_lengkap").val());

  // FUNDING
  $("#summary-jangka-waktu").text($("#jangka_waktu").val() + " Bulan");
  $("#summary-downpayment").text("Rp. " + $("#down_payment").val());
}

function getText(elm) {
  var _elm = $(elm);
  return _elm.find('option[value="' + _elm.val() + '"]').text();
}

function goToStep(idx) {
  form.steps("setStep", idx);
}

var isEdit = false;
function editStep(idx) {
  isEdit = true;
  goToStep(idx);
}

function getDataRegister() {
  var _data = {
    "submission_id": submission_id,
    // "full_name": $('#nama_lengkap').val().toString(),
    // "email": $('#email_pemohon').val().toString(),
    // "phone_number": $('#no_handphone').val().toString()
  }
  return _data;
}

function sendLeadData1Edu(){
  if (form.valid()) {
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

var isValidOtp = false;
(function ($) {

  $("#step-otp").hide();
  form = $("#getCredit").show();

  form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    titleTemplate: '<span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>#index#</b></span> <p>#title#</p>',
    /* Labels */
    labels: {
      finish: "Selesai",
      next: "Selanjutnya",
      previous: "Sebelumnya",
      loading: "Loading ..."
    },
    onInit: function () {
      nextButton("inactive");
    },
    onStepChanging: function (event, currentIndex, newIndex) {
      // Allways allow previous action even if the current form is not valid!
      if (currentIndex > newIndex) {
        return true;
      }
      if( currentIndex === 0){
            if (localStorage.getItem('token') === null ) {
               if(!isKnownNumber) {
                 checkLogin(); 
              }else{
                sendLeadData1Edu();
              }
               return isKnownNumber;
             } else {
                console.log("currentIndex false");
             }
          }
      if ($(".actions > ul li a[href$='next']").parent().hasClass("inactive")) {
        return false;
      }
      // console.log("isEdit", isEdit);
      if (isEdit) {
        isEdit = false;
        // console.log("edited");
        if (currentIndex === 0) {
          // console.log("go to summary");
          goToStep(3);
          return false;
        }
      }
      form.validate().settings.ignore = ":disabled,:hidden";
      return sendLeadData();
      // return true;
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      // Used to skip the "Warning" step if the user is old enough.
      checkValid();
      if (currentIndex > priorIndex && currentIndex === 2) {
        nextButton("inactive");
        initCalculate();
      }
      if (currentIndex > priorIndex && currentIndex === 3) {
        initSummary();
      }
      // if (currentIndex > priorIndex && currentIndex === 3) {
      //   initCalculate();
      // }
    },
    onFinishing: function (event, currentIndex) {
      if (!isValidOtp) {
        var retLead = sendLeadData();
        if (retLead) { showOtp() };
        return false;
      } else {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
      }
    },
    onFinished: function (event, currentIndex) {
      alert("Submitted!");
    }
  });

  $(document).on('change', 'input[type="hidden"]', checkValid);
  $(document).on('focusout keyup', 'input, textarea, select', checkValid);


  $("#provinsi").change(function () {
    var selElm = $('#kota');
    var dataArr = getCity($(this).val()[0]);
    // console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });

  $("#kota").change(function () {
    var selElm = $('#kecamatan');
    var dataArr = getDistrict($(this).val()[0]);
    // console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });

  $("#kecamatan").change(function () {
    var selElm = $('#kelurahan');
    var dataArr = getSubdistrict($(this).val()[0]);
    // console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });

  $("#kelurahan").change(function () {
    var selElm = $('#kelurahan');
    var dataArr = getZipcode($(this).val()[0]);
    // console.log("CITY", dataArr)
    var postcodeGen = dataArr[0].postal_code;
    if (postcodeGen !== 'null') {
      $("#kode_pos").val(postcodeGen);
      $("#kode_pos").data("value", dataArr[0].id);
      $("#kode_pos").prev().css({
        'display': 'block',
        'padding': '15px 15px 5px'
      });
      $("#kode_pos").css({
        'padding-top': '35px',
        'padding-bottom': '15px'
      });
      $('#alamat_lengkap').removeAttr("disabled");
      $('#alamat_lengkap').css("background-color", "white");
    } else {
      $("#kode_pos").val("");
      $("#kode_pos").data("value", "");
    }
  });

  $('input#agreement1').click(function(){
    if($(this).prop("checked") == true){
      finishButton("active");
    }
    else if($(this).prop("checked") == false){
      finishButton("inactive");
    }
  });

  $('#otp-form').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
        var parent = $($(this).parent());
        
        if(e.keyCode === 8) {
            var prev = parent.find('input#' + $(this).data('previous'));
            
            if(prev.length) {
                $(prev).select().val("");
            }
        }
        else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
            var next = parent.find('input#' + $(this).data('next'));
            
            if(next.length) {
                $(next).removeAttr("disabled").select();
            }
            else {
                $("#btn-verify").removeAttr("disabled").removeAttr("style");
            }
        }
    });
});

  $("#recalc").click(function (e) {
    nextButton("inactive");
    e.preventDefault();
    if (form.valid()) {
      var edu_package_price = $("#ex7SliderVal").val().replace(/[.]/g, "");
      var tenor = $("#jangka_waktu").val()[0];
      var down_payment = $("#down_payment").val().replace(/[.]/g, "");
      var _data = {
        "submission_id": submission_id,
        "edu_package_price": edu_package_price,
        "tenor": tenor,
        "down_payment": down_payment
      }
      var post = postData("/credit/edu-calculator", _data);
      if (post.success === "1") {
        nextButton("active");
        finishButton("inactive");
        var admin_fee = "Rp. "+ separatordot(post.data.admin_fee);
        var life_insurance = "Rp. " + separatordot(post.data.life_insurance);
        var monthly_installment = "Rp. " + separatordot(post.data.monthly_installment);
        var monthly_installment_est_total = "Rp. " + separatordot(post.data.monthly_installment_est_total);
        var total_funding = "Rp. " + separatordot(post.data.total_funding);

        $("#administrasi, #summary-administrasi").text(admin_fee);
        $("#life_insurance, #summary-life-insurance").text(life_insurance);
        $("#monthly_installment, #summary-angsuran-bulanan").text(monthly_installment);
        $("#monthly_installment_est_total, #summary-funding").text(monthly_installment_est_total);
        $("#total_funding, #summary-total-pembiayaan").text(total_funding);
      }
    }
    $(".warning-calculate").addClass("hide");
    countCalculate += 1;
  });

  setTimeout(function() { reInitJcf(); }, 2000);

})(jQuery);