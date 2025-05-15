document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modificarContacto').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const fila = this.closest('tr');

            document.getElementById('editId').value = id;
            document.getElementById('editNombre').value = fila.children[0].textContent.trim();
            document.getElementById('editDireccion').value = fila.children[1].textContent.trim();
            document.getElementById('editTelefono').value = fila.children[2].textContent.trim();
            document.getElementById('editEmail').value = fila.children[3].textContent.trim();

            document.getElementById('popupEditar').style.display = 'flex';
        });
    });

    document.getElementById('btnCancelarEditar').addEventListener('click', () => {
        document.getElementById('popupEditar').style.display = 'none';
    });

    document.getElementById('formEditar').addEventListener('submit', function (e) {
        e.preventDefault();

        const datos = new FormData(this);

        fetch('modelo/actualizarContacto.php', {
            method: 'POST',
            body: datos
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            if (data.success) {
                function mostrarMensaje(texto, esExito) {
    const mensaje = document.getElementById('mensajeTexto');
    mensaje.textContent = texto;
    mensaje.style.color = esExito ? "green" : "red";

    document.getElementById('popupMensaje').style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modificarContacto').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const fila = this.closest('tr');

            document.getElementById('editId').value = id;
            document.getElementById('editNombre').value = fila.children[0].textContent.trim();
            document.getElementById('editDireccion').value = fila.children[1].textContent.trim();
            document.getElementById('editTelefono').value = fila.children[2].textContent.trim();
            document.getElementById('editEmail').value = fila.children[3].textContent.trim();

            document.getElementById('popupEditar').style.display = 'flex';
        });
    });

    document.getElementById('btnCancelarEditar').addEventListener('click', () => {
        document.getElementById('popupEditar').style.display = 'none';
    });

    document.getElementById('formEditar').addEventListener('submit', function (e) {
        e.preventDefault();

        const datos = new FormData(this);

        fetch('modelo/actualizarContacto.php', {
            method: 'POST',
            body: datos
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            if (data.success) {
                mostrarMensaje("Contacto actualizado correctamente.", true);
                setTimeout(() => location.reload(), 2000);
            } else {
                mostrarMensaje("Error: " + data.msg, false);
            }
        })
        .catch(err => {
            mostrarMensaje("Error en la solicitud: " + err.message, false);
            console.error("Detalle del error:", err);
        });
    });

    document.getElementById('btnCerrarMensaje').addEventListener('click', () => {
        document.getElementById('popupMensaje').style.display = 'none';
    });
});
            } else {
                alert("Error: " + data.msg);
            }
        })
        .catch(err => {
            alert("Error en la solicitud: " + err.message);
            console.error("Detalle del error:", err);
        });
    });
});
