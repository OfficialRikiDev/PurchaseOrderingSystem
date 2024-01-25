var userDropDownVisible = false;

document.body.addEventListener("click", function (e) {
    if (e.target.id != "usermenu" && !e.target.classList.contains('ignore-body-click') && userDropDownVisible) {
        document.getElementById('usermenu').classList.add('invisible');
        userDropDownVisible = false;
    }
});


// javascript functionality to preview photo file upload

window.loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('photo');
        if (event.target.files[0].type.match('image.*')) {
            output.src = reader.result;
        } else {
            event.target.value = '';
            alert('please select a valid image');
        }
    };
    reader.readAsDataURL(event.target.files[0]);
};