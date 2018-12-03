$(function(){
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

    
    var customSelect = $('.c-custom-select');
  
    // Options for custom Select
    jcf.setOptions('Select', {
      wrapNative: false,
      wrapNativeOnMobile: false,
      fakeDropInBody: false,
      maxVisibleItems: 5
    });
    
    jcf.replace(customSelect);

    // $(".header-link-menu>a").sibling("produk")

    // $(".produk-hover").mouseleave(function(){
    //     $(".produk-hover").css("display","none");
    // })
    
})