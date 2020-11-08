<?php
    
    require_once './conexion.php';



    switch($_GET["op"])
    {

        case 'agregarComprador':
            $cedula = $_GET["cedula"];
            $Nombre = $_GET["Nombre"];
            $FechaNacimiento = $_GET["FechaNacimiento"];
            $Direccion = $_GET["Direccion"];
            $tipoCliente = $_GET["tipoCliente"];
            $estado = $_GET["estado"];
            $correo = $_GET["correo"];
            $contrasena = $_GET["contrasena"];

            $sql = "INSERT INTO [dbo].[cliente]([cc], [nombre], [fechaNacimiento], [direccion], [tipoCliente], [estado], [correo], [contraseña]) 
            VALUES ($cedula, '$Nombre', '$FechaNacimiento', '$Direccion', '$tipoCliente', '$estado', '$correo', '$contrasena')";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;


        case 'boletasDisponibles':
            $sql = "SELECT COUNT(nombre) Disponibles,B.nombre 
                    FROM boleta A	
                    INNER JOIN ciudad	B 
                    on A.idciudad=B.idciudad 
                    WHERE A.estado='Disponible'
                    GROUP BY B.nombre ;";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                 $data[]= array(
                     "1"=>(string)$row['Disponibles'],
                     "0"=>(string)$row['nombre'],
                            );
                }
            $resultado = array(
                "sEcho"=>1, 
                "iTotalRecords" =>count($data), 
                "iTotalDisplayRecords" => count($data), 
                "aaData" =>$data
            );
            echo json_encode($resultado);
        break;

        case 'listarCompradores':
            $sql = "SELECT * 
                    FROM cliente;";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                 $data[]= array(
                     "cc"=>(string)$row['cc'],
                     "nombre"=>(string)$row['nombre'],
                     "direccion"=>(string)$row['direccion'],
                     "tipoCliente"=>(string)$row['tipoCliente'],
                     "estado"=>(string)$row['estado'],
                     "correo"=>(string)$row['correo'],
                     "contraseña"=>(string)$row['contraseña'],
                            );
                }
            $resultado = array(
                "sEcho"=>1, 
                "iTotalRecords" =>count($data), 
                "iTotalDisplayRecords" => count($data), 
                "aaData" =>$data
            );
            echo json_encode($resultado);
        break;

        case 'editarComprador':
            $cedula = $_GET["cedula"];
            $Nombre = $_GET["Nombre"];
            $FechaNacimiento = $_GET["FechaNacimiento"];
            $Direccion = $_GET["Direccion"];
            $tipoCliente = $_GET["tipoCliente"];
            $estado = $_GET["estado"];
            $correo = $_GET["correo"];
            $contrasena = $_GET["contrasena"];
            $sql=  "UPDATE [dbo].[cliente] SET [nombre] = '$Nombre', [fechaNacimiento] = '$FechaNacimiento', [direccion] = '$Direccion',[tipoCliente] = '$tipoCliente',[estado] = '$estado', [correo] = '$correo', [contraseña] = '$contrasena' WHERE [cc] = $cedula";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;

        
        case 'eliminarComprador':
            $cedula = $_GET["cc"];
            $sql=  "DELETE FROM [dbo].[cliente] WHERE [cc] = $cedula";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;

        case 'estadoComprador':
            $cedula = $_GET["cc"];
            $estado = $_GET["estado"];
            $sql=  "UPDATE [dbo].[cliente] SET [estado] = '$estado' WHERE [cc] = $cedula";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;

        case 'listarCompradoresBoletas':
            $sql = "SELECT D.cc, D.nombre, B.idBoleta,B.numBoleta,B.estado,A.idCompra idCompraDetalle
                    FROM detalleCompra A 
                    INNER JOIN boleta B
                    on A.idBoleta=B.idBoleta
                    INNER JOIN compra C 
                    on A.idCompra=C.idCompra
                    INNER JOIN cliente D
                    on C.ccCliente=D.cc
                    WHERE B.estado='Reservada';";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                 $data[]= array(
                     "cc"=>(string)$row['cc'],
                     "nombre"=>(string)$row['nombre'],
                     "idBoleta"=>(string)$row['idBoleta'],
                     "numBoleta"=>(string)$row['numBoleta'],
                     "estado"=>(string)$row['estado'],
                     "idCompraDetalle"=>(string)$row['idCompraDetalle'],
                            );
                }
            $resultado = array(
                "sEcho"=>1, 
                "iTotalRecords" =>count($data), 
                "iTotalDisplayRecords" => count($data), 
                "aaData" =>$data
            );
            echo json_encode($resultado);
        break;

        case 'cancelarBoleta':
            $idBoleta = $_GET["idBoleta"];
            $estado = $_GET["estado"];
            $sql=  "UPDATE [dbo].[boleta] SET [estado] = '$estado' WHERE [idBoleta] = $idBoleta";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;

        case 'listarBoletasDisponiblesCiudad':
            $sql = "SELECT A.numBoleta ,B.nombre,A.idBoleta
                    FROM boleta A	
                    INNER JOIN ciudad	B 
                    on A.idciudad=B.idciudad 
                    WHERE A.estado='Disponible'
                    ;";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                 $data[]= array(
                     "numBoleta"=>(string)$row['numBoleta'],
                     "nombre"=>(string)$row['nombre'],
                     "idBoleta"=>(string)$row['idBoleta'],
                            );
                }
            $resultado = array(
                "sEcho"=>1, 
                "iTotalRecords" =>count($data), 
                "iTotalDisplayRecords" => count($data), 
                "aaData" =>$data
            );
            echo json_encode($resultado);
        break;

        case 'asignarboleta':
            $cedula = $_GET["cc"];
            $idBoleta = $_GET["idBoleta"];
            $sql=  "UPDATE [dbo].[boleta] SET [estado] = 'Reservado' WHERE [idBoleta] = $idBoleta           
            INSERT INTO [dbo].[compra]([cantidadBoletas], [valorFactura], [ccCliente]) VALUES (1, 10000,$cedula )
            SELECT @@IDENTITY AS 'Identity';
            INSERT INTO [dbo].[detalleCompra]([idCompra], [idBoleta ])  VALUES ( @@IDENTITY, $idBoleta)";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            echo json_encode($stmt);
        break;

    }



?>
