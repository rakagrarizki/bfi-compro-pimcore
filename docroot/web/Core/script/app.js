(function ($) {
  var lang = document.documentElement.lang;

  $('.panel-collapse').on('shown.bs.collapse', function (e) {
    var $panel = $(this).closest('.panel');
    $('html,body').animate({
      scrollTop: $panel.offset().top - 120
    }, 500);
  });

  $(document).ready(function () {
    $(".sect-title .button a").click(function () {
      var aid = $(this).data("key");
      $('html,body').animate({
        scrollTop: $(aid).offset().top - 80
      }, 'slow');

      var idAccor = $(aid).find('.panel-group .panel-default:first-child .panel-collapse').attr('id');
      // console.log(idAccor);
      $('#' + idAccor).collapse('toggle');
    });

    if ($(".input-group .iptDate").length > 0) {
      $('.input-group .iptDate').datepicker({
        showOn: "button",
        buttonText: "",
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy'
      });
    }

    if ($(".formatRibuan").length > 0) {
      $(".formatRibuan").keyup(function () {
        // console.log($(this).val())
        $(this).val(formatRupiah($(this).val(), ""));
      })
    }


  });

  // TABS
  $('#tabsAccor a:first').tab('show');

  // VISI-MISI
  var $status = $('.pagingInfo');
  var $slickElement = $('#vm-slide-misi');

  $slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
    var i = (currentSlide ? currentSlide : 0) + 1;
    $status.html('<b>'+i+'</b>' + '/' + slick.slideCount);
  });

  $slickElement.slick({
    slideToShow: 1,
    prevArrow: $(".prev"),
    nextArrow: $(".next"),
    autoplay: true,
    autoplaySpeed: 5000,
    adaptiveHeight: true
  });


  // BLOG/PROMO
  $('.bp-select').select2({
    minimumResultsForSearch: Infinity
  });

  // SAME HEIGHT
  // Get Highest Dom
  var res = function () {
    if ($('#bfi-cabang .thumbnail--branch .thumbnail-caption h3').length > 0) {
      $('#bfi-cabang').each(function () {
        $(this).find(".thumbnail-caption h3").height("auto");
        cH = getHighestDOM($(this).find(".thumbnail-caption h3"));
        $(this).find(".thumbnail-caption h3").height(cH);
      });
    }
    if ($('#bfi-cabang .thumbnail--branch .thumbnail-caption p').length > 0) {
      $('#bfi-cabang').each(function () {
        $(this).find(".thumbnail-caption p").height("auto");
        cH = getHighestDOM($(this).find(".thumbnail-caption p"));
        $(this).find(".thumbnail-caption p").height(cH);
      });
    }
    if ($('.blog-promo .card-item .title').length > 0) {
      $('.blog-promo .card-item').each(function () {
        $(this).find(".title").height("auto");
        cH = getHighestDOM($(this).find(".title"));
        $(this).find(".title").height(cH);
      });
    }
  };

  function getHighestDOM(dom) {
    var highest_height = 0;

    dom.each(function (index, val) {
      if (highest_height <= $(val).height()) {
        highest_height = $(val).height();
      }
    });
    return highest_height;
  }

  $(window).resize(function () {
    res();
  });

  $(document).ready(function (e) {
    res();
  });

  var input = document.getElementById('file_upload');
  var infoArea = document.getElementById('nama-file');

  //input.addEventListener('change', showFileName);

  function showFileName(event) {

    // the change event gives us the input it occurred in
    var input = event.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    // use fileName however fits your app best, i.e. add it into a div
    infoArea.textContent = fileName;
  }

  // console.log($( window ).height());
  // console.log($(document).height());

  $(window).scroll(function () {
    var st = $(this).scrollTop();

    if (st >= 100) {
      $('#site-header').addClass('active');
      $('#site-container').addClass('active');
    } else {
      $('#site-header').removeClass('active');
      $('#site-container').removeClass('active');
    }

    lastScrollTop = st;
  });

  var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  var _marker = '/static/images/icon/marker.png';
  var _markerActive = '/static/images/icon/branch_active.png';
  var marker, i, latLngGoogle, _radius;
  var infowindow = null;
  var markers = [];
  var flag_sudahcalc = false;
  var status_edit = false;
  var change_addres = false;
  var step1Done = false;
  var step2Done = false;
  var step3Done = false;
  var step4Done = false;
  var changeDataPemohon = false;
  var changeDataTempatTinggal = false;
  var changeDataKendaraan = false;
  var changeDataBangunan = false;
  var changeJumlahPembiayaan = false;

  var retryLimit = 3;

  // SET HEIGHT CONTAINER WHEN CONTAINER SMALLER THAN DOCUMENT

  // console.log(isMobile);

  var _docHeight = $(window).height();
  var _siteContainer = $("#site-container").height();
  if ($(".navbar-fixed-top").height() > 0) {
    var _marginTop = 130;
  } else if ($(".top-nav--mobille").height() > 0) {
    var _marginTop = 90;
  }
  var _marginTop = 130;
  var _footerHeight = 80;
  var _cleanDocHeight = _docHeight - _marginTop - _footerHeight;

  if (_siteContainer < _cleanDocHeight) {
    // console.log(_cleanDocHeight);
    $("#site-container").css({
      'min-height': _cleanDocHeight,
    });
    if ($('#map').length) {
      $(".map-wrapper").css({
        'height': _cleanDocHeight,
      });
    }
  }


  // CLOSE

  var credits = {
    "angunan": {
      "jenis_angunan": ""
    },

    "pemohon": {
      "nama": "",
      "email": "",
      "no_handphone": ""
    },

    "tempat_tinggal": {
      "provinsi": "",
      "kota": "",
      "kecamatan": "",
      "kelurahan": "",
      "kode_pos": "",
      "alamat": ""
    },

    "kendaraan": {
      "merk_kendaraan": "",
      "merk_kendaraan_text": "",
      "model_kendaraan": "",
      "model_kendaraan_text": "",
      "tahun_kendaraan": "",
      "tahun_kendaraan_text": "",
      "status_pemilik": ""
    },

    "data_bangunan": {
      "status_sertifikat": "",
      "sertifikat_atas_nama": "",
      "provinsi": "",
      "kota": "",
      "kecamatan": "",
      "kelurahan": "",
      "kode_pos": "",
      "alamat": "",
      "jenis_properti": "",
      "kondisi": "",
      "tipe_sertifikat": "",
      "is_dihuni": ""
    }
  }
  var objCredits = {
    nama_lengkap: "",
    email: "",
    alamat_lengkap: "",
    no_handphone: "",
    kota: "",
    kecamatan: "",
    kelurahan: "",
    model_kendaraan: "",
    tahun_kendaraan: "",
    funding: 0,
    merk_kendaraan: "",
    jangka_waktu: 0,
    installment: 0
  }

  $("#herobanner").slick({
    slideToShow: 1,
    dots: true,
    prevArrow: $(".prev-1"),
    nextArrow: $(".next-1"),
    autoplay: true,
    autoplaySpeed: 5000
  })

  $("#herobanner2").slick({
    slideToShow: 1,
    dots: true,
    prevArrow: $(".prev-2"),
    nextArrow: $(".next-2"),
    autoplay: true,
    autoplaySpeed: 5000
  })

  $("#slider-cara--kerja").slick({
    centerMode: true,
    centerPadding: '80px',
    slidesToShow: 1
  })

  $('.slider-author__wrapper').slick({
    dots: true,
    prevArrow: '<i class="fa fa-angle-left prev-arrow" aria-hidden="true"></i>',
    nextArrow: '<i class="fa fa-angle-right next-arrow" aria-hidden="true"></i>'
  });

  if ($('.biaya-agunan').length > 0) {
    jcf.replaceAll();
  }

  $(".nav-tabs>li").on("click", function (e) {
    if ($(this).hasClass("disabled")) {
      e.preventDefault();
      return false;
    }
  });

  // With JQuery
  function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  if (!isMobile) {
    var heightmodif = parseInt($(window).height()) - 190;
    $("#site-container").css("min-height", heightmodif + "px");
    $(".map-wrapper").css("min-height", heightmodif + "px");
  }

  $("#ex6SliderVal").on("keydown", function (e) {
    if ($(this).val() == 0) {
      $(this).val("");
    }
  });

  var post_val_inputan = 0;
  $("#ex6SliderVal").on("input", function () {
    var thisval = $(this).val(),
      pricelimit = $(this).parent().next().children(".valuemax").text(),
      pricelimitmin = $(this).parent().next().children(".valuemin").text();

    thisval = thisval.replace(/\./g, "");
    pricelimit = pricelimit.replace(/\./g, "");
    pricelimitmin = pricelimitmin.replace(/\./g, "");

    if (thisval !== "") {
      if (isNaN(thisval)) {
        thisval = "";
      } else {
        if (parseInt(thisval) <= parseInt(pricelimit)) {
          thisval = thisval;
        } else {
          thisval = post_val_inputan;
        }
        post_val_inputan = thisval;
      }
    }

    $(this).parents(".sliderGroup").find(".customslide").slider('setValue', parseInt(thisval));

    var number_string = thisval.toString(),
      sisa = number_string.length % 3,
      rupiah = number_string.substr(0, sisa),
      ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    $(this).val(rupiah);
  });

  var clone_asuransi,
    raw_select,
    list_asuransi = [],
    asuransi_arr = [],
    asuransi_arr_txt = [];

  function newoptionAsuransi(thisval, raw_select) {
    $(".columnselect").remove();

    var _url = '';
    // var _param = {
    //     tipe: htmlEntities($("#jenis_form").val()),
    //     tenor: htmlEntities($("#jangka_waktu").val()),
    //     otr_price: htmlEntities($("#otr").val())
    // }
    var _param = {
      submission_id: submission_id,
      tenor: htmlEntities($("#jangka_waktu").val()),
      funding: htmlEntities($("#otr").val())
    }

    switch (credits.angunan.jenis_angunan) {
      case 'MOBIL':
        _url = '/credit/get-insurance';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-calculate';
        break;
      case 'SURAT BANGUNAN':
        _url = '/credit/pbf-calculate';
        break;
    }

    // console.log(_param);

    $.ajax({
      type: 'POST',
      url: _url,
      data: _param,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        // console.log("Asuransi Result", data);
        // console.log("asuransi = "+ data.data.insurance_list);

        if (typeof (data.data) !== "undefined") {

          var jumlah_loop = data.data.count;

          list_asuransi = [];
          asuransi_arr = [];
          asuransi_arr_txt = [];

          var tahunke = $('#tahunke').val();
          var isonly = false;
          var asu_ransi = "";

          $.each(data.data.insurance_list, function (index, value) {
            var asuransi = value;
            asu_ransi = "";
            list_asuransi[index] = [];

            $.each(value[index], function (i, item) {
              // var list_asuransi = item.asuransi;
              // console.log(item.asuransi);
              var dataAsuransi = {
                id: item.id,
                text: item.desc,
                selected: false
              }
              if (item.desc == "All Risk") {
                // asu_ransi += "<option value='" + item.id + "' selected>" + item.desc + "</option>"
                dataAsuransi.selected = true;
              } else {
                // asu_ransi += "<option value='" + item.id + "'>" + item.desc + "</option>"
                dataAsuransi.selected = false;
              }
              list_asuransi[index].push(dataAsuransi);
              if (item.desc == "All Risk" && item.is_only == true) {
                isonly = item.is_only;
              }
            })
          });

          // var raw_select = '<div class="columnselect" id="$0">' +
          //     '<div class="list-select">' +
          //     '<label>$1</label>' +
          //     '</div>' +
          //     '<div class="list-select select-wrapper">' +
          //     '<select class="c-custom-select-trans form-control formRequired opsiasuransi"' +
          //     'name="status" multiple="multiple">' + asu_ransi + '</select>' +
          //     '</div>' +
          //     '<div class="error-wrap"></div>' +
          //     '</div>';

          $(".form-group.inputsimulasi.asuransi").find(".columnselect").remove();
          for (var i = 1; i <= jumlah_loop; i++) {
            var _template = '<div class="columnselect" id="tahun' + i + '" data-index="' + i + '">' +
              '<div class="list-select">' +
              '<label>' + tahunke + ' - ' + i + '</label>' +
              '</div>' +
              '<div class="list-select select-wrapper">' +
              '<select class="c-custom-select-trans form-control formRequired opsiasuransi"' +
              'name="status" multiple="multiple"></select>' +
              '</div>' +
              '<div class="error-wrap"></div>' +
              '</div>';

            // _template.replace("$0", "tahun"+i);
            // _template.replace("$1", tahunke + " - " + i);
            // asuransi_arr[asuransi_arr.length] = $(".columnselect .c-custom-select-trans").val();
            $(".form-group.inputsimulasi.asuransi").append(_template);
            // $(".columnselect[ke=0]").attr("ke", i);
            // $(".columnselect[ke=" + i + "]").children().find("label").text("" + tahunke + " - " + i + "");

            asuransi_arr[asuransi_arr.length] = $("#tahun" + i + " .c-custom-select-trans").val();
            $("#tahun" + i + " .opsiasuransi").select2({
              dropdownParent: $("#tahun" + i + " .select-wrapper"),
              data: list_asuransi[i - 1]
            });

          }
          if (isonly == true) {
            $('.columnselect .opsiasuransi').attr("disabled", "disabled");
            $('.columnselect .opsiasuransi').next().css("background-color", "#F4F4F4");
          }

          // console.log(asu_ransi)

          // console.log(raw_select);
          $(".opsiasuransi").change(function () {
            // var opsi = $(this).val();

            // if (opsi.length == 0) {
            //     $(this).val("ARK").trigger("change");
            // } else if (opsi.length > 1) {
            //     $(this).val(opsi[opsi.length - 1]).trigger("change");
            // }
          })

          $.each($(".columnselect .c-custom-select-trans"), function (i, o) {
            asuransi_arr[asuransi_arr_txt.length] = $(o).val()[0];
            asuransi_arr_txt[asuransi_arr_txt.length] = $(o).find("option:selected").text();
          })

          $(".columnselect .c-custom-select-trans").on("change", function () {
            var rowke = $(this).parents(".columnselect").data("index");
            asuransi_arr[rowke - 1] = $(this).val()[0];
            asuransi_arr_txt[rowke - 1] = $(this).find("option:selected").text();

            disableButton("#button4");
            disableButton(".hidesavebutton");
            flag_sudahcalc = false;
          });

        }
      }
    })
  };

  $(".sliderGroup .c-custom-select-trans").on("change", function () {
    var thisval = $(this).val();
    $(this).parents(".sliderGroup").find(".customslide").slider('setValue', parseInt(thisval));

    //andry
    newoptionAsuransi(thisval, raw_select);
    disableButton("#button4");
    disableButton(".hidesavebutton");
    flag_sudahcalc = false;
  });


  if ($(".customslide").length > 0) {
    $(".customslide").slider();
    $(".customslide").on('change', function (evt) {

      var _elm = $(this)
      var _parent = _elm.parents(".sliderGroup")
      var _ifMoney = _parent.find(".c-input-trans")
      var _ifMonth = _parent.find(".c-custom-select-trans")
      var _thisVal = evt.value.newValue

      if (_ifMoney.length > 0) {

        var number_string = _thisVal.toString(),
          sisa = number_string.length % 3,
          rupiah = number_string.substr(0, sisa),
          ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        _ifMoney.val(rupiah);

        var _toInt = parseInt(_thisVal);
        _toInt = (_toInt > 0 ? _toInt : 0);
        objCredits.installment = _toInt;
        objCredits.funding = _toInt;

      } else if (_ifMonth.length > 0) {

        _ifMonth.val(parseInt(_thisVal))
        var customFormInstance = jcf.getInstance(_ifMonth);
        customFormInstance.refresh();

        newoptionAsuransi(_thisVal, raw_select);
        objCredits.jangka_waktu = parseInt(_thisVal);
      }

      disableButton("#button4");
      disableButton(".hidesavebutton");
      flag_sudahcalc = false;
    });
  }

  // js by jaya

  $(".panel").on("show.bs.collapse hide.bs.collapse", function (e) {
    if (e.type == 'show') {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });


  $.validator.addClassRules({

    formRequired: {
      required: true
    },

    formAlphabet: {
      acceptAlphabet: "[a-zA-Z]+"
    },

    formEmail: {
      emailCust: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
    },

    formNumber: {
      required: true,
      number: true
    },

    formPhoneNumber: {
      required: true,
      number: true,
      maxlength: 13,
      minlength: 9
    },

    formKodePos: {
      required: true,
      number: true,
      maxlength: 5,
      minlength: 5
    },

    formAddress: {
      minlength: 15
    },

    uploadImage: {
      accept: "image/*",
      filesize: 1000   //max size 1MB
    },

    minDownPayment: {
      required: true,
      minDp: 10
    },

    minDownPaymentMachine: {
      required: true,
      minDpMachine: 30
    },

    submitHandler: function (form) {
      form.submit();
    }
  });

  jQuery.validator.addMethod("minDp", function (value, element, param) {
    var thisval = parseInt(value.replace(/\./g, ""));
    var payment = parseInt($("#ex7SliderVal").val().replace(/\./g, ""));
    var minPayment = payment * (param / 100);
    console.log("DP ", payment, thisval, minPayment);
    return (minPayment <= thisval ? true : false);
    // return false
  }, "Minimal 10% from payment.");

  jQuery.validator.addMethod("minDpMachine", function (value, element, param) {
    var thisval = parseInt(value.replace(/\./g, ""));
    var payment = parseInt($("#ex7SliderVal").val().replace(/\./g, ""));
    var minPayment = payment * (param / 100);
    console.log("DP ", payment, thisval, minPayment);
    return (minPayment <= thisval ? true : false);
    // return false
  }, "Minimal 30% from payment.");

  jQuery.validator.addMethod("acceptAlphabet", function (value, element, param) {
    //console.log(value.match(new RegExp("." + param + "$")));
    return value.match(new RegExp("." + param + "$"));
  }, "Please Enter Only Letters");

  jQuery.validator.addMethod("minPrice", function (value, element, param) {
    var thisval = value.replace(/\./g, "");
    if (parseInt(thisval) < param) {
      return false;
    } else {
      return true;
    }

  }, "Please input price more than min price");

  jQuery.validator.addMethod("emailCust", function (value, element, param) {
    return param.test(value);
  }, "Please enter a valid email address.");

  jQuery.validator.addMethod("filesize", function (value, element, param) {
    // param = size (in bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    console.log("test", this.optional(element) || (element.files[0].size <= param), element.files[0], param)
    return this.optional(element) || (element.files[0].size <= param)
  }, "File size must be less than 1 MB.");

  console.log($.validator.classRuleSettings);

  function validateFormRequired(elementParam) {
    $(elementParam).validate({
      errorPlacement: function (error, element) {
        console.log(element)
        element.closest('.form-group').find('.error-wrap').html(error);
      }
    });
  }

  if(lang === 'id'){
    jQuery.extend(jQuery.validator.messages, {
      required: "Isian wajib diisi.",
      remote: "Harap perbaiki isian ini.",
      email: "Silakan isi alamat email yang valid.",
      url: "Silakan masukkan URL yang valid.",
      date: "Silakan masukkan tanggal yang valid.",
      dateISO: "Silakan masukkan tanggal yang valid (ISO).",
      number: "Silakan masukkan nomor yang valid.",
      digits: "Masukkan hanya berupa digit.",
      creditcard: "Harap masukkan nomor kartu kredit yang benar.",
      equalTo: "Silakan masukkan nilai yang sama sekali lagi.",
      accept: "Silakan masukkan nilai dengan ekstensi yang valid.",
      maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
      minlength: jQuery.validator.format("Silakan masukkan setidaknya {0} karakter."),
      rangelength: jQuery.validator.format("Masukkan nilai antara panjang {0} dan {1} karakter."),
      range: jQuery.validator.format("Silakan masukkan nilai antara {0} dan {1}."),
      max: jQuery.validator.format("Masukkan nilai kurang dari atau sama dengan {0}."),
      min: jQuery.validator.format("Silakan masukkan nilai yang lebih besar dari atau sama dengan {0}."),
      minDp : "DP Minimal 10% dari pembayaran.",
      minDpMachine : "DP Minimal 30% dari pembayaran.",
      acceptAlphabet: "Masukkan hanya berupa huruf alfabet.",
      minPrice : "Silakan masukkan harga lebih dari harga minimum.",
      emailCust : "Silakan isi alamat email yang valid.",
      filesize : "Ukuran file harus kurang dari 1 MB."
    });
  }

  function scrollToTop() {
    $('html, body').animate({
      scrollTop: 0
    }, 400);
  }

  function showTab1() {
    $('#menu1').fadeIn();
  }

  function hideTab1() {
    $('#menu1').hide();
  }

  function showTab2() {
    $('.nav-item-1').removeClass('disabled');
    $('#menu2').fadeIn();
  }

  function hideTab2() {
    $('#menu2').hide();
  }

  function showTab3() {
    $('.nav-item-2').removeClass('disabled');
    $('#menu3').fadeIn();
  }

  function hideTab3() {
    $('#menu3').hide();
  }

  function showTab4() {
    $('.nav-item-3').removeClass('disabled');
    $('#menu4').fadeIn();
  }

  function hideTab4() {
    $('#menu4').hide();
  }

  function showTab5() {
    $('.nav-item-4').removeClass('disabled');
    $('#menu5').fadeIn();
  }

  function hideTab5() {
    $('#menu5').hide();
  }

  function showTab6() {
    $('.nav-item-5').removeClass('disabled');
    $('#menu6').fadeIn();
  }

  function hideTab6() {
    $('#menu6').hide();
  }

  function hideCurrentTab() {
    $(".form-get--credit .tab-content .tab-pane:visible").hide();
    $('.nav-item-1').removeClass('active');
    $('.nav-item-2').removeClass('active');
    $('.nav-item-3').removeClass('active');
    $('.nav-item-4').removeClass('active');
    $('.nav-item-5').removeClass('active');
  }

  function retryAjax(_this, xhr) {
    if (xhr.status == 500) {
      _this.tryCount++;
      if (_this.tryCount <= _this.retryLimit) {
        console.log("TRY " + _this.tryCount);
        //try again
        $.ajax(_this);
        return;
      } else {
        console.log("LAST TRY");
        // _this.url = '/credit/save-car-leads1';
        return;
      }
    }
  }

  var credType = '';
  var submission_id = '';
  function setCreditType() {
    var _path = window.location.pathname;

    switch (true) {
      case _path.includes('mobil'):
        credType = 'mobil';
        break;
      case _path.includes('motor'):
        credType = 'motor';
        break;
      case _path.includes('rumah'):
      case _path.includes('ruko'):
        credType = 'rumah';
        break;
    }
  }
  setCreditType();

  function reformatDate(_date) {
    var subDate = _date.split("/");
    var theDate = new Date(subDate[2], subDate[1] - 1, subDate[0]);

    // 01, 02, 03, ... 29, 30, 31
    var dd = (theDate.getDate() < 10 ? '0' : '') + theDate.getDate();
    // 01, 02, 03, ... 10, 11, 12
    var MM = ((theDate.getMonth() + 1) < 10 ? '0' : '') + (theDate.getMonth() + 1);
    // 1970, 1971, ... 2015, 2016, ...
    var yyyy = theDate.getFullYear();

    return yyyy + '-' + MM + '-' + dd;
  }

  function reformatMoney(number) {
    return number.replace(/[.]/g, '');
  }

  function pushDataPemohon2(cb) {
    submission_id = '';
    var _URL = '';
    var _data = {};
    var nama_lengkap = $('#nama_lengkap').val(),
      email_pemohon = $('#email_pemohon').val(),
      no_telepon = $('#no_handphone').val(),
      jenis_kredit = $('#jenis_form').val();

    switch (jenis_kredit) {
      case 'MOBIL':
        _URL = '/credit/save-car-leads1';
        break;
      case 'MOTOR':
        _URL = '/credit/save-motorcycle-leads1';
        break;
      case 'SURAT BANGUNAN':
        _URL = '/credit/save-pbf-leads1';
        _data = {
          "dob": reformatDate($('#tgl_lahir').val()),
          "profession_id": $('#pekerjaan').val()[0],
          "salary": reformatMoney($('#penghasilan').val()),
          "path_ktp": $('#ktp').val()
        };
        break;
    }

    if (_URL !== '') {

      _data = Object.assign(_data, {
        "submission_id": submission_id,
        "name": nama_lengkap,
        "email": email_pemohon,
        "phone_number": no_telepon
      });

      $.ajax({
        type: 'POST',
        url: _URL,
        data: _data,
        dataType: 'json',
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, errorThrown) {
          retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
          retryAjax(this, xhr);
        },
        success: function (result) {
          if (result.success === "1") {
            submission_id = result.data.submission_id;
            credits.angunan.jenis_angunan = htmlEntities(jenis_kredit);
            credits.pemohon.nama = htmlEntities(nama_lengkap);
            credits.pemohon.email = htmlEntities(email_pemohon);
            credits.pemohon.no_handphone = htmlEntities(no_telepon);
            cb();
          } else {
            console.log('error' + result.message);
          }
        }
      })

    }

  }

  function pushDataPemohon() {
    submission_id = '';
    var _URL = '';
    var _data = {};
    var nama_lengkap = $('#nama_lengkap').val(),
      email_pemohon = $('#email_pemohon').val(),
      no_telepon = $('#no_handphone').val(),
      jenis_kredit = $('#jenis_form').val();

    switch (jenis_kredit) {
      case 'MOBIL':
        _URL = '/credit/save-car-leads1';
        break;
      case 'MOTOR':
        _URL = '/credit/save-motorcycle-leads1';
        break;
      case 'SURAT BANGUNAN':
        _URL = '/credit/save-pbf-leads1';
        _data = {
          "dob": reformatDate($('#tgl_lahir').val()),
          "profession_id": $('#pekerjaan').val()[0],
          "salary": reformatMoney($('#penghasilan').val()),
          "path_ktp": $('#ktp').val()
        };
        break;
    }

    if (_URL !== '') {

      _data = Object.assign(_data, {
        "submission_id": submission_id,
        "name": nama_lengkap,
        "email": email_pemohon,
        "phone_number": no_telepon
      });

      $.ajax({
        type: 'POST',
        url: _URL,
        data: _data,
        dataType: 'json',
        tryCount: 0,
        retryLimit: retryLimit,
        error: function (xhr, textStatus, errorThrown) {
          console.log('error', textStatus);
          retryAjax(this, xhr);
        },
        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },
        success: function (result) {
          if (result.success === "1") {
            submission_id = result.data.submission_id;
            credits.angunan.jenis_angunan = htmlEntities(jenis_kredit);
            credits.pemohon.nama = htmlEntities(nama_lengkap);
            credits.pemohon.email = htmlEntities(email_pemohon);
            credits.pemohon.no_handphone = htmlEntities(no_telepon);
            if(changeDataPemohon === true){
              //data pemohon
              $('#showFullName').html(credits.pemohon.nama);
              $('#showEmail').html(credits.pemohon.email);
              $('#showPhone').html(credits.pemohon.no_handphone);      
            }
          } else {
            console.log('error' + result.message);
          }
        }
      })

    }

  }

  function pushDataTempatTinggal() {
    var provinsi = $('#provinsi').val(),
      kota = $('#kota').val(),
      kecamatan = $('#kecamatan').val(),
      kelurahan = $('#kelurahan').val(),
      kode_pos = $('#kode_pos').data('value'),
      kode_pos_text = $('#kode_pos').val(),
      alamat = $('#alamat_lengkap').val();

    var _data = {
      "submission_id": submission_id,
      "province_id": provinsi[0],
      "city_id": kota[0],
      "district_id": kecamatan[0],
      "subdistrict_id": kelurahan[0],
      "zipcode_id": kode_pos,
      "address": alamat
    }

    provinsi = $("#provinsi option[value='" + provinsi + "']").text();
    kota = $("#kota option[value='" + kota + "']").text();
    kecamatan = $("#kecamatan option[value='" + kecamatan + "']").text();
    kelurahan = $("#kelurahan option[value='" + kelurahan + "']").text();

    var _url = '';
    console.log("DATA", _data)

    switch (credType) {
      case 'mobil':
        _url = '/credit/save-car-leads2'
        break;
      case 'motor':
        _url = '/credit/save-motorcycle-leads2'
        break;
      case 'rumah':
        _url = '/credit/save-pbf-leads2'
        break;
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          if(credType === "motor" || credType === "mobil"){
            if(data.data.is_branch) {
              credits.tempat_tinggal.provinsi = htmlEntities(provinsi);
              credits.tempat_tinggal.kota = htmlEntities(kota);
              credits.tempat_tinggal.kecamatan = htmlEntities(kecamatan);
              credits.tempat_tinggal.kelurahan = htmlEntities(kelurahan);
              credits.tempat_tinggal.kode_pos = htmlEntities(kode_pos_text);
              credits.tempat_tinggal.alamat = htmlEntities(alamat);
            } else {
              showTab2(); 
              hideTab3();
              $('.nav-item-2').addClass('active');
              $('.nav-item-3').addClass('disabled');
              $('.nav-item-2').removeClass('done');
              $('.nav-item-3').removeClass('active');
              $("#modal-branch").modal('show');
              }
          } else if (credType === "rumah") {
            credits.tempat_tinggal.provinsi = htmlEntities(provinsi);
            credits.tempat_tinggal.kota = htmlEntities(kota);
            credits.tempat_tinggal.kecamatan = htmlEntities(kecamatan);
            credits.tempat_tinggal.kelurahan = htmlEntities(kelurahan);
            credits.tempat_tinggal.kode_pos = htmlEntities(kode_pos_text);
            credits.tempat_tinggal.alamat = htmlEntities(alamat);
            getProperty();
            getCertificateType();
            getCertificateOnBehalf();
            getHunian();
          }
        }
      }
    })
  }

  function getHunian() {
    $('#property_condition').select2({
      placeholder: $('#property_condition').attr("placeholder"),
      dropdownParent: $('#property_condition').parent(),
      data: [
        { id: "true", text: "Dihuni" },
        { id: "false", text: "Kosong" }
      ]
    });
  }

  function getProperty() {
    $.ajax({
      type: 'POST',
      url: '/credit/get-pbf-property-type',
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (result) {
        if (result.success === "1") {
          var typeProperty = [];
          $.each(result.data, function (idx, val) {
            if (val.desc != '') {
              typeProperty.push({
                id: val.id,
                text: val.desc
              });
            }
          })
          $('#jenis_properti').select2({
            placeholder: $('#jenis_properti').attr("placeholder"),
            dropdownParent: $('#jenis_properti').parent(),
            data: typeProperty
          });
        }
      }
    })
  }

  function getCertificateType() {
    $.ajax({
      type: 'POST',
      url: '/credit/get-pbf-certificate-type',
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (result) {
        if (result.success === "1") {
          var certificateType = [];
          $.each(result.data, function (idx, val) {
            if (val.desc != '') {
              certificateType.push({
                id: val.id,
                text: val.desc
              });
            }
          })
          $('#status_sertificate').select2({
            placeholder: $('#status_sertificate').attr("placeholder"),
            dropdownParent: $('#status_sertificate').parent(),
            data: certificateType
          });
        }
      }
    })
  }

  function getCertificateOnBehalf() {
    $.ajax({
      type: 'POST',
      url: '/credit/get-pbf-certificate-on-behalf',
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (result) {
        if (result.success === "1") {
          var certificateOnBehalf = [];
          $.each(result.data, function (idx, val) {
            if (val.desc != '') {
              certificateOnBehalf.push({
                id: val.id,
                text: val.desc
              });
            }
          })
          $('#own_sertificate').select2({
            placeholder: $('#own_sertificate').attr("placeholder"),
            dropdownParent: $('#own_sertificate').parent(),
            data: certificateOnBehalf
          });
        }
      }
    })
  }

  function pushDataKendaraan(cb) {
    var type_kendaraan = $('#type_kendaraan').val()[0],
      merk_kendaraan = $('#merk_kendaraan').val()[0],
      model_kendaraan = $('#model_kendaraan').val()[0],
      tahun_kendaraan = $('#tahun_kendaraan').val()[0],
      status_pemilik = $('#status_kep').val()[0];

    var _url = '';
    var _data = {
      "submission_id": submission_id,
      "bpkb_atas_nama": (status_pemilik === "Milik Pribadi" ? true : false)
    };
    console.log("DATA", _data)

    switch (credType) {
      case 'mobil':
        _url = '/credit/save-car-leads3';
        _data = Object.assign(_data, {
          "car_type_id": type_kendaraan,
          "car_brand_id": merk_kendaraan,
          "car_model_id": model_kendaraan,
          "car_year_id": tahun_kendaraan
        });
        break;
      case 'motor':
        _url = '/credit/save-motorcycle-leads3';
        _data = Object.assign(_data, {
          "motorcycle_type_id": type_kendaraan,
          "motorcycle_brand_id": merk_kendaraan,
          "motorcycle_model_id": model_kendaraan,
          "motorcycle_year_id": tahun_kendaraan
        });
        break;
    }

    var merk_kendaraan_text = $("#merk_kendaraan option[value='" + merk_kendaraan + "']").text(),
      model_kendaraan_text = $("#model_kendaraan option[value='" + model_kendaraan + "']").text(),
      tahun_kendaraan_text = $("#tahun_kendaraan option[value='" + tahun_kendaraan + "']").text();

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          if(credType === "motor" || credType ==="mobil"){
             if(data.data.is_pricing){
              credits.kendaraan.merk_kendaraan = htmlEntities(merk_kendaraan);
              credits.kendaraan.merk_kendaraan_text = htmlEntities(merk_kendaraan_text);
              credits.kendaraan.model_kendaraan = htmlEntities(model_kendaraan);
              credits.kendaraan.model_kendaraan_text = htmlEntities(model_kendaraan_text);
              credits.kendaraan.tahun_kendaraan = htmlEntities(tahun_kendaraan);
              credits.kendaraan.tahun_kendaraan_text = htmlEntities(tahun_kendaraan_text);
              credits.kendaraan.status_pemilik = htmlEntities(status_pemilik);
              cb();
             }else{
              showTab3(); 
              hideTab4();
              $('.nav-item-3').addClass('active');
              $('.nav-item-4').addClass('disabled');
              $('.nav-item-3').removeClass('done');
              $('.nav-item-4').removeClass('active');
              $("#modal-pricing").modal('show');
            }
          }
        }
      }
    })

  }

  function sendLeads4(cb) {

    var _url = '';
    var _data = {
      "submission_id": submission_id
    };

    switch (credType) {
      case 'mobil':
        _url = '/credit/save-car-leads4';
        break;
      case 'motor':
        _url = '/credit/save-motorcycle-leads4';
        break;
      case 'rumah':
        _url = '/credit/save-pbf-leads4';
        break;
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          cb();
        }
      }
    })

  }

  function sendLeads5(cb) {

    var _url = '';
    var _data = {
      "submission_id": submission_id
    };

    switch (credType) {
      case 'mobil':
        _url = '/credit/save-car-leads5';
        break;
      case 'motor':
        _url = '/credit/save-motorcycle-leads5';
        break;
      case 'rumah':
        _url = '/credit/save-pbf-leads5';
        break;
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          cb();
        }
      }
    })

  }

  function sendLeads6(cb) {

    var _url = '';
    var _data = {
      "submission_id": submission_id
    };

    switch (credType) {
      case 'mobil':
        _url = '/credit/save-car-leads6';
        break;
      case 'motor':
        _url = '/credit/save-motorcycle-leads6';
        break;
      case 'rumah':
        _url = '/credit/save-pbf-leads6';
        break;
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          registerCredit(data.data.submission_id)
          cb();
        }
      }
    })
  }

  function registerCredit(submission_id) {
    var _url = '/submission-register';
    var _data = {
      "submission_id": submission_id
    };

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success === "1") {
          phone_number = data.data.phone_number
        }
      }
    })
  }

  function pushDataBangunan(cb) {
    if ($('#status_sertificate').length > 0) {
      var status_sertificate = $('#status_sertificate').val(),
        provinsi_sertificate = $('#provinsi_sertificate').val(),
        kota_sertificate = $('#kota_sertificate').val(),
        kecamatan_sertificate = $('#kecamatan_sertificate').val(),
        kelurahan_sertificate = $('#kelurahan_sertificate').val(),
        kode_pos_sertificate = $('#kode_pos_sertificate').data("value"),
        alamat_lengkap_sertificate = $('#alamat_lengkap_sertificate').val(),
        own_sertificate = $('#own_sertificate').val(),
        jenis_properti = $('#jenis_properti').val(),
        property_condition = $('#property_condition').val(),
        is_dihuni = $('#property_condition').val();

      var _data = {
        "submission_id": submission_id,
        "province_id": provinsi_sertificate[0],
        "city_id": kota_sertificate[0],
        "district_id": kecamatan_sertificate[0],
        "subdistrict_id": kelurahan_sertificate[0],
        "zipcode_id": kode_pos_sertificate,
        "address": alamat_lengkap_sertificate,
        "certificate_type_id": status_sertificate[0],
        "certificate_on_behalf_id": own_sertificate[0],
        "property_type_id": jenis_properti[0],
        "is_dihuni": is_dihuni[0]
      }


      status_sertificate = $("#status_sertificate option[value='" + status_sertificate + "']").text();
      provinsi_sertificate = $("#provinsi_sertificate option[value='" + provinsi_sertificate + "']").text();
      kota_sertificate = $("#kota_sertificate option[value='" + kota_sertificate + "']").text();
      kecamatan_sertificate = $("#kecamatan_sertificate option[value='" + kecamatan_sertificate + "']").text();
      kelurahan_sertificate = $("#kelurahan_sertificate option[value='" + kelurahan_sertificate + "']").text();
      kode_pos_sertificate = $("#kode_pos_sertificate").val();
      own_sertificate = $("#own_sertificate option[value='" + own_sertificate + "']").text();
      jenis_properti = $("#jenis_properti option[value='" + jenis_properti + "']").text();
      property_condition = $("#property_condition option[value='" + property_condition + "']").text();

      $.ajax({
        type: 'POST',
        url: '/credit/save-pbf-leads3',
        data: _data,
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },
        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },
        success: function (data) {
          if (data.success === "1") {
            credits.data_bangunan.status_sertifikat = htmlEntities(status_sertificate);
            credits.data_bangunan.sertifikat_atas_nama = htmlEntities(own_sertificate);
            credits.data_bangunan.provinsi = htmlEntities(provinsi_sertificate);
            credits.data_bangunan.kota = htmlEntities(kota_sertificate);
            credits.data_bangunan.kecamatan = htmlEntities(kecamatan_sertificate);
            credits.data_bangunan.kelurahan = htmlEntities(kelurahan_sertificate);
            credits.data_bangunan.kode_pos = htmlEntities(kode_pos_sertificate);
            credits.data_bangunan.alamat = htmlEntities(alamat_lengkap_sertificate);
            credits.data_bangunan.jenis_properti = htmlEntities(jenis_properti);
            credits.data_bangunan.tipe_sertifikat = htmlEntities(own_sertificate);
            credits.data_bangunan.kondisi = htmlEntities(property_condition);
            credits.data_bangunan.is_dihuni = htmlEntities(property_condition);
            cb();
          }
        }
      })
    };
  }

  function setSummary() {
    // data tipe angunan
    // $('#showAngunan').html(credits.angunan.jenis_angunan);

    //data pemohon
    $('#showFullName').html(credits.pemohon.nama);
    $('#showEmail').html(credits.pemohon.email);
    $('#showPhone').html(credits.pemohon.no_handphone);

    //data tempat tinggal
    $('#showProvinsi').html(credits.tempat_tinggal.provinsi);
    $('#showKota').html(credits.tempat_tinggal.kota);
    $('#showKecamatan').html(credits.tempat_tinggal.kecamatan);
    $('#showKelurahan').html(credits.tempat_tinggal.kelurahan);
    $('#showKodePos').html(credits.tempat_tinggal.kode_pos);
    $('#showAddress').html(credits.tempat_tinggal.alamat);

    // data merk kendaraan
    $('#showMerkKendaraan').html(credits.kendaraan.merk_kendaraan_text);
    $('#showModelKendaraan').html(credits.kendaraan.model_kendaraan_text);
    $('#showTahunKendaraan').html(credits.kendaraan.tahun_kendaraan_text);
    $('#showStatusPemilik').html(credits.kendaraan.status_pemilik);

    //data bangunan
    $('#showJenis_properti').html(credits.data_bangunan.jenis_properti);
    $('#showStatus_sertificate').html(credits.data_bangunan.status_sertifikat);
    $('#showOwn_sertificate').html(credits.data_bangunan.sertifikat_atas_nama);
    $('#showProvinsi_sertificate').html(credits.data_bangunan.provinsi);
    $('#showKota_sertificate').html(credits.data_bangunan.kota);
    $('#showKecamatan_sertificate').html(credits.data_bangunan.kecamatan);
    $('#showKelurahan_sertificate').html(credits.data_bangunan.kelurahan);
    $('#showKode_pos_sertificate').html(credits.data_bangunan.kode_pos);
    $('#showAlamat_lengkap_sertificate').html(credits.data_bangunan.alamat);
    $('#showProperty_condition').html(credits.data_bangunan.kondisi);

    //data pembiayaan
    if ($(".tablebiaya").length > 0) {
      var installment_set = separatordot(objCredits.installment),
        jangka_set = objCredits.jangka_waktu;

      installment_set = "Rp " + installment_set;
      jangka_set = jangka_set + " Bulan";

      $(".jml_biaya").html(installment_set);
      $(".jangka").html(jangka_set);
      $(".angsuran").html($(".total").text());

      if ($(".tahun").length > 0) {
        var start_delRow = 3;
        for (var i = start_delRow; i <= $(".tablebiaya tr").length - 1; i++) {
          $(".tablebiaya tr:eq(" + i + ")").remove();
          i--;
        }
      }

      for (var i = 0; i <= asuransi_arr.length - 1; i++) {
        //var txt_asuransi = $(".c-custom-select-trans.opsiasuransi option[value='"+ asuransi_arr[i] +"']").text();
        var html_sum_asuransi = "<tr>" +
          "<td>Asuransi Tahun ke-" + (i + 1) + "</td>" +
          "<td class='tahun'>" + asuransi_arr_txt[i] + "</td>" +
          "</tr>";

        $(".tablebiaya").append(html_sum_asuransi);
      }
    }
  }

  function showDefaultButton() {
    $(".cta-primary").removeClass("deactive");

    if ($(".hidesavebutton").length > 0) {
      $(".hidesavebutton").removeClass("active");
    } else {
      $(".hidesavebuttonhome").removeClass("active");
    }

    $(".button-area").removeClass("center");
    status_edit = true;
  }

  function hideDefaultButton() {
    $(".cta-primary").addClass("deactive");

    if ($(".hidesavebutton").length > 0) {
      $(".hidesavebutton").addClass("active");
    } else {
      $(".hidesavebuttonhome").addClass("active");
    }

    $(".button-area").addClass("center");
  }

  function disableButton(button) {
    $(button).css("background-color", "#dddddd");
    $(button).css("border-color", "#dddddd");
    $(button).attr("disabled", 'disabled');
  }

  function enableButton(button) {
    $(button).css("background-color", "#F8991D");
    $(button).css("border-color", "#F8991D");
    $(button).removeAttr("disabled");
  }

  function stepAction() {
    disableButton("#button1");
    disableButton("#button2");
    disableButton("#button3");
    disableButton("#button3rumah");
    disableButton("#button4");
    disableButton("#button4rumah");
    enableButton("#button5");
    $("#kode_pos").css("background-color", "#F4F4F4");
    $("#kode_pos_sertificate").css("background-color", "#F4F4F4");

    if ($("#pekerjaan").length == 0) {
      $("#nama_lengkap").on('keyup', function (e) {
        if ($("#email_pemohon").val() == "" || $(this).val() == "" || $("#no_handphone").val() == "") {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#email_pemohon").on('keyup', function (e) {
        if ($("#nama_lengkap").val() == "" || $(this).val() == "" || $("#no_handphone").val() == "") {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#no_handphone").on('keyup', function (e) {
        if ($("#email_pemohon").val() == "" || $(this).val() == "" || $("#nama_lengkap").val() == "") {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });
    } else {

      $.ajax({
        type: 'POST',
        url: '/credit/get-pbf-profession',
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (result) {
          var dataPekerjaan = [];
          if (result.success === "1") {
            $.each(result.data, function (idKec, valKec) {
              if (valKec.desc != '') {
                dataPekerjaan.push({
                  id: valKec.id,
                  text: valKec.desc
                });
              }
            })
            $('#pekerjaan').select2({
              placeholder: $('#pekerjaan').attr("placeholder"),
              dropdownParent: $('#pekerjaan').parent(),
              data: dataPekerjaan
            });
          }
        }
      })

      var isInvalid = function () { return ($("#nama_lengkap").val() == "" || $("#tgl_lahir").val() == "" || $("#email_pemohon").val() == "" || $("#penghasilan").val() == "" || $("#no_handphone").val() == "" || $("#pekerjaan").val() == "" || $("#ktp").val() == "" ? true : false) };
      $("#nama_lengkap").on('keyup', function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#tgl_lahir").change(function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#email_pemohon").on('keyup', function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#penghasilan").on('keyup', function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#no_handphone").on('keyup', function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#ktp").change(function (e) {
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });

      $("#pekerjaan").on('change', function (e) {
        $('#pekerjaan').parent().find(".select2-selection").children(".select2-selection__rendered").html($(this).find(":selected").text());
        if (isInvalid()) {
          disableButton("#button1");
        } else {
          enableButton("#button1");
        }
      });
    }

    $("#kode_pos").on('keyup', function (e) {
      if ($("#alamat_lengkap").val() == "" || $(this).val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kecamatan").val() == "" || $("#kelurahan").val() == "") {
        disableButton("#button2");
      } else {
        enableButton("#button2");
      }
      showDefaultButton();
      change_addres = true;
    });

    $("#kode_pos_sertificate").on('keyup', function (e) {
      if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kota_sertificate").val() == null || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null) {
        disableButton("#button3rumah");
      } else {
        enableButton("#button3rumah");
      }
      showDefaultButton();
    });

    $("#alamat_lengkap").on('keyup', function (e) {
      if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kecamatan").val() == "" || $("#kelurahan").val() == "") {
        disableButton("#button2");
      } else {
        enableButton("#button2");
      }
      showDefaultButton();
      change_addres = true;
    });

    $("#alamat_lengkap_sertificate").on('keyup', function (e) {
      if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kota_sertificate").val() == "" || $(this).val() == "" || $("#kode_pos_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null) {
        disableButton("#button3rumah");
      } else {
        enableButton("#button3rumah");
      }
      showDefaultButton();
    });

    $('.biaya-agunan .form-group').on('click', function () {
      setTimeout(function () {
        if ($('input#agreement1').parent().hasClass('jcf-checked') && $('input#agreement2').parent().hasClass('jcf-checked')) {
          enableButton("#button4rumah");
        } else {
          disableButton("#button4rumah");
        }
      }, 500);
    })

    $('.biaya-agunan .form-group').on('click', function () {
      setTimeout(function () {
        if ($('input#agreement1').parent().hasClass('jcf-checked')) {
          enableButton("#button5");
        } else {
          disableButton("#button5");
        }
      }, 500);
    })

    $('.hidesavebutton').on('click', function (e) {
      e.preventDefault();

      if ($(this).closest('form').valid() && flag_sudahcalc == true) {
        showTab5();
        hideTab1();
        hideTab2();
        hideTab3();
        hideTab4();

        scrollToTop();
        $('.nav-item-1').removeClass('active');
        $('.nav-item-1').addClass('done');
        $('.nav-item-2').removeClass('active');
        $('.nav-item-2').addClass('done');
        $('.nav-item-3').removeClass('active');
        $('.nav-item-3').addClass('done');
        $('.nav-item-4').removeClass('active');
        $('.nav-item-4').addClass('done');
        $('.nav-item-5').addClass('active');

        showDefaultButton();
        $(".text-head").children("h2[class='text-center']").css("display", "block");
        $(".text-head").children("h2[class='text-center-edit']").css("display", "none");

        pushDataPemohon();
        pushDataTempatTinggal();
        pushDataKendaraan();
        setSummary();
      }

    });

    $('.hidesavebuttonhome').on('click', function (e) {
      e.preventDefault();

      if ($(this).closest('form').valid()) {
        showTab5();
        hideTab1();
        hideTab2();
        hideTab3();
        hideTab4();

        scrollToTop();
        $('.nav-item-1').removeClass('active');
        $('.nav-item-1').addClass('done');
        $('.nav-item-2').removeClass('active');
        $('.nav-item-2').addClass('done');
        $('.nav-item-3').removeClass('active');
        $('.nav-item-3').addClass('done');
        $('.nav-item-4').addClass('active');

        showDefaultButton();
        $(".text-head").children("h2[class='text-center']").css("display", "block");
        $(".text-head").children("h2[class='text-center-edit']").css("display", "none");

        pushDataPemohon();
        pushDataTempatTinggal();
        pushDataBangunan();
        setSummary();
      }
    });

    $('#button1').on('click', function (e) {
      e.preventDefault();

      if ($(this).closest('form').valid()) {
        pushDataPemohon2(function () {
          hideTab1();
          showTab2();
          scrollToTop();
          step1Done = true;
          $('.nav-item-1').removeClass('active');
          $('.nav-item-1').addClass('done');
          $('.nav-item-2').addClass('active');
          if ($('.nav-item-1').hasClass("done")) {
            $('.nav-item-1').on('click', function (e) {
              e.preventDefault();
              hideCurrentTab();
              showTab1();
              $('.nav-item-1').addClass('active');
              if ($('.nav-item-1').hasClass('active')) {
                hideTab2();
                hideTab3();
                hideTab4();
                hideTab5();
                hideTab6();
              }
            })
          }

          if (isMobile) {
            $(".horizontal-scroll").scrollLeft(80);
          }
        });

      }
    })

    $('#button2').on('click', function (e) {
      e.preventDefault();

      pushDataTempatTinggal();

      if ($(this).closest('form').valid()) {
        showTab3();
        hideTab2();
        scrollToTop();
        step2Done = true;
        $('.nav-item-2').removeClass('active');
        $('.nav-item-2').addClass('done');
        $('.nav-item-3').addClass('active');
        if ($('.nav-item-2').hasClass("done")) {
          $('.nav-item-2').on('click', function (e) {
            e.preventDefault();
            hideCurrentTab();
            showTab2();
            $('.nav-item-2').addClass('active');
            if ($('.nav-item-2').hasClass('active')) {
              hideTab1();
              hideTab3();
              hideTab4();
              hideTab5();
              hideTab6();
            }
          })
        }

        if ($("#merk_kendaraan").length > 0 && change_addres) {
          getmobilormotor($("#merk_kendaraan"), credits);
          change_addres = false;
        }

        if (isMobile) {
          $(".horizontal-scroll").scrollLeft(260);
        }
      }
    })

    $('#button3').on('click', function (e) {
      e.preventDefault();

      if ($(this).closest('form').valid()) {

        pushDataKendaraan(function () {
          // console.log("HHHHHHHHHH")
          showTab4();
          hideTab3();
          scrollToTop();
          step3Done = true;
          $('.nav-item-3').removeClass('active');
          $('.nav-item-3').addClass('done');
          $('.nav-item-4').addClass('active');
          if ($('.nav-item-3').hasClass("done")) {
            $('.nav-item-3').on('click', function (e) {
              e.preventDefault();
              hideCurrentTab();
              showTab3();
              $('.nav-item-3').addClass('active');
              if ($('.nav-item-3').hasClass('active')) {
                hideTab1();
                hideTab2();
                hideTab4();
                hideTab5();
                hideTab6();
              }
            })
          }

          if (status_edit) {
            $("#jangka_waktu").each(function () {
              this.selectedIndex = 0
            });
            $(".currency[tahun='0']").text("Rp " + 0);
            $(".currency[tahun='1']").text("Rp " + 0);
            $(".total").text("Rp " + 0);
            getpriceminmax(credits);
            disableButton("#button4");
            status_edit = false;
          }

          if (isMobile) {
            $(".horizontal-scroll").scrollLeft(340);
          }
        });

        // console.log($("#ex6SliderVal").val())
      }
    })

    $('#button3rumah').on('click', function (e) {
      e.preventDefault();

      if ($(this).closest('form').valid()) {
        pushDataBangunan(function () {
          showTab4();
          hideTab3();
          scrollToTop();
          step3Done = true;
          $('.nav-item-3').removeClass('active');
          $('.nav-item-3').addClass('done');
          $('.nav-item-4').addClass('active');
          if ($('.nav-item-3').hasClass("done")) {
            $('.nav-item-3').on('click', function (e) {
              e.preventDefault();
              hideCurrentTab();
              showTab3();
              $('.nav-item-3').addClass('active');
              if ($('.nav-item-3').hasClass('active')) {
                hideTab1();
                hideTab2();
                hideTab4();
                hideTab5();
                hideTab6();
              }
            })
          }

          // pushDataBangunan();
          setSummary();
          getTenor();
          $(".text-head").children("h2[class='text-center']").css("display", "block");
          $(".text-head").children("h2[class='text-center-edit']").css("display", "none");

          if (isMobile) {
            $(".horizontal-scroll").scrollLeft(340);
          }

        })
      }
    })

    if ($("#estimasi_harga").length > 0) {
      var isPrice = false;
      // $(".inputsimulasi").addClass("hidden");
      $(".inputsimulasi #ex6SliderVal").val("10.000.000");
      $(".inputsimulasi .valuemin , .inputsimulasi .valuemax").text("10.000.000");
      $("#estimasi_harga").change(function () {
        var _val = $(this).val();
        _val = parseInt(_val.replace(/[.]/g, ""));
        isPrice = (_val > 0 ? true : false);
        

        if (isPrice) {
          $(".inputsimulasi").removeClass("hidden");
          // if (status_edit) {
          $("#jangka_waktu").each(function () {
            this.selectedIndex = 0
          });
          $(".currency[tahun='0']").text("Rp " + 0);
          $(".currency[tahun='1']").text("Rp " + 0);
          $(".total").text("Rp " + 0);
          getpriceminmax(credits);
          disableButton("#button4");
          status_edit = false;
          // }
        } else {
          // $(".inputsimulasi").addClass("hidden");
        }
      });
    }

    $('#button4').on('click', function (e) {
      e.preventDefault();
      var _this = $(this);

      sendLeads4(function() {

        var totalvalidate = $(".total").text();
        totalvalidate = totalvalidate.replace("Rp", "");
        totalvalidate = totalvalidate.replace(" ", "");
        totalvalidate = totalvalidate.replace(/\./g, "");

        if (_this.closest('form').valid() && parseInt(totalvalidate) > 0 && flag_sudahcalc == true) {



          showTab5();
          hideTab4();
          scrollToTop();
          step4Done = true;
          $('.nav-item-4').removeClass('active');
          $('.nav-item-4').addClass('done');
          $('.nav-item-5').addClass('active');
          if ($('.nav-item-4').hasClass("done")) {
            $('.nav-item-4').on('click', function (e) {
              e.preventDefault();
              hideCurrentTab();
              showTab4();
              $('.nav-item-4').addClass('active');
              if ($('.nav-item-4').hasClass('active')) {
                hideTab1();
                hideTab2();
                hideTab3();
                hideTab5();
                hideTab6();
              }
            })
          }

          setSummary();
          $(".text-head").children("h2[class='text-center']").css("display", "block");
          $(".text-head").children("h2[class='text-center-edit']").css("display", "none");

          if (isMobile) {
            $(".horizontal-scroll").scrollLeft(500);
          }
        }
      });
    })

    $('#button4rumah').on('click', function (e) {
      e.preventDefault();

      sendLeads4(function () {
        showTab5();
        hideTab4();
        scrollToTop();

        $('.input-number:first-child').focus();
        $('.horizontal-scroll').hide();
        // $('#showPhone span').html(credits.pemohon.no_handphone);
        $("#otpPhone").val(credits.pemohon.no_handphone)
        countDown();
        requestOtp(credits);
      });

    })

    $('#button5').on('click', function (e) {
      e.preventDefault();

      sendLeads5(function () {
        showTab6();
        hideTab5();
        scrollToTop();

        $('.input-number:first-child').focus();
        $('.horizontal-scroll').hide();
        // $('#showPhone span').html(credits.pemohon.no_handphone);
        $("#otpPhone").val(credits.pemohon.no_handphone)
        countDown();
        requestOtp(credits);
      });

    })

    $('#button6').on('click', function (e) {
      e.preventDefault();

      // $('.tab-pane').hide();
      // $('#success').fadeIn();

      sendOtp(credits);

      //console.log(objCredits);
    })

    $("#otpEditPhone").on("click", function (e) {
      $("#otpPhone").prop('disabled', !$("#otpPhone").prop('disabled'));
      $(".otp-number__phone").toggleClass("disabled")
    })
    $("#otpPhone").change(function () {
      $("#otpPhone").prop('disabled', !$("#otpPhone").prop('disabled'));
      $(".otp-number__phone").toggleClass("disabled")
      credits.pemohon.no_handphone = $("#otpPhone").val()
    })
  }

  function tabAction() {
    $(document).on('click', '.nav-tabs li.active #tab1', function (e) {
      e.preventDefault();
      $('.tab-pane').fadeOut();
      showTab1();
    })

    $(document).on('click', '.nav-tabs li.active #tab2', function (e) {
      e.preventDefault();
      $('.tab-pane').fadeOut();
      showTab2();
    })

    $(document).on('click', '.nav-tabs li.active #tab3', function (e) {
      e.preventDefault();
      $('.tab-pane').fadeOut();
      showTab3();
    })

    $(document).on('click', '.nav-tabs li.active #tab4', function (e) {
      e.preventDefault();
      $('.tab-pane').fadeOut();
      showTab4();
    })

    $(document).on('click', '.nav-tabs li.active #tab5', function (e) {
      e.preventDefault();
      $('.tab-pane').fadeOut();
      showTab5();
    })
  }

  function backAction() {
    $('#buttonback2').on('click', function (e) {
      e.preventDefault();
      $('.nav-item-2').removeClass('active');
      if (!step1Done) {
        $('.nav-item-1').removeClass('done');
      }
      $('.nav-item-1').addClass('active');

      $('.tab-pane').fadeOut();
      scrollToTop();
      showTab1();

      if (isMobile) {
        $(".horizontal-scroll").scrollLeft(0);
      }

    })

    $('#buttonback3').on('click', function (e) {
      e.preventDefault();
      $('.nav-item-3').removeClass('active');
      if (!step2Done) {
        $('.nav-item-2').removeClass('done');
      }
      $('.nav-item-2').addClass('active');

      $('.tab-pane').fadeOut();
      scrollToTop();
      showTab2();

      if (isMobile) {
        $(".horizontal-scroll").scrollLeft(80);
      }

    })

    $('#buttonback4').on('click', function (e) {
      e.preventDefault();
      $('.nav-item-4').removeClass('active');
      if (!step3Done) {
        $('.nav-item-3').removeClass('done');
      }
      $('.nav-item-3').addClass('active');

      $('.tab-pane').fadeOut();
      scrollToTop();
      showTab3();

      if (isMobile) {
        $(".horizontal-scroll").scrollLeft(260);
      }

    })

    $('#buttonbackfunding').on('click', function (e) {
      e.preventDefault();
      $('.nav-item-5').removeClass('active');
      if (!step3Done) {
        $('.nav-item-4').removeClass('done');
      }
      $('.nav-item-4').addClass('active');

      $('.tab-pane').fadeOut();
      scrollToTop();
      showTab4();

      if (isMobile) {
        $(".horizontal-scroll").scrollLeft(260);
      }

    })

    $('#buttonback5').on('click', function (e) {
      e.preventDefault();
      $('.nav-item-5').removeClass('active');
      if (!step4Done) {
        $('.nav-item-4').removeClass('done');
      }
      $('.nav-item-4').addClass('active');

      $('.tab-pane').fadeOut();
      scrollToTop();
      showTab4();

      if (isMobile) {
        $(".horizontal-scroll").scrollLeft(340);
      }
    })
  }

  function checkActiveMenu() {

  }

  function changeSumary() {

    $('#btnDataPemohon').on('click', function (e) {
      e.preventDefault();

      hideDefaultButton();
      $(".text-head").children("h2[class='text-center']").css("display", "none");
      $(".text-head").children("h2[class='text-center-edit']").css("display", "block");

      // $('.nav-item-5').removeClass('active');
      // $('.nav-item-1').removeClass('done');
      // $('.nav-item-1').addClass('active');
      $('.tab-pane').fadeOut();
      showTab1();
      changeDataPemohon = true;
    })

    $('#btnDataTempatTinggal').on('click', function (e) {
      e.preventDefault();

      hideDefaultButton();
      $(".text-head").children("h2[class='text-center']").css("display", "none");
      $(".text-head").children("h2[class='text-center-edit']").css("display", "block");

      // $('.nav-item-5').removeClass('active');
      // $('.nav-item-2').removeClass('done');
      // $('.nav-item-2').addClass('active');
      $('.tab-pane').fadeOut();
      showTab2();
      changeDataTempatTinggal = true;
    })

    $('#btnDataKendaraan').on('click', function (e) {
      e.preventDefault();

      hideDefaultButton();
      $(".text-head").children("h2[class='text-center']").css("display", "none");
      $(".text-head").children("h2[class='text-center-edit']").css("display", "block");

      // $('.nav-item-5').removeClass('active');
      // $('.nav-item-3').removeClass('done');
      // $('.nav-item-3').addClass('active');
      $('.tab-pane').fadeOut();
      showTab3();
      changeDataKendaraan = true;
    })

    $('#btnDataBangunan').on('click', function (e) {
      e.preventDefault();

      hideDefaultButton();
      $(".text-head").children("h2[class='text-center']").css("display", "none");
      $(".text-head").children("h2[class='text-center-edit']").css("display", "block");

      // $('.nav-item-4').removeClass('active');
      // $('.nav-item-3').removeClass('done');
      // $('.nav-item-3').addClass('active');
      $('.tab-pane').fadeOut();
      showTab3();
      changeDataBangunan = true;
    })

    $('#btnJumlahPembiayaan').on('click', function (e) {
      e.preventDefault();

      hideDefaultButton();
      $(".text-head").children("h2[class='text-center']").css("display", "none");
      $(".text-head").children("h2[class='text-center-edit']").css("display", "block");

      // $('.nav-item-5').removeClass('active');
      // $('.nav-item-4').removeClass('done');
      // $('.nav-item-4').addClass('active');
      $('.tab-pane').fadeOut();
      showTab4();
      changeJumlahPembiayaan = true;
    })

  }

  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
  }

  function keyupOtpAction() {

    $('.input-number').on('keyup', function (e) {
      if ($(this).val() !== "") {
        $(this).next().focus();
      } else if ($(this).val() == "") {
        //$(this).prev().focus();
      }
      // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      // 	return false;
      // }

      // if($(this).val() != ""){
      // 	$(this).next().focus();
      // }

      if (e.which == 8) {
        $(this).prev().focus();
      }

    })

    $(".input-number").keypress(function (e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });
  }


  $('#chooseFile').bind('change', function () {
    var filename = $("#chooseFile").val();
    if (/^\s*$/.test(filename)) {
      $(".file-upload").removeClass('active');
      $("#noFile").text("No file chosen...");
    } else {
      $(".file-upload").addClass('active');
      $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
  });


  if (isMobile) {
    $('.sect-step').slick({
      dots: false,
      prevArrow: false,
      nextArrow: false,
      infinite: false,
      slidesToShow: 2.5
    })

    $('ul.list-step').slick({
      dots: false,
      prevArrow: false,
      nextArrow: false,
      infinite: false,
      slidesToShow: 2.5,
      responsive: [
        {
          breakpoint: 1024,
          settings: "unslick"
        },
        {
          breakpoint: 750,
          settings: {
            centerMode: true,
            slidesToShow: 1.3,
            slidesToScroll: 1
          }
        }
      ]
    });
  }

  function requestOtp(params) {

    //var _url = 'https://bfi.staging7.salt.id/otp/send-otp';
    var _url = '/otp/send-otp';

    var _data = {
      nama_lengkap: htmlEntities(params.pemohon.nama),
      phone_number: htmlEntities(params.pemohon.no_handphone)
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        if (data.success != "1") {
          console.log('failed')
        } else {
          //console.log(data)
        }
      }
    })
  }

  function sendOtp(params) {

    //var _url = 'https://bfi.staging7.salt.id/otp/validate-otp';
    var _url = '/otp/validate-otp';

    var otp1Value = htmlEntities($('input[name=otp1]').val()),
      otp2Value = htmlEntities($('input[name=otp2]').val()),
      otp3Value = htmlEntities($('input[name=otp3]').val()),
      otp4Value = htmlEntities($('input[name=otp4]').val());

    var _data = {
      phone_number: htmlEntities(params.pemohon.no_handphone),
      otp_code: otp1Value + otp2Value + otp3Value + otp4Value
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        // console.log(data.success)
        if (data.success == 0) {
          $('#wrongOtp').modal('show');

        } else if (data.success == 1) {
          $('.tab-pane').fadeOut();
          leads6();
          //sendDataCredits(credits);
          //showTab4();
        }
      }
    })
  }

  function leads6() {
    sendLeads6(function () {
      $('.tab-pane').hide();
      $('#success').fadeIn();
      setTimeout(function(){ 
        window.location="/"+lang+"/login";
      }, 120000);
    });
  }

  function sendDataCredits(params) {

    objCredits.nama_lengkap = htmlEntities(params.pemohon.nama),
      objCredits.email = htmlEntities(params.pemohon.email),
      objCredits.alamat_lengkap = htmlEntities(params.tempat_tinggal.alamat),
      objCredits.no_handphone = htmlEntities(params.pemohon.no_handphone),
      objCredits.kota = htmlEntities(params.tempat_tinggal.kota),
      objCredits.kecamatan = htmlEntities(params.tempat_tinggal.kecamatan),
      objCredits.kelurahan = htmlEntities(params.tempat_tinggal.kelurahan),
      objCredits.model_kendaraan = htmlEntities(params.kendaraan.model_kendaraan),
      objCredits.tahun_kendaraan = htmlEntities(params.kendaraan.tahun_kendaraan),
      objCredits.funding = 98000000,
      objCredits.merk_kendaraan = htmlEntities(params.kendaraan.merk_kendaraan),
      objCredits.jangka_waktu = 36,
      objCredits.installment = 3000000

    var _url = '';
    var type = $('#jenis_form').val().toLowerCase();

    if (type == 'mobil') {
      //_url = 'https://bfi.staging7.salt.id/credit/send-mobil';
      _url = '/credit/send-mobil';
    } else if (type == 'motor') {
      //_url = 'https://bfi.staging7.salt.id/credit/send-motor';
      _url = '/credit/send-motor';
    } else if (type = 'surat bangunan') {
      //_url = 'https://bfi.staging7.salt.id/credit/send-rumah';
      _url = '/credit/send-rumah';
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: objCredits,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (data) {
        // console.log(data)
        if (data.success == '0') {
          $('#failedOtp').modal('show');
        } else if (data.success == '1') {
          $('.tab-pane').hide();
          $('#success').fadeIn();
        }
      }
    })
  }

  function getmobilormotor(element, params) {
    var dataKendaraan = [];
    var typeKendaraan = [];

    var type_kendaraan_placeholder = $('#type_kendaraan').attr('placeholder');
    var merk_kendaraan_placeholder = $('#merk_kendaraan').attr('placeholder');
    $('#merk_kendaraan').empty();

    var model_kendaraan_placeholder = $('#model_kendaraan').attr('placeholder');
    var tahun_kendaraan_placeholder = $('#tahun_kendaraan').attr('placeholder');
    var status_kep_placeholder = $('#status_kep').attr('placeholder');

    var _url = '';
    var _urlType = '';
    var post_code_attr = params.tempat_tinggal.kode_pos,
      tipe_attr = params.angunan.jenis_angunan;

    switch (tipe_attr) {
      case 'MOBIL':
        _url = '/credit/get-car-brand';
        _urlType = '/credit/get-car-type';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-brand';
        _urlType = '/credit/get-motorcycle-type';
        break;
    }

    $.ajax({
      type: 'GET',
      url: _urlType,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        console.log("TYPE KENDARAAN", dataObj);
        if (dataObj.success === "1") {
          $.each(dataObj.data, function (idMobilmotor, valMobilmotor) {
            if ($('#type_kendaraan option').length > 1) {
              $('#type_kendaraan option:not(:first)').remove();
            }
            if (valMobilmotor.desc != '') {
              typeKendaraan.push({
                id: valMobilmotor.id,
                text: valMobilmotor.desc
              });
            }
          })
          $('#type_kendaraan').select2({
            placeholder: type_kendaraan_placeholder,
            dropdownParent: $('#type_kendaraan').parent(),
            data: typeKendaraan
          });
        }
      }
    });

    $.ajax({
      type: 'GET',
      url: _url,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        console.log("MERK KENDARAAN", dataObj);
        if (dataObj.success === "1") {
          $.each(dataObj.data, function (idMobilmotor, valMobilmotor) {
            if ($('#merk_kendaraan option').length > 1) {
              $('#merk_kendaraan option:not(:first)').remove();
            }
            if (valMobilmotor.desc != '') {
              dataKendaraan.push({
                id: valMobilmotor.id,
                text: valMobilmotor.desc
              });
            }
          })
          $('#merk_kendaraan').select2({
            placeholder: merk_kendaraan_placeholder,
            dropdownParent: $('#merk_kendaraan').parent(),
            data: dataKendaraan
          });

          // Adding Placeholder - Start
          $('#model_kendaraan').select2({
            placeholder: model_kendaraan_placeholder
          });
          $('#tahun_kendaraan').select2({
            placeholder: tahun_kendaraan_placeholder
          });
          $('#status_kep').select2({
            placeholder: status_kep_placeholder
          });
          // Adding Placeholder - End
        }
      }
    })
    $('#merk_kendaraan').trigger("change");
    $('#model_kendaraan').attr("disabled", "disabled");
    $('#model_kendaraan').next().css("background-color", "#F4F4F4");
    // $('#model_kendaraan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");
  }

  function resetSameAddress() {
    if ($('#chkSameAddress').length > 0) {
      $('#chkSameAddress').prop("checked", false);
      $("#chkSameAddress").trigger("change");
      $("#chkSameAddress").parent(".jcf-checkbox").removeClass('jcf-checked');
    }
  }

  // function getmotor(element){
  // 	$.ajax({
  // 		type: 'GET',
  // 		url: 'https://bfi.staging7.salt.id/brand/motor/listJson',
  // 		dataType: 'json',
  // 		error: function (data) {
  // 			console.log('error' + data);
  // 		},

  // 		fail: function (xhr, textStatus, error) {
  // 			console.log('request failed')
  // 		},

  // 		success: function (dataObj) {
  // 			if(dataObj.success == true) {
  // 				$.each(dataObj.result.data, function(idMotor, valMotor) {
  // 					if(valMotor.name != '') {
  // 						var elementOption = '<option value="'+ valMotor.id +'">'+ valMotor.name +'</option>';

  // 						$(element).append(elementOption);
  // 					}
  // 				})
  // 			}
  // 		}
  // 	})
  // }

  var dataProvinceSertificate = [];
  var dataKotaSertificate = [];
  var dataKecamatanSertificate = [];
  var dataKelurahanSertificate = [];
  function getProvinsi(element, element2) {
    dataProvince = [];

    var provinsi_placeholder = $('#provinsi').attr('placeholder');
    $('#provinsi').empty();

    var kota_placeholder = $('#kota').attr('placeholder');

    var kecamatan_placeholder = $('#kecamatan').attr('placeholder');

    var kelurahan_placeholder = $('#kelurahan').attr('placeholder');

    $('#provinsi_sertificate').empty();

    $.ajax({
      type: 'GET',
      // url: '/service/provinsi/listJson',
      url: '/credit/get-province',
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        if (dataObj.message === 'Sukses') {
          $.each(dataObj.data, function (idProvince, valProvince) {
            if (valProvince.desc != '') {
              dataProvince.push({
                id: valProvince.id,
                text: valProvince.desc
              });
            }
          })
          $('#provinsi').select2({
            placeholder: provinsi_placeholder,
            dropdownParent: $('#provinsi').parent(),
            data: dataProvince
          });

          dataProvinceSertificate = dataProvince;
          if (element2) {
            $('#provinsi_sertificate').select2({
              placeholder: provinsi_placeholder,
              dropdownParent: $('#provinsi_sertificate').parent(),
              data: dataProvince
            });
          }

          // Adding Placeholder - Start
          $('#kota').select2({
            placeholder: kota_placeholder
          });
          $('#kecamatan').select2({
            placeholder: kecamatan_placeholder
          });
          $('#kelurahan').select2({
            placeholder: kelurahan_placeholder
          });

          $('#kota_sertificate').select2({
            placeholder: kota_placeholder
          });
          $('#kecamatan_sertificate').select2({
            placeholder: kecamatan_placeholder
          });
          $('#kelurahan_sertificate').select2({
            placeholder: kelurahan_placeholder
          });
          // Adding Placeholder - End

          $(".select2-search__field").css({
            "width": "100%"
          });
        }
      }
    })
  }

  $('#kota').attr("disabled", "disabled");
  $('#kota').next().css("background-color", "#F4F4F4");
  // $('#kota').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#kota_sertificate').attr("disabled", "disabled");
  $('#kota_sertificate').next().css("background-color", "#F4F4F4");
  // $('#kota_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#kecamatan').attr("disabled", "disabled");
  $('#kecamatan').next().css("background-color", "#F4F4F4");
  // $('#kecamatan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#kecamatan_sertificate').attr("disabled", "disabled");
  $('#kecamatan_sertificate').next().css("background-color", "#F4F4F4");
  // $('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#kelurahan').attr("disabled", "disabled");
  $('#kelurahan').next().css("background-color", "#F4F4F4");
  // $('#kelurahan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#kelurahan_sertificate').attr("disabled", "disabled");
  $('#kelurahan_sertificate').next().css("background-color", "#F4F4F4");
  // $('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#model_kendaraan').attr("disabled", "disabled");
  $('#model_kendaraan').next().css("background-color", "#F4F4F4");
  // $('#model_kendaraan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#alamat_lengkap').attr("disabled", "disabled");
  $('#alamat_lengkap').css("background-color", "#F4F4F4");

  $('#alamat_lengkap_sertificate').attr("disabled", "disabled");
  $('#alamat_lengkap_sertificate').css("background-color", "#F4F4F4");

  $('#tahun_kendaraan').attr("disabled", "disabled");
  $('#tahun_kendaraan').next().css("background-color", "#F4F4F4");
  // $('#tahun_kendaraan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#status_kep').attr("disabled", "disabled");
  $('#status_kep').next().css("background-color", "#F4F4F4");
  // $('#status_kep').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

  $('#provinsi').change(function () {
    // console.log('#provinsi change working...');

    resetSameAddress();

    showDefaultButton();
    change_addres = true;
    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");

    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }


    $("#kode_pos").val("");

    $('#kota').removeAttr("disabled");
    $('#kota').next().css("background-color", "white");
    // $('#kota').next().find(".jcf-select-opener").css("background-color", "white");

    $('#kecamatan').attr("disabled", "disabled");
    $('#kecamatan').next().css("background-color", "#F4F4F4");
    // $('#kecamatan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

    $('#kelurahan').attr("disabled", "disabled");
    $('#kelurahan').next().css("background-color", "#F4F4F4");
    // $('#kelurahan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

    $('#alamat_lengkap').attr("disabled", "disabled");
    $('#alamat_lengkap').css("background-color", "#F4F4F4");

    if ($("#kode_pos").val() == "" || $(this).val() == null || $("#alamat_lengkap").val() == "" || $("#kota").val() == null || $("#kecamatan").val() == null || $("#kelurahan").val() == null) {
      disableButton("#button2");
    } else {
      enableButton("#button2");
    }

    var dataCity = [];

    var kota_placeholder = $('#kota').attr('placeholder');
    $('#kota').empty();

    $('#kecamatan').empty();

    $('#kelurahan').empty();

    $('#kode_pos').val("");
    $('#alamat_lengkap').val("");

    var id = this.value;
    var params_getCity = { "province_id": id }

    $.ajax({
      type: 'POST',
      // url: '/service/city/listJson?id=' + id,
      url: '/credit/get-city',
      data: params_getCity,
      dataType: 'json',
      error: function (data) {
        console.log('[GET city]error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        if (dataObj.message === "Sukses") {
          $.each(dataObj.data, function (idCity, valCity) {
            if (valCity.desc != '') {
              dataCity.push({
                id: valCity.id,
                text: valCity.desc
              });
            }
          })
          $('#kota').select2({
            placeholder: kota_placeholder,
            dropdownParent: $('#kota').parent(),
            data: dataCity
          });
          dataKotaSertificate = dataCity;
        }
      }
    })
  })

  $('#provinsi_sertificate').change(function () {
    if (!$('#chkSameAddress').is(':checked')) {
      showDefaultButton();

      if ($('.nav-item-3').hasClass("done")) {
        $('.nav-item-3').removeClass("done");
        $('.nav-item-3').addClass("disabled");
      }
      if ($('.nav-item-4').hasClass("done")) {
        $('.nav-item-4').removeClass("done");
        $('.nav-item-4').addClass("disabled");
      }

      if (changeDataBangunan) {
        $('.nav-item-3').addClass("active")
        $('.nav-item-4').removeClass("active");
        $('.nav-item-4').addClass("disabled").off('click');
      }



      $("#kode_pos_sertificate").val("");

      $('#kota_sertificate').removeAttr("disabled");
      $('#kota_sertificate').next().css("background-color", "white");
      // $('#kota_sertificate').next().find(".jcf-select-opener").css("background-color", "white");

      $('#kecamatan_sertificate').attr("disabled", "disabled");
      $('#kecamatan_sertificate').next().css("background-color", "#F4F4F4");
      // $('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

      $('#kelurahan_sertificate').attr("disabled", "disabled");
      $('#kelurahan_sertificate').next().css("background-color", "#F4F4F4");
      // $('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

      $('#alamat_lengkap_sertificate').attr("disabled", "disabled");
      $('#alamat_lengkap_sertificate').css("background-color", "#F4F4F4");

      if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null) {
        disableButton("#button3rumah");
      } else {
        enableButton("#button3rumah");
      }

      var dataCity = [];

      var kota_placeholder = $('#kota_sertificate').attr('placeholder');
      $('#kota_sertificate').empty();

      $('#kecamatan_sertificate').empty();

      $('#kelurahan_sertificate').empty();

      $('#kode_pos_sertificate').val("");
      $('#alamat_lengkap_sertificate').val("");

      var id = this.value;
      var params_getCity = { "province_id": id }

      $.ajax({
        type: 'POST',
        // url: '/service/city/listJson?id=' + id,
        url: '/credit/get-city',
        data: params_getCity,
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (dataObj) {
          if (dataObj.success === "1") {
            $.each(dataObj.data, function (idCity, valCity) {
              if (valCity.desc != '') {
                dataCity.push({
                  id: valCity.id,
                  text: valCity.desc
                });
              }
            })
            $('#kota_sertificate').select2({
              placeholder: kota_placeholder,
              dropdownParent: $('#kota_sertificate').parent(),
              data: dataCity
            });
          }
        }
      })
    }
  })

  $('#kota').change(function () {
    resetSameAddress();
    showDefaultButton();
    change_addres = true;

    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $("#kode_pos").val("");

    $('#kecamatan').removeAttr("disabled");
    $('#kecamatan').next().css("background-color", "white");
    // $('#kecamatan').next().find(".jcf-select-opener").css("background-color", "white");

    $('#kelurahan').attr("disabled", "disabled");
    $('#kelurahan').next().css("background-color", "#F4F4F4");
    // $('#kelurahan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

    $('#alamat_lengkap').attr("disabled", "disabled");
    $('#alamat_lengkap').css("background-color", "#F4F4F4");

    if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == "" || $("#kecamatan").val() == "" || $("#kelurahan").val() == "") {
      disableButton("#button2");
    } else {
      enableButton("#button2");
    }

    var dataKec = [];

    var kecamatan_placeholder = $('#kecamatan').attr('placeholder');
    $('#kecamatan').empty();

    $('#kelurahan').empty();

    $('#kode_pos').val("");
    $('#alamat_lengkap').val("");

    var id = this.value;
    var param_getKecamatan = { "city_id": id };

    $.ajax({
      type: 'POST',
      // url: '/service/kecamatan/listJson?id=' + id,
      url: '/credit/get-district',
      data: param_getKecamatan,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        // console.log("(OK)[onChange Kota]dataObj: ", dataObj);
        if (dataObj.message === "Sukses") {
          $.each(dataObj.data, function (idKec, valKec) {
            if (valKec.desc != '') {
              dataKec.push({
                id: valKec.id,
                text: valKec.desc
              });
            }
          })
          $('#kecamatan').select2({
            placeholder: kecamatan_placeholder,
            dropdownParent: $('#kecamatan').parent(),
            data: dataKec
          });
          dataKecamatanSertificate = dataKec;
        }
      }
    })
  })

  $('#kota_sertificate').change(function () {
    if (!$('#chkSameAddress').is(':checked')) {
      showDefaultButton();

      if ($('.nav-item-3').hasClass("done")) {
        $('.nav-item-3').removeClass("done");
        $('.nav-item-3').addClass("disabled");
      }
      if ($('.nav-item-4').hasClass("done")) {
        $('.nav-item-4').removeClass("done");
        $('.nav-item-4').addClass("disabled");
      }
      if (changeDataBangunan) {
        $('.nav-item-2').addClass("active")
        $('.nav-item-3').addClass("disabled").off('click');
        $('.nav-item-4').removeClass("active");
        $('.nav-item-4').addClass("disabled").off('click');
      }
      $("#kode_pos_sertificate").val("");

      $('#kecamatan_sertificate').removeAttr("disabled");
      $('#kecamatan_sertificate').next().css("background-color", "white");
      // $('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color", "white");

      $('#kelurahan_sertificate').attr("disabled", "disabled");
      $('#kelurahan_sertificate').next().css("background-color", "#F4F4F4");
      // $('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

      $('#alamat_lengkap_sertificate').attr("disabled", "disabled");
      $('#alamat_lengkap_sertificate').css("background-color", "#F4F4F4");

      if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null) {
        disableButton("#button3rumah");
      } else {
        enableButton("#button3rumah");
      }

      var dataKec = [];

      var kecamatan_sertificate_placeholder = $('#kecamatan_sertificate').attr('placeholder');
      $('#kecamatan_sertificate').empty();

      $('#kelurahan_sertificate').empty();

      $('#kode_pos_sertificate').val("");
      $('#alamat_lengkap_sertificate').val("");

      var id = this.value;
      var params_getCity = { "city_id": id }

      $.ajax({
        type: 'POST',
        url: '/credit/get-district',
        data: params_getCity,
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (dataObj) {
          if (dataObj.success == "1") {
            var dataKec = [];
            $.each(dataObj.data, function (idKec, valKec) {
              if (valKec.desc != '') {
                dataKec.push({
                  id: valKec.id,
                  text: valKec.desc
                });
              }
            })
            $('#kecamatan_sertificate').select2({
              placeholder: kecamatan_sertificate_placeholder,
              dropdownParent: $('#kecamatan_sertificate').parent(),
              data: dataKec
            });
          }
        }
      })
    }
  })

  $('#kecamatan').change(function () {
    resetSameAddress();
    showDefaultButton();
    change_addres = true;

    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $("#kode_pos").val("");

    $('#kelurahan').removeAttr("disabled");
    $('#kelurahan').next().css("background-color", "white");
    // $('#kelurahan').next().find(".jcf-select-opener").css("background-color", "white");

    $('#alamat_lengkap').attr("disabled", "disabled");
    $('#alamat_lengkap').css("background-color", "#F4F4F4");

    if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kelurahan").val() == "") {
      disableButton("#button2");
    } else {
      enableButton("#button2");
    }

    var dataKel = [];

    var kelurahan_placeholder = $('#kelurahan').attr('placeholder');

    $('#kelurahan').empty();

    $('#kode_pos').val("");
    $('#alamat_lengkap').val("");

    var id = this.value;
    var params_getSubdistrict = { "district_id": id }

    $.ajax({
      type: 'POST',
      // url: '/service/kelurahan/listJson?id=' + id,
      url: '/credit/get-subdistrict',
      dataType: 'json',
      data: params_getSubdistrict,
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        // console.log("[onChange kecamatan]dataObj: ", dataObj);
        if (dataObj.message === "Sukses") {
          $.each(dataObj.data, function (idKel, valKel) {
            if (valKel.desc != '') {
              dataKel.push({
                id: valKel.id,
                text: valKel.desc,
                // postcode: valKel.postcode
              });
            }
          })

          function formatState(state) {
            if (!state.postcode) {
              return state.text;
            }
            var $state = $(
              '<span class="selected-kelurahan" postcode="' + state.postcode + '">' + state.text + '</span>'
            );
            return $state;
          };

          $('#kelurahan').select2({
            placeholder: kelurahan_placeholder,
            templateSelection: formatState,
            dropdownParent: $('#kelurahan').parent(),
            data: dataKel
          });

          dataKelurahanSertificate = dataKel;
        }
      }
    })
  })

  $('#kecamatan_sertificate').change(function () {
    if (!$('#chkSameAddress').is(':checked')) {
      showDefaultButton();

      if ($('.nav-item-3').hasClass("done")) {
        $('.nav-item-3').removeClass("done");
        $('.nav-item-3').addClass("disabled");
      }
      if ($('.nav-item-4').hasClass("done")) {
        $('.nav-item-4').removeClass("done");
        $('.nav-item-4').addClass("disabled");
      }
      if (changeDataBangunan) {
        $('.nav-item-2').addClass("active")
        $('.nav-item-3').addClass("disabled").off('click');
        $('.nav-item-4').removeClass("active");
        $('.nav-item-4').addClass("disabled").off('click');
      }
      $("#kode_pos_sertificate").val("");

      $('#kelurahan_sertificate').removeAttr("disabled");
      $('#kelurahan_sertificate').next().css("background-color", "white");
      // $('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color", "white");

      $('#alamat_lengkap_sertificate').attr("disabled", "disabled");
      $('#alamat_lengkap_sertificate').css("background-color", "#F4F4F4");

      if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#provinsi_sertificate").val() == null || $("#kelurahan_sertificate").val() == null) {
        disableButton("#button3rumah");
      } else {
        enableButton("#button3rumah");
      }

      var dataKel = [];

      var kelurahan_sertificate_placeholder = $('#kelurahan_sertificate').attr('placeholder');
      $('#kelurahan_sertificate').empty();

      $('#kode_pos_sertificate').val("");
      $('#alamat_lengkap_sertificate').val("");

      var id = this.value;
      var param_getKecamatan = { "district_id": id };

      $.ajax({
        type: 'POST',
        url: '/credit/get-subdistrict',
        data: param_getKecamatan,
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (dataObj) {
          if (dataObj.success == "1") {
            var dataKel = [];
            $.each(dataObj.data, function (idKel, valKel) {
              if (valKel.desc != '') {
                dataKel.push({
                  id: valKel.id,
                  text: valKel.desc,
                  postcode: valKel.postcode
                });
              }
            })

            function formatState(state) {
              if (!state.postcode) {
                return state.text;
              }
              var $state = $(
                '<span class="selected-kelurahan_sertificate" postcode="' + state.postcode + '">' + state.text + '</span>'
              );
              return $state;
            };

            $('#kelurahan_sertificate').select2({
              placeholder: kelurahan_sertificate_placeholder,
              templateSelection: formatState,
              dropdownParent: $('#kelurahan_sertificate').parent(),
              data: dataKel
            });
          }
        }
      })
    }
  })

  $("#kelurahan").on("select2:select", function (e) {
    resetSameAddress();
    console.log("===#kelurahan select ganti2");
    showDefaultButton();
    change_addres = true;
    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $('#alamat_lengkap').removeAttr("disabled");
    $('#alamat_lengkap').css("background-color", "white");



    // var postcodeGen = $(this).children("option[value='" + $(this).val() + "']").attr("postcode");
    // var postcodeGen = $(this).parent().find(".selected-kelurahan").attr("id");

    // var postcodeGen = $(this).parent().find(".selected-kelurahan");
    // console.log("====postcodeGen: ", postcodeGen);

    $.ajax({
      type: 'POST',
      url: '/credit/get-zipcode',
      dataType: 'json',
      data: { "subdistrict_id": this.value },
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        if (dataObj.success == true) {
          console.log('ZIP CODE', dataObj)
          var postcodeGen = dataObj.data[0].postal_code;


          if (postcodeGen !== 'null') {
            $("#kode_pos").val(postcodeGen);
            $("#kode_pos").data("value", dataObj.data[0].id);
            $("#kode_pos").prev().css({
              'display': 'block',
              'padding': '15px 15px 5px'
            });
            $("#kode_pos").css({
              'padding-top': '35px',
              'padding-bottom': '15px'
            });
          } else {
            $("#kode_pos").val("");
            $("#kode_pos").data("value", "");
          }

          if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kecamatan").val() == "") {
            disableButton("#button2");
          } else {
            enableButton("#button2");
          }
        }
      }
    })
  });

  $('#kode_pos').change(function () {
    resetSameAddress();
    showDefaultButton();
    change_addres = true;
    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $('#alamat_lengkap').removeAttr("disabled");
    $('#alamat_lengkap').css("background-color", "white");

    if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kecamatan").val() == "") {
      disableButton("#button2");
    } else {
      enableButton("#button2");
    }

  })

  $('#alamat_lengkap').change(function () {
    resetSameAddress();
    showDefaultButton();
    change_addres = true;
    if ($('.nav-item-2').hasClass("done")) {
      $('.nav-item-2').removeClass("done");
      $('.nav-item-2').addClass("disabled");
    }
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataTempatTinggal) {
      $('.nav-item-2').addClass("active")
      $('.nav-item-3').addClass("disabled").off('click');
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $('#alamat_lengkap').removeAttr("disabled");
    $('#alamat_lengkap').css("background-color", "white");

    if ($("#kode_pos").val() == "" || $(this).val() == "" || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == "" || $("#kota").val() == "" || $("#kecamatan").val() == "") {
      disableButton("#button2");
    } else {
      enableButton("#button2");
    }

  })

  $("#kelurahan_sertificate").on("select2:select", function (e) {
    if (!$('#chkSameAddress').is(':checked')) {
      showDefaultButton();

      if ($('.nav-item-3').hasClass("done")) {
        $('.nav-item-3').removeClass("done");
        $('.nav-item-3').addClass("disabled");
      }
      if ($('.nav-item-4').hasClass("done")) {
        $('.nav-item-4').removeClass("done");
        $('.nav-item-4').addClass("disabled");
      }
      if (changeDataBangunan) {
        $('.nav-item-3').addClass("active")
        $('.nav-item-4').removeClass("active");
        $('.nav-item-4').addClass("disabled").off('click');
      }
      $('#alamat_lengkap_sertificate').removeAttr("disabled");
      $('#alamat_lengkap_sertificate').css("background-color", "white");

      $.ajax({
        type: 'POST',
        url: '/credit/get-zipcode',
        dataType: 'json',
        data: { "subdistrict_id": this.value },
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (dataObj) {
          if (dataObj.success == "1") {
            console.log('ZIP CODE', dataObj)
            var postcodeGen = dataObj.data[0].postal_code;


            if (postcodeGen !== 'null') {
              $("#kode_pos_sertificate").val(postcodeGen);
              $("#kode_pos_sertificate").data("value", dataObj.data[0].id);
              $("#kode_pos_sertificate").prev().css({
                'display': 'block',
                'padding': '15px 15px 5px'
              });
              $("#kode_pos_sertificate").css({
                'padding-top': '35px',
                'padding-bottom': '15px'
              });
            } else {
              $("#kode_pos_sertificate").val("");
              $("#kode_pos_sertificate").data("value", "");
            }

            if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null) {
              disableButton("#button3rumah");
            } else {
              enableButton("#button3rumah");
            }
          }
        }
      })

      // var postcodeGen = $(this).parent().find(".selected-kelurahan_sertificate").attr("postcode");

      // if (postcodeGen !== 'null') {
      //   $("#kode_pos_sertificate").val(postcodeGen);
      //   $("#kode_pos_sertificate").prev().css({
      //     'display': 'block',
      //     'padding': '15px 15px 5px'
      //   });
      //   $("#kode_pos_sertificate").css({
      //     'padding-top': '35px',
      //     'padding-bottom': '15px'
      //   });
      // } else {
      //   $("#kode_pos_sertificate").val("");
      // }

      // if ($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null) {
      //   disableButton("#button3rumah");
      // } else {
      //   enableButton("#button3rumah");
      // }
    }
  })

  $('#status_sertificate').change(function () {
    showDefaultButton();
    $('#status_sertificate').parent().find(".select2-selection").children(".select2-selection__rendered").html($(this).find(":selected").text());
    if (changeDataBangunan) {
      $('.nav-item-3').addClass("active")
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
    }

    if ($("#kelurahan_sertificate").val() == null || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null) {
      disableButton("#button3rumah");
    } else {
      enableButton("#button3rumah");
    }

  })

  $('#own_sertificate').change(function () {
    showDefaultButton();
    $('#own_sertificate').parent().find(".select2-selection").children(".select2-selection__rendered").html($(this).find(":selected").text());
    if (changeDataBangunan) {
      $('.nav-item-3').addClass("active")
      $('.nav-item-4').removeClass("active");
      $('.nav-item-4').addClass("disabled").off('click');
    }
    if ($("#status_sertificate").val() == "" || $("#kelurahan_sertificate").val() == null || $("#kode_pos_sertificate").val() == "" || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null) {
      disableButton("#button3rumah");
    } else {
      enableButton("#button3rumah");
    }

  })

  $('#chkSameAddress').change(function () {
    // console.log($(this).is(':checked'), dataKotaSertificate, credits.tempat_tinggal.kota)
    if ($(this).is(':checked')) {

      $("#kota_sertificate").empty().select2({
        placeholder: $('#kota_sertificate').attr('placeholder'),
        dropdownParent: $('#kota_sertificate').parent(),
        data: dataKotaSertificate
      });
      $("#kecamatan_sertificate").empty().select2({
        placeholder: $('#kecamatan_sertificate').attr('placeholder'),
        dropdownParent: $('#kecamatan_sertificate').parent(),
        data: dataKecamatanSertificate
      });
      $("#kelurahan_sertificate").empty().select2({
        placeholder: $('#kelurahan_sertificate').attr('placeholder'),
        dropdownParent: $('#kelurahan_sertificate').parent(),
        data: dataKelurahanSertificate
      });

      $("#provinsi_sertificate").val($("#provinsi").val()).trigger("change");
      $("#kota_sertificate").val($("#kota").val()).trigger("change");
      $("#kecamatan_sertificate").val($("#kecamatan").val()).trigger("change");
      $("#kelurahan_sertificate").val($("#kelurahan").val()).trigger("change");
      $("#kode_pos_sertificate").val($("#kode_pos").val()).trigger("change");
      $("#kode_pos_sertificate").data("value", $("#kode_pos").data("value"));
      $("#alamat_lengkap_sertificate").val($("#alamat_lengkap").val()).trigger("change");
      $('#provinsi_sertificate, #kota_sertificate, #kecamatan_sertificate, #kelurahan_sertificate, #kode_pos_sertificate, #alamat_lengkap_sertificate').prop('disabled', true);
      enableButton("#button3rumah");

    } else {
      $('#kota_sertificate').select2({
        placeholder: $('#kota_sertificate').attr('placeholder'),
        dropdownParent: $('#kota_sertificate').parent(),
        data: []
      });
      $('#kecamatan_sertificate').select2({
        placeholder: $('#kecamatan_sertificate').attr('placeholder'),
        dropdownParent: $('#kecamatan_sertificate').parent(),
        data: []
      });
      $('#kelurahan_sertificate').select2({
        placeholder: $('#kelurahan_sertificate').attr('placeholder'),
        dropdownParent: $('#kelurahan_sertificate').parent(),
        data: []
      });
      $("#provinsi_sertificate").val(null).trigger("change");
      $("#kota_sertificate").val(null).trigger("change");
      $("#kecamatan_sertificate").val(null).trigger("change");
      $("#kelurahan_sertificate").val(null).trigger("change");
      $('#kode_pos_sertificate').val('');
      $('#alamat_lengkap_sertificate').val('');

      // disabled input
      $('#provinsi_sertificate').prop('disabled', false)
      $('#kota_sertificate, #kecamatan_sertificate, #kelurahan_sertificate, #kode_pos_sertificate, #alamat_lengkap_sertificate').prop('disabled', true)

      disableButton("#button3rumah");
    }
  })

  if ($('#provinsi_sertificate').length > 0) {
    getProvinsi($('#provinsi'), $('#provinsi_sertificate'));
  } else {
    getProvinsi($('#provinsi'));
  }

  $('#merk_kendaraan, #type_kendaraan').change(function () {
    // console.log("CHANGE",$('#type_kendaraan').val(),$('#merk_kendaraan').val())
    if ($('#type_kendaraan').val()[0] !== '' && $('#merk_kendaraan').val()[0] !== '') {
      showDefaultButton();

      if ($('.nav-item-3').hasClass("done")) {
        $('.nav-item-3').removeClass("done");
        $('.nav-item-3').addClass("disabled");
      }
      if ($('.nav-item-4').hasClass("done")) {
        $('.nav-item-4').removeClass("done");
        $('.nav-item-4').addClass("disabled");
      }
      $('.nav-item-5').addClass("disabled");
      if (changeDataKendaraan) {
        $('.nav-item-3').addClass("active")
        $('.nav-item-4').addClass("disabled").off('click');
        $('.nav-item-5').removeClass("active");
        $('.nav-item-5').addClass("disabled").off('click');
      }
      $('#model_kendaraan').removeAttr("disabled");
      $('#model_kendaraan').next().css("background-color", "white");
      // $('#model_kendaraan').next().find(".jcf-select-opener").css("background-color", "white");

      $('#tahun_kendaraan').attr("disabled", "disabled");
      $('#tahun_kendaraan').next().css("background-color", "#F4F4F4");
      // $('#tahun_kendaraan').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

      $('#status_kep').attr("disabled", "disabled");
      $('#status_kep').next().css("background-color", "#F4F4F4");
      // $('#status_kep').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

      var dataModel = [];

      var model_kendaraan_placeholder = $('#model_kendaraan').attr('placeholder');
      $('#model_kendaraan').empty();

      var tahun_kendaraan_placeholder = $('#tahun_kendaraan').attr('placeholder');
      $('#tahun_kendaraan').empty();
      $('#tahun_kendaraan').append("<option value='' disabled selected>" + tahun_kendaraan_placeholder + "</option>");

      var status_kep_placeholder = $('#status_kep').attr('placeholder');
      $('#status_kep').empty();
      $('#status_kep').append("<option value='' disabled selected>" + status_kep_placeholder + "</option>");

      //var id = this.value;
      var _url = '';
      var post_code_attr = credits.tempat_tinggal.kode_pos,
        tipe_attr = credits.angunan.jenis_angunan,
        type_attr = $('#type_kendaraan').val()[0],
        brand_attr = $('#merk_kendaraan').val()[0];

      var _data = {
        type_id: type_attr,
        brand_id: brand_attr
      }

      // console.log(brand_attr, $(this).val())
      switch (tipe_attr) {
        case 'MOBIL':
          _url = '/credit/get-car-model';
          break;
        case 'MOTOR':
          _url = '/credit/get-motorcycle-model';
          break;
      }

      $.ajax({
        type: 'POST',
        url: _url,
        data: _data,
        dataType: 'json',
        error: function (data) {
          console.log('error' + data);
        },

        fail: function (xhr, textStatus, error) {
          console.log('request failed')
        },

        success: function (dataObj) {
          if (dataObj.success === '1') {
            $.each(dataObj.data, function (idKendaraan, valKendaraan) {
              if (valKendaraan.desc != '') {
                dataModel.push({
                  id: valKendaraan.id,
                  text: valKendaraan.desc
                });
              }
            })

            $('#model_kendaraan').select2({
              placeholder: model_kendaraan_placeholder,
              dropdownParent: $('#model_kendaraan').parent(),
              data: dataModel
            });

            // $('#status_kep').val("");
            // var customFormInstance = jcf.getInstance($('#status_kep'));
            // customFormInstance.refresh();
            // $('#status_kep').empty();
          }
        }
      })
      disableButton("#button3");
    }
  });

  $('#model_kendaraan').change(function () {
    showDefaultButton();

    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataKendaraan) {
      $('.nav-item-3').addClass("active")
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    $('#tahun_kendaraan').removeAttr("disabled");
    $('#tahun_kendaraan').next().css("background-color", "white");
    // $('#tahun_kendaraan').next().find(".jcf-select-opener").css("background-color", "white");

    $('#status_kep').attr("disabled", "disabled");
    $('#status_kep').next().css("background-color", "#F4F4F4");
    // $('#status_kep').next().find(".jcf-select-opener").css("background-color", "#F4F4F4");

    var dataTahun = [];

    var tahun_kendaraan_placeholder = $('#tahun_kendaraan').attr('placeholder');

    $('#tahun_kendaraan').empty();

    var status_kep_placeholder = $('#status_kep').attr('placeholder');
    $('#status_kep').empty();
    $('#status_kep').append("<option value='' disabled selected>" + status_kep_placeholder + "</option>");

    var post_code_attr = credits.tempat_tinggal.kode_pos,
      tipe_attr = credits.angunan.jenis_angunan,
      model_attr = $(this).val()[0];

    var _url = '';
    var _data = {
      model_id: model_attr
    }

    // console.log(brand_attr, $(this).val())
    switch (tipe_attr) {
      case 'MOBIL':
        _url = '/credit/get-car-year';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-year';
        break;
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        console.log("YEAR", dataObj)
        if (dataObj.success == '1') {
          if (dataObj.data) {
            $.each(dataObj.data, function (index, dataYear) {
              if (dataYear.year != '') {
                dataTahun.push({
                  id: dataYear.id,
                  text: dataYear.year
                });
              }
            })

            $('#tahun_kendaraan').select2({
              placeholder: tahun_kendaraan_placeholder,
              dropdownParent: $('#tahun_kendaraan').parent(),
              data: dataTahun
            });

            // $('#status_kep').val("");
            // var customFormInstance = jcf.getInstance($('#status_kep'));
            // customFormInstance.refresh();
            // $('#status_kep').empty();

            // var status_self = $('#status_kep').data('status-self');
            // var status_other = $('#status_kep').data('status-other');
            // var injectStatusKep = ['<option value="' + status_self.toUpperCase() + '">' + status_self + '</option>', '<option value="' + status_other.toUpperCase() + '">' + status_other + '</option>'];
            // $('#status_kep').append(injectStatusKep);
            // $('#status_kep').next().removeClass("jcf-disabled");
          }
        }
      }
    })

    if ($("#merk_kendaraan").val() == "" || $(this).val() == "" || $("#tahun_kendaraan").val() == "" || $("#status_kep").val() == "") {
      disableButton("#button3");
    } else {
      enableButton("#button3");
    }
  });

  $('#tahun_kendaraan').change(function () {
    var dataStatus = [];
    showDefaultButton();
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataKendaraan) {
      $('.nav-item-3').addClass("active")
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    var statusSelf = $("#status_kep").data("status-self");
    var statusOther = $("#status_kep").data("status-other");
    dataStatus.push({
      id: statusSelf,
      text: statusSelf
    });
    dataStatus.push({
      id: statusOther,
      text: statusOther
    });
    $('#status_kep').removeAttr("disabled");
    $('#status_kep').next().css("background-color", "white");
    $('#status_kep').empty();
    $('#status_kep').select2({
      placeholder: status_kep_placeholder,
      dropdownParent: $('#status_kep').parent(),
      data: dataStatus
    });

    if ($("#model_kendaraan").val() == "" || $(this).val() == "" || $("#merk_kendaraan").val() == "" || $("#status_kep").val() == "") {
      disableButton("#button3");
    } else {
      enableButton("#button3");
    }
  });

  $('#status_kep').change(function () {
    showDefaultButton();
    // console.log('click');
    // alert();
    $('#status_kep').parent().find(".select2-selection").children(".select2-selection__rendered").html($(this).find(":selected").text());
    if ($('.nav-item-3').hasClass("done")) {
      $('.nav-item-3').removeClass("done");
      $('.nav-item-3').addClass("disabled");
    }
    if ($('.nav-item-4').hasClass("done")) {
      $('.nav-item-4').removeClass("done");
      $('.nav-item-4').addClass("disabled");
    }
    $('.nav-item-5').addClass("disabled");
    if (changeDataKendaraan) {
      $('.nav-item-3').addClass("active")
      $('.nav-item-4').addClass("disabled").off('click');
      $('.nav-item-5').removeClass("active");
      $('.nav-item-5').addClass("disabled").off('click');
    }
    if ($("#model_kendaraan").val() == "" || $(this).val() == "" || $("#tahun_kendaraan").val() == "" || $("#merk_kendaraan").val() == "") {
      disableButton("#button3");
    } else {
      enableButton("#button3");
    }
  });

  //function get credit min max price dan asurasi list

  function separatordot(o) {
    var bilangan = Math.ceil(o);

    var number_string = bilangan.toString(),
      sisa = number_string.length % 3,
      rupiah = number_string.substr(0, sisa),
      ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    return rupiah;
  }

  function getpriceminmax(params) {
    var _url = '';
    var _data = {};

    switch (params.angunan.jenis_angunan) {
      case 'MOBIL':
        _url = '/credit/get-car-funding';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-funding';
        break;
      case 'SURAT BANGUNAN':
        var _val = $("#estimasi_harga").val();
        _val = parseInt(_val.replace(/[.]/g, ""));
        _url = '/credit/get-pbf-funding';
        _data = { "estimasi_harga": _val }
        break;
    }

    //var kota = params.tempat_tinggal.kota;

    //kota = kota.slice(5,kota.length);

    // var _data = {
    //     tipe: htmlEntities(params.angunan.jenis_angunan),
    //     model_kendaraan: htmlEntities(params.kendaraan.model_kendaraan),
    //     merk_kendaraan: htmlEntities(params.kendaraan.merk_kendaraan_text),
    //     post_code: htmlEntities(params.tempat_tinggal.kode_pos),
    //     tahun: htmlEntities(params.kendaraan.tahun_kendaraan),
    //     status_kep: htmlEntities(params.kendaraan.status_pemilik)
    // }
    _data = Object.assign(_data, {
      "submission_id": submission_id
    });
    // alert(_data.tipe + "-" +_data.model_kendaraan + "-" + _data.merk_kendaraan + "-" + _data.post_code + "-" + _data.tahun);
    $.ajax({
      type: 'POST',
      url: _url,
      data: _data,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        var rawMinPrice = parseInt(data.data.minimum_funding),
          rawMaxPrice = parseInt(data.data.maximum_funding),
          otr_price = parseInt(data.data.minimum_funding);

        console.log(otr_price);
        console.log("LOG", $("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider'))

        if ($("#funding").length > 0) {
          $("#funding").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
        } else {
          $("#ex11").slider({ min: rawMinPrice, max: rawMaxPrice, step: 100000 });
        }

        $("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.max = rawMaxPrice;
        $("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.min = rawMinPrice;
        $("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.step = 100000;

        $("#ex6SliderVal").parents(".sliderGroup").find(".customslide").slider('setValue', rawMinPrice);

        var minprice = separatordot(rawMinPrice),
          maxprice = separatordot(rawMaxPrice);

        $("#ex6SliderVal").val(minprice);
        $(".valuemin").text(minprice);
        $(".valuemax").text(maxprice);
        $("#otr").val(otr_price);


        // var opsiasuransi = "<option value='"+data.data.asuransi_1+"'>"+data.data.asuransi_1+"</option>"+
        // 					"<option value='"+data.data.asuransi_2+"'>"+data.data.asuransi_2+"</option>";

        // var opsiasuransi = ""

        // $.each(data.data.asuransi, function(idx, opt) {
        //     if (opt.name == "All Risk Only") {
        //         opsiasuransi += "<option value='" + opt.code + "' selected>" + opt.name + "</option>"
        //     } else {
        //         opsiasuransi += "<option value='" + opt.code + "'>" + opt.name + "</option>"
        //     }
        // })

        // console.log("GGGG", data.data, opsiasuransi)

        // var tahunke = $('#tahunke').val();
        // console.log('tahun ke ' + tahunke);

        // raw_select = '<div class="columnselect" ke="0">' +
        //     '<div class="list-select">' +
        //     '<label>'+ tahunke +' - 1</label>' +
        //     '</div>' +
        //     '<div class="list-select">' +
        //     '<select class="c-custom-select-trans form-control formRequired opsiasuransi"' +
        //     'name="status" multiple="multiple">' + opsiasuransi + '</select>' +
        //     '</div>' +
        //     '<div class="error-wrap"></div>' +
        //     '</div>';

        // newoptionAsuransi(12, raw_select);

        // console.log(opsiasuransi);

        // objCredits.installment = rawMinPrice;
        // objCredits.jangka_waktu = 12;

        if ($("#jenis_form").val() == "MOBIL") {
          newoptionAsuransi(12, raw_select);

          objCredits.installment = rawMinPrice;
          objCredits.jangka_waktu = 12;
        } else if ($("#jenis_form").val() == "MOTOR") {
          newoptionAsuransi(6, raw_select);

          objCredits.installment = rawMinPrice;
          objCredits.jangka_waktu = 6;
        }

        post_val_inputan = rawMinPrice;

        $.validator.addClassRules({
          formPrice: {
            minPrice: rawMinPrice,
            required: true
          }
        });
        // $(".opsiasuransi").append(opsiasuransi);
        // $(".opsiasuransi").val(data.data.asuransi_1);
        // $(".opsiasuransi").next().children().children().text(data.data.asuransi_1);

        //raw_select = "<select class='opsiasuransi'>"+opsiasuransi+"</select>";
        //clone_asuransi = $(".columnselect").clone(true);

        $('#jangka_waktu').empty();
        getTenor();
      }
    })
  }


  function listingLocation(params) {
    $.ajax({
      type: 'GET',
      url: params,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      success: function (data) {
        var dataraw = [];
        $.each(data, function (id, val) {

          var listing = val.data;

          $.each(listing, function (idListing, valListing) {
            dataraw[dataraw.length] = valListing;
            // if (valListing.latitude != "" || valListing.longitude != "") {

            marker = new google.maps.Marker({
              position: new google.maps.LatLng(valListing.latitude, valListing.longitude),
              map: map,
              icon: _marker
            });

            if (valListing.gerai) {
              var icondynamic = "/static/images/icon/gerai.png";
            } else {
              var icondynamic = "/static/images/icon/branch1.png";
            }

            var contentString = '<div class="col-md-12 parent-brachlist linkgoogle infowindow" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
            contentString += '<div class="wrapper-branchlist">';
            contentString += '<div class="row">';
            contentString += '<div class="col-md-2 col-sm-2 col-xs-2 branchlist"><img class="icon-gedung-branchlist" src="' + icondynamic + '"></div>';
            contentString += '<div class="col-md-10 col-sm-9 col-xs-8 branchlist">';
            contentString += '<p class="title-branch margin-bottom-10">' + valListing.name + '</p>';
            contentString += '<p class="desc-branch">' + valListing.address + '</p>';
            contentString += '<a href="#" class="margin-top-20">PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></a>';
            contentString += '</div>';
            contentString += '</div>';
            contentString += '</div>';
            contentString += '</div>';

            infowindow = new google.maps.InfoWindow({
              content: ''
            });


            google.maps.event.addListener(marker, 'click', (function (marker, i) {

              return function () {
                $.each(markers, function (i, o) {
                  markers[i].setIcon(_marker);
                });
                marker.setIcon(_markerActive);
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
              }

            })(marker, i));


            markers.push(marker);

            google.maps.event.addListener(infowindow, 'domready', function () {
              if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                $(".gm-style-iw").parent().parent().parent().css("top", 100 + "%");
                $(".gm-style-iw").children().css("display", "table");
              }
            });
            // }
          })
        });
        //console.log(markers[0]);
        searchBox.addListener('places_changed', function (event) {
          var place = searchBox.getPlaces();

          $.each(place, function (idPlace, valPlace) {
            var latComplete = valPlace.geometry.location.lat(),
              lngComplete = valPlace.geometry.location.lng();

            _radius = (13 * 500);
            $('#branch').empty();

            for (var i = 0; i <= dataraw.length - 1; i++) {
              latLngGoogle = new google.maps.LatLng(latComplete, lngComplete);
              var latLngAPI = new google.maps.LatLng(parseFloat(dataraw[i].latitude), parseFloat(dataraw[i].longitude));
              var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(latLngGoogle, latLngAPI);

              CircleOption = {
                strokeColor: '#0F2236',
                strokeOpacity: 0.5,
                strokeWeight: 0.5,
                fillColor: '#0069aa',
                fillOpacity: 0.15,
                map: map,
                radius: _radius,
                center: latLngGoogle
              };

              if (cityCircle) {
                cityCircle.setMap(null);
              }

              cityCircle = new google.maps.Circle(CircleOption);

              if (valPlace.geometry.viewport) {
                map.setCenter(valPlace.geometry.location);
                map.setZoom(11);
              } else {
                map.setCenter(valPlace.geometry.location);
                map.setZoom(25);
              }

              var newMarker = null;

              newMarker = marker;

              marker = new google.maps.Marker({
                map: map,
                position: valPlace.geometry.location,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 0
                }
              });

              if ((distance_from_location <= _radius)) {

                if (dataraw[i].gerai) {
                  var icondynamic = "/static/images/icon/gerai.png";
                } else {
                  var icondynamic = "/static/images/icon/branch1.png";
                }

                $('#branch').removeClass("deactive");
                $(".map-wrapper").addClass("active");


                var html = '<div class="col-md-12 parent-brachlist notlinkgoogle" data-id="' + i + '" data-lat="' + dataraw[i].latitude + '"  data-lng="' + dataraw[i].longitude + '">';
                html += '<div class="wrapper-branchlist">';
                html += '<div class="row">';
                html += '<div class="col-md-2 col-sm-2 col-xs-2 branchlist"><img class="icon-gedung-branchlist" src="' + icondynamic + '"></div>';
                html += '<div class="col-md-8 col-sm-8 col-xs-8 branchlist">';
                html += '<p class="title-branch margin-bottom-10">' + dataraw[i].name + '</p>';
                html += '<p class="desc-branch">' + dataraw[i].address + '</p>';
                html += '<a href="#" class="margin-top-20">PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></a>';
                html += '</div>';
                html += '<div class="col-md-2 branchlist"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $('.wrapper-parent-branchlist').addClass('active');
                $('#branch').append(html);

                if ($('.parent-brachlist').length > 2) {
                  $('.wrapper-parent-branchlist').css('height', 400);
                } else {
                  $('.wrapper-parent-branchlist').css('height', 'auto');
                }

              }
              // else {

              // 	var html = '<div class="col-md-12 parent-brachlist" data-id="' + i + '" data-lat="' + dataraw[i].latitude + '"  data-lng="' + dataraw[i].longitude + '">';
              // 	html += '<div class="wrapper-branchlist">';
              // 	html += '<p>Lokasi Tidak Ditemukan</p>';
              // 	html += '</div>';
              // 	html += '</div>';

              // 	$('#branch').html(html);
              // 	$('.wrapper-parent-branchlist').css('height', 'auto');
              // }
            }
          });
        })
      }
    });

    $(document).on('click', '.notlinkgoogle', function () {

      $(".parent-brachlist").css("background-color", "white");
      var idMarker = $(this).data('id');

      console.log(idMarker);

      google.maps.event.trigger(markers[parseInt(idMarker)], 'click');

      $(this).css("background-color", "#F7F7F7");

      setTimeout(function () {
        $('#branch').addClass("deactive");
      }, 10);

      $(".map-wrapper").removeClass("active");

      if (isMobile) {
        $(".container-map-arrowback").addClass("active");
        $(".form-autocomplete").css("display", "none");
      }

    })

    $(".container-map-arrowback").click(function () {
      $(this).removeClass("active");
      $(".form-autocomplete").css("display", "block");
      google.maps.event.trigger(searchBox, 'places_changed');
    });
  }

  $(document).on('click', '.linkgoogle', function () {

    var tembaklat = $(this).data('lat'),
      tembaklng = $(this).data('lng');

    navigator.geolocation.getCurrentPosition(function (position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var urlgoogle = "https://www.google.com/maps/dir/?api=1&origin=" + pos.lat + "," + pos.lng + "&destination=" + tembaklat + "," + tembaklng + "";
      window.open(urlgoogle, '_blank');
    })
  });


  var getlong,
    getlat;

  if ($('#map').length) {

    function getUrlVars() {
      var vars = {};
      //var testing = 'https://bfi.staging7.salt.id/id/branch-office?longitude=98,495277&latitude=3,611302';
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
      });
      return vars;
    }

    getlong = getUrlVars()["longitude"];
    getlat = getUrlVars()["latitude"];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-6.21462, 106.84513)
    });


    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      console.log("Geolocation is not supported by this browser.");
    }

    var input = document.getElementById('searchTextField');
    var searchBox = new google.maps.places.SearchBox(input);
    var cityCircle;

    var autocomplete = new google.maps.places.Autocomplete(input, {
      types: ["geocode"]
    });

    autocomplete.bindTo('bounds', map);

    var base_url = '/branch/listJson';

    listingLocation(base_url);

  }

  function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;

    if (!getlong && !getlat) {
      map.setCenter(new google.maps.LatLng(lat, lng));
    } else {
      var getlatInput = getlat.replace(",", ".");
      var getlongInput = getlong.replace(",", ".");
      map.setCenter(new google.maps.LatLng(getlatInput, getlongInput));
    }

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat, lng),
      icon: '/static/images/icon/circled-dot.png'
    });

    marker.setMap(map);
    map.setZoom(14);
  }

  function countDown() {
    var count = 120;
    var counter = setInterval(function timerDown() {
      count = count - 1;
      if (count === -1) {
        clearInterval(counter);
        return;
      }

      var seconds = count % 60,
        minutes = Math.floor(count / 60),
        hours = Math.floor(minutes / 60);
      minutes %= 60;
      hours %= 60;

      if (minutes < 10) {

        minutes = '0' + minutes;
      }

      if (hours < 10) {

        hours = '0' + hours;
      }

      if (seconds < 10) {

        seconds = '0' + seconds;
      }


      if (minutes == 00 && seconds == 00) {
        var reload = '<a href="#" class="countdown countdown--reload">Kirim Ulang</a>';
        $('.otp-number__text p span').html(reload);


      } else {
        $('.countdown').html(minutes + ":" + seconds);
      }

    }, 1000)

  }

  function calculatePremi() {
    var _url = '';
    // var _val = $('#ex6SliderVal').val()
    // var _reform = _val.replace(/[.]/g, "")
    // var _toInt = parseInt(_reform)
    // _toInt = (_toInt > 0 ? _toInt : 0)
    // var _param = {
    //     tipe: htmlEntities(credits.angunan.jenis_angunan),
    //     model_kendaraan: htmlEntities(credits.kendaraan.model_kendaraan),
    //     merk_kendaraan: htmlEntities(credits.kendaraan.merk_kendaraan_text),
    //     tahun: htmlEntities(credits.kendaraan.tahun_kendaraan),
    //     post_code: htmlEntities(credits.tempat_tinggal.kode_pos),
    //     funding: htmlEntities(objCredits.funding),
    //     tenor: htmlEntities(objCredits.jangka_waktu),
    //     asuransi: htmlEntities(asuransi_arr.join("-")),
    //     status_kep: htmlEntities(credits.kendaraan.status_pemilik),
    //     taksasi: htmlEntities(objCredits.installment)
    // }

    var _param = {
      submission_id: submission_id,
      funding: htmlEntities(objCredits.funding),
      tenor: htmlEntities(objCredits.jangka_waktu),
      insurance: asuransi_arr.join(",")
    }


    // console.log(brand_attr, $(this).val())
    switch (credits.angunan.jenis_angunan) {
      case 'MOBIL':
        _url = '/credit/get-car-calculate';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-calculate';
        break;
      case 'SURAT BANGUNAN':
        _url = '/credit/pbf-calculate';
        break;
    }

    if (_param.funding == 0) {
      if ($("#jenis_form").val() == "MOBIL") {
        _param.funding = 10000000;
      } else if ($("#jenis_form").val() == "MOTOR") {
        _param.funding = 1000000;
      }
    }

    $.ajax({
      type: 'POST',
      url: _url,
      data: _param,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (result) {

        // console.log("Calculator Result", data)

        var angsuranFinal = result.data.monthly_installment_est_total,
          angsuranFinal_txt = separatordot(angsuranFinal),
          // insuranceCarTot = result.data.monthly_insurance / parseInt(_param.tenor),
          insuranceCarTot = result.data.monthly_insurance,
          insuranceCarTot_txt = separatordot(insuranceCarTot);

        // var totalbiaya = (parseInt(angsuranFinal) * parseInt(_param.tenor) - parseInt(insuranceCarTot)) / parseInt(_param.tenor),
        var totalbiaya = result.data.monthly_installment,
          totalbiaya_txt = separatordot(totalbiaya);

        angsuranFinal_txt = "Rp " + angsuranFinal_txt;
        totalbiaya_txt = "Rp " + totalbiaya_txt;
        insuranceCarTot_txt = "Rp " + insuranceCarTot_txt;

        $(".currency[tahun='0']").text(totalbiaya_txt);
        $(".currency[tahun='1']").text(insuranceCarTot_txt);
        $(".total").text(angsuranFinal_txt);


        // if($(".textsubcurrency").length > 0){
        // 	var start_delRow = 2;
        // 	for(var i=start_delRow; i<=$(".tableangsuran tr").length - 1; i++){
        // 		$(".tableangsuran tr:eq("+i+")").remove();
        // 		i--;
        // 	}
        // }

        //       for(var i=0; i<=asuransi_arr.length - 1; i++){
        //       	//var txt_asuransi = $(".c-custom-select-trans.opsiasuransi option[value='"+ asuransi_arr[i] +"']").text();
        //       	var html_angsuran = '<tr>'+
        //                                         '<td class="textsubcurrency">'+
        //                                             'Tahun ke-'+(i+1)+' ['+asuransi_arr_txt[i]+'*]'+
        //                                         '</td>'+
        //                                         '<td class="currency" tahun="'+(i+1)+'">'+
        //                                             'Rp 340.000'+
        //                                         '</td>'+
        //                                 	'</tr>';

        //       	$(".tableangsuran").append(html_angsuran);
        //       }

      }
    })
  }

  function getTenor() {
    var _url = '';
    var jenis_kredit = $('#jenis_form').val();
    // var _param = {
    //     tipe: htmlEntities($("#jenis_form").val()),
    //     funding: htmlEntities(objCredits.funding),
    // }
    var _param = {
      "submission_id": submission_id
    };
    switch (jenis_kredit) {
      case 'MOBIL':
        _url = '/credit/get-tenor';
        break;
      case 'MOTOR':
        _url = '/credit/get-motorcycle-tenor';
        break;
      case 'SURAT BANGUNAN':
        _url = '/credit/get-pbf-tenor';
        break;
    }

    // console.log(_param);

    $.ajax({
      type: 'POST',
      url: _url,
      data: _param,
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },
      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },
      success: function (data) {
        // console.log("Tenor Result", data);
        $.each(data.data, function (index, value) {
          var tenor = value.tenor;
          var tenor_text = value.desc;
          // console.log(tenor_text, tenor)
          $('#jangka_waktu').append($('<option>', {
            value: tenor,
            text: tenor_text
          }));
        })

        $('#jangka_waktu option:first-child').attr('selected', 'selected');

      }
    })
  }
  // if($("#jangka_waktu").length){
  //     if ($("#jenis_form").val() == "MOBIL") {
  //         getInsurance();
  //     }
  // }

  $("#ex6SliderVal").change(function () {
    console.log(parseInt($(this).val()))
    var _val = $(this).val()
    var _reform = _val.replace(/[.]/g, "")
    var _toInt = parseInt(_reform)
    _toInt = (_toInt > 0 ? _toInt : 0)
    objCredits.funding = _toInt;

    console.log(_toInt);
    $('#jangka_waktu').empty();
    getTenor();
  })

  previousVal = "";
  function InputChangeListener() {
    if ($('#jangka_waktu').val() != previousVal) {
      previousVal = $('#jangka_waktu').val();
      $('#jangka_waktu').change();
    }
  }

  setInterval(InputChangeListener, 500);

  if (typeof ($('#ex6SliderVal').parents(".sliderGroup").find(".customslide").slider()) !== 'undefined') {
    $('#ex6SliderVal').parents(".sliderGroup").find(".customslide").slider().on('slideStop', function (ev) {
      $('#jangka_waktu').empty();
      getTenor();
    });
  }

  // if ($("#jangka_waktu").length) {
  //     var defaultJangkaWaktu = $("#jangka_waktu").val()[0];

  //     $("#jangka_waktu").select2({
  //         dropdownParent: $('#jangka_waktu').parent()
  //     });

  //     $("#jangka_waktu").change(function() {
  //         var jangkaWaktu = $("#jangka_waktu").val();

  //         if (jangkaWaktu.length == 0) {
  //             $("#jangka_waktu").val(defaultJangkaWaktu).trigger("change");
  //         } else if (jangkaWaktu.length > 1) {
  //             $("#jangka_waktu").val(jangkaWaktu[jangkaWaktu.length - 1]).trigger("change");
  //         }
  //         objCredits.jangka_waktu = $(this).val();
  //     })
  // }

  $("#jangka_waktu").change(function () {
    objCredits.jangka_waktu = $(this).val();
  })

  $(document).on('click', '#recalc', function (e) {
    e.preventDefault();
    $(this).text("HITUNG ULANG");
    calculatePremi();
    if ($("#button4rumah").length > 0) {
      enableButton('#button4rumah');
    } else {
      enableButton('#button4');
    }
    enableButton('.hidesavebutton');
    flag_sudahcalc = true;
  })

  $(document).on('click', '.countdown--reload', function (e) {
    e.preventDefault();
    countDown();
    requestOtp(credits);
    $('.countdown').removeClass('countdown--reload');
  })

  $("input.form-control").on('focus', function () {
    if ($(this).attr("id") !== "ex6SliderVal") {
      $(this).prev().css({
        'display': 'block',
        'padding': '15px 15px 5px'
      });
      $(this).css({
        'padding-top': '35px',
        'padding-bottom': '15px'
      });
    }
  });

  $("textarea.form-control").on('focus', function () {
    if ($(this).attr("id") == "alamat_lengkap") {
      $(this).prev().css({
        'display': 'block',
        'padding': '15px 15px 5px'
      });
      $(this).css({
        'padding-top': '35px',
        'padding-bottom': '15px'
      });
    }
  });  

  $("input.form-control").on('focusout', function () {
    if ($(this).val() == "") {
      $(this).prev().css("display", "none");
      $(this).css({
        'padding-top': '20px',
        'padding-bottom': '20px'
      });
    }
  });

  $(document).on('focus', '.select2', function (e) {
    $(this).parent().find("label").css({
      'display': 'block',
      'padding': '12px 15px'
    });
  });

  // $("#produk").hover(function() {
  // 	$(".header-link-menu").addClass("active");
  // });


  $(".dark-back").hover(
    function () {
      $(".header-link-menu").addClass("active");
    },
    function () {
      $(".header-link-menu").removeClass("active");
    }
  );

  // placeholder cek pengajuan
  if ($('.cek-pengajuan').length) {
    var placeholder = $("#sel-how-form-credit").data("placeholder");
    $('.cek-pengajuan').parent().find(".select2-selection").children(".select2-selection__rendered").html(placeholder);
  }
  $("#sel-how-form-credit").on('change', function (e) {
    $(".select2-selection").children(".select2-selection__rendered").html($(this).find("option:selected").text());
  })

  // placeholder status kepemilikan form mobil/motor
  var status_kep_placeholder = $('#status_kep').attr('placeholder');
  $('#status_kep').parent().find(".select2-selection").children(".select2-selection__rendered").html(status_kep_placeholder);
  // placeholder pekerjaan form rumah
  var pekerjaan_placeholder = $('#pekerjaan').attr('placeholder');
  $('#pekerjaan').parent().find(".select2-selection").children(".select2-selection__rendered").html(pekerjaan_placeholder);
  // placeholder status sertifikat form rumah
  var status_certificate_placeholder = $('#status_sertificate').attr('placeholder');
  $('#status_sertificate').parent().find(".select2-selection").children(".select2-selection__rendered").html(status_certificate_placeholder);
  // placeholder status kepemilikan form rumah
  var own_sertificate_placeholder = $('#own_sertificate').attr('placeholder');
  $('#own_sertificate').parent().find(".select2-selection").children(".select2-selection__rendered").html(own_sertificate_placeholder);

  // var locationurlnow = window.location.pathname;

  // if(locationurlnow == "/"){
  // 	$("._EN").removeClass("active");
  // 	$("._ID").addClass("active");
  // }else{
  // 	$("._ID").removeClass("active");
  // 	$("._EN").addClass("active");
  // }

  validateFormRequired($('#getCredit'))
  keyupOtpAction();
  changeSumary();
  stepAction();
  //tabAction();
  backAction();


  // CLEAR NEWSLETTER
  $('.news-ok').on('click', function () {
    $('#sendNewsletter .form-control').val('');
  });

  // SELECT WRAPPER
  $(document).ready(function () {
    $('.form-get--credit .form-group > select').parent().addClass('select-wrapper');
    $('.form-get--credit .inputsimulasi .columnselect .list-select select').parent().addClass('select-wrapper');
  });

  // PHONE NUMBER formPhoneNumber
  $('.formPhoneNumber').focus(function () {
    if ($.trim($(this).val()) == "") {
      $(this).val("0");
    }
  });

  $(".formPhoneNumber").on("keydown", function (e) {
    if (e.which != 8 && e.which != 0 && e.which != 144 && (e.which < 46 || e.which > 57) && (e.which < 96 || e.which > 105)) {
      return false;
    }
  //   if (($(this).get(0).selectionStart == 0 && (e.keyCode < 35 || e.keyCode > 40)) ||
  //     ($(this).get(0).selectionStart == 1 && e.keyCode == 8)) {
  //     return false;
  //   }
  });

  $('.formPhoneNumber').on('input propertychange paste', function (e) {
    var reg = /^00+/gi;
    var reg2 = /^[+62]+/gi;
    if (this.value.match(reg)) {
      this.value = this.value.replace(reg, '0');
    }
    if (this.value.match(reg2)) {
      this.value = this.value.replace(reg2, '0');
    }
  });

  $(".formPhoneNumber").bind("contextmenu", function (e) {
    e.preventDefault();
  });

  $("#nama_lengkap").on("keydown", function (e) {
    var regex = new RegExp("^[a-zA-Z\s\b\.\'\\ ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
      return true;
    } else {
      return false;
    }
  });

  $("#nama_lengkap").each(function (index) {
    $(this).focusout(function () {
      var text = $(this).val();
      text = $.trim(text);
      $(this).val(text);
    });
  });

  // SELECT2
  var pekerjaan_placeholder = $('#pekerjaan').attr('placeholder');
  $('#pekerjaan').select2({
    placeholder: pekerjaan_placeholder,
    dropdownParent: $('#pekerjaan').parent()
  });
  var status_sertificate_placeholder = $('#status_sertificate').attr('placeholder');
  $('#status_sertificate').select2({
    placeholder: status_sertificate_placeholder,
    dropdownParent: $('#status_sertificate').parent()
  });
  var own_sertificate_placeholder = $('#own_sertificate').attr('placeholder');
  $('#own_sertificate').select2({
    placeholder: own_sertificate_placeholder,
    dropdownParent: $('#own_sertificate').parent()
  });

  $(".file-input").change(function (e) {
    var sizeLimit = 1000000;
    var parent = $(this).parents(".upload-image");
    var preview = parent.find("img")[0];
    var label = parent.find("b")[0];
    var file = e.target.files[0];
    var iptFrm = $(this).data("id");
    var isImage = (file.type.match("image") ? true : false);

    if (file.size <= sizeLimit && isImage) {
      var reader = new FileReader();
      reader.addEventListener("load", function () {
        if (typeof (preview) !== "undefined") {
          // $("#" + iptFrm).val(reader.result).trigger("change");
          $("#" + iptFrm).val("/test/test.png").trigger("change");
          $(label).text(file.name);
          preview.src = reader.result;
        }
      }, false);

      if (file) {
        $(preview).show();
        reader.readAsDataURL(file);
      } else {
        $(preview).hide();
      }
      parent.find(".error-wrap").hide();
    } else {
      var errorMsg = '';
      switch (false) {
        case (file.size <= sizeLimit):
          console.log("app")
          if(lang === 'id'){
            errorMsg = 'Ukuran file harus kurang dari 1 MB.';
          }else{
            errorMsg = 'File size must be less than 1 MB.';
          }
          break;
        case isImage:
          if(lang === 'id'){
            errorMsg = 'Silakan pilih file gambar.';
          }else{
            errorMsg = 'Please choose image file.';
          }
          break;
      }
      parent.find(".error-wrap").show();
      parent.find(".error-wrap").html('<label id="ktp-error" class="error" for="ktp" style="display: inline-block;">' + errorMsg + '</label>')
    }
  });

  $(".upload-btn button").click(function () {
    var parent = $(this).parents(".upload-image");
    parent.find(".file-input").click();
  });


})(jQuery);

