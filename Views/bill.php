<?php
    session_start();

    include("../controllers/conexion.php");

    if (isset($_SESSION['mesaId'])) {
        $mesa = $_SESSION['mesaId'];  
    } else {
        header("Location: ../index.php");
    } 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factura</title>
    <link rel="stylesheet" href="../styles/bill.css">
    <link rel="stylesheet" href="../styles/fontStyles.css">
</head>
<body>
    <h1>Factura</h1>
    <div class="table-container">
        <table>
            <h1>
            </h1>
            <?php
                include("../controllers/conexion.php");
                // Consulta SQL
                $sql = "SELECT Mesas.numero_mesa, 
                        Productos.nombre AS producto, 
                        DetallePedido.cantidad, 
                        Productos.precio, 
                        Productos.categoria, 
                        (DetallePedido.cantidad * Productos.precio) AS total
                    FROM Pedidos
                    INNER JOIN Mesas ON Pedidos.mesa_id = Mesas.mesa_id
                    INNER JOIN DetallePedido ON Pedidos.pedido_id = DetallePedido.pedido_id
                    INNER JOIN Productos ON DetallePedido.producto_id = Productos.producto_id
                    WHERE Mesas.mesa_id = $mesa";
                        

                $result = $conn->query($sql);

                // Inicializar variables para los totales
                $subtotal = 0;
                $total_impuestos = 0;

                if ($result->num_rows > 0) {
                    echo "<tr>
                            <th>Número de Mesa</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                          </tr>";

                    // Recorrer y mostrar los resultados
                    while ($row = $result->fetch_assoc()) {
                        $impuesto_producto = 0;

                        // Calcular el impuesto solo para los productos de la categoría 'platos'
                        if ($row["categoria"] == 'platos') {
                            $impuesto_producto = $row["total"] * 0.08;  // 8% de impuesto sobre 'platos'
                            $row["total"] += $impuesto_producto;  // Sumar el impuesto al total del plato
                            $total_impuestos += $impuesto_producto;  // Acumular el valor del impuesto
                        }

                        // Mostrar la fila en la tabla
                        echo "<tr>
                                <td>" . $row["numero_mesa"] . "</td>
                                <td>" . $row["producto"] . "</td>
                                <td>" . $row["cantidad"] . "</td>
                                <td>" . number_format($row["precio"], 2) . "</td>
                                <td>" . number_format($row["total"], 2) . "</td>
                              </tr>";

                        // Sumar al subtotal
                        $subtotal += $row["total"];
                    }

                    // Mostrar las filas con los totales
                    echo "<tr>
                            <td colspan='4'><strong>Subtotal (sin impuestos):</strong></td>
                            <td>" . number_format($subtotal - $total_impuestos, 2) . "</td>
                          </tr>";

                    echo "<tr>
                            <td colspan='4'><strong>Total de Impuestos (8% solo en platos):</strong></td>
                            <td>" . number_format($total_impuestos, 2) . "</td>
                          </tr>";

                    echo "<tr>
                            <td colspan='4'><strong>Total General (con impuestos):</strong></td>
                            <td>" . number_format($subtotal, 2) . "</td>
                          </tr>";

                } else {
                    echo "No se encontraron resultados.";
                }

                // Cerrar la conexión
                $conn->close();
            ?>
        </table>
        <a href="home.php">salir</a>
    </div>
</body>
</html>
