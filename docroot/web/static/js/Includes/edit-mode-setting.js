$(".pimcore_area_editmode").on("mouseenter", function () {
    
    let edit_window_width = $(this).closest(".x-window").width() - 60;

    $(this).css("width", edit_window_width);
    
    // adjust the content inside editable to fit inside editor frame
    $(this).find(".pimcore_editable").css({
        "width": "100%",
        "height": "100%",
    });
})