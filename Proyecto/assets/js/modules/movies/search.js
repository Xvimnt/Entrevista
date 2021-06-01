function Search() {
    title = document.getElementById('title');
    if (title.value !== "") {
        /////////// POST /////////
        var http = new FormData();
        http.append("request", "search");
        http.append("title", title.value);
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
    } else {
        swal("Ups!", "Debe llenar los Campos Obligatorios", "warning");
    }
}

function Save() {
    swal({
        title: "\u00BFGuardar Pelicula?",
        text: "\u00BFEsta seguro de guardar esta pelicula en su repertorio?",
        icon: "warning",
        buttons: {
            cancel: "Cancelar",
            ok: { text: "Aceptar", value: true },
        }
    }).then((value) => {
        switch (value) {
            case true:
                imdb = document.getElementById('imdb');
                if (imdb.value !== "") {
                    /////////// POST /////////
                    var http = new FormData();
                    http.append("request", "save");
                    http.append("imdb", imdb.value);
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
                            swal("Excelente!", resultado.message, "success").then((value) => {
                                window.location.reload();
                            });
                        }
                    };
                } else {
                    swal("Ups!", "Debe llenar los Campos Obligatorios", "warning");
                }
                break;
            default:
                return;
        }
    });

}

function Delete() {
    swal({
        title: "\u00BFEliminar Pelicula?",
        text: "\u00BFEsta seguro de eliminar esta pelicula de su repertorio?, tendra que volver a agregarla luego...",
        icon: "warning",
        buttons: {
            cancel: "Cancelar",
            ok: { text: "Aceptar", value: true },
        }
    }).then((value) => {
        switch (value) {
            case true:
                imdb = document.getElementById('imdb');
                if (imdb.value !== "") {
                    /////////// POST /////////
                    var http = new FormData();
                    http.append("request", "delete");
                    http.append("imdb", imdb.value);
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
                            swal("Excelente!", resultado.message, "success").then((value) => {
                                window.location.reload();
                            });
                        }
                    };
                } else {
                    swal("Ups!", "Debe llenar los Campos Obligatorios", "warning");
                }
                break;
            default:
                return;
        }
    });
    
}