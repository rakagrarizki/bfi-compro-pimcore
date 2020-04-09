var form, submission_id;
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone", "#ktp"];
formGroup[1] = ["#provinsi", "#kota", "#kecamatan", "#kelurahan", "#kode_pos", "#alamat_lengkap"];
formGroup[2] = ["#ex7SliderVal", "#down_payment", "#jangka_waktu","#pocket_money"];
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
  if (typeof (formGroup[currentStep]) !== "undefined" && currentStep === 2 && countCalculate > 0) {
      isValid = false;
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
  if (action === "active") {
    nextBtn.removeClass("inactive");
  } else {
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
        _url = "/credit/save-leisure-leads1";
        _data = {
          "submission_id": "",
          "name": $("#nama_lengkap").val(),
          "email": $("#email_pemohon").val(),
          "phone_number": $("#no_handphone").val()
        //   "path_ktp": $("#ktp").val()
        }
        break;
      case 1:
        _url = "/credit/save-leisure-leads2";
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
        _url = "/credit/save-leisure-leads3";
        _data = {
          "submission_id": submission_id
        }
        break;
      case 3:
        _url = "/credit/save-leisure-leads4";
        _data = {
          "submission_id": submission_id
        }
        break;
      case 4:
        _url = "/credit/save-leisure-leads5";
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
      // } else if (currentStep === 2) {
      //   if (sendData.data.is_pricing === false) {
      //     $("#modal-pricing").modal('show');
      //   }
      //   return sendData.data.is_pricing
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

function sendLeadData1Travel() {
  if (form.valid()) {
    var currentStep = form.steps("getCurrentIndex");
    var _url = "";
    var _data = {};

    switch (currentStep) {
      case 0:
        _url = "/credit/save-leisure-leads1";
        _data = {
          "submission_id": "",
          "name": $("#nama_lengkap").val(),
          "email": $("#email_pemohon").val(),
          "phone_number": $("#no_handphone").val()
        //   "path_ktp": $("#ktp").val()
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
  _url = "/credit/save-leisure-leads5";
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
  var package = getData("/credit/get-leisure-package", {});
  var rawMinPrice = parseInt(package.data.minimum_funding),
    rawMaxPrice = parseInt(package.data.maximum_funding),
    otr_price = parseInt(package.data.minimum_funding);

  var rawDownPayment = rawMinPrice * 0.1;

  $("#calcSlider").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.max = rawMaxPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.min = rawMinPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.step = 100000;
  $('#ex7SliderVal').parents(".sliderGroup").find(".calcslide").slider().on('slideStop', function (ev) {
    $("#down_payment").val((parseInt($("#ex7SliderVal").val().replace(/[.]/g, ""),10)/10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
  });

  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").slider('setValue', rawMinPrice);

  var minprice = separatordot(rawMinPrice),
    maxprice = separatordot(rawMaxPrice),
    downPayment = separatordot(rawDownPayment);

  $("#ex7SliderVal").val(minprice);
  $('#down_payment').val(downPayment);
  $("#pocket_money").val(downPayment);
  $(".valuemin").text(minprice);
  $(".valuemax").text(maxprice);
  $("#otr").val(otr_price);
}

function getDataTenor() {
  var selElm = $("#jangka_waktu");
  var ret = getData("/credit/get-leisure-tenor", {});
  var dataArr = [];
  $.each(ret.data, function (idx, item) {
    dataArr.push({
      id: item.tenor,
      text: item.desc
    });
  })
  selElm.empty();
  selElm.select2({
    placeholder : selElm.attr('placeholder'),
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
          }else{
            sendLeadData1Travel();
          }
           return isKnownNumber;
         } else {
            console.log("currentIndex false");
         }
      }
      form.validate().settings.ignore = ":disabled,:hidden";
      return sendLeadData();
      // return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      // Used to skip the "Warning" step if the user is old enough.
      checkValid();
      if (currentIndex > priorIndex && currentIndex === 2) {
        nextButton("inactive");
        initCalculate();
      }else if (currentIndex > priorIndex && currentIndex === 3) {
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
    console.log("CITY", dataArr)
    selElm.empty();
    selElm.select2({
      placeholder: selElm.attr('placeholder'),
      dropdownParent: selElm.parent(),
      data: dataArr
    });
    selElm.removeAttr("disabled");
  });


  $('.main-package-price').on('input propertychange paste', function (e) {
    var _val = parseInt($("#ex7SliderVal").val().replace(/[.]/g, ""), 10);
    var _valMin = parseInt($(".valuemin").text().replace(/\./g, ''), 10);
    var _valMax = parseInt($(".valuemax").text().replace(/\./g, ''), 10);
    if (_valMin <= _val && _val <= _valMax){
      $("#down_payment").val((_val/10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      $("#pocket_money").val((_val/10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    } else {
      e.preventDefault();
      // $("#down_payment").val(_valMin.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      // $("#pocket_money").val(_valMin.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    }
  });

  $("#kota").change(function () {
    var selElm = $('#kecamatan');
    var dataArr = getDistrict($(this).val()[0]);
    console.log("CITY", dataArr)
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
    console.log("CITY", dataArr)
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
    console.log("CITY", dataArr)
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

  $("#recalc").click(function (e) {
    if ($("#jangka_waktu").valid()) {
      nextButton("inactive");
      e.preventDefault();
      var leisure_package_price = $("#ex7SliderVal").val().replace(/[.]/g, "");
      var tenor = $("#jangka_waktu").val()[0];
      var down_payment = parseInt($("#down_payment").val().replace(/[.]/g, ""),10);
      var pocket_money = $("#pocket_money").val().replace(/[.]/g, "");
      var _data = {
        "submission_id": submission_id,
        "leisure_package_price": leisure_package_price,
        "tenor": tenor,
        "down_payment": down_payment,
        "pocket_money" : pocket_money
      }
      var post = postData("/credit/leisure-calculator", _data);
      if (post.success === "1") {
      //   console.log("CALC", post)
          nextButton("active");
          finishButton("inactive");
          $("#totalFinance").text(post.data.total_funding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#pocketMoney").text(post.data.pocket_money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#labelTotal").text(post.data.monthly_installment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#lifeInsurance").text(post.data.life_insurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#administrativeCode").text(post.data.admin_fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#totalMonthly").text(post.data.monthly_installment_est_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#summary-angsuran-bulanan").text('Rp. '+post.data.monthly_installment_est_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#summary-total-pembiayaan").text('Rp. '+post.data.total_funding.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
          $("#summary-harga-paket-pendidikan").text('Rp. '+$("#ex7SliderVal").val());
      }
      $(".warning-calculate").addClass("hide");
    }
    countCalculate += 1;
  });

  $('#jangka_waktu').on("select2:select", function () {
    nextButton("inactive");
    if (countCalculate > 0) {
      $(".warning-calculate").removeClass("hide");
    }
  });

  $('#alamat_lengkap').keypress(function(event){
    $('#alamat_lengkap').addClass('label-padding');
    $('.label-place').addClass('disapper-label');
  });

  setTimeout(function () { reInitJcf(); }, 2000); 

  $("input.input-number").on('focusout', function () {
    if ($(this).val() == "") {
        $("#otp-verification").css({"backgroundColor": "#dddddd", "color": "white"});
    }else{
        $("#otp-verification").removeAttr("disabled").css({"backgroundColor": "#f9991c", "color": "white"});
    }
});

})(jQuery);