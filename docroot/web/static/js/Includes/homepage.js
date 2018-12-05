$(function () {
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

    $.validator.addClassRules({

        formRequired: {
            required: true
        },

        formNumber: {
            required: true,
            number: true
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

    function validateFormRequired(element) {
        $(element).validate({
            errorPlacement: function (error, element) {
                element.closest('.form-group').find('.error-wrap').html(error);
                setTimeout(function () {
                    $('label.error').addClass('show-error');
                }, 200);
            }
        });
    }

    validateFormRequired($('#getCredit'));

    function showTab1() {
        $('#menu1').fadeIn();
    }

    function hideTab1() {
        $('#menu1').fadeOut();
    }

    function showTab2() {
        $('#menu2').fadeIn();
    }

    function hideTab2() {
        $('#menu2').fadeOut();
    }

    function showTab3() {
        $('#menu3').fadeIn();
    }

    function hideTab3() {
        $('#menu3').fadeOut();
    }

    function showTab4() {
        $('#menu4').fadeIn();
    }

    function hideTab4() {
        $('#menu4').fadeOut();
    }

    function showTab5() {
        $('#menu5').fadeIn();
    }

    function hideTab5() {
        $('#menu5').fadeOut();
    }

    $('#button1').on('click', function (e) {
        e.preventDefault();

        if ($(this).closest('form').valid()) {
            showTab2();
            hideTab1();
            $('.nav-item-2').addClass('active');
        }
    })

    $('#button2').on('click', function (e) {
        e.preventDefault();

        if ($(this).closest('form').valid()) {
            showTab3();
            hideTab2();
            $('.nav-item-3').addClass('active');
        }
    })

    $('#button3').on('click', function (e) {
        e.preventDefault();

        if ($(this).closest('form').valid()) {
            showTab4();
            hideTab3();
            $('.nav-item-4').addClass('active');
        }
    })

    $('#button4').on('click', function (e) {
        e.preventDefault();

        if ($(this).closest('form').valid()) {
            showTab5();
            hideTab4();
            $('.nav-item-5').addClass('active');
        }
    })

    // click tab

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

    // click button back

    $('#buttonback2').on('click', function (e) {
        e.preventDefault();
        $('.tab-pane').fadeOut();
        showTab1();
    })

    $('#buttonback3').on('click', function (e) {
        e.preventDefault();
        $('.tab-pane').fadeOut();
        showTab2();
    })

    $('#buttonback4').on('click', function (e) {
        e.preventDefault();
        $('.tab-pane').fadeOut();
        showTab3();
    })

    $('#buttonback5').on('click', function (e) {
        e.preventDefault();
        $('.tab-pane').fadeOut();
        showTab4();
    })

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



    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $form = $(".form-get--credit");
    $successMsg = $(".alert");


    $form.validate({
        errorPlacement: function (error, element) {
            if (!error) {
                return true;
            }
        },
        onfocusout: false,
        onkeyup: false,
        rules: {
            nama_lengkap: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            no_handphone: {
                required: true,
                number: true
            },
            file_upload: {
                required: true,
                accept: "image/jpeg, pdf"
            },
            provinsi: {
                required: true
            },
            kota: {
                required: true
            },
            kecamatan: {
                required: true
            },
            kelurahan: {
                required: true
            },
            kode_pos: {
                required: true
            },
            alamat_lengkap: {
                required: true
            },
            merk_kendaraan: {
                required: true
            },
            model_kendaraan: {
                required: true
            },
            tahun_kendaraan: {
                required: true
            },
            status: {
                required: true
            },
        },
        messages: {
            nama_lengkap: "Please specify your name",
            provinsi: "Please input your province"

        },
        submitHandler: function () {

        }
    })

    var inputTargets = [{
        input: '#nama_lengkap',
        target: '#button1'
    }, {
        input: '#email1',
        target: '#button1'
    },
    {
        input: '#no_handphone',
        target: '#button1'
    },
    {
        input: '#file_upload',
        target: '#button1'
    },
    {
        select: '#provinsi',
        target: '#button2'
    },
    {
        select: '#kota',
        target: '#button2'
    },
    {
        select: '#kecamatan',
        target: '#button2'
    },
    {
        select: '#kelurahan',
        target: '#button2'
    },
    {
        select: '#kode_pos',
        target: '#button2'
    },
    {
        select: '#alamat_lengkap',
        target: '#button2'
    },
    {
        trans: '#model_kendaraan',
        target: '#button3'
    },
    {
        trans: '#merk_kendaraan',
        target: '#button3'
    },
    {
        trans: '#tahun_kendaraan',
        target: '#button3'
    },
    {
        trans: '#status',
        target: '#button3'
    },
    ];


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

    $("#ex11").slider();

    $("#ex12").slider();


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

    $(".panel").on("show.bs.collapse hide.bs.collapse", function (e) {
        if (e.type == 'show') {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });

    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    if (isMobile) {
        $('.sect-step').slick({
            dots: false,
            prevArrow: false,
            nextArrow: false
        })
    }

//listbranch map - Andry
 var locations = [
     ['Jakarta', -6.21462, 106.84513],
     ['Kebon Jeruk', -6.19257205, 106.76972549],
     ['Bogor', -6.5962986, 106.7972421],
     ['Gunung Sahari', -6.1611974, 106.84235412],
     ['Tangerang', -6.1825501, 106.4711093]
 ];

 var map = new google.maps.Map(document.getElementById('map'), {
     zoom: 10,
     center: new google.maps.LatLng(-6.21462, 106.84513)
 });

 var infowindow = new google.maps.InfoWindow();

 var marker, i, latLngGoogle, _radius;

 function listingLocationMarker(params){
    for (i = 0; i < params.length; i++) {
         marker = new google.maps.Marker({
             position: new google.maps.LatLng(params[i][1], params[i][2]),
             map: map
         });

         google.maps.event.addListener(marker, 'click', (function(marker, i) {
             return function() {
                 infowindow.setContent(params[i][0]);
                 infowindow.open(map, marker);
             }
         })(marker, i));
     }
 }

 listingLocationMarker(locations);

 //listbranch search autocomplete - Andry

var input = document.getElementById('searchTextField');

var cityCircle;
var autocomplete = new google.maps.places.Autocomplete(input, {types: ["geocode"]});

autocomplete.bindTo('bounds', map);

google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
    infowindow.close();
    var place = autocomplete.getPlace();

    if (!place.geometry) {
         // User entered the name of a Place that was not suggested and
         // pressed the Enter key, or the Place Details request failed.
         window.alert("No details available for input: '" + place.name + "'");
         return;
     }
    
     var latComplete = place.geometry.location.lat(),
         lngComplete = place.geometry.location.lng();

     var latLngComplete = new google.maps.LatLng(latComplete, lngComplete);

     latLngGoogle = new google.maps.LatLng(parseFloat(latComplete), parseFloat(lngComplete));
     _radius = (13 * 500);
     marker.setVisible(false);

     $.each(locations, function(id, value) {
        console.log(value)

         var latLngAPI = new google.maps.LatLng(parseFloat(value[1]), parseFloat(value[2]));

         var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(latLngGoogle, latLngAPI);

         if ((distance_from_location <= _radius)) {
             console.log('ada')
         }
         else {
            console.log('tidak ada');
         }

     })

     CircleOption = {
         strokeColor: '#0F2236',
         strokeOpacity: 0.5,
         strokeWeight: 2,
         fillColor: '#0F2236',
         fillOpacity: 0.15,
         map: map,
         radius: _radius,
         center: latLngGoogle
     };

    if (cityCircle) {
        cityCircle.setMap(null);
    }

    cityCircle = new google.maps.Circle(CircleOption);
     
     // If the place has a geometry, then present it on a map.
     if (place.geometry.viewport) {
         map.fitBounds(place.geometry.viewport);
     } else {
         map.setCenter(place.geometry.location);
         map.setZoom(20); // Why 17? Because it looks good.
     }

     var markerUser = new google.maps.Marker({
             position: place.geometry.location,
             map: map
         });
     //marker.setPosition(place.geometry.location);
     marker.setVisible(true);
 });



})
