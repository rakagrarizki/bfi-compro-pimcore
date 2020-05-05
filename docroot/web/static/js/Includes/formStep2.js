var semester_count = 0;
var univ,nim,fak,prodi;

//// select2 semester ////
$(document).ready(function() {
    var semester_label_element = document.getElementById("semester-label");
    var default_semester_label = semester_label_element.textContent;
    var lang = document.documentElement.lang

    if (lang == 'id'){
        var placeholderText = 'Pilih Semester' 
    }else{
        var placeholderText = "Choose Semester"
    }

    $('.semester').select2({
        minimumResultsForSearch: Infinity,
        placeholder: placeholderText,
        allowClear: true
    });
    $('.semester').on('select2:open', function (e) {
        semester_label_element.textContent = "SEMESTER"
        semester_label_element.classList.add("exist");
    });
    $('.semester').on('select2:closing', function () {
        var selected_item = $(".semester option:selected").val();
        semester_count = parseInt(selected_item);
        if(selected_item.length > 0){
            $('.select2-selection__rendered').text(selected_item);
            $('.select2-selection').css({"padding-bottom": "5px"});
        }
        else{
            semester_label_element.classList.remove("exist");
            semester_label_element.textContent = default_semester_label;
        }

        return semester_count;
    });
});