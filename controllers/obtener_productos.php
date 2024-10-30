<?php
include ('conexion.php');

$categoria = $_GET['categoria'];
$productos = obtenerProductosPorCategoria($categoria);

header('Content-Type: application/json');
echo json_encode($productos);

function cargarProductos(categoria) {
    fetch(`obtener_productos.php?categoria=${categoria}`)
        .then(response => response.json())
        .then(data => {
            let listaProductos = '';
            data.forEach(producto => {
                listaProductos += `
                    <div class="entry-item">
                        <button>${producto.producto} - $${producto.precio}</button>
                        <div class="quantity" id="${categoria}-quantity-${producto.producto_id}">0</div>
                        <div>
                            <button onclick="increment('${categoria}-quantity-${producto.producto_id}', '${categoria}')"><i class="fas fa-plus"></i></button>
                            <button onclick="decrement('${categoria}-quantity-${producto.producto_id}', '${categoria}')"><i class="fas fa-minus"></i></button>
                        </div>
                        <button class="note-button" onclick="openNoteModal('${categoria}', '${categoria}-quantity-${producto.producto_id}')">Nota</button>
                    </div>
                `;
            });
            document.getElementById('list-' + categoria).innerHTML = listaProductos;
        });
}
?>