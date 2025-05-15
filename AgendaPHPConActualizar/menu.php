
        <nav>
            <?php
				if (isset($_SESSION["tipo"])){
					if ($_SESSION["tipo"]=="Administrador"){
			
					}
			?>
       

			<?php
				} else {
			?>
			<ul>
				<li> <a href="inicio.php" class="menu">Contactos</a> </li>
				<li> <a href="usuarios.php" class="menu">Usuarios</a> </li>
				<li> <a href="index.php" class="menu">Cerrar sesion</a> </li>
			</ul>
			<?php
				}
			?>
        </nav>
