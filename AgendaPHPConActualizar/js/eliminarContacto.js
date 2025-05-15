document.addEventListener('DOMContentLoaded', function () {
    const enlacesEliminar = document.querySelectorAll('.eliminarContacto');
    const popup = document.getElementById('popupConfirmacion');
    const btnSi = document.getElementById('btnSi');
    const btnNo = document.getElementById('btnNo');

    let idEliminar = null;

    enlacesEliminar.forEach(function (enlace) {
        enlace.addEventListener('click', function (e) {
            e.preventDefault();
            idEliminar = this.getAttribute('data-id');
            popup.style.display = 'flex';
        });
    });

    btnSi.addEventListener('click', function () {
        if (idEliminar) {
            fetch('controlador/eliminarContacto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + encodeURIComponent(idEliminar),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Ocultar popup
                    popup.style.display = 'none';
                    // Recargar la página para reflejar los cambios
                    location.reload();
                } else {
                    alert(data.message || 'No se pudo eliminar el contacto.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar el contacto.');
            });
        }
    });

    btnNo.addEventListener('click', function () {
        popup.style.display = 'none';
        idEliminar = null;
    });
});
