  
var table;


function listarBoletasDisponibles()
{

    table = $('#tblistado')
        .dataTable(
            {
                "ajax":{
                    url: '../models/consultas.php?op=boletasDisponibles',
                    data:{},
                    type: "get",
                    dataType:"json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                }                         
            })
        .DataTable();

}



function registarComprador()
{
    var cedula = $("#cc").val();
    var Nombre = $("#Nombre").val();
    var FechaNacimiento = $("#FechaNacimiento").val();
    var Direccion = $("#Direccion").val();
    var tipoCliente = $("#tipoCliente").val();
    var estado = $("#estado").val();
    var correo = $("#correo").val();
    var contrasena = $("#contrasena").val();
    
    $.ajax({
        url: "../models/consultas.php?op=agregarComprador",
        method: "GET",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data:{'cedula': cedula,'Nombre': Nombre,'FechaNacimiento': FechaNacimiento,'Direccion': Direccion,'tipoCliente': tipoCliente,'estado': estado,'correo': correo,'contrasena': contrasena},
        error: function(error)
        {
            console.log("error: " + error);
        }       
    });
}

function listarCompradores()
{

    table = $('#tblistadoCompradores')
        .dataTable(
            {
                "ajax":{
                    url: '../models/consultas.php?op=listarCompradores',
                    data:{},
                    type: "get",
                    dataType:"json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                } ,
                
				"columns":[
					{"data":"cc"},
                    {"data":"nombre"},
                    {"data":"direccion"},
                    {"data":"tipoCliente"},
                    {"data":"estado"},
                    {"data":"correo"},
					{"defaultContent": "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i>Editar</button>	<button type='button' class='estadoActivo btn btn-primary'><i class='fa fa-pencil-square-o'></i>Activar</button> <button type='button' class='estadoInactivo btn btn-primary'><i class='fa fa-pencil-square-o'></i>Inactivar</button> <button type='button' class='eliminar btn btn-primary'><i class='fa fa-pencil-square-o'></i>Eliminar</button>"	}	
                ]
                         
            })
        .DataTable();
        data_compradores_editar("#tblistadoCompradores tbody", table);
        data_idcomprador_eliminar("#tblistadoCompradores tbody", table);
        data_idcomprador_estadoActivo("#tblistadoCompradores tbody", table);
        data_idcomprador_estadoInactivo("#tblistadoCompradores tbody", table);
}


var data_compradores_editar = function(tbody, table){
    $(tbody).on("click", "button.editar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var cc = $("#cc").val( data.cc ),
            nombre = $("#nombre").val( data.nombre ),
            direccion = $("#direccion").val( data.direccion ),
            tipoCliente = $("#tipoCliente").val( data.tipoCliente ),
            estado = $("#estado").val( data.estado ),
            correo = $("#correo").val( data.correo )
          
        console.log(data)
    });
}
var data_idcomprador_eliminar = function(tbody, table){
    $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        $.ajax({
            method:"GET",
            url: "../models/consultas.php?op=eliminarComprador",
            data: {"cc":  data.cc}
        });
    });
}
var data_idcomprador_estadoActivo = function(tbody, table){
    $(tbody).on("click", "button.estadoActivo", function(){
        var data = table.row( $(this).parents("tr") ).data();
        $.ajax({
            method:"GET",
            url: "../models/consultas.php?op=estadoComprador",
            data: {"cc":  data.cc,"estado":"activo"}
        });
    });
}
var data_idcomprador_estadoInactivo = function(tbody, table){
    $(tbody).on("click", "button.estadoInactivo", function(){
        var data = table.row( $(this).parents("tr") ).data();
        $.ajax({
            method:"GET",
            url: "../models/consultas.php?op=estadoComprador",
            data: {"cc":  data.cc,"estado":"inactivo"}
        });
    });
}

