<?php
include("cabecera.html");
include_once("menu.php");
?>

<div class="main-layout">

    <div class="main-content">
    <section>
        <h2>Iniciar Sesión</h2>
        <form id="frm" method="post" action="login.php">
            <div class="form-group">
                <label for="txtCve">Usuario:</label>
                <input type="text" name="txtCve" id="txtCve" required />
            </div>
            <div class="form-group">
                <label for="txtPwd">Contraseña:</label>
                <input type="password" name="txtPwd" id="txtPwd" required />
            </div>
            <input class="btn" type="submit" value="Enviar" />
        </form>
    </section>
    <?php include_once("aside.html"); ?>
    </div>

    

</div>

<?php
include_once("pie.html");
?>
