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
$nombre = $oUsu->getNombre();
$tipo = $oUsu->getTipo();
$idUsuario = $oUsu->getId();
?>

<div class="main-content">
    <section>
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</h2>

        <?php if ($tipo === "admin"): ?>
            <p>Eres administrador. Tienes acceso completo:</p>
        <?php else: ?>
            <p>Solo puedes gestionar tus contactos:</p>
        <?php endif; ?>

        <table border="1" cellpadding="5" id="tablaContactos">
            <tr>
                <th>Nombre</th>
                <th>Direcci&oacute;n</th>
                <th>Tel&eacute;fono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>

            <?php
            $oAD = new AccesoDatos();
            if ($oAD->conectar()) {
                $condicion = ($tipo === "admin") ? "" : "WHERE id_usuario = $idUsuario";
                $query = "SELECT id, nombre, direccion, telefono, email FROM contactos $condicion";
                $contactos = $oAD->ejecutarConsulta($query);

                if ($contactos) {
                    foreach ($contactos as $c) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($c[1]); ?></td>
                            <td><?php echo htmlspecialchars($c[2]); ?></td>
                            <td><?php echo htmlspecialchars($c[3]); ?></td>
                            <td><?php echo htmlspecialchars($c[4]); ?></td>
                            <td>
                                <a href='#' class='modificarContacto' data-id="<?php echo $c[0]; ?>">Modificar</a>
                                <a href="#" class="eliminarContacto" data-id="<?php echo $c[0]; ?>">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No se encontraron contactos.</td></tr>";
                }

                $oAD->desconectar();
            } else {
                echo "<tr><td colspan='5'>Error al conectar con la base de datos.</td></tr>";
            }
            ?>
        </table>

        <br>
        <a href="insertar.php"><button>Agregar nuevo contacto</button></a>

        <div id="popupConfirmacion" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:999;">
            <div style="background:#fff; padding:30px; border-radius:10px; text-align:center;">
                <p>¿Est&aacute;s seguro que deseas eliminar este contacto?</p>
                <button id="btnSi">S&iacute;, eliminar</button>
                <button id="btnNo">No, cancelar</button>
            </div>
        </div>

        <div id="popupEditar" style="display:none;">
            <form id="formEditar">
                <input type="hidden" id="editId" name="id">
                <label>Nombre: <input type="text" id="editNombre" name="nombre" required></label>
                <label>Direcci&oacute;n: <input type="text" id="editDireccion" name="direccion"></label>
                <label>Tel&eacute;fono: <input type="text" id="editTelefono" name="telefono"></label>
                <label>Email: <input type="email" id="editEmail" name="email"></label>
                <button type="submit">Guardar</button>
                <button type="button" id="btnCancelarEditar">Cancelar</button>
            </form>
        </div>

<div id="popupMensaje" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
    background-color:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000;">
    <div style="background:#fff; padding:20px 30px; border-radius:10px; text-align:center; max-width:400px;">
        <p id="mensajeTexto" style="margin-bottom: 20px;"></p>
        <button id="btnCerrarMensaje">Cerrar</button>
    </div>
</div>
    </section>

    <?php include('aside.html'); ?>
</div>

<script src="js/editarContacto.js"></script>
<script src="js/eliminarContacto.js"></script>

<?php include_once("pie.html"); ?>
