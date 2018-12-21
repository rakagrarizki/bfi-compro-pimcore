(function ($) {

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


	$(window).scroll(function () {

		var st = $(this).scrollTop();

		if (st >= 100) {
			$('#site-header').addClass('active');
			$('#site-container').addClass('active');

		}
		else {
			$('#site-header').removeClass('active');
			$('#site-container').removeClass('active');
		}

		lastScrollTop = st;
	});

	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
	var _marker = '/static/images/icon/marker.png';
	var marker, i, latLngGoogle, _radius;
	var infowindow = null;
	var markers = [];

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
			"model_kendaraan": "",
			"tahun_kendaraan": "",
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
			"alamat": ""
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
		funding: "",
		merk_kendaraan: "",
		jangka_waktu: "",
		installment: ""
	}


	$("#herobanner").slick({
		slideToShow: 1,
		dots: true,
		prevArrow: $(".prev-1"),
		nextArrow: $(".next-1")
	})

	$("#herobanner2").slick({
		slideToShow: 1,
		dots: true,
		prevArrow: $(".prev-2"),
		nextArrow: $(".next-2")
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


	var customSelect = $('.c-custom-select-home');

	// Options for custom Select
	jcf.setOptions('Select', {
		wrapNative: false,
		wrapNativeOnMobile: false,
		fakeDropInBody: false,
		maxVisibleItems: 5
	});

	jcf.replace(customSelect);

	var customSelect2 = $('.c-custom-select');

	// Options for custom Select
	jcf.setOptions('Select', {
		wrapNative: false,
		wrapNativeOnMobile: false,
		fakeDropInBody: false,
		maxVisibleItems: 5
	});

	jcf.replace(customSelect2);

	var customSelect3 = $('.c-custom-select-trans');

	// Options for custom Select
	jcf.setOptions('Select', {
		wrapNative: false,
		wrapNativeOnMobile: false,
		fakeDropInBody: false,
		maxVisibleItems: 5
	});

	jcf.replace(customSelect3);

	$(".nav-tabs>li").on("click", function (e) {
		if ($(this).hasClass("disabled")) {
			e.preventDefault();
			return false;
		}
	});

	// jQuery.validator.setDefaults({
	// 	debug: true,
	// 	success: "valid"
	// });

	// $form = $(".form-get--credit");
	// $successMsg = $(".alert");


	// $form.validate({
	// 	errorPlacement: function (error, element) {
	// 		if (!error) {
	// 			return true;
	// 		}
	// 	},
	// 	onfocusout: false,
	// 	onkeyup: false,
	// 	rules: {
	// 		nama_lengkap: {
	// 			required: true,
	// 			minlength: 5
	// 		},
	// 		email: {
	// 			required: true,
	// 			email: true
	// 		},
	// 		no_handphone: {
	// 			required: true,
	// 			number: true
	// 		},
	// 		file_upload: {
	// 			required: true,
	// 			accept: "image/jpeg, pdf"
	// 		},
	// 		provinsi: {
	// 			required: true
	// 		},
	// 		kota: {
	// 			required: true
	// 		},
	// 		kecamatan: {
	// 			required: true
	// 		},
	// 		kelurahan: {
	// 			required: true
	// 		},
	// 		kode_pos: {
	// 			required: true
	// 		},
	// 		alamat_lengkap: {
	// 			required: true
	// 		},
	// 		merk_kendaraan: {
	// 			required: true
	// 		},
	// 		model_kendaraan: {
	// 			required: true
	// 		},
	// 		tahun_kendaraan: {
	// 			required: true
	// 		},
	// 		status: {
	// 			required: true
	// 		},
	// 	},
	// 	messages: {
	// 		nama_lengkap: "Please specify your name",
	// 		provinsi: "Please input your province"

	// 	},
	// 	submitHandler: function () {

	// 	}
	// })

	// var inputTargets = [{
	// 	input: '#nama_lengkap',
	// 	target: '#button1'
	// }, {
	// 	input: '#email1',
	// 	target: '#button1'
	// },
	// {
	// 	input: '#no_handphone',
	// 	target: '#button1'
	// },
	// {
	// 	input: '#file_upload',
	// 	target: '#button1'
	// },
	// {
	// 	select: '#provinsi',
	// 	target: '#button2'
	// },
	// {
	// 	select: '#kota',
	// 	target: '#button2'
	// },
	// {
	// 	select: '#kecamatan',
	// 	target: '#button2'
	// },
	// {
	// 	select: '#kelurahan',
	// 	target: '#button2'
	// },
	// {
	// 	select: '#kode_pos',
	// 	target: '#button2'
	// },
	// {
	// 	select: '#alamat_lengkap',
	// 	target: '#button2'
	// },
	// {
	// 	trans: '#model_kendaraan',
	// 	target: '#button3'
	// },
	// {
	// 	trans: '#merk_kendaraan',
	// 	target: '#button3'
	// },
	// {
	// 	trans: '#tahun_kendaraan',
	// 	target: '#button3'
	// },
	// {
	// 	trans: '#status',
	// 	target: '#button3'
	// },
	// ];


	// inputTargets.forEach(function (v) {


	//     $(v.input).bind("input change", function (e) {

	//         if ($("#nama_lengkap, #email1, #no_handphone, #file_upload").valid()) {

	//             $("#button1").removeClass("disabled").addClass("done");
	//         } else {
	//             $("#button1").addClass("disabled");
	//         }

	//     });

	//     $(v.select).bind("change input", function () {
	//         if ($("#provinsi, #kota, #kecamatan, #kelurahan, #kode_pos, #alamat_lengkap").valid()) {
	//             $("#button2").removeClass("disabled");
	//         } else {
	//             $("#button2").addClass("disabled");
	//         }
	//     });

	//     $(v.trans).bind("change", function () {
	//         if ($("#merk_kendaraan, #model_kendaraan, #tahun_kendaraan, #status").valid()) {
	//             $("#button3").removeClass("disabled");
	//         } else {
	//             $("#button3").addClass("disabled");
	//         }
	//     });


	// })

	// $(".buttonnext").click(function () {
	//     $idnext = $(this).parent(".button-area").parent(".tab-pane").next(".tab-pane");
	//     $getidnext = $idnext.attr("id");


	//     $('a[href="#' + $getidnext + '"]').parent("li").removeClass("disabled");

	//     $id = $(this).parent(".button-area").parent(".tab-pane").next(".tab-pane");
	//     $getid = $id.attr("id");

	//     $('a[href="#' + $getid + '"]').click();

	// })

	// $(".buttonback").click(function () {
	//     $id = $(this).parent(".button-area").parent(".tab-pane").prev();
	//     $getid = $id.attr("id");

	//     $('a[href="#' + $getid + '"]').click();

	// })

	//Range Form,

	var bilangan = 10000000;

	var number_string = bilangan.toString(),
		sisa = number_string.length % 3,
		rupiah = number_string.substr(0, sisa),
		ribuan = number_string.substr(sisa).match(/\d{3}/g);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	// $value = $(".slider-handle").attr("aria-valuenow");

	// console.log($value);

	$("#ex6SliderVal").val(rupiah);

	$(".valuemin").text("Rp 10.000.000");

	$(".valuemax").text("Rp 60.000.000");


	// With JQuery

	$("#ex6SliderVal").on("keyup",function(){
		var thisval = $(this).val();
		thisval = thisval.replace(/\./g,"");
		$(this).parents(".sliderGroup").find(".customslide").slider('setValue',parseInt(thisval));
	});

	$(".sliderGroup .c-custom-select-trans").on("change",function(){
		var thisval = $(this).val();
		thisval = thisval.replace(".","");
		$(this).parents(".sliderGroup").find(".customslide").slider('setValue',parseInt(thisval));
	});

	if($(".customslide").length>0) {
		$(".customslide").slider();	
		$(".customslide").on('slide',function(evt){
				var _elm = $(this)
				var _parent = _elm.parents(".sliderGroup")
				var _ifMoney = _parent.find(".c-input-trans")
				var _ifMonth = _parent.find(".c-custom-select-trans")
				var _thisVal = evt.value

				if(_ifMoney.length>0) {
					var number_string = _thisVal.toString(),
						sisa = number_string.length % 3,
						rupiah = number_string.substr(0, sisa),
						ribuan = number_string.substr(sisa).match(/\d{3}/g);

					if (ribuan) {
						separator = sisa ? '.' : '';
						rupiah += separator + ribuan.join('.');
					}
					_ifMoney.val(rupiah)
				} else if(_ifMonth.length>0) {
					_ifMonth.val(parseInt(_thisVal))
					var customFormInstance = jcf.getInstance(_ifMonth);
					customFormInstance.refresh();
				}
			});
	}

	// $("#ex12").slider();


	$("#ex11").on("slide", function (slideEvt) {

		var bilangan = slideEvt.value;

		var number_string = bilangan.toString(),
			sisa = number_string.length % 3,
			rupiah = number_string.substr(0, sisa),
			ribuan = number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		$("#ex6SliderVal").val(rupiah);
	});


	// js by jaya

	$(".panel").on("show.bs.collapse hide.bs.collapse", function (e) {
		if (e.type == 'show') {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});

	jQuery.validator.addMethod("accept", function(value, element, param) {
		return value.match(new RegExp("." + param + "$"));
	},"Please Enter Only Letters");

	$.validator.addClassRules({

		formRequired: {
			required: true
		},

		formAlphabet: {
			accept: "[a-zA-Z]+"
		},

		formNumber: {
			required: true,
			number: true
		},

		formPhoneNumber: {
			required: true,
			number: true,
			maxlength: 12,
			minlength: 9
		},

		formKodePos: {
			required: true,
			number: true,
			maxlength: 5,
			minlength: 5
		},

		submitHandler: function (form) {
			form.submit();
		}
	});

	function validateFormRequired(elementParam) {
		$(elementParam).validate({
			errorPlacement: function (error, element) {
				console.log(element)
				element.closest('.form-group').find('.error-wrap').html(error);
			}
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
		$('#menu2').fadeIn();
	}

	function hideTab2() {
		$('#menu2').hide();
	}

	function showTab3() {
		$('#menu3').fadeIn();
	}

	function hideTab3() {
		$('#menu3').hide();
	}

	function showTab4() {
		$('#menu4').fadeIn();
	}

	function hideTab4() {
		$('#menu4').hide();
	}

	function showTab5() {
		$('#menu5').fadeIn();
	}

	function hideTab5() {
		$('#menu5').hide();
	}

	function showTab6() {
		$('#menu6').fadeIn();
	}

	function hideTab6() {
		$('#menu6').hide();
	}

	function pushDataPemohon() {
		var nama_lengkap = $('#nama_lengkap').val(),
			email_pemohon = $('#email_pemohon').val(),
			no_telepon = $('#no_handphone').val(),
			jenis_kredit = $('#jenis_form').val();


		credits.angunan.jenis_angunan = jenis_kredit;
		credits.pemohon.nama = nama_lengkap;
		credits.pemohon.email = email_pemohon;
		credits.pemohon.no_handphone = no_telepon;

	}

	function pushDataTempatTinggal() {
		var provinsi = $('#provinsi').val(),
			kota = $('#kota').val(),
			kecamatan = $('#kecamatan').val(),
			kelurahan = $('#kelurahan').val(),
			kode_pos = $('#kode_pos').val(),
			alamat = $('#alamat_lengkap').val();
		
		provinsi = $("#provinsi option[value='"+ provinsi +"']").text();
		kota = $("#kota option[value='"+ kota +"']").text();
		kecamatan = $("#kecamatan option[value='"+ kecamatan +"']").text();
		kelurahan = $("#kelurahan option[value='"+ kelurahan +"']").text();

		credits.tempat_tinggal.provinsi = provinsi;
		credits.tempat_tinggal.kota = kota;
		credits.tempat_tinggal.kecamatan = kecamatan;
		credits.tempat_tinggal.kelurahan = kelurahan;
		credits.tempat_tinggal.kode_pos = kode_pos;
		credits.tempat_tinggal.alamat = alamat;
	}

	function pushDataKendaraan() {
		var merk_kendaraan = $('#merk_kendaraan').val(),
			model_kendaraan = $('#model_kendaraan').val(),
			tahun_kendaraan = $('#tahun_kendaraan').val(),
			status_pemilik = $('#status_kep').val();


		credits.kendaraan.merk_kendaraan = merk_kendaraan;
		credits.kendaraan.model_kendaraan = model_kendaraan;
		credits.kendaraan.tahun_kendaraan = tahun_kendaraan;
		credits.kendaraan.status_pemilik = status_pemilik;
	}

	function pushDataBangunan() {
		if ($('#status_sertificate').length > 0) {
			var status_sertificate = $('#status_sertificate').val(),
				own_sertificate = $('#own_sertificate').val(),
				provinsi_sertificate = $('#provinsi_sertificate').val(),
				kota_sertificate = $('#kota_sertificate').val(),
				kecamatan_sertificate = $('#kecamatan_sertificate').val(),
				kelurahan_sertificate = $('#kelurahan_sertificate').val(),
				kode_pos_sertificate = $('#kode_pos_sertificate').val(),
				alamat_lengkap_sertificate = $('#alamat_lengkap_sertificate').val();


			provinsi_sertificate = $("#provinsi_sertificate option[value='"+ provinsi_sertificate +"']").text();
			kota_sertificate = $("#kota_sertificate option[value='"+ kota_sertificate +"']").text();
			kecamatan_sertificate = $("#kecamatan_sertificate option[value='"+ kecamatan_sertificate +"']").text();
			kelurahan_sertificate = $("#kelurahan_sertificate option[value='"+ kelurahan_sertificate +"']").text();


			credits.data_bangunan.status_sertifikat = status_sertificate;
			credits.data_bangunan.sertifikat_atas_nama = own_sertificate;
			credits.data_bangunan.provinsi = provinsi_sertificate;
			credits.data_bangunan.kota = kota_sertificate;
			credits.data_bangunan.kecamatan = kecamatan_sertificate;
			credits.data_bangunan.kelurahan = kelurahan_sertificate;
			credits.data_bangunan.kode_pos = kode_pos_sertificate;
			credits.data_bangunan.alamat = alamat_lengkap_sertificate;
		};
	}

	function setSummary() {
		// data tipe angunan
		$('#showAngunan').html(credits.angunan.jenis_angunan);

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

		// data merk kendaraan

		$('#showMerkKendaraan').html(credits.kendaraan.merk_kendaraan);
		$('#showModelKendaraan').html(credits.kendaraan.model_kendaraan);
		$('#showTahunKendaraan').html(credits.kendaraan.tahun_kendaraan);
		$('#showStatusPemilik').html(credits.kendaraan.status_pemilik);

		//data bangunan

		$('#showStatus_sertificate').html(credits.data_bangunan.status_sertifikat);
		$('#showOwn_sertificate').html(credits.data_bangunan.sertifikat_atas_nama);
		$('#showProvinsi_sertificate').html(credits.data_bangunan.provinsi);
		$('#showKota_sertificate').html(credits.data_bangunan.kota);
		$('#showKecamatan_sertificate').html(credits.data_bangunan.kecamatan);
		$('#showKelurahan_sertificate').html(credits.data_bangunan.kelurahan);
		$('#showKode_pos_sertificate').html(credits.data_bangunan.kode_pos);
		$('#showAlamat_lengkap_sertificate').html(credits.data_bangunan.alamat);

	}

	function stepAction() {
		$('.hidesavebutton').on('click', function (e) {
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
				$('.nav-item-4').removeClass('active');
				$('.nav-item-4').addClass('done');
				$('.nav-item-5').addClass('active');

				$(".cta-primary").removeClass("deactive");
				$(".hidesavebutton").removeClass("active");
				$(".button-area").removeClass("center");
				$(".text-head").children("h2[class='text-center']").css("display","block");
				$(".text-head").children("h2[class='text-center-edit']").css("display","none");

				pushDataPemohon();
				pushDataTempatTinggal();
				pushDataKendaraan();
				setSummary();
			}
		});

		$('.hidesavebuttonhome').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				showTab4();
				hideTab1();
				hideTab2();
				hideTab3();
				

				scrollToTop();
				$('.nav-item-1').removeClass('active');
				$('.nav-item-1').addClass('done');
				$('.nav-item-2').removeClass('active');
				$('.nav-item-2').addClass('done');
				$('.nav-item-3').removeClass('active');
				$('.nav-item-3').addClass('done');
				$('.nav-item-4').addClass('active');

				$(".cta-primary").removeClass("deactive");
				$(".hidesavebuttonhome").removeClass("active");
				$(".button-area").removeClass("center");
				$(".text-head").children("h2[class='text-center']").css("display","block");
				$(".text-head").children("h2[class='text-center-edit']").css("display","none");

				pushDataPemohon();
				pushDataTempatTinggal();
				pushDataBangunan();
				setSummary();
			}
		});

		$('#button1').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				hideTab1();
				showTab2();
				scrollToTop();
				$('.nav-item-1').removeClass('active');
				$('.nav-item-1').addClass('done');
				$('.nav-item-2').addClass('active');
				
				pushDataPemohon();

			}
		})

		$('#button2').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				showTab3();
				hideTab2();
				scrollToTop();
				$('.nav-item-2').removeClass('active');
				$('.nav-item-2').addClass('done');
				$('.nav-item-3').addClass('active');

				pushDataTempatTinggal();

			}
		})

		$('#button3').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				showTab4();
				hideTab3();
				scrollToTop();
				$('.nav-item-3').removeClass('active');
				$('.nav-item-3').addClass('done');
				$('.nav-item-4').addClass('active');

				pushDataKendaraan();
				getpriceminmax(credits);
			}
		})

		$('#button3rumah').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				showTab4();
				hideTab3();
				scrollToTop();
				$('.nav-item-3').removeClass('active');
				$('.nav-item-3').addClass('done');
				$('.nav-item-4').addClass('active');

				pushDataBangunan();
				setSummary();

			}
		})

		$('#button4').on('click', function (e) {
			e.preventDefault();

			if ($(this).closest('form').valid()) {
				showTab5();
				hideTab4();
				scrollToTop();
				$('.nav-item-4').removeClass('active');
				$('.nav-item-4').addClass('done');
				$('.nav-item-5').addClass('active');

				setSummary();
			}
		})

		$('#button4rumah').on('click', function (e) {
			e.preventDefault();

			showTab5();
			hideTab4();
			scrollToTop();

			$('.input-number:first-child').focus();
			$('.horizontal-scroll').hide();
			// $('#showPhone span').html(credits.pemohon.no_handphone);
			$("#otpPhone").val(credits.pemohon.no_handphone)
			countDown();
			requestOtp(credits);
			
		})

		$('#button5').on('click', function (e) {
			e.preventDefault();

			showTab6();
			hideTab5();
			scrollToTop();
			$('.input-number:first-child').focus();
			$('.horizontal-scroll').hide();
			// $('#showPhone span').html(credits.pemohon.no_handphone);
			$("#otpPhone").val(credits.pemohon.no_handphone)
			countDown();
			requestOtp(credits);

		})

		$('#button6').on('click', function (e) {
			e.preventDefault();

			sendOtp(credits);
			sendDataCredits(credits);

			console.log(objCredits);
		})

		$("#otpEditPhone").on("click", function(e){
			$("#otpPhone").prop('disabled', ! $("#otpPhone").prop('disabled'));
			$(".otp-number__phone").toggleClass("disabled")
		})
		$("#otpPhone").change(function(){
			$("#otpPhone").prop('disabled', ! $("#otpPhone").prop('disabled'));
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
			$('.nav-item-1').removeClass('done');
			$('.nav-item-1').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab1();

		})

		$('#buttonback3').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-3').removeClass('active');
			$('.nav-item-2').removeClass('done');
			$('.nav-item-2').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab2();
		})

		$('#buttonback4').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-4').removeClass('active');
			$('.nav-item-3').removeClass('done');
			$('.nav-item-3').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab3();
		})

		$('#buttonback5').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-5').removeClass('active');
			$('.nav-item-4').removeClass('done');
			$('.nav-item-4').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab4();
		})
	}

	function changeSumary() {
		$('#btnDataPemohon').on('click', function (e) {
			e.preventDefault();
			$(".cta-primary").addClass("deactive");

			if($(".hidesavebutton").length > 0){
				$(".hidesavebutton").addClass("active");	
			}else{
				$(".hidesavebuttonhome").addClass("active");
			}

			$(".button-area").addClass("center");

			$(".text-head").children("h2[class='text-center']").css("display","none");
			$(".text-head").children("h2[class='text-center-edit']").css("display","block");
			
			$('.nav-item-5').removeClass('active');
			$('.nav-item-1').removeClass('done');
			$('.nav-item-1').addClass('active');
			$('.tab-pane').fadeOut();
			showTab1();
		})

		$('#btnDataTempatTinggal').on('click', function (e) {
			e.preventDefault();
			$(".cta-primary").addClass("deactive");
			
			if($(".hidesavebutton").length > 0){
				$(".hidesavebutton").addClass("active");	
			}else{
				$(".hidesavebuttonhome").addClass("active");
			}

			$(".button-area").addClass("center");

			$(".text-head").children("h2[class='text-center']").css("display","none");
			$(".text-head").children("h2[class='text-center-edit']").css("display","block");

			$('.nav-item-5').removeClass('active');
			$('.nav-item-2').removeClass('done');
			$('.nav-item-2').addClass('active');
			$('.tab-pane').fadeOut();
			showTab2();
		})

		$('#btnDataKendaraan').on('click', function (e) {
			e.preventDefault();
			$(".cta-primary").addClass("deactive");
			$(".hidesavebutton").addClass("active");

			$(".button-area").addClass("center");

			$(".text-head").children("h2[class='text-center']").css("display","none");
			$(".text-head").children("h2[class='text-center-edit']").css("display","block");

			$('.nav-item-5').removeClass('active');
			$('.nav-item-3').removeClass('done');
			$('.nav-item-3').addClass('active');
			$('.tab-pane').fadeOut();
			showTab3();
		})

		$('#btnDataBangunan').on('click', function (e) {
			e.preventDefault();
			$(".cta-primary").addClass("deactive");
			$(".hidesavebuttonhome").addClass("active");

			$(".button-area").addClass("center");

			$(".text-head").children("h2[class='text-center']").css("display","none");
			$(".text-head").children("h2[class='text-center-edit']").css("display","block");

			$('.nav-item-4').removeClass('active');
			$('.nav-item-3').removeClass('done');
			$('.nav-item-3').addClass('active');
			$('.tab-pane').fadeOut();
			showTab3();
		})

		$('#btnJumlahPembiayaan').on('click', function (e) {
			e.preventDefault();
			$(".cta-primary").addClass("deactive");
			$(".hidesavebutton").addClass("active");

			$(".button-area").addClass("center");

			$(".text-head").children("h2[class='text-center']").css("display","none");
			$(".text-head").children("h2[class='text-center-edit']").css("display","block");

			$('.nav-item-5').removeClass('active');
			$('.nav-item-4').removeClass('done');
			$('.nav-item-4').addClass('active');
			$('.tab-pane').fadeOut();
			showTab4();
		})
	}

	function keyupOtpAction() {

		$('.input-number').keyup(function () {
			if ($(this).val() > 0) {
				$(this).next().focus();
			}

			else if ($(this).val() == 0) {
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
		}
		else {
			$(".file-upload").addClass('active');
			$("#noFile").text(filename.replace("C:\\fakepath\\", ""));
		}
	});



	if (isMobile) {
		$('.sect-step').slick({
			dots: false,
			prevArrow: false,
			nextArrow: false
		})

		$('ul.list-step').slick({
			dots: false,
			prevArrow: false,
			nextArrow: false
		});
	}

	function requestOtp(params) {

		//var _url = 'https://bfi.staging7.salt.id/otp/send-otp';
		var _url = '/otp/send-otp';

		var _data = {
			nama_lengkap: params.pemohon.nama,
			no_handphone: params.pemohon.no_handphone
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
				}

				else {
					//console.log(data)
				}
			}
		})
	}

	function sendOtp(params) {

		//var _url = 'https://bfi.staging7.salt.id/otp/validate-otp';
		var _url = '/otp/validate-otp';

		var otp1Value = $('input[name=otp1]').val(),
			otp2Value = $('input[name=otp2]').val(),
			otp3Value = $('input[name=otp3]').val(),
			otp4Value = $('input[name=otp4]').val();

		var _data = {
			no_handphone: params.pemohon.no_handphone,
			otp1: otp1Value,
			otp2: otp2Value,
			otp3: otp3Value,
			otp4: otp4Value
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
				console.log(data.success)
				if (data.success == 0) {
					$('#wrongOtp').modal('show');

				}
				else if(data.success == 1) {
					$('.tab-pane').fadeOut();
					showTab4();
				}
			}
		})
	}

	function sendDataCredits(params) {

		objCredits.nama_lengkap = params.pemohon.nama,
		objCredits.email = params.pemohon.email,
		objCredits.alamat_lengkap = params.tempat_tinggal.alamat,
		objCredits.no_handphone = params.pemohon.no_handphone,
		objCredits.kota = params.tempat_tinggal.kota,
		objCredits.kecamatan = params.tempat_tinggal.kecamatan,
		objCredits.kelurahan = params.tempat_tinggal.kelurahan,
		objCredits.model_kendaraan = params.kendaraan.model_kendaraan,
		objCredits.tahun_kendaraan = params.kendaraan.tahun_kendaraan,
		objCredits.funding = 98000000,
		objCredits.merk_kendaraan = params.kendaraan.merk_kendaraan,
		objCredits.jangka_waktu = 36,
		objCredits.installment = 3000000

		var _url = '';
		var type = $('#jenis_form').val().toLowerCase();

		if (type == 'bpkb mobil') {
			//_url = 'https://bfi.staging7.salt.id/credit/send-mobil';
			_url = '/credit/send-mobil';
		}

		else if (type == 'bpkb motor') {
			//_url = 'https://bfi.staging7.salt.id/credit/send-motor';
			_url = '/credit/send-motor';
		}

		else if (type = 'surat bangunan') {
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
				//console.log(data)
				// if (data.success == '0') {
				// 	$('#failedOtp').modal('show');
				// }

				// else if(data.success == '1') {
				// 	$('.tab-pane').hide();
				// 	$('#success').fadeIn();
				// }
			}
		})
	}

	function getProvinsi(element,element2) {

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/provinsi/listJson',
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idPrivince, valProvince) {
						if(valProvince.name != '') {
							var elementOption = '<option value="'+ valProvince.id +'">'+ valProvince.name +'</option>';

							$(element).append(elementOption);
							if(element2){
								$(element2).append(elementOption);	
							}
						}
					})
				}
			}
		})
	}
	
	$('#provinsi').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/city/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				console.log(dataObj)
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idCity, valCity) {
						if(valCity.name != '') {
							var elementOption = '<option value="'+ valCity.id +'">'+ valCity.name +'</option>';
							$('#kota').empty();
							$('#kota').next().find(".jcf-select-text").children("span").html("Pilih Kota");
							$('#kecamatan').empty();
							$('#kecamatan').next().find(".jcf-select-text").children("span").html("Pilih Kecamatan");
							$('#kelurahan').empty();
							$('#kelurahan').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							setTimeout(function() {
								$("#kota").append(elementOption);
							}, 50);
							
						}
					})
				}
			}
		})
	})

	$('#provinsi_sertificate').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/city/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				console.log(dataObj)
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idCity, valCity) {
						if(valCity.name != '') {
							var elementOption = '<option value="'+ valCity.id +'">'+ valCity.name +'</option>';
							$('#kota_sertificate').empty();
							$('#kota_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kota");
							$('#kecamatan_sertificate').empty();
							$('#kecamatan_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kecamatan");
							$('#kelurahan_sertificate').empty();
							$('#kelurahan_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							setTimeout(function() {
								$("#kota_sertificate").append(elementOption);
							}, 50);
							
						}
					})
				}
			}
		})
	})

	$('#kota').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/kecamatan/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idKec, valKec) {
						if(valKec.name != '') {
							
							var elementOption = '<option value="'+ valKec.id +'">'+ valKec.name +'</option>';

							$('#kecamatan').empty();
							$('#kecamatan').next().find(".jcf-select-text").children("span").html("Pilih Kecamatan");
							$('#kelurahan').empty();
							$('#kelurahan').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							
							setTimeout(function() {
								$("#kecamatan").append(elementOption);
							}, 50);
							
						}
					})
				}
			}
		})
	})

	$('#kota_sertificate').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/kecamatan/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idKec, valKec) {
						if(valKec.name != '') {
							
							var elementOption = '<option value="'+ valKec.id +'">'+ valKec.name +'</option>';

							$('#kecamatan_sertificate').empty();
							$('#kecamatan_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kecamatan");
							$('#kelurahan_sertificate').empty();
							$('#kelurahan_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							
							setTimeout(function() {
								$("#kecamatan_sertificate").append(elementOption);
							}, 50);
							
						}
					})
				}
			}
		})
	})

	$('#kecamatan').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/kelurahan/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idKel, valKel) {
						if(valKel.name != '') {
					
							var elementOption = '<option value="'+ valKel.id +'">'+ valKel.name +'</option>';
							$('#kelurahan').empty();
							$('#kelurahan').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							
							setTimeout(function() {
								$("#kelurahan").append(elementOption);
							}, 50)
							
						}
					})
				}
			}
		})
	})

	$('#kecamatan_sertificate').change(function() {

		var id = this.value;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/service/kelurahan/listJson?id='+id,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idKel, valKel) {
						if(valKel.name != '') {
					
							var elementOption = '<option value="'+ valKel.id +'">'+ valKel.name +'</option>';
							$('#kelurahan_sertificate').empty();
							$('#kelurahan_sertificate').next().find(".jcf-select-text").children("span").html("Pilih Kelurahan");
							
							setTimeout(function() {
								$("#kelurahan_sertificate").append(elementOption);
							}, 50)
							
						}
					})
				}
			}
		})
	})

	if($('#provinsi_sertificate').length > 0){
		getProvinsi($('#provinsi'),$('#provinsi_sertificate'));	
	}else{
		getProvinsi($('#provinsi'));	
	}

	//function get credit min max price dan asurasi list

	function separatordot(o){
		var bilangan = o;

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

	function getpriceminmax(params){
		var _url = 'https://bfi.staging7.salt.id/credit/get-price';

		var kota = params.tempat_tinggal.kota;

		kota = kota.slice(5,kota.length);

		var _data = {
			tipe: params.angunan.jenis_angunan,
			model_kendaraan: params.kendaraan.merk_kendaraan,
			merk_kendaraan: params.kendaraan.model_kendaraan,
			kota: kota,
			tahun: params.kendaraan.tahun_kendaraan
		}
		//alert(_data.tipe + "-" +_data.merk + "-" + _data.brand + "-" + _data.kota + "-" + _data.tahun);
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
				var rawMinPrice = parseInt(data.data.minPrice),
					rawMaxPrice = parseInt(data.data.maxPrice);

				// if($("#funding").length >0){
				// 	$("#funding").slider({min:rawMinPrice, max:rawMaxPrice, step:100000});	
				// }else{
				// 	$("#ex11").slider({min:rawMinPrice, max:rawMaxPrice, step:100000});	
				// }
				
				$("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.max = rawMaxPrice;
				$("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.min = rawMinPrice;
				$("#ex6SliderVal").parents(".sliderGroup").find(".customslide").data('slider').options.step = 100000; 

				$("#ex6SliderVal").parents(".sliderGroup").find(".customslide").slider('setValue',rawMinPrice);

				var minprice = separatordot(rawMinPrice),
					maxprice = separatordot(rawMaxPrice);

				$("#ex6SliderVal").val(minprice);
				$(".valuemin").text(minprice);
				$(".valuemax").text(maxprice);

				var opsiasuransi = "<option value='"+data.data.asuransi_1+"'>"+data.data.asuransi_1+"</option>"+
									"<option value='"+data.data.asuransi_2+"'>"+data.data.asuransi_2+"</option>";

				$(".c-custom-select-trans[name='status']").append(opsiasuransi);
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
				$.each(data, function (id, val) {
					var listing = val.data;

					$.each(listing, function (idListing, valListing) {
						if (valListing.latitude != "" || valListing.longitude != "") {

							marker = new google.maps.Marker({
								position: new google.maps.LatLng(valListing.latitude, valListing.longitude),
								map: map,
								icon: _marker
							});

							var contentString = '<div class="col-md-12 parent-brachlist" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
							contentString += '<div class="wrapper-branchlist">';
							contentString += '<div class="col-md-2 col-sm-2 col-xs-2 branchlist"><img class="icon-gedung-branchlist" src="/static/images/icon/branch1.png"></div>';
							contentString += '<div class="col-md-8 col-sm-8 col-xs-8 branchlist">';
							contentString += '<p class="title-branch margin-bottom-10">' + valListing.name + '</p>';
							contentString += '<p class="desc-branch">' + valListing.address + '</p>';
							contentString += '<a href="#" class="margin-top-20">PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></a>';
							contentString += '</div>';
							contentString += '</div>';
							contentString += '</div>';

							infowindow = new google.maps.InfoWindow({
								content: ''
							});


							google.maps.event.addListener(marker, 'click', (function (marker, i) {

								return function () {
									infowindow.setContent(contentString);
									infowindow.open(map, marker);
								}

							})(marker, i));


							markers.push(marker);

							searchBox.addListener('places_changed', function (event) {
								var place = searchBox.getPlaces();

								$.each(place, function (idPlace, valPlace) {

									var latComplete = valPlace.geometry.location.lat(),
										lngComplete = valPlace.geometry.location.lng();


									_radius = (13 * 500);
									latLngGoogle = new google.maps.LatLng(latComplete, lngComplete);
									var latLngAPI = new google.maps.LatLng(parseFloat(valListing.latitude), parseFloat(valListing.longitude));
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

										setTimeout(function () {
											$('#branch').empty();
										}, 10);

										setTimeout(function () {
											var html = '<div class="col-md-12 parent-brachlist" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
											html += '<div class="wrapper-branchlist">';
											html += '<div class="col-md-2 col-sm-2 col-xs-2 branchlist"><img class="icon-gedung-branchlist" src="/static/images/icon/branch1.png"></div>';
											html += '<div class="col-md-8 col-sm-8 col-xs-8 branchlist">';
											html += '<p class="title-branch margin-bottom-10">' + valListing.name + '</p>';
											html += '<p class="desc-branch">' + valListing.address + '</p>';
											html += '<a href="#" class="margin-top-20">PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></a>';
											html += '</div>';
											html += '<div class="col-md-2 branchlist"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
											html += '</div>';
											html += '</div>';

											$('.wrapper-parent-branchlist').addClass('active');
											$('#branch').append(html);

											if ($('.parent-brachlist').length > 2) {
												$('.wrapper-parent-branchlist').css('height', 300);
											}

											else {
												$('.wrapper-parent-branchlist').css('height', 'auto');
											}
										}, 100);

									}
									else {

										var html = '<div class="col-md-12 parent-brachlist" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
										html += '<div class="wrapper-branchlist">';
										html += '<p>Lokasi Tidak Ditemukan</p>';
										html += '</div>';
										html += '</div>';

										$('#branch').html(html);
										$('.wrapper-parent-branchlist').css('height', 'auto');
									}
								});
							})


						}
					})
				});
			}
		});

		$(document).on('click', '.parent-brachlist', function () {

			$(".parent-brachlist").css("background-color","white");
			var idMarker = $(this).data('id');
			google.maps.event.trigger(markers[parseInt(idMarker)], 'click');
			$(this).css("background-color","#F7F7F7");
		})
	}

	if ($('#map').length) {

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

		var autocomplete = new google.maps.places.Autocomplete(input, { types: ["geocode"] });

		autocomplete.bindTo('bounds', map);

		var base_url = '/branch/listJson';

		listingLocation(base_url);

	}

	function showPosition(position) {
	  	var lat = position.coords.latitude;
	  	var lng = position.coords.longitude;
	  	map.setCenter(new google.maps.LatLng(lat, lng));

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

			

			if(minutes == 00 && seconds == 00) {
				var reload = '<a href="#" class="countdown countdown--reload">Kirim Ulang</a>';
				$('.otp-number__text p span').html(reload);

				
			}
			else {
				$('.countdown').html(minutes + ":" + seconds);
			}

		}, 1000)

	}

	$(document).on('click', '.countdown--reload', function(e) {
		e.preventDefault();
		countDown();
		requestOtp(credits);
		$('.countdown').removeClass('countdown--reload');
	})

	$(".form-control").on('focus',function(){
		if($(this).attr("id") !== "ex6SliderVal"){
			$(this).prev().css("display","block");	
		}		
	});

	$(".form-control").on('focusout',function(){
		if($(this).val() == ""){
			$(this).prev().css("display","none");
		};
	});
	
	$(".jcf-select").click(function(){
		$(this).prev().prev().css("display","block");
	});

	$("#produk").hover(function() {
		$(".header-link-menu").addClass("active");	  
	});


	$("#produk").hover(
		  function() {
		    $(".header-link-menu").addClass("active");
		  }, function() {
		    $(".header-link-menu").removeClass("active");
		  }
	);


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
	
	

})(jQuery);