function copyURL(url) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(url).select();
  document.execCommand("copy");
  $temp.remove();
  $('#copied').show().delay(2000).fadeOut(400);
}

function checkStatusPengajuan() {
  console.log(phone_number);
  var lang = document.documentElement.lang;
  var _url = "/submission-login";
  var _data = {
    'phone_number' : phone_number
  }

  $.ajax({
    type: 'POST',
    url: _url,
    data: _data,
    dataType: 'json',
    error: function (data) {
      console.log('error' + data);
    },
    fail: function (xhr, textStatus, error) {
      console.log('request failed')
    },
    success: function (data) {
      if (data.success === "1") {
        var token = data.data.customer_token
        localStorage.setItem("token", token);
        console.log ('token : ' + token);
        getCustomer(token);
        window.location="/"+lang+"/user/dashboard";    
      }else{
        console.log("login after submission failed");
      }
    }
  })
}

function loginCustomer() {
  var dataPhone = {
      'phone_number' : $('#phone-input').val()
  };
  console.log(dataPhone);
  $.ajax({
      type: 'POST',
      url: '/user/login',
      data: dataPhone,
      dataType: 'json',
      error: function (data) {
          console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
          console.log('request failed')
      },

      success: function (dataObj) {
          if (dataObj.success === true) {
              console.log('berhasil login')
              requestOTP(dataPhone)
              $('#login').addClass("hide");
              $('#otp').removeClass("hide");
              otp();
          }
      }
  })
}

