var form, submission_id;
var formAfterOTP = ["#education", "#meried", "#burden", "#profession", "#npwp", "#noKtp", "#ktp", "#haveSmartphone"];
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone"];
formGroup[1] = ["#provinsi", "#kota", "#kecamatan", "#kelurahan", "#kode_pos", "#alamat_lengkap"];
formGroup[2] = ["#bank", "#account_number", "#account_name"];


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

  if (typeof (formGroup[currentStep]) !== "undefined" && currentStep === 0 && isValidOtp) {
    $.each(formAfterOTP, function (idx, item) {
      if ($(item).val() === "") {
        isValid = false;
      }
    });
    if ($('input[name="are_member"]:checked').val() === "1" && $("#areCode").val() === "") {
      isValid = false;
    }
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

function sendLeadData() {
  if (form.valid()) {
    var currentStep = form.steps("getCurrentIndex");
    var _url = "";
    var _data = {};

    switch (currentStep) {
      case 0:
        _url = "/agent/save-agent-otp";
        _data = {
          "submission_id": submission_id,
          "name": $("#nama_lengkap").val(),
          "email": $("#email_pemohon").val(),
          "phone_number": $("#no_handphone").val(),
          "education_id": $("#education").val()[0],
          "marital_status_id": $("#meried").val()[0],
          "jumlah_tanggungan": $("#burden").val()[0],
          "occupation_id": $("#profession").val()[0],
          "no_npwp": $("#npwp").val(),
          "no_ktp": $("#noKtp").val(),
          "stream_ktp": $("#ktp").val(),
          "code_are": ($('input[name="are_member"]:checked').val() === "1" ? $("#areCode").val() : ""),
          "have_smartphone": $('input[name="haveSmartphone"]:checked').val()
        }
        break;
      case 1:
        _url = "/agent/save-agent-candidate-step2";
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
        _url = "/agent/save-agent-candidate-step3";
        _data = {
          "submission_id": submission_id,
          "bank_id": $("#bank").val()[0],
          "account_number": $("#account_number").val(),
          "account_name": $("#account_name").val(),
        }
        break;
      case 3:
        var _channels = [];
        $.each($('input[name="channel"]:checked'), function (idx, item) {
          _channels.push($(this).val());
        });
        _url = "/agent/save-agent-candidate-step4";
        _data = {
          "submission_id": submission_id,
          "is_paham_financing": $('input[name="financing"]:checked').val(),
          "id_waktu_kerja": $('input[name="waktu-kerja"]:checked').val(),
          "selling_channel": _channels.join(","),
        }
        break;
    }
    var sendData = postData(_url, _data);
    if (currentStep === 0) {
      submission_id = sendData.data.submission_id;
    }
    if (sendData.success === "1") {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function initCalculate() {
  getDataTenor();
  var package = getData("/credit/get-edu-package", {});
  var rawMinPrice = parseInt(package.data.minimum_funding),
    rawMaxPrice = parseInt(package.data.maximum_funding),
    otr_price = parseInt(package.data.minimum_funding);

  $("#calcSlider").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.max = rawMaxPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.min = rawMinPrice;
  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").data('slider').options.step = 100000;

  $("#ex7SliderVal").parents(".sliderGroup").find(".calcslide").slider('setValue', rawMinPrice);

  var minprice = separatordot(rawMinPrice),
    maxprice = separatordot(rawMaxPrice);

  $("#ex7SliderVal").val(minprice);
  $(".valuemin").text(minprice);
  $(".valuemax").text(maxprice);
  $("#otr").val(otr_price);
}

function getDataTenor() {
  var selElm = $("#jangka_waktu");
  var ret = getData("/credit/get-edu-tenor", {});
  var dataArr = [];
  selElm.empty();
  $.each(ret.data, function (idx, item) {
    selElm.append($('<option>', {
      value: item.tenor,
      text: item.desc
    }));
  })
  selElm.find('option:first-child').attr('selected', 'selected');
}

function initSummary() {
  // PERSONAL
  $("#showFullName").text($("#nama_lengkap").val());
  $("#showEmail").text($("#email_pemohon").val());
  $("#showPhone").text($("#no_handphone").val());

  $("#showEducation").text(getText($("#education")));
  $("#showMeried").text(getText($("#meried")));
  $("#showBurden").text(getText($("#burden")));
  $("#showProfession").text(getText($("#profession")));

  $("#showNpwp").text($("#npwp").val());
  $("#showNoKtp").text($("#noKtp").val());

  var areMember = $('input[name="are_member"]:checked');
  var haveSmartphone = $('input[name="haveSmartphone"]:checked');
  console.log("MEMBER", areMember)
  $("#showAre_member").text(areMember[0].labels[0].innerText);
  $("#showAreCode").text((areMember.val() === "1" ? $("#areCode").val() : "-"));
  $("#showHaveSmartphone").text(haveSmartphone[0].labels[0].innerText);

  // ADDRESS
  $("#showProvinsi").text(getText("#provinsi"));
  $("#showKota").text(getText("#kota"));
  $("#showKecamatan").text(getText("#kecamatan"));
  $("#showKelurahan").text(getText("#kelurahan"));
  $("#showKodePos").text($("#kode_pos").val());
  $("#showAddress").text($("#alamat_lengkap").val());

  // Data Rekening Bank
  $("#showBank").text(getText("#bank"));
  $("#showAccount_number").text($("#account_number").val());
  $("#showAccount_name").text($("#account_name").val());

  // // Data Tambahan
  // var financing = $('input[name="financing"]:checked')[0].labels[0].innerText;
  // var workingHour = $('input[name="waktu-kerja"]:checked')[0].labels[0].innerText;
  // $("#showChannel").empty();
  // $.each($('input[name="channel"]:checked'), function (idx, item) {
  //   console.log("CHOOSE", $(this));
  //   $("#showChannel").append("<li>" + $(this)[0].labels[0].innerText + "</li>");
  // });

  // $("#showFinancing").text(financing);
  // $("#showWaktu-kerja").text(workingHour);
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

function dropdownElm(elm, url, data) {
  var selElm = elm;
  var dataArr = transformData(getData(url, data).data);
  // console.log("EDUCATION", dataArr)
  // selElm.empty();
  selElm.select2({
    placeholder: selElm.attr('placeholder'),
    dropdownParent: selElm.parent(),
    data: dataArr
  });
  selElm.removeAttr("disabled");
}

function radioElm(elm, name, url, data) {
  var selElm = elm;
  var dataArr = getData(url, data).data;

  selElm.empty();
  $.each(dataArr, function (idx, item) {
    var _id = name + idx;
    selElm.append('<div class="radio-inside"><input type="radio" value="' + item.id + '" id="' + _id + '" name="' + name + '"><label for="' + _id + '">' + item.desc + '</label></div >');
  });
}

function checkboxElm(elm, name, url, data) {
  var selElm = elm;
  var dataArr = getData(url, data).data;

  selElm.empty();
  $.each(dataArr, function (idx, item) {
    var _id = name + idx;
    selElm.append('<div class="checkbox-inside"><input type="checkbox" value="' + item.id + '" id="' + _id + '" name="' + name + '"><label for="' + _id + '">' + item.desc + '</label></div >');
  });
}

function getEducation() {
  var url = "/agent/get-list-education";
  var data = {};
  var selElm = $('#education');
  dropdownElm(selElm, url, data);
}

function getMaritalStatus() {
  var url = "/agent/get-list-marital-status";
  var data = {};
  var selElm = $('#meried');
  dropdownElm(selElm, url, data);
}

function getBurden() {
  var selElm = $('#burden');
  var dataArr = [
    { id: 0, text: 0 },
    { id: 1, text: 1 },
    { id: 2, text: 2 },
    { id: 3, text: 3 },
    { id: 4, text: 4 },
    { id: 5, text: 5 }
  ];
  selElm.select2({
    placeholder: selElm.attr('placeholder'),
    dropdownParent: selElm.parent(),
    data: dataArr
  });
  selElm.removeAttr("disabled");
}

function getProfession() {
  var url = "/agent/get-list-pekerjaan";
  var data = {};
  var selElm = $('#profession');
  dropdownElm(selElm, url, data);
}

function getWorkinTimeList() {
  var url = "/agent/get-list-waktu-kerja";
  var data = {};
  var selElm = $('#waktu-kerja');
  radioElm(selElm, "waktu-kerja", url, data);
  jcf.replace(selElm.find("input"));
}

function getMarketingList() {
  var url = "/agent/get-list-selling-channel";
  var data = {};
  var selElm = $('#selling-channel');
  checkboxElm(selElm, "channel", url, data);
  jcf.replace(selElm.find("input"));
}

function showFormOTP() {
  if (isValidOtp) {
    form.validate().settings.ignore = ":disabled";
    return sendLeadData();
  } else {
    $("#formStep1").hide();
    showOtp()
    return false;
  }
}

function successAgentOTP() {
  $(".actions > ul li a[href$='next']").text('Selanjutnya');
  $("#personal-detail").show();
}

function otpAgentVerified() {
  var otp1Value = $('input[name=otp1]').val().toString(),
    otp2Value = $('input[name=otp2]').val().toString(),
    otp3Value = $('input[name=otp3]').val().toString(),
    otp4Value = $('input[name=otp4]').val().toString(),
    no_handphone = $('#no_handphone').val().toString();

  var _data = {
    phone_number: no_handphone,
    otp_code: otp1Value + otp2Value + otp3Value + otp4Value
  }
  var verifiedOtp = postOTP("/otp/validate-otp", _data);
  if (verifiedOtp.success === "1") {
    successAgentOTP();
  } else {
    $('#wrongOtp').modal('show');
  }
}

$("#frmAreCode").hide();
function toggleAreMember() {
  var _val = $('input[name="are_member"]:checked').val();
  // console.log("ARE", _val)
  if (_val === "1") {
    $("#frmAreCode").show();
  } else {
    $("#frmAreCode").hide();
  }
}

function agentVerifiedOtp() {
  var otp1Value = $('input[name=otp1]').val().toString(),
    otp2Value = $('input[name=otp2]').val().toString(),
    otp3Value = $('input[name=otp3]').val().toString(),
    otp4Value = $('input[name=otp4]').val().toString(),
    no_handphone = $('#no_handphone').val().toString();

  var _data = {
    phone_number: no_handphone,
    otp_code: otp1Value + otp2Value + otp3Value + otp4Value
  }
  var verifiedOtp = postOTP("/otp/validate-otp", _data);
  if (verifiedOtp.success === "1") {
    successAgentOTP();
    // showSuccessAgentOtp();
  } else {
    $('#wrongOtp').modal('show');
  }
}

function successAgentOTP() {
  var _data = {
    "submission_id": "",
    "collateral_type_id": $('#collateral_type').val().toString(),
    "name": $('#nama_lengkap').val().toString(),
    "email": $('#email_pemohon').val().toString(),
    "phone_number": $('#no_handphone').val().toString()
  }
  var register = postData("/agent/save-agent-candidate-step1", _data);
  if (register.success === "1") {
    submission_id = register.data.submission_id;
    showSuccessAgentOtp();
  } else {
    $('#failedOtp').modal('show');
  }
}

function showSuccessAgentOtp() {
  $("#formStep1, .actions, .steps").show();
  $("#step-otp").hide();
  $("#personal-detail").show();
  $("#step-summary").show();
  nextButton("inactive");
  $(".actions > ul li a[href$='next']").text('Selanjutnya');
  isValidOtp = true;
}

function initForm() {
  reInitJcf();
  $("#step-otp,#personal-detail").hide();
  $("#npwp").inputmask("99.999.999.9-999.999", { "placeholder": "0" });
  $("#areCode").inputmask("99999", { "placeholder": "0" });
  getEducation();
  getMaritalStatus();
  getBurden();
  getProfession();
}

function initBank() {
  var url = "/agent/get-list-bank";
  var data = {};
  var selElm = $('#bank');
  dropdownElm(selElm, url, data);
}

function initAdditionalInfo() {
  getWorkinTimeList();
  getMarketingList();
  // reInitJcf();
  // jcf.refreshAll();
}

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
    setTimeout(initForm, 500);
  },
  onStepChanging: function (event, currentIndex, newIndex) {
    // Allways allow previous action even if the current form is not valid!
    if (currentIndex > newIndex) {
      return true;
    }
    if ($(".actions > ul li a[href$='next']").parent().hasClass("inactive")) {
      form.valid();
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

    if (currentIndex === 0 && !isValidOtp) {
      return showFormOTP();
    }

    form.validate().settings.ignore = ":disabled,:hidden";
    return sendLeadData();
    // return true;
  },
  onStepChanged: function (event, currentIndex, priorIndex) {
    // Used to skip the "Warning" step if the user is old enough.
    checkValid();
    if (currentIndex > priorIndex && currentIndex === 2) {
      setTimeout(initBank, 500);
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
      showOtp()
      return false;
    } else {
      form.validate().settings.ignore = ":disabled";
      return form.valid();
    }
  },
  onFinished: function (event, currentIndex) {
    $("#otp-success").show();
    $("#step-summary").hide();
    $(".wizard .steps, .wizard .actions").hide();
    // alert("Submitted!");
  }
});

var isValidOtp = false;
(function ($) {
  $(document).on("click", "#otp-verification", otpAgentVerified)

  $("#step-otp").hide();

  $(document).on('change', 'input[type="hidden"]', checkValid);
  $(document).on('focusout keyup', 'input, textarea, select', checkValid);

  $(document).on('change', 'input[name="are_member"]', toggleAreMember);
  $(document).on('click', '#agentOtp-verification', agentVerifiedOtp)

  $('input[name="applicant_position"]').change(function () {
    console.log($(this).val())
  });

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

  $("#recalc").click(function (e) {
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
        var life_insurance = "Rp. " + separatordot(post.data.life_insurance);
        var monthly_installment = "Rp. " + separatordot(post.data.monthly_installment);
        var monthly_installment_est_total = "Rp. " + separatordot(post.data.monthly_installment_est_total);
        var total_funding = "Rp. " + separatordot(post.data.total_funding);

        $("#life_insurance, #summary-life-insurance").text(life_insurance);
        $("#monthly_installment, #summary-angsuran-bulanan").text(monthly_installment);
        $("#monthly_installment_est_total, #summary-funding").text(monthly_installment_est_total);
        $("#total_funding, #summary-total-pembiayaan").text(total_funding);
      }
    }
  });

})(jQuery);