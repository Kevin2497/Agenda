<?php
require_once("../modelo/AccesoDatos.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
        exit;
    }

    $id = intval($_POST['id']);
    $oAD = new AccesoDatos();

    if ($oAD->conectar()) {
        $query = "DELETE FROM contactos WHERE id = $id";
        $result = $oAD->ejecutarComando($query);
        $oAD->desconectar();

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el contacto']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

