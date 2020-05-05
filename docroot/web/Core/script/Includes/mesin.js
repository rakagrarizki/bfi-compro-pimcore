var form, submission_id;
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone"]
formGroup[1] = ["#provinsi", "#kota", "#kecamatan", "#kelurahan", "#kode_pos", "#alamat_lengkap"]
formGroup[2] = ["#layanan", "#industri", "#type", "#machine_qty", "#brand", "#model", "#year", "#machine_estimated"]
formGroup[3] = ["#down_payment", "#jangka_waktu"]
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

  if (typeof (formGroup[currentStep]) !== "undefined" && currentStep === 3) {
    // if (!$('#jangka_waktu').valid()) {
    isValid = false;
    // }
    // if ($('#jangka_waktu').val()[0]==="") {
      // isValid = false;
    // }
  }
  return isValid;
}

var chkValid = function() {
  return $('#nama_lengkap').valid()&& 
      $('#email_pemohon').valid() && 
      $('#no_handphone').valid()
      ? true
      : false;
};

function checkValid() {
  if (isValidStep()&&chkValid()) {
    // do something
    nextButton("active");
  } else {
    nextButton("inactive");
  }
}

function showNextButton(isShow) {
  if (isShow) {
    // do something
    nextButton("active");
  } else {
    nextButton("inactive");
  }
}

function getService() {
    var url = "/credit/get-machinery-services";
    var data = {};
    return transformData(getData(url, data).data);
}

function setService(){
    var selElm = $('#layanan');
    var dataArr = getService();
    // console.log("CITY", dataArr)
    // selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
}

function getIndustry() {
    var url = "/credit/get-machinery-industry";
    var data = {};
    return transformData(getData(url, data).data);
}

function setIndustry(){
    var selElm = $('#industri');
    var dataArr = getIndustry();
    // console.log("CITY", dataArr)
    // selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
}

function getType() {
    var url = "/credit/get-machinery-type";
    var data = {};
    return transformData(getData(url, data).data);
}

function setType(){
    var selElm = $('#type');
    var dataArr = getType();
    // console.log("CITY", dataArr)
    // selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
}

function getBrand() {
    var url = "/credit/get-machinery-brand";
    var data = {};
    return transformData(getData(url, data).data);
}

function setBrand(){
    var selElm = $('#brand');
    var dataArr = getBrand();
    // console.log("CITY", dataArr)
    // selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
}

function getModel(brandId) {
    var url = "/credit/get-machinery-model";
    var data = { 
      "machinery_brand_id": brandId, "machinery_type_id": $("#type").val()[0] 
      // "machinery_brand_id": '7C50EED3-52DE-488E-90D6-E5AB9F96016A', "machinery_type_id": '5F8D0155-8035-4F37-8930-723594973F68'
    };
    return transformData(postData(url, data).data);
}

function getYear(modelId) {
    var url = "/credit/get-machinery-year";
    var data = { 
      "machinery_model_id": modelId
      // "machinery_model_id": '7EA5CCF9-2738-4C74-845B-0042CEF2A351' 
    };
    return postData(url, data).data
}

function getEstimatePrice(yearId){
  var url = "/credit/get-machinery-price";
    var data = { 
      "machinery_service_id": $("#layanan").val()[0], "machinery_year_id": yearId
    };
    return postData(url, data).data
}

function nextButton(action) {
  var nextBtn = $(".actions > ul li a[href$='next']").parent();
  var warnElm = $(".warning-calculate");
  var isWarn = warnElm.hasClass("hide");
  if (action === "active") {
    nextBtn.removeClass("inactive");
    if (!isWarn && countCalculate > 0) { warnElm.addClass("hide") }
  } else {
    if (!nextBtn.hasClass("inactive")) {
      nextBtn.addClass("inactive");
    }
    if (isWarn && countCalculate > 0) { warnElm.removeClass("hide") }
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
    var sendData = postData(_url, _data);
    if (currentStep === 0) {
      submission_id = sendData.data.submission_id;
      setService();
      setIndustry();
      setType();
      setBrand();
    }
    // sendData.data.is_branch = false;
    if (sendData.success === "1") {
      // return true;
      if(currentStep === 1) {
        if(sendData.data.is_branch === false) {
          $("#modal-branch").modal('show');
        }        
        return sendData.data.is_branch
      } else if (currentStep === 2) {
        if (sendData.data.is_pricing === false) {
          $("#modal-pricing").modal('show');
        }
        return sendData.data.is_pricing
      }else{
        return true;
      }
    } else {
      return false;
    }
  }else {
    return false;
  }
}

