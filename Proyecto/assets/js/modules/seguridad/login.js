function login() {
    nick = document.getElementById('nick');
    password = document.getElementById('password');
    if (nick.value !== "" && password.value !== "") {
        /////////// POST /////////
        var http = new FormData();
        http.append("request", "login");
        http.append("nick", nick.value);
        http.append("password", password.value);
        var request = new XMLHttpRequest();
        request.open("POST", "api.php");
        request.send(http);
        request.onreadystatechange = function () {
            // console.log( request );
            if (request.readyState != 4) return;
            if (request.status === 200) {
                resultado = JSON.parse(request.responseText);
                if (resultado.status !== true) {
                    // console.log(resultado.sql);
                    swal("Error", resultado.message, "error");
                    return;
                }
                //console.log( resultado );
                swal("Excelente!", resultado.message, "success").then((value) => {
                    window.location.href = "menu.php";
                });
            }
        };
    } else {
        swal("Ups!", "Debe llenar los Campos Obligatorios", "warning");
    }
}