<?php
include("conexion.php"); // Asegúrate de tener el archivo de conexión a la BD
include("basic.php");

$userId = $_SESSION['userid'];
$estado = "pendiente";

// Verificar si los datos del formulario están presentes
if (isset($_POST['mesa_id'], $_POST['usuario_id'], $_POST['estado'], $_POST['productos'])) {
    $mesa_id = intval($_POST['mesa_id']);
    $estado = $_POST['estado'];
    $productos = $_POST['productos'];

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Insertar el pedido en la tabla Pedidos
        $stmtPedido = $conn->prepare("INSERT INTO Pedidos (usuario_id, mesa_id, estado) VALUES (?, ?, ?)");
        $stmtPedido->bind_param("iis", $userId, $mesa_id, $estado);
        $stmtPedido->execute();
        $pedido_id = $conn->insert_id; // Obtener el ID del pedido insertado

        // Insertar cada producto en la tabla DetallePedido
        $stmtDetalle = $conn->prepare("INSERT INTO DetallePedido (pedido_id, producto_id, cantidad, subtotal, comentario, estado) VALUES (?, ?, ?, ?, ?, ?)");

        foreach ($productos as $producto) {
            $producto_id = intval($producto['producto_id']);
            $cantidad = intval($producto['cantidad']);
            $nota = $producto['nota'];
            
            // Consultar el precio del producto
            $resultadoPrecio = $conn->query("SELECT precio FROM Productos WHERE producto_id = $producto_id");
            $precio = $resultadoPrecio->fetch_assoc()['precio'];
            $subtotal = $precio * $cantidad;

            echo $estado;
            // Insertar en DetallePedido
            $stmtDetalle->bind_param("iiiids", $pedido_id, $producto_id, $cantidad, $subtotal, $nota, $estado);  
            $stmtDetalle->execute();
        }

        // Confirmar la transacción
        $conn->commit();
        echo "Pedido y detalles guardados exitosamente.";
        header("Location: ../Views/home.php");

    } catch (Exception $e) {
        // Revertir en caso de error
        $conn->rollback();
        echo "Error al guardar el pedido: " . $e->getMessage();
    }

    $stmtPedido->close();
    $stmtDetalle->close();
    $conn->close();

} else {
    echo "Faltan datos en el formulario.";
}
?>