function sendLastLeads() {
  _url = "/credit/save-machinery-leads6";
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
  var package = postData("/credit/get-machinery-funding", {
    "submission_id" : submission_id
  });
  var rawMinPrice = parseInt(package.data.funding_min),
  rawMaxPrice = parseInt(package.data.funding_max),
  otr_price = parseInt(package.data.funding_min);
  
  if(package.data.is_payment_down){
    var down_payment = postData("/credit/get-machinery-down-payment", {
      "submission_id" : submission_id
    });
    $('.mesin-down-payment').show();
    var rawDownPayment = parseInt(down_payment.data.down_payment_min_value),
      rawMinDPVal = parseInt(down_payment.data.down_payment_min_value),
      rawMaxDPVal = parseInt(down_payment.data.down_payment_max_value),
      rawMinDPPercent = parseFloat(down_payment.data.down_payment_min_percent),
      rawMaxDPPercent = parseFloat(down_payment.data.down_payment_max_percent);

    $('#down_payment').data("minVal", rawMinDPVal);
    $('#down_payment').data("maxVal", rawMaxDPVal);
    $('#down_payment').data("minPercentage", rawMinDPPercent);
    $('#down_payment').data("maxPercentage", rawMaxDPPercent);
  }else{
    $('.mesin-down-payment').hide();
    var rawDownPayment = 0;
  }

  $("#calcSlider").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.max = rawMaxPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.min = rawMinPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.step = 100000;

  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").slider('setValue', rawMinPrice);

  var minprice = separatordot(rawMinPrice),
    maxprice = separatordot(rawMaxPrice), 
    downPayment = separatordot(rawDownPayment);

  $('#down_payment').val(downPayment);

  $("#ex7SliderVal").val(minprice);
  $(".valuemin").text(minprice);
  $(".valuemax").text(maxprice);
  $("#otr").val(otr_price);
}

function getDataTenor() {
  var selElm = $("#jangka_waktu");
  var ret = getData("/credit/get-machinery-tenor", {});
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

  // Machine data
  $("#summary-service-mesin").text(getText("#layanan"));
  $("#summary-industri").text(getText("#industri"));
  $("#summary-mesin-type").text(getText("#type"));
  $("#summary-machine-qty").text($("#machine_qty").val());
  $("#summary-mesin-brand").text(getText("#brand"));
  $("#summary-estimated-price").text($("#machine_estimated").val());

  // FUNDING
  $("#summary-jangka-waktu").text($("#jangka_waktu").val() + " Bulan");
  $("#summary-total-pembiayaan").text("Rp. " + $("#ex7SliderVal").val());
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
  }
  return _data;
}

