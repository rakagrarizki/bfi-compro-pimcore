var form, submission_id;
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone", "#ktp"]
formGroup[1] = ["#provinsi", "#kota", "#kecamatan", "#kelurahan", "#kode_pos", "#alamat_lengkap"]

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

(function ($) {

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
      form.validate().settings.ignore = ":disabled,:hidden";
      return sendLeadData();
      // return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
      // Used to skip the "Warning" step if the user is old enough.
      checkValid();
      if (currentIndex > priorIndex && currentIndex === 2) {
        initCalculate();
      }
    },
    onFinishing: function (event, currentIndex) {
      form.validate().settings.ignore = ":disabled";
      return form.valid();
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

  $("#recalc").click(function (e) {
    e.preventDefault();
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
      console.log("CALC", post)
    }
  });

})(jQuery);