function otp(){
  var timeleft = 90;
  var timer = setInterval(function(){
      document.getElementById("resend").innerHTML = "Mohon menunggu <b>" +timeleft+ " seconds </b> untuk mengirim ulang";
      timeleft -= 1;
      if(timeleft <= 0){
          clearInterval(timer);
          document.getElementById("resend").innerHTML = "Tidak menerima 4-digit kode ? <a onclick='resendOTP()'><b>Kirim Ulang</b></a>"
      };
  }, 1000);
}

function resendOTP(){
  var dataPhone = {
      'phone_number' : $('#phone-input').val()
  };
  otp();
  requestOTP(dataPhone)
  document.getElementById("resend-notice").textContent = "4-digit kode telah dikirimkan ke nomor handphone anda";
}

function requestOTP(phone) {
  $.ajax({
      type: 'POST',
      url: '/user/otp-request',
      data: phone,
      dataType: 'json',
      error: function (data) {
          console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
          console.log('request failed')
      },

      success: function (dataObj) {
          console.log(dataObj.result.data)
      }
  })
}

function verified(language){
  var otpInput = $("input[name='digit[]']").map( function() { return $(this).val(); } ).get();
  otpInput = otpInput.join("")
  
  var dataOTP = {
      'phone_number' : $('#phone-input').val(),
      'otp_code' : otpInput
  };

  console.log(dataOTP)
  verifiedOTP(language, dataOTP)
}

