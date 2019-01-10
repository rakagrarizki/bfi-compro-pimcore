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
	var _markerActive = '/static/images/icon/branch_active.png';
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
			"merk_kendaraan_text": "",
			"model_kendaraan": "",
			"model_kendaraan_text":"",
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
		funding: 0,
		merk_kendaraan: "",
		jangka_waktu: 0,
		installment: 0
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
	var post_val_inputan = 0;
	$("#ex6SliderVal").on("input",function(){
		var thisval = $(this).val(),
			pricelimit = $(this).parent().next().children(".valuemax").text();

		thisval = thisval.replace(/\./g,"");
		pricelimit = pricelimit.replace(/\./g,"");
		

		if(parseInt(thisval) <= parseInt(pricelimit) && !isNaN(thisval)){
			thisval = thisval;
		}else{
			thisval = post_val_inputan;
		}

		post_val_inputan = thisval;

		$(this).parents(".sliderGroup").find(".customslide").slider('setValue',parseInt(thisval));
			
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
		asuransi_arr=[],
		asuransi_arr_txt = [];

	function newoptionAsuransi(thisval,raw_select){
		$(".columnselect").remove();

		if($("#jenis_form").val() == "MOBIL"){
			var jumlah_loop = parseInt(thisval) / 12;	
		}else if($("#jenis_form").val() == "MOTOR"){
			var jumlah_loop = parseInt(thisval) / 6;
		}
		
		asuransi_arr=[];
		asuransi_arr_txt = [];
		
		for(var i=1; i<=jumlah_loop; i++){
			$(".form-group.inputsimulasi.asuransi").append(raw_select);
			$(".columnselect[ke=0]").attr("ke",i);
			$(".columnselect[ke="+i+"]").children().find("label").text("Tahun ke - "+i+"");
			asuransi_arr[asuransi_arr.length] = $(".columnselect .c-custom-select-trans").val();	
		}

		jcf.replaceAll();

		$.each($(".columnselect .c-custom-select-trans"), function(i,o){
			asuransi_arr_txt[asuransi_arr_txt.length] = $(o).next().children().children().text();
		})
			
		$(".columnselect .c-custom-select-trans").on("change",function(){
			var rowke = $(this).parents(".columnselect").attr("ke");
			asuransi_arr[rowke - 1] = $(this).val();
			asuransi_arr_txt[rowke - 1] = $(this).next().children().children().text();
		});
	};

	$(".sliderGroup .c-custom-select-trans").on("change",function(){
		var thisval = $(this).val();
		thisval = thisval.replace(".","");
		$(this).parents(".sliderGroup").find(".customslide").slider('setValue',parseInt(thisval));

		//andry
		newoptionAsuransi(thisval, raw_select);
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
					_ifMoney.val(rupiah);

					var _toInt = parseInt(_thisVal);
					_toInt = (_toInt>0?_toInt:0);
					objCredits.installment = _toInt;

				} else if(_ifMonth.length>0) {
					_ifMonth.val(parseInt(_thisVal))
					var customFormInstance = jcf.getInstance(_ifMonth);
					customFormInstance.refresh();

					newoptionAsuransi(_thisVal, raw_select);
					objCredits.jangka_waktu = parseInt(_thisVal);
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


		var merk_kendaraan_text = $("#merk_kendaraan option[value='"+ merk_kendaraan +"']").text(),
			model_kendaraan_text = $("#model_kendaraan option[value='"+ model_kendaraan +"']").text();


		credits.kendaraan.merk_kendaraan = merk_kendaraan;
		credits.kendaraan.merk_kendaraan_text = merk_kendaraan_text;
		credits.kendaraan.model_kendaraan = model_kendaraan;
		credits.kendaraan.model_kendaraan_text = model_kendaraan_text;
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

		$('#showMerkKendaraan').html(credits.kendaraan.merk_kendaraan_text);
		$('#showModelKendaraan').html(credits.kendaraan.model_kendaraan_text);
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

		//data pembiayaan
		if($(".tablebiaya").length > 0){
			var installment_set = separatordot(objCredits.installment),
			jangka_set = objCredits.jangka_waktu;

			installment_set = "Rp " + installment_set;
			jangka_set = jangka_set + " Bulan";

			$(".jml_biaya").html(installment_set);
			$(".jangka").html(jangka_set);
			$(".angsuran").html($(".total").text());

			if($(".tahun").length > 0){
				var start_delRow = 3;
				for(var i=start_delRow; i<=$(".tablebiaya tr").length - 1; i++){
					$(".tablebiaya tr:eq("+i+")").remove();
					i--;
				}
			}
			
	        for(var i=0; i<=asuransi_arr.length - 1; i++){
	        	//var txt_asuransi = $(".c-custom-select-trans.opsiasuransi option[value='"+ asuransi_arr[i] +"']").text();
	        	var html_sum_asuransi = "<tr>"+
		            					"<td>Asuransi Tahun ke-"+(i+1)+"</td>"+
		            					"<td class='tahun'>"+asuransi_arr_txt[i]+"</td>"+
		        						"</tr>";

		       	$(".tablebiaya").append(html_sum_asuransi);
	        }	
		}
	}

	function stepAction() {
		$("#button1").css("background-color","#dddddd");
		$("#button1").css("border-color","#dddddd");
		$("#button2").css("background-color","#dddddd");
		$("#button2").css("border-color","#dddddd");
		$("#button3").css("background-color","#dddddd");
		$("#button3").css("border-color","#dddddd");
		$("#button3rumah").css("background-color","#dddddd");
		$("#button3rumah").css("border-color","#dddddd");
		$("#kode_pos").css("background-color","#dddddd");
		$("#kode_pos_sertificate").css("background-color","#dddddd");

		if($("#pekerjaan").length == 0){
			$("#nama_lengkap").on('keyup',function(e){
				if($("#email_pemohon").val() == "" || $(this).val() == "" || $("#no_handphone").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});

			$("#email_pemohon").on('keyup',function(e){
				if($("#nama_lengkap").val() == "" || $(this).val() == "" || $("#no_handphone").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});

			$("#no_handphone").on('keyup',function(e){
				if($("#email_pemohon").val() == "" || $(this).val() == "" || $("#nama_lengkap").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});
		}else{
			$("#nama_lengkap").on('keyup',function(e){
				if($("#email_pemohon").val() == "" || $(this).val() == "" || $("#no_handphone").val() == "" || $("#pekerjaan").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});

			$("#email_pemohon").on('keyup',function(e){
				if($("#nama_lengkap").val() == "" || $(this).val() == "" || $("#no_handphone").val() == "" || $("#pekerjaan").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});

			$("#no_handphone").on('keyup',function(e){
				if($("#email_pemohon").val() == "" || $(this).val() == "" || $("#nama_lengkap").val() == "" || $("#pekerjaan").val() == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});

			$("#pekerjaan").on('change',function(e){
				if($("#email_pemohon").val() == "" || $(this).val() == "" || $("#nama_lengkap").val() == "" || $("#no_handphone") == ""){
					$("#button1").css("background-color","#dddddd");
					$("#button1").css("border-color","#dddddd");
				}else{
					$("#button1").css("background-color","#F8991D");
					$("#button1").css("border-color","#F8991D");
				}
			});
		}

		
		$("#kode_pos").on('keyup',function(e){
			if($("#alamat_lengkap").val() == "" || $(this).val() == "" || $("#provinsi").val() == null || $("#kota").val() == null || $("#kecamatan").val() == null || $("#kelurahan").val() == null){
				$("#button2").css("background-color","#dddddd");
				$("#button2").css("border-color","#dddddd");
			}else{
				$("#button2").css("background-color","#F8991D");
				$("#button2").css("border-color","#F8991D");
			}
		});

		$("#kode_pos_sertificate").on('keyup',function(e){
			if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kota_sertificate").val() == null || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null){
				$("#button3rumah").css("background-color","#dddddd");
				$("#button3rumah").css("border-color","#dddddd");
			}else{
				$("#button3rumah").css("background-color","#F8991D");
				$("#button3rumah").css("border-color","#F8991D");
			}
		});

		$("#alamat_lengkap").on('keyup',function(e){
			if($("#kode_pos").val() == "" || $(this).val() == "" || $("#provinsi").val() == null || $("#kota").val() == null || $("#kecamatan").val() == null || $("#kelurahan").val() == null){
				$("#button2").css("background-color","#dddddd");
				$("#button2").css("border-color","#dddddd");
			}else{
				$("#button2").css("background-color","#F8991D");
				$("#button2").css("border-color","#F8991D");
			}
		});

		$("#alamat_lengkap_sertificate").on('keyup',function(e){
			if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kota_sertificate").val() == null || $(this).val() == "" || $("#kode_pos_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null){
				$("#button3rumah").css("background-color","#dddddd");
				$("#button3rumah").css("border-color","#dddddd");
			}else{
				$("#button3rumah").css("background-color","#F8991D");
				$("#button3rumah").css("border-color","#F8991D");
			}
		});




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

				if(isMobile){
					$(".horizontal-scroll").scrollLeft(80);
				}

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

				if($("#merk_kendaraan").length > 0){
					getmobilormotor($("#merk_kendaraan"),credits);	
				}

				if(isMobile){
					$(".horizontal-scroll").scrollLeft(260);
				}
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
				// setTimeout(function() {
				// 	calculatePremi();
				// }, 1000);
				if(isMobile){
					$(".horizontal-scroll").scrollLeft(340);
				}
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

				if(isMobile){
					$(".horizontal-scroll").scrollLeft(340);
				}

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

				if(isMobile){
					$(".horizontal-scroll").scrollLeft(500);
				}
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

			// $('.tab-pane').hide();
			// $('#success').fadeIn();

			sendOtp(credits);
			sendDataCredits(credits);

			//console.log(objCredits);
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

			if(isMobile){
				$(".horizontal-scroll").scrollLeft(0);
			}

		})

		$('#buttonback3').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-3').removeClass('active');
			$('.nav-item-2').removeClass('done');
			$('.nav-item-2').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab2();

			if(isMobile){
				$(".horizontal-scroll").scrollLeft(80);
			}
			
		})

		$('#buttonback4').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-4').removeClass('active');
			$('.nav-item-3').removeClass('done');
			$('.nav-item-3').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab3();

			if(isMobile){
				$(".horizontal-scroll").scrollLeft(260);
			}
			
		})

		$('#buttonback5').on('click', function (e) {
			e.preventDefault();
			$('.nav-item-5').removeClass('active');
			$('.nav-item-4').removeClass('done');
			$('.nav-item-4').addClass('active');

			$('.tab-pane').fadeOut();
			scrollToTop();
			showTab4();

			if(isMobile){
				$(".horizontal-scroll").scrollLeft(340);
			}
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

		$('.input-number').on('keyup', function (e) {
			if ($(this).val() !== "") {
				$(this).next().focus();
			}

			else if ($(this).val() == "") {
				//$(this).prev().focus();
			}
			// if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			// 	return false;
			// }

			// if($(this).val() != ""){
			// 	$(this).next().focus();	
			// }

			if(e.which == 8){
				$(this).prev().focus();	
			}
						
		})

		$(".input-number").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});

		// $(".input-number").keydown(function (e) {
		// 	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		// 		return false;
		// 	}
		// 	$(this).val("");
		// 	// if(e.which == 37){
		// 	// 	$(this).prev().focus();	
		// 	// }else if(e.which == 39){
		// 	// 	$(this).next().focus();
		// 	// }
		// });
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
			nextArrow: false,
			infinite:false,
			slidesToShow:2.5
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
					//showTab4();
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

		if (type == 'mobil') {
			//_url = 'https://bfi.staging7.salt.id/credit/send-mobil';
			_url = '/credit/send-mobil';
		}

		else if (type == 'motor') {
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
				console.log(data)
				if (data.success == '0') {
					$('#failedOtp').modal('show');
				}

				else if(data.success == '1') {
					$('.tab-pane').hide();
					$('#success').fadeIn();
				}
			}
		})
	}


	function getmobilormotor(element, params){
		var post_code_attr = params.tempat_tinggal.kode_pos,
			tipe_attr = params.angunan.jenis_angunan;

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/brand/product/listJson?post_code='+post_code_attr+'&tipe='+tipe_attr,
			dataType: 'json',
			error: function (data) {
				console.log('error' + data);
			},

			fail: function (xhr, textStatus, error) {
				console.log('request failed')
			},

			success: function (dataObj) {
				if(dataObj.success == true) {
					$.each(dataObj.result.data, function(idMobilmotor, valMobilmotor) {
						if(valMobilmotor.name != '') {
							var elementOption = '<option value="'+ valMobilmotor.id +'">'+ valMobilmotor.name +'</option>';

							$(element).append(elementOption);
						}
					})
				}
			}
		})
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
					$.each(dataObj.result.data, function(idProvince, valProvince) {
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

	$('#kota').attr("disabled","disabled");
	$('#kota').next().css("background-color","#dddddd");
	$('#kota').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#kota_sertificate').attr("disabled","disabled");
	$('#kota_sertificate').next().css("background-color","#dddddd");
	$('#kota_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#kecamatan').attr("disabled","disabled");
	$('#kecamatan').next().css("background-color","#dddddd");
	$('#kecamatan').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#kecamatan_sertificate').attr("disabled","disabled");
	$('#kecamatan_sertificate').next().css("background-color","#dddddd");
	$('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#kelurahan').attr("disabled","disabled");
	$('#kelurahan').next().css("background-color","#dddddd");
	$('#kelurahan').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#kelurahan_sertificate').attr("disabled","disabled");
	$('#kelurahan_sertificate').next().css("background-color","#dddddd");
	$('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

	$('#model_kendaraan').attr("disabled","disabled");
	$('#model_kendaraan').next().css("background-color","#dddddd");
	$('#model_kendaraan').next().find(".jcf-select-opener").css("background-color","#dddddd");

	// $('#tahun_kendaraan').attr("disabled","disabled");
	// $('#tahun_kendaraan').next().css("background-color","#dddddd");
	// $('#tahun_kendaraan').next().find(".jcf-select-opener").css("background-color","#dddddd");

	// $('#status_kep').attr("disabled","disabled");
	// $('#status_kep').next().css("background-color","#dddddd");
	// $('#status_kep').next().find(".jcf-select-opener").css("background-color","#dddddd");


	
	$('#provinsi').change(function() {

		$("#kode_pos").val("");

		$('#kota').removeAttr("disabled");
		$('#kota').next().css("background-color","white");
		$('#kota').next().find(".jcf-select-opener").css("background-color","white");

		$('#kecamatan').attr("disabled","disabled");
		$('#kecamatan').next().css("background-color","#dddddd");
		$('#kecamatan').next().find(".jcf-select-opener").css("background-color","#dddddd");

		$('#kelurahan').attr("disabled","disabled");
		$('#kelurahan').next().css("background-color","#dddddd");
		$('#kelurahan').next().find(".jcf-select-opener").css("background-color","#dddddd");

		if($("#kode_pos").val() == "" || $(this).val() == null || $("#alamat_lengkap").val() == "" || $("#kota").val() == null || $("#kecamatan").val() == null || $("#kelurahan").val() == null){
			$("#button2").css("background-color","#dddddd");
			$("#button2").css("border-color","#dddddd");
		}else{
			$("#button2").css("background-color","#F8991D");
			$("#button2").css("border-color","#F8991D");
		}

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

		$("#kode_pos_sertificate").val("");

		$('#kota_sertificate').removeAttr("disabled");
		$('#kota_sertificate').next().css("background-color","white");
		$('#kota_sertificate').next().find(".jcf-select-opener").css("background-color","white");

		$('#kecamatan_sertificate').attr("disabled","disabled");
		$('#kecamatan_sertificate').next().css("background-color","#dddddd");
		$('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

		$('#kelurahan_sertificate').attr("disabled","disabled");
		$('#kelurahan_sertificate').next().css("background-color","#dddddd");
		$('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

		if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

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

		$("#kode_pos").val("");

		$('#kecamatan').removeAttr("disabled");
		$('#kecamatan').next().css("background-color","white");
		$('#kecamatan').next().find(".jcf-select-opener").css("background-color","white");

		$('#kelurahan').attr("disabled","disabled");
		$('#kelurahan').next().css("background-color","#dddddd");
		$('#kelurahan').next().find(".jcf-select-opener").css("background-color","#dddddd");

		if($("#kode_pos").val() == "" || $(this).val() == null || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == null || $("#kecamatan").val() == null || $("#kelurahan").val() == null){
			$("#button2").css("background-color","#dddddd");
			$("#button2").css("border-color","#dddddd");
		}else{
			$("#button2").css("background-color","#F8991D");
			$("#button2").css("border-color","#F8991D");
		}

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

		$("#kode_pos_sertificate").val("");

		$('#kecamatan_sertificate').removeAttr("disabled");
		$('#kecamatan_sertificate').next().css("background-color","white");
		$('#kecamatan_sertificate').next().find(".jcf-select-opener").css("background-color","white");

		$('#kelurahan_sertificate').attr("disabled","disabled");
		$('#kelurahan_sertificate').next().css("background-color","#dddddd");
		$('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color","#dddddd");

		if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#provinsi_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#kelurahan_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

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

		$("#kode_pos").val("");

		$('#kelurahan').removeAttr("disabled");
		$('#kelurahan').next().css("background-color","white");
		$('#kelurahan').next().find(".jcf-select-opener").css("background-color","white");

		if($("#kode_pos").val() == "" || $(this).val() == null || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == null || $("#kota").val() == null || $("#kelurahan").val() == null){
			$("#button2").css("background-color","#dddddd");
			$("#button2").css("border-color","#dddddd");
		}else{
			$("#button2").css("background-color","#F8991D");
			$("#button2").css("border-color","#F8991D");
		}

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
					
							var elementOption = '<option value="'+ valKel.id +'" postcode='+valKel.postcode+'>'+ valKel.name +'</option>';
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

		$("#kode_pos_sertificate").val("");

		$('#kelurahan_sertificate').removeAttr("disabled");
		$('#kelurahan_sertificate').next().css("background-color","white");
		$('#kelurahan_sertificate').next().find(".jcf-select-opener").css("background-color","white");

		if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#provinsi_sertificate").val() == null || $("#kelurahan_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

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
					
							var elementOption = '<option value="'+ valKel.id +'" postcode='+valKel.postcode+'>'+ valKel.name +'</option>';
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

	$('#kelurahan').change(function() {

		var postcodeGen = $(this).children("option[value='"+$(this).val()+"']").attr("postcode");
	
		if(postcodeGen !== 'null'){
			$("#kode_pos").val(postcodeGen);	
		}else{
			$("#kode_pos").val("");	
		}

		if($("#kode_pos").val() == "" || $(this).val() == null || $("#alamat_lengkap").val() == "" || $("#provinsi").val() == null || $("#kota").val() == null || $("#kecamatan").val() == null){
			$("#button2").css("background-color","#dddddd");
			$("#button2").css("border-color","#dddddd");
		}else{
			$("#button2").css("background-color","#F8991D");
			$("#button2").css("border-color","#F8991D");
		}

	})

	$('#kelurahan_sertificate').change(function() {

		var postcodeGen = $(this).children("option[value='"+$(this).val()+"']").attr("postcode");
	
		if(postcodeGen !== 'null'){
			$("#kode_pos_sertificate").val(postcodeGen);	
		}else{
			$("#kode_pos_sertificate").val("");	
		}

		if($("#status_sertificate").val() == "" || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == null || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

	})

	$('#status_sertificate').change(function() {

		if($("#kelurahan_sertificate").val() == null || $("#own_sertificate").val() == "" || $("#kode_pos_sertificate").val() == "" || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

	})

	$('#own_sertificate').change(function() {

		if($("#status_sertificate").val() == "" || $("#kelurahan_sertificate").val() == null || $("#kode_pos_sertificate").val() == "" || $(this).val() == "" || $("#alamat_lengkap_sertificate").val() == "" || $("#kota_sertificate").val() == null || $("#kecamatan_sertificate").val() == null || $("#provinsi_sertificate").val() == null){
			$("#button3rumah").css("background-color","#dddddd");
			$("#button3rumah").css("border-color","#dddddd");
		}else{
			$("#button3rumah").css("background-color","#F8991D");
			$("#button3rumah").css("border-color","#F8991D");
		}

	})

	if($('#provinsi_sertificate').length > 0){
		getProvinsi($('#provinsi'),$('#provinsi_sertificate'));	
	}else{
		getProvinsi($('#provinsi'));	
	}

	$('#merk_kendaraan').change(function() {
		$('#model_kendaraan').removeAttr("disabled");
		$('#model_kendaraan').next().css("background-color","white");
		$('#model_kendaraan').next().find(".jcf-select-opener").css("background-color","white");

		if($("#model_kendaraan").val() == "" || $(this).val() == "" || $("#tahun_kendaraan").val() == "" || $("#status_kep").val() == ""){
			$("#button3").css("background-color","#dddddd");
			$("#button3").css("border-color","#dddddd");
		}else{
			$("#button3").css("background-color","#F8991D");
			$("#button3").css("border-color","#F8991D");
		}


		//var id = this.value;
		var post_code_attr = credits.tempat_tinggal.kode_pos,
			tipe_attr = credits.angunan.jenis_angunan,
			brand_attr = $(this).next().children().children().text();

		$.ajax({
			type: 'GET',
			url: 'https://bfi.staging7.salt.id/brand/detail/product/listJson?post_code='+post_code_attr+'&tipe='+tipe_attr+'&brand='+brand_attr,
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
					$.each(dataObj.result.data, function(idKendaraan, valKendaraan) {
						if(valKendaraan.name != '') {
							var elementOption = '<option value="'+ valKendaraan.codeProduct +'">'+ valKendaraan.name +'</option>';
							$('#model_kendaraan').empty();
							$('#model_kendaraan').next().find(".jcf-select-text").children("span").html("Pilih Model Kendaraan");
							setTimeout(function() {
								$("#model_kendaraan").append(elementOption);
							}, 50);	
						}
					})
				}
			}
		})
	});

	$('#model_kendaraan').change(function() {
		// $('#tahun_kendaraan').removeAttr("disabled");
		// $('#tahun_kendaraan').next().css("background-color","white");
		// $('#tahun_kendaraan').next().find(".jcf-select-opener").css("background-color","white");

		if($("#merk_kendaraan").val() == "" || $(this).val() == "" || $("#tahun_kendaraan").val() == "" || $("#status_kep").val() == ""){
			$("#button3").css("background-color","#dddddd");
			$("#button3").css("border-color","#dddddd");
		}else{
			$("#button3").css("background-color","#F8991D");
			$("#button3").css("border-color","#F8991D");
		}
	});

	$('#tahun_kendaraan').change(function() {
		// $('#status_kep').removeAttr("disabled");
		// $('#status_kep').next().css("background-color","white");
		// $('#status_kep').next().find(".jcf-select-opener").css("background-color","white");

		if($("#model_kendaraan").val() == "" || $(this).val() == "" || $("#merk_kendaraan").val() == "" || $("#status_kep").val() == ""){
			$("#button3").css("background-color","#dddddd");
			$("#button3").css("border-color","#dddddd");
		}else{
			$("#button3").css("background-color","#F8991D");
			$("#button3").css("border-color","#F8991D");
		}
	});

	$('#status_kep').change(function() {
		if($("#model_kendaraan").val() == "" || $(this).val() == "" || $("#tahun_kendaraan").val() == "" || $("#merk_kendaraan").val() == ""){
			$("#button3").css("background-color","#dddddd");
			$("#button3").css("border-color","#dddddd");
		}else{
			$("#button3").css("background-color","#F8991D");
			$("#button3").css("border-color","#F8991D");
		}
	});
	
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

		//var kota = params.tempat_tinggal.kota;

		//kota = kota.slice(5,kota.length);

		var _data = {
			tipe: params.angunan.jenis_angunan,
			model_kendaraan: params.kendaraan.model_kendaraan,
			merk_kendaraan: params.kendaraan.merk_kendaraan_text,
			post_code: params.tempat_tinggal.kode_pos,
			tahun: params.kendaraan.tahun_kendaraan
		}
		//alert(_data.tipe + "-" +_data.model_kendaraan + "-" + _data.merk_kendaraan + "-" + _data.post_code + "-" + _data.tahun);
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

				//console.log(data);

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


				// var opsiasuransi = "<option value='"+data.data.asuransi_1+"'>"+data.data.asuransi_1+"</option>"+
				// 					"<option value='"+data.data.asuransi_2+"'>"+data.data.asuransi_2+"</option>";

				var opsiasuransi = ""
				$.each(data.data.asuransi, function(idx,opt) { 
					opsiasuransi += "<option value='"+opt.code+"'>"+opt.name+"</option>"
				})

				// console.log("GGGG", data.data, opsiasuransi)

				raw_select = '<div class="columnselect" ke="0">'+
                                                    '<div class="list-select">'+
                                                        '<label>Tahun ke - 1</label>'+
                                                    '</div>'+
                                                    '<div class="list-select">'+
                                                        '<select class="c-custom-select-trans formRequired opsiasuransi" data-jcf={"wrapNative": '+false+', "wrapNativeOnMobile": '+false+', "fakeDropInBody": '+false+', "useCustomScroll": '+false+'}'+
                                                                'name="status">'+opsiasuransi+'</select>'+
                                                    '</div>'+
                                                    '<div class="error-wrap"></div>'+
                                                '</div>';

                newoptionAsuransi(12, raw_select);

                objCredits.installment = rawMinPrice;
                objCredits.jangka_waktu = 12;

                post_val_inputan = rawMinPrice;
				// $(".opsiasuransi").append(opsiasuransi);
				// $(".opsiasuransi").val(data.data.asuransi_1);
				// $(".opsiasuransi").next().children().children().text(data.data.asuransi_1);

				//raw_select = "<select class='opsiasuransi'>"+opsiasuransi+"</select>";
				//clone_asuransi = $(".columnselect").clone(true);
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

							if(valListing.gerai){
								var icondynamic = "/static/images/icon/gerai.png";	
							}else{
								var icondynamic = "/static/images/icon/branch1.png";
							}

							var contentString = '<div class="col-md-12 parent-brachlist linkgoogle infowindow" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
							contentString += '<div class="wrapper-branchlist">';
							contentString += '<div class="col-md-2 col-sm-4 col-xs-4 branchlist"><img class="icon-gedung-branchlist" src="'+icondynamic+'"></div>';
							contentString += '<div class="col-md-10 col-sm-8 col-xs-8 branchlist">';
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
									$.each(markers,function(i,o){
										markers[i].setIcon(_marker);
									});
									marker.setIcon(_markerActive);
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

										if(valListing.gerai){
											var icondynamic = "/static/images/icon/gerai.png";	
										}else{
											var icondynamic = "/static/images/icon/branch1.png";
										}
										 
										$('#branch').removeClass("deactive");
										$(".map-wrapper").addClass("active");
										setTimeout(function () {
											$('#branch').empty();
										}, 10);

										setTimeout(function () {
											var html = '<div class="col-md-12 parent-brachlist notlinkgoogle" data-id="' + idListing + '" data-lat="' + valListing.latitude + '"  data-lng="' + valListing.longitude + '">';
											html += '<div class="wrapper-branchlist">';
											html += '<div class="col-md-2 col-sm-2 col-xs-2 branchlist"><img class="icon-gedung-branchlist" src="'+icondynamic+'"></div>';
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

							google.maps.event.addListener(infowindow, 'domready', function() {
								if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 									$(".gm-style-iw").parent().parent().parent().css("top",100+"%");
									$(".gm-style-iw").children().css("display","table");
								}
							});
						}
					})
				});
			}
		});

		$(document).on('click', '.notlinkgoogle', function () {

			$(".parent-brachlist").css("background-color","white");
			var idMarker = $(this).data('id');
			
			google.maps.event.trigger(markers[parseInt(idMarker)], 'click');
			
			$(this).css("background-color","#F7F7F7");

			setTimeout(function () {
				$('#branch').addClass("deactive");
			}, 10);

			$(".map-wrapper").removeClass("active");
			
		})
	}

	$(document).on('click', '.linkgoogle', function () {

			var tembaklat = $(this).data('lat'),
				tembaklng = $(this).data('lng');

			navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
			              lat: position.coords.latitude,
			              lng: position.coords.longitude
	            	};
	            	
	            	var urlgoogle = "https://www.google.com/maps/dir/?api=1&origin="+pos.lat+","+pos.lng+"&destination="+tembaklat+","+tembaklng+"";
	            	window.open(urlgoogle,'_blank');
				})
	});


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

		var base_url = 'https://bfi.staging7.salt.id/branch/listJson';

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

	function calculatePremi() {
		var _url = 'https://bfi.staging7.salt.id/credit/get-loan';
		var _param = {
			tipe: credits.angunan.jenis_angunan,
			model_kendaraan: credits.kendaraan.model_kendaraan,
			merk_kendaraan: credits.kendaraan.merk_kendaraan_text,
			tahun: credits.kendaraan.tahun_kendaraan,
			post_code: credits.tempat_tinggal.kode_pos,
			funding: objCredits.funding,
			tenor: objCredits.jangka_waktu,
			asuransi: asuransi_arr.join("-"),
			taksasi: objCredits.installment
		}
		console.log(_param);
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

				console.log("Calculator Result", data)

				var angsuranFinal = data.data.angsuranFinal, 
					angsuranFinal_txt = separatordot(angsuranFinal),
					insuranceCarTot = data.data.insuranceCarTotal,
					insuranceCarTot_txt = separatordot(insuranceCarTot);

				var totalbiaya = parseInt(angsuranFinal) * parseInt(_param.tenor) - parseInt(insuranceCarTot),
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

	$("#ex6SliderVal").change(function(){
		console.log(parseInt($(this).val()))
		var _val = $(this).val()
		var _reform = _val.replace(/[.]/g,"")
		var _toInt = parseInt(_reform)
		_toInt = (_toInt>0?_toInt:0)
		objCredits.installment = _toInt
	})

	$("#jangka_waktu").change(function(){
		objCredits.jangka_waktu = $(this).val()
	})

	$(document).on('click', '#recalc', function(e) {
		e.preventDefault();
		$(this).text("HITUNG ULANG");
		calculatePremi();
	})

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

	// $("#produk").hover(function() {
	// 	$(".header-link-menu").addClass("active");	  
	// });


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