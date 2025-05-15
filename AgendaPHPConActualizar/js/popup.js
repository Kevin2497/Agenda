function mostrarConfirmacion(mensaje, onConfirmar, onCancelar = null) {
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
    popup.style.padding = '30px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
    popup.style.maxWidth = '300px';

    const mensajeElem = document.createElement('p');
    mensajeElem.textContent = mensaje;

    const btnSi = document.createElement('button');
    btnSi.textContent = 'S&iacute;';
    btnSi.style.margin = '10px';
    btnSi.style.padding = '10px 20px';
    btnSi.style.cursor = 'pointer';
    btnSi.addEventListener('click', () => {
        document.body.removeChild(overlay);
        if (typeof onConfirmar === 'function') onConfirmar();
    });

    const btnNo = document.createElement('button');
    btnNo.textContent = 'No';
    btnNo.style.margin = '10px';
    btnNo.style.padding = '10px 20px';
    btnNo.style.cursor = 'pointer';
    btnNo.addEventListener('click', () => {
        document.body.removeChild(overlay);
        if (typeof onCancelar === 'function') onCancelar();
    });

    popup.appendChild(mensajeElem);
    popup.appendChild(btnSi);
    popup.appendChild(btnNo);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}
