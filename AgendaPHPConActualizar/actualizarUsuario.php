<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

include_once("cabecera.html");
include_once("menu.php");
include_once("modelo/Usuario.php");
include_once("modelo/AccesoDatos.php");

$oUsu = unserialize($_SESSION["usuario"]);
$id = $oUsu->getId();
$nombre = $oUsu->getNombre();
$clave = $oUsu->getClave();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoNombre = $_POST["nombre"];
    $nuevaClave = $_POST["clave"];

    $oAD = new AccesoDatos();
    if ($oAD->conectar()) {
        $query = "UPDATE usuarios SET nombre = ?, clave = ? WHERE id = ?";
        $stmt = $oAD->getConexion()->prepare($query);
        $stmt->execute([$nuevoNombre, $nuevaClave, $id]);

        // Actualizar objeto en sesión
        $oUsu->setNombre($nuevoNombre);
        $oUsu->setClave($nuevaClave);
        $_SESSION["usuario"] = serialize($oUsu);

        $mensaje = "Datos actualizados correctamente.";
        $oAD->desconectar();
    }
}
?>

<section>
    <h2>Actualizar Usuario</h2>

    <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>"; ?>

    <form method="post">
        <label>Nombre:
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </label><br>
        <label>Clave:
            <input type="password" name="clave" value="<?php echo htmlspecialchars($clave); ?>" required>
        </label><br><br>
        <input type="submit" value="Actualizar">
    </form>
</section>

<?php include_once("pie.html"); ?>
