<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("../modelo/AccesoDatos.php");

$response = ['success' => false, 'msg' => 'Error desconocido'];

if (!empty($_POST['id']) && !empty($_POST['nombre'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';

    try {
        $oAD = new AccesoDatos();
        if ($oAD->conectar()) {
            $pdo = $oAD->getPDO();
            if (!$pdo) {
                $response['msg'] = "getPDO() devolvió null";
            } else {
                $stmt = $pdo->prepare("UPDATE contactos SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE id = ?");
                $ok = $stmt->execute([$nombre, $direccion, $telefono, $email, $id]);
                $response['success'] = $ok;
                if (!$ok) {
                    $response['msg'] = "No se pudo ejecutar el UPDATE.";
                }
            }
            $oAD->desconectar();
        } else {
            $response['msg'] = "No se pudo conectar a la base de datos.";
        }
    } catch (Exception $e) {
        $response['msg'] = "Excepción: " . $e->getMessage();
    }
} else {
    $response['msg'] = "Faltan datos (POST)";
}

echo json_encode($response);
exit;