function verifiedOTP(language, dataOTP){
  $.ajax({
      type: 'POST',
      url: '/user/otp-confirm',
      data: dataOTP,
      dataType: 'json',
      error: function (data) {
          console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
          console.log('request failed')
      },

      success: function (dataObj) {
          if (dataObj.success === true) {
              console.log('berhasil verified otp')
              var token = dataObj.result.data.customer_token
              localStorage.setItem("token", token);
              console.log ('token : ' + token);
              getCustomer(token);
              window.location="/"+language+"/user/dashboard";
          }else {
            console.log('otp salah, masukkan otp yang valid')
          }
      }
  })
}

function getCustomer(token){
  $.ajax({
      type: 'GET',
      url: '/user/data-customer',
      crossDomain: true,
      dataType: 'json',
      async: false,
      headers: {'sessionId': token},

      error: function(data) {
          console.log('error' + data);
      },

      fail: function(xhr, textStatus, error) {
          console.log('request failed')
      },

      success: function(dataObj){
        if(dataObj.success === true) {
          var data = dataObj.result.data;
          console.log(data.full_name)
          document.cookie = "customer="+data.full_name+"; path=/";
        }
      }
  });
}

function logout(language) {
  var token = window.localStorage.getItem("token");

  $.ajax({
    type: 'POST',
    url: '/user/logout',
    crossDomain: true,
    dataType: 'json',
    headers: {'sessionId': token },

    error: function (data) {
        console.log('error' + data);
    },

    fail: function (xhr, textStatus, error) {
        console.log('request failed')
    },

    success: function (dataObj) {
        if (dataObj.success === true) {
          console.log('berhasil logout');
          window.localStorage.clear();
          document.cookie = "customer=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          window.location="/"+language+"/login";
        }
    }
  })
}
$(document).ready(function() {
  $('#category-1').select2({
    placeholder: "Pilih jenis pembiayaan?",
    minimumResultsForSearch: -1
  });
  $('#category-2').select2({
    placeholder: "Pembiayaan apa yang dibutuhkan?",
    minimumResultsForSearch: -1
  });

  window.onload = function(){

    var lang = document.documentElement.lang
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var date = new Date($(".blog-promo").find('.dateview > span.date').html());
    var blogDate = date.toLocaleDateString(lang+'-'+lang, options);
    $(".blog-promo").find('.dateview > span.date').text(blogDate);
  }
});

