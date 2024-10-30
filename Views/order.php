<?php
include ("../controllers/conexion.php");
include ("../controllers/ForCategory.php");
include ("../controllers/table&user.php");
// Obtener el número de mesa y el usuario de la URL
$numeroMesa = isset($_GET['mesa']) ? intval($_GET['mesa']) : 'N/A';
$usuarioId = isset($_GET['user']) ? intval($_GET['user']) : 'N/A';

// Obtener productos por categoría
$entradas = obtenerProductosPorCategoria('Entradas');
$fuertes = obtenerProductosPorCategoria('Fuertes');
$bebidas = obtenerProductosPorCategoria('Bebidas');
?>
<html>
<head>
    <title>RePOS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/StyleOrder.css">
</head>
<body>
    <div class="header">RePOS</div>
    <div class="container">
        <div class="box">
            <div class="pedido-info">
            <span id="pedido-number">N°<?php echo $numeroMesa; ?></span>
            <span id="user-name"><?php echo $nombreUsuario; ?></span>
            </div>
            <div class="type-buttons">
                <button onclick="openEntradasModal()">Entradas</button>
                <button onclick="openFuertesModal()">Fuertes</button>
                <button onclick="openBebidasModal()">Bebidas</button>
            </div>
            <div class="addition-list" id="addition-list">
                <!-- Este cuadro estará vacío inicialmente -->
            </div>
             <!-- Botones para guardar pedido y volver -->
             <div class="button-group">
             <button onclick="window.location.href='home.php'">Volver</button>
             <button onclick="sendOrder()">Enviar Pedido</button>
            </div>
            <!-- HTML para mostrar productos en los modales -->
            <div id="entradas-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEntradasModal()">&times;</span>
                    <h2 id="entradas-modal-title">Entradas</h2>
                    <?php foreach ($entradas as $entrada): ?>
                        <div class="entry-item">
                            <button><?php echo $entrada['nombre']; ?> - $<?php echo $entrada['precio']; ?></button>
                            <div class="quantity" id="entradas-quantity-<?php echo $entrada['producto_id']; ?>">0</div>
                            <div>
                                <button onclick="increment('entradas-quantity-<?php echo $entrada['producto_id']; ?>', '<?php echo $entrada['nombre']; ?>')"><i class="fas fa-plus"></i></button>
                                <button onclick="decrement('entradas-quantity-<?php echo $entrada['producto_id']; ?>', '<?php echo $entrada['nombre']; ?>')"><i class="fas fa-minus"></i></button>
                            </div>
                            <button class="note-button" onclick="openNoteModal('Entradas', 'entradas-quantity-<?php echo $entrada['producto_id']; ?>', '<?php echo $entrada['nombre']; ?>')">Nota</button>
                        </div>
                    <?php endforeach; ?>
                    <div class="button-group">
                        <button onclick="closeEntradasModal()">Atrás</button>
                        <button onclick="saveChanges('Entradas')">Guardar cambios</button>
                    </div>
                </div>
            </div>

            <div id="fuertes-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeFuertesModal()">&times;</span>
                    <h2 id="fuertes-modal-title">Fuertes</h2>
                    <?php foreach ($fuertes as $fuerte): ?>
                        <div class="entry-item">
                            <button><?php echo $fuerte['nombre']; ?> - $<?php echo $fuerte['precio']; ?></button>
                            <div class="quantity" id="fuertes-quantity-<?php echo $fuerte['producto_id']; ?>">0</div>
                            <div>
                                <button onclick="increment('fuertes-quantity-<?php echo $fuerte['producto_id']; ?>', '<?php echo $fuerte['nombre']; ?>')"><i class="fas fa-plus"></i></button>
                                <button onclick="decrement('fuertes-quantity-<?php echo $fuerte['producto_id']; ?>', '<?php echo $fuerte['nombre']; ?>')"><i class="fas fa-minus"></i></button>
                            </div>
                            <button class="note-button" onclick="openNoteModal('Fuertes', 'fuertes-quantity-<?php echo $fuerte['producto_id']; ?>', '<?php echo $fuerte['nombre']; ?>')">Nota</button>
                        </div>
                    <?php endforeach; ?>
                    <div class="button-group" style="margin-top: 20px;">
                        <button onclick="closeFuertesModal()">Atrás</button>
                        <button onclick="saveChanges('Fuertes')">Guardar cambios</button>
                    </div>
                </div>
            </div>

            <div id="bebidas-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeBebidasModal()">&times;</span>
                    <h2 id="bebidas-modal-title">Bebidas</h2>
                    <?php foreach ($bebidas as $bebida): ?>
                        <div class="entry-item">
                            <button><?php echo $bebida['nombre']; ?> - $<?php echo $bebida['precio']; ?></button>
                            <div class="quantity" id="bebidas-quantity-<?php echo $bebida['producto_id']; ?>">0</div>
                            <div>
                                <button onclick="increment('bebidas-quantity-<?php echo $bebida['producto_id']; ?>', '<?php echo $bebida['nombre']; ?>')"><i class="fas fa-plus"></i></button>
                                <button onclick="decrement('bebidas-quantity-<?php echo $bebida['producto_id']; ?>', '<?php echo $bebida['nombre']; ?>')"><i class="fas fa-minus"></i></button>
                            </div>
                            <button class="note-button" onclick="openNoteModal('Bebidas', 'bebidas-quantity-<?php echo $bebida['producto_id']; ?>', '<?php echo $bebida['nombre']; ?>')">Nota</button>
                        </div>
                    <?php endforeach; ?>
                    <div class="button-group" style="margin-top: 20px;">
                        <button onclick="closeBebidasModal()">Atrás</button>
                        <button onclick="saveChanges('Bebidas')">Guardar cambios</button>
                    </div>
                </div>
            </div>

            <div id="note-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeNoteModal()">&times;</span>
                    <h2 id="note-modal-title">Nota</h2>
                    <textarea id="note-text"></textarea>
                    <div class="button-group" style="margin-top: 20px;">
                        <button onclick="closeNoteModal()">Atrás</button>
                        <button onclick="saveNoteChanges()">Guardar Nota</button>
                    </div>
                </div>
            </div>

            <script>
                let notes = {};

                function openEntradasModal() {
                    document.getElementById('entradas-modal').style.display = "block";
                }

                function closeEntradasModal() {
                    document.getElementById('entradas-modal').style.display = "none";
                }

                function openFuertesModal() {
                    document.getElementById('fuertes-modal').style.display = "block";
                }

                function closeFuertesModal() {
                    document.getElementById('fuertes-modal').style.display = "none";
                }

                function openBebidasModal() {
                    document.getElementById('bebidas-modal').style.display = "block";
                }

                function closeBebidasModal() {
                    document.getElementById('bebidas-modal').style.display = "none";
                }

                function openNoteModal(type, id, producto) {
                    document.getElementById('note-modal-title').textContent = 'Nota para ' + producto;
                    document.getElementById('note-modal').style.display = "block";
                    document.getElementById('note-text').value = notes[id] || '';
                    document.getElementById('note-text').dataset.id = id;
                }

                function closeNoteModal() {
                    document.getElementById('note-modal').style.display = "none";
                }

                function increment(id, producto) {
                    var quantity = document.getElementById(id);
                    quantity.textContent = parseInt(quantity.textContent) + 1;
                    updateAdditionList(producto, quantity.textContent, id);
                }

                function decrement(id, producto) {
                    var quantity = document.getElementById(id);
                    if (parseInt(quantity.textContent) > 0) {
                        quantity.textContent = parseInt(quantity.textContent) - 1;
                        updateAdditionList(producto, quantity.textContent, id);
                    }
                }

                function updateAdditionList(producto, quantity, id) {
                    var list = document.getElementById('addition-list');
                    var existingItem = document.getElementById('item-' + id);

                    if (quantity > 0) {
                        if (existingItem) {
                            existingItem.textContent = producto + ": " + quantity + " - Nota: " + (notes[id] || " ");
                        } else {
                            var newItem = document.createElement('div');
                            newItem.id = 'item-' + id;
                            newItem.textContent = producto + ": " + quantity + " - Nota: " + (notes[id] || " ");
                            list.appendChild(newItem);
                        }
                    } else {
                        if (existingItem) {
                            list.removeChild(existingItem);
                        }
                    }
                }

                function saveNoteChanges() {
                    var noteText = document.getElementById('note-text').value;
                    var id = document.getElementById('note-text').dataset.id;
                    notes[id] = noteText; // Guardar la nota
                    closeNoteModal();

                    // Obtener el producto desde el elemento de cantidad
                    var producto = document.getElementById(id).previousElementSibling.textContent.split(" - ")[0]; // Obtener el nombre del producto
                    updateAdditionList(producto, document.getElementById(id).textContent, id);
                }

                function saveChanges(type) {
                    // Aquí puedes agregar la lógica para guardar cambios en el backend si es necesario
                    alert(type + ' cambios guardados.');
                }
                function sendOrder() {
                // Obtener los datos básicos
                const mesa_id = <?php echo json_encode($numeroMesa); ?>;
                const usuario_id = <?php echo json_encode($nombreUsuario); ?>;
                const estado = 'pendiente'; // Asigna el estado que corresponda
                const productos = [];

                // Recorre los productos seleccionados y agrega sus detalles al array `productos`
                document.querySelectorAll('.entry-item .quantity').forEach(item => {
                    const cantidad = parseInt(item.textContent);
                    if (cantidad > 0) {
                        const id = item.id.split('-')[2]; // Obtener el producto_id del ID del elemento
                        const nombreProducto = item.previousElementSibling.textContent.split(" - ")[0];
                        productos.push({
                            producto_id: id,
                            cantidad: cantidad,
                            nombre: nombreProducto,
                            nota: notes[item.id] || '' // Agregar la nota si existe
                        });
                    }
                });

                // Verificar que se haya seleccionado al menos un producto
                if (productos.length === 0) {
                    alert("Por favor, selecciona al menos un producto antes de enviar el pedido.");
                    return;
                }

                // Crear un formulario para enviar los datos
                const form = document.createElement("form");
                form.method = "POST";
                form.action = "../controllers/guardar_pedido.php";

                // Agregar los datos de mesa, usuario y estado al formulario
                form.appendChild(createHiddenInput("mesa_id", mesa_id));
                form.appendChild(createHiddenInput("usuario_id", usuario_id));
                form.appendChild(createHiddenInput("estado", estado));

                // Agregar los productos al formulario
                productos.forEach((producto, index) => {
                    form.appendChild(createHiddenInput(`productos[${index}][producto_id]`, producto.producto_id));
                    form.appendChild(createHiddenInput(`productos[${index}][cantidad]`, producto.cantidad));
                    form.appendChild(createHiddenInput(`productos[${index}][nota]`, producto.nota));
                });

                // Enviar el formulario
                document.body.appendChild(form);
                form.submit();
            }

            // Función auxiliar para crear inputs ocultos
            function createHiddenInput(name, value) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = name;
                input.value = value;
                return input;
            }
            
            </script>
        </div>
    </div>
</body>
</html>