function eliminarProducto(event, detalleId) { 
    event.preventDefault(); // Evita la recarga de la página
    
    const productoItem = document.getElementById(`producto-${detalleId}`);
    if (!productoItem) return;

    // Enviar el formulario usando Fetch API
    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ detalle_id: detalleId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Eliminar solo el contenedor específico del producto
            productoItem.remove();
        } else {
            console.error('Error al actualizar el estado del pedido:', data.error);
        }
    })
    .catch(error => console.error('Error de red:', error));
}
