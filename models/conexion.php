<?php
  $serverName = "localhost"; //serverName\instanceName
  $connectionInfo = array( 'CharacterSet' => 'UTF-8',"Database"=>"ICGSoftware");
  $conn = sqlsrv_connect( $serverName, $connectionInfo);
  if( $conn ) {
       //echo "Conexión establecida.<br />";
  }else{
       echo "Conexión no se pudo establecer.<br />";
       die( print_r( sqlsrv_errors(), true));
  }
?>