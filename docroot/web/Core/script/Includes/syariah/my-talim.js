const lang = document.documentElement.lang;

let applicantData = {
    name: "",
    phone: "",
    email: "",
};

$("#next1").on("click", function (e) {
    e.preventDefault();
    step("next", 1);
});

$("#next2").on("click", function (e) {
    e.preventDefault();
    step("next", 2);
});

$("#back1").on("click", function (e) {
    e.preventDefault();
    step("back", 1);
});
