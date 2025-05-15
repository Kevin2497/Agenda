<?php
include_once("AccesoDatos.php");

class Contacto {
    public static function eliminar($id) {
        $oAD = new AccesoDatos();
        if ($oAD->conectar()) {
            $stmt = $oAD->getConexion()->prepare("DELETE FROM contactos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $res = $stmt->execute();
            $stmt->close();
            $oAD->desconectar();
            return $res;
        }
        return false;
    }
}
?>

