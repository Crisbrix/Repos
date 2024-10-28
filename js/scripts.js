// JavaScript para enviar el formulario y eliminar el contenedor
document.querySelectorAll('.finished').forEach(button => {
    button.addEventListener('click', () => {
        const form = button.closest('.finalizar-pedido');
        form.submit(); // Enviar el formulario

        const tarjeta = button.closest('.mesa-container');
        if (tarjeta) {
            tarjeta.remove(); // Elimina la tarjeta
        }
    });
});