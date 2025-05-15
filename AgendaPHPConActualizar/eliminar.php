<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
            margin: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a.enlaceEliminar {
            color: #f44336;
            text-decoration: none;
            font-weight: bold;
        }
        a.enlaceEliminar:hover {
            text-decoration: underline;
        }
        /* Popup */
        #popupConfirmacion {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        #popupConfirmacion .popup-contenido {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        #popupConfirmacion button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        #btnSi {
            background-color: #4CAF50;
            color: white;
        }
        #btnNo {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

<?php 
$mysql = new mysqli("localhost", "root", "", "agenda", 3307);

if ($mysql->connect_error) {
    die("<h2>Error de conexión: " . $mysql->connect_error . "</h2>");
}

$Query = "SELECT * FROM contactos";
$Result = $mysql->query($Query);

$numeroRegistros = $Result->num_rows;

if ($numeroRegistros <= 0) { 
    echo "<div align='center'>"; 
    echo "<h2>No se encontraron registros</h2>"; 
    echo "</div><hr>"; 
} else {
?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    <?php while($row = $Result->fetch_assoc()): ?>
        <tr>
            <td><a href="#" class="enlaceEliminar" data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>"><?php echo htmlspecialchars($row['nombre']); ?></a></td>
            <td><?php echo htmlspecialchars($row['direccion']); ?></td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><a href="#" class="enlaceEliminar" data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>">Eliminar</a></td>
        </tr>
    <?php endwhile; ?>
    </table>
<?php
}
?>

<!-- Popup de Confirmación -->
<div id="popupConfirmacion">
    <div class="popup-contenido">
        <p>¿Estás seguro que deseas eliminar este contacto?</p>
        <button id="btnSi">Sí, eliminar</button>
        <button id="btnNo">No, cancelar</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const enlaces = document.querySelectorAll('.enlaceEliminar');
    const popup = document.getElementById('popupConfirmacion');
    const btnSi = document.getElementById('btnSi');
    const btnNo = document.getElementById('btnNo');

    let nombreAEliminar = '';

    enlaces.forEach(function(enlace) {
        enlace.addEventListener('click', function(e) {
            e.preventDefault();
            nombreAEliminar = this.getAttribute('data-nombre');
            popup.style.display = 'flex';
        });
    });

    btnSi.addEventListener('click', function() {
        fetch('eliminacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'Nombre=' + encodeURIComponent(nombreAEliminar)
        })
        .then(response => response.text())
        .then(data => {
            popup.style.display = 'none';
            if (data.trim() === 'success') {
                mostrarPopup('¡El contacto ha sido eliminado con éxito!', 'feliz.png');
            } else {
                mostrarPopup('No se pudo eliminar el contacto.', 'triste.jpg');
            }
        })
        .catch(error => {
            popup.style.display = 'none';
            mostrarPopup('Ocurrió un error al eliminar.', 'triste.jpg');
        });
    });

    btnNo.addEventListener('click', function() {
        popup.style.display = 'none';
        nombreAEliminar = '';
    });

    function mostrarPopup(mensaje, imagenSrc) {
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = 0;
        overlay.style.left = 0;
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        overlay.style.display = 'flex';
        overlay.style.justifyContent = 'center';
        overlay.style.alignItems = 'center';
        overlay.style.zIndex = 1000;

        const popup = document.createElement('div');
        popup.style.background = '#fff';
        popup.style.padding = '20px';
        popup.style.borderRadius = '10px';
        popup.style.textAlign = 'center';
        popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';

        const imagen = document.createElement('img');
        imagen.style.width = '100px';
        imagen.src = imagenSrc; 

        const message = document.createElement('p');
        message.textContent = mensaje;

        const button = document.createElement('button');
        button.textContent = 'Aceptar';
        button.style.marginTop = '10px';
        button.style.padding = '10px 20px';
        button.style.cursor = 'pointer';

        button.addEventListener('click', function () {
            overlay.remove();
            location.reload(); // Recargar la tabla
        });

        popup.appendChild(imagen);
        popup.appendChild(message);
        popup.appendChild(button);
        overlay.appendChild(popup);
        document.body.appendChild(overlay);
    }
});
</script>

<button onclick="regresar()">Regresar</button>

</body>
</html>


