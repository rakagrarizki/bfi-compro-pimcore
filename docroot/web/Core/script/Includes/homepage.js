$(document).ready(function () {
    let btnSubmitFormCredit = $('.btn-submit-how-form-credit');
    let selFormCredit = $('#sel-how-form-credit');
    let sel_placeholder = selFormCredit.attr('data-placeholder');
    
    selFormCredit.select2({
        placeholder: sel_placeholder,
        dropdownParent: selFormCredit.parent()
    });

    selFormCredit.on('focus', function () {
        $(this).css({
            'padding-top' : '15px',
            'padding-bottom' : '15px'
        });
    });

    selFormCredit.change(() => {
        let selVal = $(this).val();
        if (selVal === 0)
            btnSubmitFormCredit.attr("disabled", 'disabled');
        else
            btnSubmitFormCredit.removeAttr("disabled");

    });

    btnSubmitFormCredit.click((e) => {
        e.preventDefault();
        let redirectUrl = selFormCredit.val();
        if (redirectUrl) {

            window.location.href = redirectUrl;
        }
    });
});

function hoverDropdown(){
    // $("body").css("background-color", "yellow");
    document.getElementById("overlay").classList.add("greyout");
}

function closeDropdown(){
    // $("body").css("background-color", "#fff");
    document.getElementById("overlay").classList.remove("greyout");
}