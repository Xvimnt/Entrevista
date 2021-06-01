function Favorites() {
    /////////// POST /////////
    var http = new FormData();
    http.append("request", "favorites");
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
            console.log(resultado);
            document.getElementById("result").innerHTML = resultado.data;
        }
    };

}
