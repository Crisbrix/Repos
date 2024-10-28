<?php
session_start(); 
include("conexion.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegúrate de sanitizar los datos de entrada
    $detalle_id = isset($_POST['detalle_id']) ? $_POST['detalle_id'] : null;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;

    if ($detalle_id && $comentario) {
        // Consulta para obtener los detalles del pedido antes de eliminar
        $selectQuery = "SELECT pedido_id, producto_id, cantidad FROM DetallePedido WHERE detalle_id = ?";
        $stmtSelect = $conn->prepare($selectQuery);
        $stmtSelect->bind_param("i", $detalle_id);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->get_result();

        if ($resultSelect->num_rows > 0) {
            $row = $resultSelect->fetch_assoc();
            $pedido_id = $row['pedido_id'];
            $producto_id = $row['producto_id'];
            $cantidad = $row['cantidad']; // Asegúrate de obtener la cantidad aquí

            // Disminuir la cantidad en lugar de eliminar el detalle
            if ($cantidad > 1) {
                // Actualizar la cantidad del detalle
                $updateQuery = "UPDATE DetallePedido SET cantidad = cantidad - 1 WHERE detalle_id = ?";
                $stmtUpdate = $conn->prepare($updateQuery);
                $stmtUpdate->bind_param("i", $detalle_id);
                $stmtUpdate->execute();
            } else {
                // Si la cantidad es 1, eliminar el detalle
                $deleteQuery = "DELETE FROM DetallePedido WHERE detalle_id = ?";
                $stmtDelete = $conn->prepare($deleteQuery);
                $stmtDelete->bind_param("i", $detalle_id);
                $stmtDelete->execute();
            }

                // Registrar la devolución
                $insertDevolucionQuery = "INSERT INTO Devoluciones (pedido_id, producto_id, cantidad, razon) 
                                           VALUES (?, ?, ?, ?)";
                $stmtDevolucion = $conn->prepare($insertDevolucionQuery);
                $cantidadDevolucion = 1; // Cantidad a devolver
                $stmtDevolucion->bind_param("iiis", $pedido_id, $producto_id, $cantidadDevolucion, $comentario);
                $stmtDevolucion->execute();

                // Actualizar el inventario
                $updateInventarioQuery = "UPDATE Inventario SET cantidad = cantidad + ? WHERE producto_id = ?";
                $stmtUpdateInventario = $conn->prepare($updateInventarioQuery);
                $stmtUpdateInventario->bind_param("ii", $cantidad, $producto_id);
                $stmtUpdateInventario->execute();

                // Redirigir a otra página después de la operación exitosa
                header("Location:../views/deleteOrder.php?mensaje=Devolución registrada y detalle eliminado exitosamente.");
                exit; // Asegúrate de llamar a exit después de header
            } else {
                $message = "Error: No se pudo eliminar el detalle.";
            }

            // Cerrar las declaraciones
            $stmtDelete->close();
            $stmtSelect->close();
            $stmtCheckDetails->close();
            $stmtDevolucion->close();
            $stmtUpdateInventario->close();
        } 
    } else {
        // Manejo de errores si faltan datos
        echo "Error: faltan datos.";
    }
    $pedidoId = 0;
    if (isset($_SESSION['mesaId'])) {
        $mesa = $_SESSION['mesaId'];  
    } else {
        header("Location: ../index.php");
    } 
$sql = "SELECT p.pedido_id, u.nombre AS mesero, m.numero_mesa,
p.estado, p.fecha_hora, pr.nombre AS producto, dp.cantidad, dp.subtotal, dp.detalle_id
FROM Pedidos p
JOIN Usuarios u ON p.usuario_id = u.usuario_id
JOIN Mesas m ON p.mesa_id = m.mesa_id
JOIN DetallePedido dp ON p.pedido_id = dp.pedido_id
JOIN Productos pr ON dp.producto_id = pr.producto_id
WHERE p.pedido_id = $mesa ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $pedidos[] = [
        'nombre' => $row['mesero'],
        'producto' => $row['producto'],
        'cantidad' => $row['cantidad'],
        'detalle_id' => $row['detalle_id']
    ];
}


    $stmt->close();
