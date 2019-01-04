$(document).ready(function () {
    let $btnSubmitFormCredit = $('.btn-submit-how-form-credit');
    let $selFormCredit = $('#sel-how-form-credit');

    $selFormCredit.change(() => {
        let selVal = $(this).val();
        if (selVal === 0)
            $btnSubmitFormCredit.attr("disabled", 'disabled');
        else
            $btnSubmitFormCredit.removeAttr("disabled");

    });

    $btnSubmitFormCredit.click((e) => {
        e.preventDefault();
        let redirectUrl = $selFormCredit.val();
        if (redirectUrl) {

            window.location.href = redirectUrl;
        }
    });
});