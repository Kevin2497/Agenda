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

if ($tipo !== "admin") {
    echo "<h2>No tienes permisos para ver esta s&eacute;ccion</h2>";
    exit;
}
?>
<div class="main-content">
    <section>
    <h2>Lista de Usuarios</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Nombre</th>
            <th>Clave</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>

        <?php
        $oAD = new AccesoDatos();
        if ($oAD->conectar()) {
            $query = "SELECT id, nombre, clave, tipo FROM usuarios";
            $usuarios = $oAD->ejecutarConsulta($query);

            if ($usuarios) {
                foreach ($usuarios as $u) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($u[1]) . "</td>";
                    echo "<td>" . htmlspecialchars($u[2]) . "</td>";
                    echo "<td>" . htmlspecialchars($u[3]) . "</td>";
                    echo "<td>
                            
                            <a href='#' class='eliminarUsuario' data-id='" . $u[0] . "'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
            }

            $oAD->desconectar();
        } else {
            echo "<tr><td colspan='4'>Error al conectar con la base de datos.</td></tr>";
        }
        ?>
    </table>

    <div id="popupConfirmacionUsuario" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:999;">
        <div style="background:#fff; padding:30px; border-radius:10px; text-align:center;">
            <p>Est&aacute;s seguro que deseas eliminar este usuario?</p>
            <button id="btnSiUsuario">S&iacute;, eliminar</button>
            <button id="btnNoUsuario">No, cancelar</button>
        </div>  
    </div>

    <script src="js/eliminarUsuario.js"></script>
</section>
    <?php include_once("aside.html"); ?>
</div>

<?php include_once("pie.html"); ?>
