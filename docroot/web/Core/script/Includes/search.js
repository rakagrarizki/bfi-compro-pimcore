var input = document.querySelector('input');
var id_input = document.getElementById('search-input');

input.addEventListener('input', updateValue);

function updateValue(e){
    if (id_input.value.length == 0){
        document.getElementById("button-search").src = "/static/images/icon/search.png";
        document.getElementById("search-off").id = "search-on";
        document.getElementById("search-result").textContent = "";
        document.getElementById("result-list").classList.add("hide");
    }
}

function search(btn_id){
    var input = document.getElementById("search-input").value;
    if (btn_id == "search-on" && input.length > 0 ){
        document.getElementById("button-search").src = "/static/images/icon/close.png";
        document.getElementById("search-on").id = "search-off";
        document.getElementById("search-result").textContent = "1234 hasil pencarian ditemukan";
        document.getElementById("result-list").classList.remove("hide");
    }
    else if (btn_id == "search-off") {
        document.getElementById("button-search").src = "/static/images/icon/search.png";
        document.getElementById("search-off").id = "search-on";
        document.getElementById("search-result").textContent = "";
        document.getElementById("search-input").value = "";
        document.getElementById("result-list").classList.add("hide");
    }
}