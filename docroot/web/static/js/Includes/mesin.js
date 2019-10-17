var form, submission_id;
var formGroup = [];
formGroup[0] = ["#nama_lengkap", "#email_pemohon", "#no_handphone"]
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

function getService() {
    var url = "/credit/get-machinery-services";
    var data = {};
    return transformData(getData(url, data).data);
}

function setService(){
    var selElm = $('#layanan');
    var dataArr = getService();
    console.log("CITY", dataArr)
    selElm.empty();
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
    console.log("CITY", dataArr)
    selElm.empty();
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
    console.log("CITY", dataArr)
    selElm.empty();
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
    console.log("CITY", dataArr)
    selElm.empty();
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
        // "machinery_brand_id": brandId, "machinery_type_id": $("#type").val()[0] 
        "machinery_brand_id": '7C50EED3-52DE-488E-90D6-E5AB9F96016A', "machinery_type_id": '5F8D0155-8035-4F37-8930-723594973F68'
    };
    return transformData(postData(url, data).data);
}

function getYear(modelId) {
    var url = "/credit/get-machinery-year";
    var data = { 
        // "machinery_model_id": modelId
        "machinery_model_id": '7EA5CCF9-2738-4C74-845B-0042CEF2A351' 
    };
    return postData(url, data).data
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
    }
    var sendData = postData(_url, _data);
    if (currentStep === 0) {
      submission_id = sendData.data.submission_id;
      setService();
      setIndustry();
      setType();
      setBrand();
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
  var package = getData("/credit/get-machinery-funding", {
      "submission_id" : submission_id
  });
  var rawMinPrice = parseInt(package.data.funding_min),
    rawMaxPrice = parseInt(package.data.funding_max),
    otr_price = parseInt(package.data.funding_min);

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
      if (currentIndex > priorIndex && currentIndex === 3) {
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

  $("#brand").change(function () {
    var selElm = $('#model');
    var dataArr = getModel($(this).val()[0]);
    console.log("CITY", dataArr)
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
      "funding": edu_package_price,
      "tenor": tenor,
      "down_payment": down_payment
    }
    var post = postData("/credit/machinery-calculate", _data);
    if (post.success === "1") {
      console.log("CALC", post)
    }
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

})(jQuery);