function editarComprador()
{
    var cedula = $("#cc").val();
    var Nombre = $("#nombre").val();
    var FechaNacimiento = $("#fechaNacimiento").val();
    var Direccion = $("#direccion").val();
    var tipoCliente = $("#tipoCliente").val();
    var estado = $("#estado").val();
    var correo = $("#correo").val();
    var contrasena = $("#contrasena").val();
    
    $.ajax({
        url: "../models/consultas.php?op=editarComprador",
        method: "GET",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data:{'cedula': cedula,'Nombre': Nombre,'FechaNacimiento': FechaNacimiento,'Direccion': Direccion,'tipoCliente': tipoCliente,'estado': estado,'correo': correo,'contrasena': contrasena},
        error: function(error)
        {
            console.log("error: " + error);
        }       
    });
}

function listarCompradoresBoletas()
{

    table = $('#tblistadoCompradoresBoletas')
        .dataTable(
            {
                "ajax":{
                    url: '../models/consultas.php?op=listarCompradoresBoletas',
                    data:{},
                    type: "get",
                    dataType:"json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                } ,
                
				"columns":[
					{"data":"cc"},
                    {"data":"nombre"},
                    {"data":"idBoleta"},
                    {"data":"numBoleta"},
                    {"data":"estado"},
                    {"data":"idCompraDetalle"},
					{"defaultContent": "<button type='button' class='cancelar btn btn-primary'><i class='fa fa-pencil-square-o'></i>Cancelar Reserva</button>"	}	
                ]
                         
            })
        .DataTable();
        data_boleta_cancelar("#tblistadoCompradoresBoletas tbody", table);
}
var data_boleta_cancelar = function(tbody, table){
    $(tbody).on("click", "button.cancelar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        $.ajax({
            method:"GET",
            url: "../models/consultas.php?op=cancelarBoleta",
            data: {"idBoleta":  data.idBoleta,"estado":"Disponible"}
        });
    });
}

function listarCompradoresAsignacionBoletos()
{

    table = $('#tblistadoCompradoresAsignacionBoletos')
        .dataTable(
            {
                "ajax":{
                    url: '../models/consultas.php?op=listarCompradores',
                    data:{},
                    type: "get",
                    dataType:"json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                } ,
                
				"columns":[
					{"data":"cc"},
                    {"data":"nombre"},                   
                    {"data":"correo"},
					{"defaultContent": "<button type='button' class='seleccionar btn btn-primary'><i class='fa fa-pencil-square-o'></i>Seleccionar</button>	"	}	
                ]
                         
            })
        .DataTable();
       data_compradores_asignacion_boleto("#tblistadoCompradoresAsignacionBoletos tbody", table);

}

var data_compradores_asignacion_boleto = function(tbody, table){
    $(tbody).on("click", "button.seleccionar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var cc = $("#cc").val( data.cc );
        console.log(data)
    });
}

function listarBoletasDisponiblesCiudad()
{

    table = $('#tblistadoBoletosDisponibles')
        .dataTable(
            {
                "ajax":{
                    url: '../models/consultas.php?op=listarBoletasDisponiblesCiudad',
                    data:{},
                    type: "get",
                    dataType:"json",
                    error: function(e) {
                        console.log(e.responseText);
                    }
                },
                                
				"columns":[
					{"data":"nombre"},
                    {"data":"numBoleta"},      
                    {"data":"idBoleta"},               
					{"defaultContent": "<button type='button' class='seleccionar btn btn-primary'><i class='fa fa-pencil-square-o'></i>Seleccionar</button>	"	}	
                ]                         
            })
        .DataTable();
        data_boleto_disponible_ciudad("#tblistadoBoletosDisponibles tbody", table);
}

var data_boleto_disponible_ciudad = function(tbody, table){
    $(tbody).on("click", "button.seleccionar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idBoleta = $("#idBoleta").val( data.idBoleta );
        console.log(data)
    });
}

function asignar()
{
        var  idBoleta  = $("#idBoleta").val();
        var cc = $("#cc").val();
        $.ajax({
            method:"GET",
            url: "../models/consultas.php?op=asignarboleta",
            data: {"idBoleta": idBoleta, "cc": cc}
        });
}