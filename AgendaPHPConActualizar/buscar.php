<?php 

$nombreBuscar=$_GET["Nombre"];
$oMysql = new mysqli("localhost", "root", "", "agenda", 3307);
$Query="select * from contactos WHERE nombre = '".$nombreBuscar."'";
$Result = $oMysql->query( $Query );

if($Result==null)
   	print("No se  encontra el registro");
else{
      $row =$Result->fetch_array();
  	  $direccion=$row["direccion"];
	  $telefono=$row["telefono"];
	  $email=$row["email"];
	}
?>
