<?php
include_once("../modelo/AccesoDatos.php");

if (isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $oAD = new AccesoDatos();
    if ($oAD->conectar()) {
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $res = $oAD->ejecutarConsulta($sql);
        echo $res ? "ok" : "error";
        $oAD->desconectar();
    } else {
        echo "error";
    }
} else {
    echo "error";
}