function sendLeadData1Mesin(){
  if (form.valid()) {
    var currentStep = form.steps("getCurrentIndex");
    var _url = "";
    var _data = {};

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
    }
    var sendData = postData(_url,_data);
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

  var lang = document.documentElement.lang;
  if ( lang === 'id'){
      nextLabel = 'Selanjutnya'
      previouslabel = 'Sebelumnya'
      finishlabel = 'Selesai'
      loadinglabel = 'Mohon menunggu ...'
  }else{
      nextLabel = 'Next'
      previouslabel = 'Previous'
      finishlabel = 'Finish',
      loadinglabel = 'Loading ...'
  }

  form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="number"><i class="fa fa-check" aria-hidden="true"></i><b>#index#</b></span> <p>#title#</p>',
    /* Labels */
  
    labels: {
      finish: finishlabel,
      next: nextLabel,
      previous:  previouslabel ,
      loading: loadinglabel 
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
               checkLoginCustom(); 
               return isKnownNumber;
            }else if (localStorage.getItem('token') != null ){
              sendLeadData1Mesin();
            }
             
           } else {
              // console.log("currentIndex false");
           }
        }
      form.validate().settings.ignore = ":disabled,:hidden";
      return sendLeadData();
      // return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      // Used to skip the "Warning" step if the user is old enough.
      checkValid();
      if (currentIndex > priorIndex && currentIndex === 3) {
        nextButton("inactive");
        initCalculate();
      }else if (currentIndex > priorIndex && currentIndex === 4) {
        initSummary();
      }
    },
    onFinishing: function (event, currentIndex) {
      if (!isValidOtp) {
        var retLead = sendLeadData();
        if (retLead) { showOtp() };
        var dataNews = {
          "submission_id": submission_id,
          "is_news_letter": $('#agreement1').is(":checked")
        }
        var post = postData("/register/newsletter", dataNews);
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

  $("#brand").change(function () {
    var selElm = $('#model');
    var dataArr = getModel($(this).val()[0]);
    // console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });

  $("#model").change(function () {
    var selElm = $('#year');
    var ret = getYear($(this).val()[0]);
    var dataArr = [];
    $.each(ret, function (idx, item) {
        dataArr.push({
        id: item.id,
        text: item.year
        });
    })
    // console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });

  $("#year").change(function () {
    var ret = getEstimatePrice($(this).val()[0]);
    var rawPrice = parseInt(ret.price);
    var rawMinPriceMachinery = parseInt(ret.min_estimasi_price);
    var price = separatordot(rawPrice);
    $("#machine_estimated").val(price);
    $("#machine_estimated").prev().css({
      'display': 'block',
      'padding': '15px 15px 5px'
    });
    $("#machine_estimated").css({
      'padding-top': '35px',
      'padding-bottom': '15px'
    });
    $.validator.addClassRules({
      formEstimate: {
        minEstimatePrice: rawMinPriceMachinery,
        required: true
      }
    });
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

  $("#recalcMesin").click(function (e) {
    nextButton("inactive");
    e.preventDefault();
    if ($("#jangka_waktu").valid()) {
      var edu_package_price = parseInt($("#ex7SliderVal").val().replace(/[.]/g, ""),10);
      var tenor = parseInt($("#jangka_waktu").val()[0],10);
      var down_payment = parseInt($("#down_payment").val().replace(/[.]/g, ""),10);
      var _data = {
        "submission_id": submission_id,
        "funding": edu_package_price,
        "tenor": tenor,
        "down_payment": down_payment
      }
      var post = postData("/credit/machinery-calculate", _data);
    
      // var lang = document.documentElement.lang;
      // var tenorMsg;
      // if (lang == "id") {
      //   tenorMsg = "Isian wajib diisi";
      // } else {
      //   tenorMsg = "Field is required.";
      // }

      // if (isNaN(tenor)){
      //   $("#error-tenor").append("<div class='text-error-tenor'>"+tenorMsg+"</div>");
      //   $(this).off("click");
      // }
      if (post.success === "1") {
        // console.log("CALC", post)
        nextButton("active");
        finishButton("inactive");
        $("#permonth-estimation").text(post.data.monthly_installment_est_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $("#summary-angsuran-bulanan").text(post.data.monthly_installment_est_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      }
      $(".warning-calculate").addClass("hide");
    }
    countCalculate += 1;
    
  });

  $('input[type=radio][name=applicant_position]').change(function() {
        if (this.value == 'perorang') {
            $("#nama_perusahaan").prop('disabled', true);
            $("#nama_perusahaan").val(null);
            $("#nama_perusahaan").css("padding-top", '20px');
            $('label[for="nama_perusahaan"]').hide();
        }
        else if (this.value == 'perusahaan') {
            $("#nama_perusahaan").prop('disabled', false);
        }
  });

  $('#alamat_lengkap').keypress(function(event){
    $('#alamat_lengkap').addClass('label-padding');
    $('.label-place').addClass('disapper-label');
  });
  
  // if ($("#jangka_waktu").length > 0) {
    // $('#jangka_waktu').on('select2:select', function (e) {
    //   nextButton("inactive");
    //   if (countCalculate > 0) {
    //     $(".warning-calculate").removeClass("hide");
    //   }
    // });
  // }
  setTimeout(function () { reInitJcf(); }, 2000);
  
  $("input.input-number").on('focusout', function () {
    if ($(this).val() == "") {
        $("#otp-verification").css({"backgroundColor": "#dddddd", "color": "white"});
    }else{
        $("#otp-verification").removeAttr("disabled").css({"backgroundColor": "#f9991c", "color": "white"});
    }
});

})(jQuery);