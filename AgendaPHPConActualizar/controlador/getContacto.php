<?php
include_once("../modelo/AccesoDatos.php");

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $oAD = new AccesoDatos();

    if ($oAD->conectar()) {
        $res = $oAD->ejecutarConsulta("SELECT id, nombre, direccion, telefono, email FROM contactos WHERE id = $id");
        if ($res && count($res) > 0) {
            echo json_encode([
                "success" => true,
                "contacto" => [
                    "id" => $res[0][0],
                    "nombre" => $res[0][1],
                    "direccion" => $res[0][2],
                    "telefono" => $res[0][3],
                    "email" => $res[0][4]
                ]
            ]);
        } else {
            echo json_encode(["success" => false]);
        }
        $oAD->desconectar();
    } else {
        echo json_encode(["success" => false]);
    }
}
