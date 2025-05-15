<script>
document.addEventListener('DOMContentLoaded', function () {
    const enlacesEliminar = document.querySelectorAll('.eliminarContacto');
    const popup = document.getElementById('popupConfirmacion');
    const btnSi = document.getElementById('btnSi');
    const btnNo = document.getElementById('btnNo');

    let contactoId = null;
    let filaActual = null;

    enlacesEliminar.forEach(function (enlace) {
        enlace.addEventListener('click', function (e) {
            e.preventDefault();
            contactoId = this.getAttribute('data-id');
            filaActual = this.closest('tr');
            popup.style.display = 'flex';
        });
    });

    btnSi.addEventListener('click', function () {
        fetch('controlador/eliminarContacto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(contactoId)
        })
        .then(res => res.text())
        .then(data => {
            popup.style.display = 'none';
            if (data.trim() === 'success') {
                filaActual.remove();
                mostrarMensaje('Contacto eliminado con éxito', 'feliz.png');
            } else {
                mostrarMensaje('No se pudo eliminar el contacto.', 'triste.jpg');
            }
        })
        .catch(() => {
            popup.style.display = 'none';
            mostrarMensaje('Error al eliminar.', 'triste.jpg');
        });
    });

    btnNo.addEventListener('click', function () {
        popup.style.display = 'none';
        contactoId = null;
        filaActual = null;
    });

    function mostrarMensaje(texto, imagen) {
        const fondo = document.createElement('div');
        fondo.style.position = 'fixed';
        fondo.style.top = 0;
        fondo.style.left = 0;
        fondo.style.width = '100%';
        fondo.style.height = '100%';
        fondo.style.background = 'rgba(0,0,0,0.6)';
        fondo.style.display = 'flex';
        fondo.style.justifyContent = 'center';
        fondo.style.alignItems = 'center';
        fondo.style.zIndex = 1000;

        const popup = document.createElement('div');
        popup.style.background = '#fff';
        popup.style.padding = '20px';
        popup.style.borderRadius = '10px';
        popup.style.textAlign = 'center';

        const img = document.createElement('img');
        img.src = imagen;
        img.style.width = '80px'; b

        const msg = document.createElement('p');
        msg.textContent = texto;

        const btn = document.createElement('button');
        btn.textContent = 'Aceptar';
        btn.style.marginTop = '10px';
        btn.addEventListener('click', () => fondo.remove());

        popup.appendChild(img);
        popup.appendChild(msg);
        popup.appendChild(btn);
        fondo.appendChild(popup);
        document.body.appendChild(fondo);
    }
});
</script>

