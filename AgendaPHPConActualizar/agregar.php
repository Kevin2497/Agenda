<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<?php
$oMysql = new mysqli("localhost", "root", "", "agenda", 3307);
$id = $_POST["ID"];
$nombre = $_POST["Nombre"];
$direccion = $_POST["Direccion"];
$telefono = $_POST["Telefono"];
$email = $_POST["Email"];
$id_contacto = $_POST["Contacto"];


 if($_POST["Nombre"]!=""){
$Query = "INSERT INTO contactos VALUES ('$id','$nombre', '$direccion', '$telefono', '$email', '$id_contacto')";
$Result = $oMysql->query($Query);

if ($Result != null) {
  
   echo '<!DOCTYPE html>
   <html>
   <head>
       <title>Confirmación</title>
       <script defer src="popup_script.js"></script>
   </head>
   <body data-popup-msg="¡Contacto agregado correctamente!" data-popup-img="feliz.png">
   </body>
   </html>';

}}

else {
   echo '<!DOCTYPE html>
   <html>
   <head>
       <title>Error</title>
       <script defer src="popup_script.js"></script>
   </head>
   <body data-popup-msg="Error al agregar contacto" data-popup-img="triste.jpg">
   </body>
   </html>';
}
?>
	

</body>
</html>
