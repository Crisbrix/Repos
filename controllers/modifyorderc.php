<?php
session_start();
// Conexión a la base de datos
include("conexion.php");
// Consulta para obtener platos fuertes
$sqlFuertes = "SELECT nombre FROM Productos WHERE categoria = 'platos'";
$stmtFuertes = $conn->prepare($sqlFuertes);
$stmtFuertes->execute();
$resultFuertes = $stmtFuertes->get_result();
$platosFuertes = [];
while ($row = $resultFuertes->fetch_assoc()) {
    $platosFuertes[] = htmlspecialchars($row['nombre']);
}
$stmtFuertes->close();
// Consulta para Entradas
$sqlEntradas = "SELECT nombre FROM Productos WHERE categoria = 'entradas'";
$stmtEntradas = $conn->prepare($sqlEntradas);
$stmtEntradas->execute();
$resultEntradas = $stmtEntradas->get_result();
$entradas = [];
while ($row = $resultEntradas->fetch_assoc()) {
    $entradas[] = htmlspecialchars($row['nombre']);
}
$stmtEntradas->close();
// Consulta para Bebidas
$sqlBebidas = "SELECT nombre FROM Productos WHERE categoria = 'bebidas'";
$stmtBebidas = $conn->prepare($sqlBebidas);
$stmtBebidas->execute();
$resultBebidas = $stmtBebidas->get_result();
$bebidas = [];
while ($row = $resultBebidas->fetch_assoc()) {
    $bebidas[] = htmlspecialchars($row['nombre']);
}
$stmtBebidas->close();
$pedidoId = 0;
if (isset($_SESSION['mesaId'])) {
    $mesaId = $_SESSION['mesaId'];  
} else {
    header("Location: ../index.php");
} 
$sql = "SELECT p.pedido_id,u.nombre AS mesero, m.numero_mesa,
p.estado,p.fecha_hora, pr.nombre AS producto, dp.cantidad, dp.subtotal
FROM Pedidos p
JOIN Usuarios u ON p.usuario_id = u.usuario_id
JOIN Mesas m ON p.mesa_id = m.mesa_id
JOIN DetallePedido dp ON p.pedido_id = dp.pedido_id
JOIN Productos pr ON dp.producto_id = pr.producto_id
WHERE m.numero_mesa = $mesaId;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$row=$result->fetch_assoc();
$pedidoId = $row['pedido_id'];

while ($row = $result->fetch_assoc()) {
    $pedidos[] = [
        'nombre' => $row['mesero'],
        'producto' => $row['producto'],
        'cantidad' => $row['cantidad']
    ];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si los campos están establecidos
    if (isset($_POST['platoSeleccionado']) && isset($_POST['cantidadSeleccionada'])) {
        $platoSeleccionado = htmlspecialchars($_POST['platoSeleccionado']);
        $cantidadSeleccionada = intval($_POST['cantidadSeleccionada']); // Asegúrate de que sea un número
        // Obtiene el comentario y lo sanitiza
        $comentario = isset($_POST['comentario']) ? htmlspecialchars($_POST['comentario']) : '';
        echo "Plato seleccionado: " . $platoSeleccionado . "<br>";
        echo "Cantidad seleccionada: " . $cantidadSeleccionada . "<br>";
        echo "Comentario: " . $comentario . "<br>";
        // Verifica que la cantidad sea mayor que 0
        if ($cantidadSeleccionada > 0) {
            // Aquí puedes obtener el precio del producto
            $sqlPrecio = "SELECT precio FROM Productos WHERE nombre = ?";
            $stmtPrecio = $conn->prepare($sqlPrecio);
            $stmtPrecio->bind_param("s", $platoSeleccionado);
            $stmtPrecio->execute();
            $resultPrecio = $stmtPrecio->get_result();

            if ($rowPrecio = $resultPrecio->fetch_assoc()) {
                $precio = $rowPrecio['precio'];
                $subtotal = $precio * $cantidadSeleccionada; // Calcular el subtotal

                // Aquí puedes insertar o actualizar el pedido en la base de datos
                $mesaId = $_SESSION['mesaId']; // Asegúrate de que la mesa esté en la sesión
                $sql = "INSERT INTO DetallePedido (pedido_id, producto_id, cantidad, subtotal, comentario, estado) 
                        VALUES (?, (SELECT producto_id FROM Productos WHERE nombre = ?), ?, ?, ?, 'pendiente')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issis", $pedidoId, $platoSeleccionado, $cantidadSeleccionada, $subtotal, $comentario);

                if ($stmt->execute()) {
                    header("Location:modifyorder.php");
                    echo "Pedido modificado correctamente.";
                } else {
                    echo "Error al modificar el pedido: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "El producto no se encuentra disponible.";
            }
            $stmtPrecio->close();
        } else {
            echo "La cantidad debe ser mayor que 0.";
        }
    } else {
        echo "Datos incompletos.";
    }
} 
