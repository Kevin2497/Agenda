document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popupConfirmacionUsuario");
    const btnSi = document.getElementById("btnSiUsuario");
    const btnNo = document.getElementById("btnNoUsuario");
    let idSeleccionado = null;

    // Asignar evento a los enlaces de eliminar
    document.querySelectorAll(".eliminarUsuario").forEach(boton => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();
            idSeleccionado = this.getAttribute("data-id");
            popup.style.display = "flex";
        });
    });

    btnSi.addEventListener("click", function () {
        fetch("controlador/eliminarUsuario.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id=${idSeleccionado}`
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "ok") {
                // Cierra el popup y recarga la página completa
                popup.style.display = "none";
                window.location.reload();
            } else {
                alert("Eliminado con exito");  
                popup.style.display = "none";
                window.location.reload();
            }
        });
    });

    btnNo.addEventListener("click", function () {
        popup.style.display = "none";
    });
});
