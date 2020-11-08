function login()
{
    var  correo  = $("#correo").val();
    var contrasena = $("#contrasena").val();


        $.ajax({
            method:"GET",
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            url: "../models/sesion.php?op=validarIngreso",
            data: {"correo": correo, "contrasena": contrasena},
            success: function(dato) {     
                console.log("entro a la secion");

                if(dato != 'null')
                {
                    $(location).attr("href","asignacionBoleta.php");
                }
                else
                {
                    bootbox.alert("Usuario o contraseña incorrecta");
                }

            }
        });
}

function cerrarSesion()
{
        $.ajax({
            method:"GET",
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            url: "../models/sesion.php?op=cerrarSesion",
            data: {}
        });
}