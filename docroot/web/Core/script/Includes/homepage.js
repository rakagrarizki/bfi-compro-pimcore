$(document).ready(function () {
    let btnSubmitFormCredit = $('.btn-submit-how-form-credit');
    let btnNext = $('.btn-next');
    let selFormCredit = $('#sel-how-form-credit');
    let selFormCreditCategory = $('#category-1');
    let selFormCreditNew = $('#category-2');
    let sel_placeholder = selFormCredit.attr('data-placeholder');

    selFormCredit.select2({
        placeholder: sel_placeholder,
        dropdownParent: selFormCredit.parent()
    });

    selFormCreditCategory.select2({
        placeholder: sel_placeholder,
        dropdownParent: selFormCredit.parent(),
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

    btnNext.click((e) => {
        var _url = '';
        var el = document.getElementById("category-2");
        var selectedText = el.options[el.selectedIndex].text;
        var lang = $('html').attr('lang');

        switch (true) {
            case selectedText.includes('Mobil'):
              _url = lang + '/credit/form-mobil';
              break;
            case selectedText.includes('Motor'):
              _url = lang +  '/credit/form-motor';
              break;
            case selectedText.includes('Rumah'):
              _url = lang +  '/credit/form-rumah';
              break;
            case selectedText.includes('Mesin'):
              _url = lang +  '/credit/form-mesin';
              break;
            case selectedText.includes('Pendidikan'):
                _url = lang +  '/credit/form-edu';
                break;
            case selectedText.includes('Travel'):
              _url = lang +  '/credit/form-travel';
              break;
            default: 
             _url = lang + '/credit';
            }
        e.preventDefault();
        if (_url!=='') {
            window.location.href = _url;
        }
    });
    getListCategory();
});

function hoverDropdown(){
    // $("body").css("background-color", "yellow");
    document.getElementById("overlay").classList.add("greyout");
}

function closeDropdown(){
    // $("body").css("background-color", "#fff");
    document.getElementById("overlay").classList.remove("greyout");
}

  function getListCategory() {
    dataListCat = [];
    var listcategory_placeholder = $('#category-1').attr('placeholder');
    $('#category-1').empty();
    
    
    $.ajax({
      type: 'GET',
      url: '/simulation/get-list-product-category',
      dataType: 'json',
      error: function (data) {
        console.log('error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        if (dataObj.message === 'Sukses') {
          $.each(dataObj.data, function ( key, valListCategory) {
            if (valListCategory.desc != '') {
              dataListCat.push({
                id: valListCategory.id,
                text: valListCategory.desc
              });
            }
          })
          $('#category-1').select2({
            minimumResultsForSearch: -1,
            placeholder: listcategory_placeholder,
            dropdownParent: $('#category-1').parent(),
            data: dataListCat
          });
          changeSelected($('#category-1')[0].value);
        }
      }
    })
  }
  function changeSelected(ids){
    var dataListPro = [];
    var id = ids;
    var params_getCategory = { "category_id": id }
    var listproduct_placeholder = $('#category-2').attr('placeholder');
    $('#category-2').empty();

    $.ajax({
      type: 'POST',
      url: '/simulation/get-product',
      data: params_getCategory,
      dataType: 'json',
      error: function (data) {
        console.log('[GET product]error' + data);
      },

      fail: function (xhr, textStatus, error) {
        console.log('request failed')
      },

      success: function (dataObj) {
        if (dataObj.message === 'Sukses') {
          $.each(dataObj.data, function ( key, valListProduct) {
            if (valListProduct.desc != '') {
              dataListPro.push({
                id: valListProduct.id,
                text: valListProduct.desc
              });
            }
          })
          $('#category-2').select2({
            minimumResultsForSearch: -1,
            placeholder: listproduct_placeholder,
            dropdownParent: $('#category-2').parent(),
            data: dataListPro
          });
        }
      }
    })
  }

  $('#category-1').change(function () {
    changeSelected(this.value);
  })




