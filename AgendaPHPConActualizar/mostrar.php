<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

include_once("modelo/Usuario.php");
$oUsu = unserialize($_SESSION["usuario"]);
$idUsuario = $oUsu->getId();
$tipo = $oUsu->getTipo();

$mysql = new mysqli("localhost", "root", "", "agenda", 3307);
if ($mysql->connect_errno) {
    die("Error de conexión: " . $mysql->connect_error);
}

// Filtrar contactos por usuario si no es admin
if ($tipo === "admin") {
    $Query = "SELECT * FROM contactos";
} else {
    $Query = "SELECT * FROM contactos WHERE idUsuario = $idUsuario";
}
$Result = $mysql->query($Query);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contactos</title>
<script src="jscript3.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
$numeroRegistros = $Result->num_rows;
if ($numeroRegistros <= 0) {
    echo "<div align='center'><h2>No se encontraron resultados</h2></div><hr>";
} else {
?>
    <table border=1>
        <tr>
            <td><strong>Nombre</strong></td>
            <td><strong>Dirección</strong></td>
            <td><strong>Teléfono</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Acciones</strong></td>
        </tr>
        <?php while ($row = $Result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($row["direccion"]); ?></td>
                <td><?php echo htmlspecialchars($row["telefono"]); ?></td>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td>
                    <a href="actualizar.php?id=<?php echo $row["idContacto"]; ?>">Editar</a> |
                    <a href="eliminar.php?id=<?php echo $row["idContacto"]; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

<br><button onclick="location.href='inicio.php'">Regresar</button>
</body>
</html>
