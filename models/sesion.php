<?php
    header('Content-type: application/json; charset=utf-8');
    require_once './conexion.php';
    session_start();

    switch($_GET["op"])
    {

        case 'validarIngreso':
            $correo = $_GET["correo"];
            $contrasena = $_GET["contrasena"];
            $hash = hash("SHA256",$contrasena);
            $sql = "SELECT correo,contraseña
                    FROM cliente
                    WHERE correo='$correo' 
                    AND contraseña='$hash';";
            $stmt = sqlsrv_query( $conn, $sql  );
            $data = array();
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $data[]= array(
            "correo"=>(string)$row['correo'],
            "contraseña"=>(string)$row['contraseña'],
                    );
                }
                if (count($data) > 0 ) {
                    $_SESSION['correo'] = $correo;
                    echo json_encode($data);
                  }
          
        break;
        case 'cerrarSesion':
            session_unset(); //Limpiamos las variables de sesion
            session_destroy(); //Destriumos la sesion
            header("Location: ../views/logidn.php");
        break;
       
    }
    

?>