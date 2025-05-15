<?php
/*
Archivo:  login.php
Objetivo: verifica clave y contraseña contra repositorio a través de clases
Autor:   
*/
include_once("modelo/Usuario.php");
session_start();

$sErr = "";
$oUsu = new Usuario();

if (isset($_POST["txtCve"], $_POST["txtPwd"])) {
	$oUsu->setClave($_POST["txtCve"]);
	$oUsu->setContra($_POST["txtPwd"]);
	
	try {
		if ($oUsu->buscarClaveYContra()) {
			$_SESSION["usuario"] = serialize($oUsu);


			header("Location: inicio.php");

			exit;

		} else {
			$sErr = "Usuario o contraseña incorrectos.";
		}
	} catch (Exception $e) {
		// TEMPORALMENTE muestra el error real
		die("Error en la base de datos: " . $e->getMessage());
	}
} else {
	$sErr = "Faltan datos.";
}

header("Location: error.php?sError=" . urlencode($sErr));

?>
