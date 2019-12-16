var phone_label_element = document.getElementById("phone-label");
var default_phone_label = phone_label_element.textContent;

function changeLabel(ele_id) {
    if(ele_id == "phone-input"){
        phone_label_element.textContent = "NOMOR HANDPHONE";
    }
}

function deleteLabel(ele_id) {
    if (ele_id == "phone-input" && document.getElementById(ele_id).value.length > 0) {
        phone_label_element.classList.add("exist");
        document.getElementById(ele_id).classList.add("exist-input");
        return phone = document.getElementById(ele_id).value;
    }
    else {
        phone_label_element.classList.remove("exist");
        phone_label_element.textContent = default_phone_label;
    }
}

$('#otp-form').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
        }
        else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
			var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
            }
            else {
				if(parent.data('autosubmit')) {
					parent.submit();
				}
			}
		}
	});
});

function login() {
    $('#login').addClass("hide");
    $('#otp').removeClass("hide");
}