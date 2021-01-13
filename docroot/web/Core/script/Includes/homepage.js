$(document).ready(function() {
    let btnSubmitFormCredit = $(".btn-submit-how-form-credit");
    let btnNext = $(".btn-next");
    let selFormCredit = $("#sel-how-form-credit");
    let selFormCreditCategory = $("#category-1");
    let sel_placeholder = selFormCredit.attr("data-placeholder");
  
    selFormCredit.select2({
        placeholder: sel_placeholder,
        dropdownParent: selFormCredit.parent()
    });
  
    selFormCreditCategory.select2({
        placeholder: sel_placeholder,
        dropdownParent: selFormCredit.parent()
    });
  
    selFormCredit.on("focus", function() {
        $(this).css({
            "padding-top": "15px",
            "padding-bottom": "15px"
        });
    });
  
    selFormCredit.change(() => {
        let selVal = $(this).val();
        if (selVal === 0) btnSubmitFormCredit.attr("disabled", "disabled");
        else btnSubmitFormCredit.removeAttr("disabled");
    });

    function lazyLoadBanner(banner){
        $(banner).on('afterChange',function(event,slick,currentSlide,nextSlide){
            temp = (currentSlide + 1)*2;
            
            imageslide = $(".lazy-slider");
                if(imageslide.length != 0){
                slideDesktop = imageslide[temp-2];
                slideMobile = imageslide[temp-1];

                $(slideDesktop).css("background-image","url("+slideDesktop.dataset.src+")");
                $(slideMobile).css("background-image","url("+slideMobile.dataset.src+")");
                
                if(currentSlide ==0){
                    imageslide.each(function(){
                        $(this).removeClass("lazy-slider");
                    });
                }
            } else {
                return null;
            }
        })
    }

    lazyLoadBanner("#herobanner");

    $(document).ready(function() {
  
    var lang = document.documentElement.lang;  
    if ( lang === 'id'){
      placeholderCat = 'Pilih jenis pembiayaan';
      placeholderProd = 'Pembiayaan apa yang dibutuhkan?';
     }else{
      placeholderCat = 'Choose the type of financing';
      placeholderProd = 'What funding is needed?';
     }
     
    $("#category-1").select2({
        placeholder: "Pilih jenis pembiayaan?",
        minimumResultsForSearch: -1
    });
  
    $("#category-2").select2({
        placeholder: placeholderProd,
        minimumResultsForSearch: -1,
        disabled: true
    });
  
    window.onload = function() {
        var lang = document.documentElement.lang;
        var options = { year: "numeric", month: "long", day: "numeric" };
        var date = new Date(
            $(".blog-promo")
                .find(".dateview > span.date")
                .html()
        );
        var blogDate = date.toLocaleDateString(lang + "-" + lang, options);
        $(".blog-promo")
            .find(".dateview > span.date")
            .text(blogDate);
    };
  });

    btnNext.click(e => {
        var _url = "";
        var el = document.getElementById("category-2");
        var selectedText = el.options[el.selectedIndex].text;
        var lang = $("html").attr("lang");
  
        switch (true) {
            case selectedText.includes("Mobil"):
                _url = lang + "/credit/form-mobil";
                break;
            case selectedText.includes("Motor"):
                _url = lang + "/credit/form-motor";
                break;
            case selectedText.includes("Rumah"):
                _url = lang + "/credit/form-rumah";
                break;
            case selectedText.includes("Mesin"):
                _url = lang + "/credit/form-mesin";
                break;
            case selectedText.includes("Pendidikan"):
                _url = lang + "/credit/form-edu";
                break;
            case selectedText.includes("Travel"):
                _url = lang + "/credit/form-travel";
                break;
            default:
                _url = lang + "/credit";
        }
        e.preventDefault();
        if (_url !== "") {
            window.location.href = _url;
        }
    });
  });
  
    var token = localStorage.getItem("token");
        if (token != null) {
        getDataStorage(token);
    }

    if(document.getElementById("pengajuan")){
        getListCategory();
    } 
  
  function getListCategory() {
    dataListCat = [];
    $("#category-1").empty();
    var lang = document.documentElement.lang;
      
     if ( lang === 'id'){
       placeholderCat = 'Pilih jenis pembiayaan';
      }else{
          placeholderCat = 'Choose the type of financing';
      }
  
    $.ajax({
        type: "GET",
        url: "/simulation/get-list-product-category",
        dataType: "json",
        error: function(data) {
            // console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            // console.log("request failed");
        },
  
        success: function(dataObj) {
      
          if (dataObj.message === "Sukses" && $("#category-1").length > 0) {
                $.each(dataObj.data, function(key, valListCategory) {
                    if (valListCategory.desc != "") {
                        dataListCat.push({
                            id: valListCategory.id,
                            text: valListCategory.desc
                        });
                    }
                });
                $("#category-1").select2({
                    dropdownParent: $("#category-1").parent(),
                    data: dataListCat
                });
    
                $("#category-1")
                    .prepend('<option selected=""></option>')
                    .select2({
                        placeholder: placeholderCat,
                        minimumResultsForSearch: -1
                    });
                    
                $("#category-1").on("hover", function() {
                    $(".select2-selection__rendered").removeAttr("title");
                });
                changeSelected($("#category-1").val()[0]);
                // $("#category-2").prop('disabled', true);
            }
        }
    });
  }
  function changeSelected(ids) {
    var dataListPro = [];
    var id = ids;
    var params_getCategory = { category_id: id };
    var lang = document.documentElement.lang;
    $("#category-2").empty();
      
    if ( lang === 'id'){
      placeholderProd = 'Pembiayaan apa yang dibutuhkan?';
     }else{
      placeholderProd = 'What funding is needed?';
     }
     
    $.ajax({
        type: "POST",
        url: "/simulation/get-product",
        data: params_getCategory,
        dataType: "json",
        error: function(data) {
            // console.log("[GET product]error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            // console.log("request failed");
        },
  
        success: function(dataObj) {
            if (dataObj.message === "Sukses") {
                $.each(dataObj.data, function(key, valListProduct) {
                    if (valListProduct.desc != "") {
                        dataListPro.push({
                            id: valListProduct.id,
                            text: valListProduct.desc
                        });
                    }
                });
                $("#category-2").select2({
                    dropdownParent: $("#category-2").parent(),
                    data: dataListPro
                });
                $("#category-2").on("change", function() {
                    $(".select2-selection__rendered").removeAttr("title");
                });
                $("#category-2")
                    .prepend('<option selected=""></option>')
                    .select2({
                        placeholder: placeholderProd,
                        minimumResultsForSearch: -1
                    });
                $("#category-2").removeAttr("disabled");
            }
        }
    });
  }
  
  $("#category-1").change(function() {
    changeSelected(this.value);
    // $("#category-2").removeAttr("disabled");
  });
  
  $("#selection-form").validate({
    errorClass: "help-block",
    errorElement: "div",
  
    errorPlacement: function(error, e) {
        e.parents(".selection-1").append(error);
    },
    highlight: function(e) {
        $(e)
            .closest(".selection-1")
            .removeClass("has-success has-error")
            .addClass("has-error");
        $(e)
            .closest(".help-block")
            .remove();
    },
    unhighlight: function(e) {
        if (jQuery(e).is("#category-1")) {
            setTimeout(function() {
                $(e)
                    .closest(".selection-1")
                    .removeClass("has-error");
            }, 50);
        }
    },
    success: function(e) {
        e.closest(".selection-1").removeClass("has-success has-error");
        e.closest(".help-block").remove();
    },
    rules: {
        select: { required: true }
    },
    messages: {
        select: { required: "" }
    }
  });
  
  $("#category-1").on("change", function() {
    $thisVal = $("#category-1").val();
    if ($thisVal != "") {
        setTimeout(function() {
            $("#selection-form")
                .validate()
                .element("#category-1");
        }, 100);
    }
  });
  
  function disabledFieldHome(elm, val){
    if (elm.length > 0 && val !== "" && val !== undefined && val !== null) {
      elm.val(val).prop("readonly", true);
    }
  }

  function getDataStorage(token) {
    // disabled = disabledField();
    $.ajax({
        type: "GET",
        url: "/user/data-customer",
        crossDomain: true,
        dataType: "json",
        headers: { sessionId: token },
  
        error: function(data) {
            // console.log("error" + data);
        },
  
        fail: function(xhr, textStatus, error) {
            // console.log("request failed");
        },
        success: function(dataObj) {
            if (dataObj.success === true) {
                var data = dataObj.result.data;
                disabledFieldHome($("#nama_lengkap"), data.full_name);
                disabledFieldHome($("#email_pemohon"), data.email);
                disabledFieldHome($("#no_handphone"), data.phone_number);
                enableButton("#button1");
                nextButton("active");
                $(".label-cekLogin").removeClass('hide');
            }
        }
    });
  }
  
  function enableButton(button) {
    $(button).css("background-color", "#F8991D");
    $(button).css("border-color", "#F8991D");
    $(button).removeAttr("disabled");
  }

  function nextButton(action) {
    var nextBtn = $(".actions > ul li a[href$='next']").parent();
    if (action === "inactive") {
        nextBtn.removeClass("inactive");
        nextBtn.addClass("active");
    } 
  }

    document.addEventListener("DOMContentLoaded", function() {
        var lazyloadImages = document.querySelectorAll("img.lazy");    
        var lazyloadBackground = document.querySelectorAll("div.lazy-slide");
        var lazyloadThrottleTimeout;
        
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
              rect.top >= 0 &&
              rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
            );
          }

        function lazyload () {
          if(lazyloadThrottleTimeout) {
            clearTimeout(lazyloadThrottleTimeout);
          }    
          
          lazyloadThrottleTimeout = setTimeout(function() {
              var scrollTop = window.pageYOffset;
              lazyloadImages.forEach(function(img) {
                  if(isElementInViewport(img)) {
                    img.src = img.dataset.src;
                    $(img).removeClass("lazy");
                  }
              });

              lazyloadBackground.forEach(function(div){
                if(isElementInViewport(div)) {
                    $(div).css("background-image","url("+div.dataset.src+")");
                    $(div).removeClass("lazy-slide");
                  }
            });
              if(lazyloadImages.length == 0) { 
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
              }
          }, 2);
        }
        
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
      });

      