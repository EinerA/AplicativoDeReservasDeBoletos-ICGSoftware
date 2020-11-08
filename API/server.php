<?php
header( 'Content-Type: application/json' );
require_once 'conexion.php';

$user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
$pwd = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

if ( !empty($user) && !empty($pwd) ) {
	$hash = hash("SHA256",$pwd);
	$sql = "SELECT correo,contraseña
			FROM cliente
			WHERE correo='$user' 
			AND contraseña='$pwd';";
		$stmt = sqlsrv_query( $conn, $sql  );
		$data = array();
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$data[]= array(
		"correo"=>(string)$row['correo'],
		"contraseña"=>(string)$row['contraseña'],
				);
		}
	if (count($data) > 0 && $pwd === $data[0]['contraseña']) {
		http_response_code( 200 );
	  } else {
		http_response_code( 400 );
		echo json_encode(['usuario o contraseña incorrectos']);
		die;
	  }
}else {
	echo json_encode(['ingresa un usuario y contraseña']);
	http_response_code( 400 );
	die;
  }

$resourceType = $_GET['resource_type'];
$resourceId = array_key_exists('resource_id', $_GET ) ? $_GET['resource_id'] : '';
$method = $_SERVER['REQUEST_METHOD'];

switch ( strtoupper( $method ) ) {
	case 'GET':
		switch ( $resourceType) {
			case 'compradores':
				if ( !empty( $resourceId) ) {
					$sql = "SELECT nombre,cc,fechaNacimiento
							FROM cliente
							where cc=$resourceId;";
					$stmt = sqlsrv_query( $conn, $sql  );
					if( $stmt === false) {
					http_response_code( 404 );
					 json_encode(['Error Comprador '.$resourceId.' no encontrado']);
					}
					$data = array();
					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					$data[]= array(
					"cc"=>(string)$row['cc'],
					"nombre"=>(string)$row['nombre'],
					"fechaNacimiento"=>$row['fechaNacimiento'],
						);
					}
					echo json_encode($data[0]);
				} else {
					$sql = "SELECT nombre,cc,fechaNacimiento
							FROM cliente;";
					$stmt = sqlsrv_query( $conn, $sql  );
					$data = array();
					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					$data[]= array(
						"cc"=>(string)$row['cc'],
						"nombre"=>(string)$row['nombre'],
						"fechaNacimiento"=>$row['fechaNacimiento'],
								);
					}
					echo json_encode($data);
				}
				break;
			case 'disponibilidad':
				if ( !empty( $resourceId) ) {
					$sql = "SELECT A.numBoleta ,B.nombre,A.idBoleta
							FROM boleta A	
							INNER JOIN ciudad	B 
							on A.idciudad=B.idciudad 
							WHERE A.estado='Disponible' 
							AND idBoleta=$resourceId;";
					$stmt = sqlsrv_query( $conn, $sql  );
					if( $stmt === false) {
					http_response_code( 404 );
					 json_encode(['Boleta '.$resourceId.' no encontrada']);
					}
					$data = array();
					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					$data[]= array(
					"numBoleta"=>(string)$row['numBoleta'],
					"nombre"=>(string)$row['nombre'],
					"idBoleta"=>$row['idBoleta'],
						);
					}
					echo json_encode($data[0]);
				} else {
					$sql = "SELECT A.numBoleta ,B.nombre,A.idBoleta
							FROM boleta A	
							INNER JOIN ciudad	B 
							on A.idciudad=B.idciudad 
							WHERE A.estado='Disponible';";
					$stmt = sqlsrv_query( $conn, $sql  );
					$data = array();
					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
					$data[]= array(
						"numBoleta"=>(string)$row['numBoleta'],
						"nombre"=>(string)$row['nombre'],
						"idBoleta"=>$row['idBoleta'],
								);
					}
					echo json_encode($data);
				}
				break;
			default:
				http_response_code( 404 );
				echo json_encode(['error la ruta'.$resourceType. 'o el id ' .$resourceId. ' No se encontro']);
				die;
		}
		
		break;
	case 'POST':
		switch ( $resourceType) {
			case 'compradores':
				$json = file_get_contents( 'php://input' );
				$list[] = json_decode( $json );

				$cedula = $list[0]->cedula;
				$Nombre = $list[0]->Nombre;
				$FechaNacimiento = $list[0]->FechaNacimiento;
				$Direccion = $list[0]->Direccion;
				$tipoCliente = $list[0]->tipoCliente;
				$estado = $list[0]->estado;
				$correo = $list[0]->correo;
				$contrasena = $list[0]->contrasena;

				$sql = "INSERT INTO [dbo].[cliente]([cc], [nombre], [fechaNacimiento], [direccion], [tipoCliente], [estado], [correo], [contraseña]) 
				VALUES ($cedula, '$Nombre', '$FechaNacimiento ', '$Direccion', '$tipoCliente', '$estado', '$correo', '$contrasena')";
				$stmt = sqlsrv_query( $conn, $sql  );
				if( $stmt === false) {
					http_response_code( 404 );
					echo json_encode(['No fue posible ingresar el comprador con el id '.$cedula. ' Gracias']);
					}
				var_dump($stmt );
			break;
			default:
			http_response_code( 400 );
			echo json_encode(['error la ruta'.$resourceType. 'o el id ' .$resourceId. ' No se encontro']);
			die;
		}
		break;
	case 'PUT':
		switch ( $resourceType) {
			case 'compradores':
				$json = file_get_contents( 'php://input' );
				$list[] = json_decode( $json );

				$cedula = $list[0]->cedula;
				$Nombre = $list[0]->Nombre;
				$FechaNacimiento = $list[0]->FechaNacimiento;
				$Direccion = $list[0]->Direccion;
				$tipoCliente = $list[0]->tipoCliente;
				$estado = $list[0]->estado;
				$correo = $list[0]->correo;
				$contrasena = $list[0]->contrasena;

				$sql=  "UPDATE [dbo].[cliente] SET [nombre] = '$Nombre', [fechaNacimiento] = '$FechaNacimiento', [direccion] = '$Direccion',[tipoCliente] = '$tipoCliente',[estado] = '$estado', [correo] = '$correo', [contraseña] = '$contrasena' WHERE [cc] = $cedula";
				$stmt = sqlsrv_query( $conn, $sql  );
				if( $stmt === false) {
					http_response_code( 404 );
					echo json_encode(['No fue posible Editar el comprador con el id '.$cedula. ' Gracias']);
					}
			break;
				
		}
		break;
	default:
		http_response_code( 404 );
		echo json_encode(['Metodo '.$method. ' No encontrado ']);
		break;
}