$(document).ready(function() {
  // if ($('#btn-burger').attr('aria-expanded') === 'true') {
  //   console.log("ada");
  //   $('#btn-credit').css({ display: "none" });
  // }
  // if ($('#btn-burger').attr('aria-expanded') === "false") {
  //   $('#btn-credit').css({ display: "block" });
  // }
});

/*Scroll to top when arrow up clicked BEGIN*/
$(window).scroll(function() {
  var height = $(window).scrollTop();
  if (height > 100) {
      $('.backtoTop').fadeIn(200);
  } else {
      $('.backtoTop').fadeOut(200);
  }
});
  $(".backtoTop").click(function(event) {
      event.preventDefault();
      $("html, body").animate({
          scrollTop: 0
      }, 800);
      return false;
  });

$(function () { 
  $('#btn-burger').on('click', function (e) {
      var menuItem = $( e.currentTarget );

      if (menuItem.attr( 'aria-expanded') === 'true') {
        $('#btn-credit').css({ display: "block" });
      } else {
        $('#btn-credit').css({ display: "none" });
      }
  });
});

var input = document.querySelector("#nama_lengkap");
console.log(input);
input.addEventListener('keydown', function(e) {
    if (e.which === 9) {
        var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    };
});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return ((evt.ctrlKey && evt.which === 65) || (evt.ctrlKey && evt.which === 67) || (evt.ctrlKey && evt.which === 86) || (charCode < 65 || charCode > 90) );
}

function alamatFocus(){
    $("#label_alamat").css({
      'display': 'block',
      'padding': '15px 15px 5px'
    });
    $("#alamat_lengkap").css({
      'padding-top': '35px',
      'padding-bottom': '15px'
    });
}