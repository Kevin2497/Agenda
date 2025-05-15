<?php
$nom = $_POST['Nombre'];
$mysql = new mysqli("localhost", "root", "", "agenda", 3307);

if ($mysql->connect_error) {
    die("Error de conexión: " . $mysql->connect_error);
}

$Query = "DELETE FROM contactos WHERE nombre = ?";
$stmt = $mysql->prepare($Query);
$stmt->bind_param("s", $nom);
$result = $stmt->execute();

echo $result ? 'success' : 'failure';
?>
