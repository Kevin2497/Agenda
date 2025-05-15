<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("AccesoDatos.php");

$response = ['success' => false, 'msg' => 'Error desconocido'];

if (isset($_POST['id']) && isset($_POST['nombre'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';

    $oAD = new AccesoDatos();
    if ($oAD->conectar()) {
        try {
            $pdo = $oAD->getPDO();
            $stmt = $pdo->prepare("UPDATE contactos SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE id = ?");
            $ok = $stmt->execute([$nombre, $direccion, $telefono, $email, $id]);

            $response['success'] = $ok;
            $response['msg'] = $ok ? 'Actualizado correctamente.' : 'No se pudo actualizar.';
        } catch (Exception $e) {
            $response['msg'] = 'Error en SQL: ' . $e->getMessage();
        }
        $oAD->desconectar();
    } else {
        $response['msg'] = 'No se pudo conectar a la base de datos.';
    }
} else {
    $response['msg'] = 'Datos incompletos.';
}

echo json_encode($response);
exit;
