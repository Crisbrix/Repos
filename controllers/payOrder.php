<?php
session_start();
include("conexion.php");

$mesaId = $_SESSION['mesaId'];

// Consulta SQL para obtener los detalles del pedido para la mesa seleccionada
$sql = "SELECT Mesas.numero_mesa, 
Productos.nombre AS producto, 
DetallePedido.cantidad, 
Productos.precio, 
(DetallePedido.cantidad * Productos.precio) AS total
FROM Pedidos
INNER JOIN Mesas ON Pedidos.mesa_id = Mesas.mesa_id
INNER JOIN DetallePedido ON Pedidos.pedido_id = DetallePedido.pedido_id
INNER JOIN Productos ON DetallePedido.producto_id = Productos.producto_id
WHERE Mesas.numero_mesa = $mesaId;";

$result = $conn->query($sql);

// Inicializar variables para los totales
$subtotal = 0;
$totalImpuestos = 0;
$totalPropina = 0;

if ($result->num_rows > 0) {
echo "<tr>
<th>PRODUCTO</th>
<th>CANT.</th>
<th>Precio Unitario</th>
<th>Total</th>
</tr>";

// Recorrer y mostrar los resultados
while ($row = $result->fetch_assoc()) {
// Calcular impuestos y propina
$totalImpuestos += $row['total'] * 0.08;


// Mostrar la fila en la tabla
echo "<tr>
<td>" . $row["producto"] . "</td>
<td>" . $row["cantidad"] . "</td>
<td> $ " . number_format($row["precio"]) . "</td>
<td> $ " . number_format($row["total"]) . "</td>
</tr>";

// Sumar al subtotal
$subtotal += $row["total"];
}

$totalPropina += ($subtotal - $totalImpuestos)* 0.1;
// Mostrar los totales
echo "<tr class='total'>
<td colspan='4'><strong>Subtotal: </strong></td>
<td> $ " . number_format($subtotal) . "</td>
</tr>";

$totalFinal = $subtotal + $totalPropina;
echo "<tr>
<td colspan='4'><strong>Total General:</strong></td>
<td> $ " . number_format($totalFinal) . "</td>
</tr>";
} else {
echo "No se encontraron resultados para la mesa seleccionada.";
}

?>