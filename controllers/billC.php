<?php
    session_start();

    include("conexion.php");

    $pedidoId = 0;
    if (isset($_SESSION['mesaId'])) {
        $mesa = $_SESSION['mesaId'];  
    } else {
        header("Location: ../index.php");
    } 

    if (isset($_SESSION['userid'])) {
        $userId = $_SESSION['userid'];  
    } else {
        header("Location: ../index.php");
    } 

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT pedido_id from pedidos where mesa_id = $mesa;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        $pedidoId = $row['pedido_id'];
    }

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
    $totalImpuestos = 0;
    $totalPropina = 0;

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
            if ($row["categoria"] == 'platos'||$row["categoria"] == 'entradas'||$row["categoria"] == 'bebidas' ) {
                $totalImpuestos += $row['total']*0.08;
                $totalPropina += $row['total']*0.1;
            }

            // Mostrar la fila en la tabla
            echo "<tr>
                <td>" . $row["numero_mesa"] . "</td>
                <td>" . $row["producto"] . "</td>
                <td>" . $row["cantidad"] . "</td>
                <td> $ " . number_format($row["precio"]) . "</td>
                <td> $ " . number_format($row["total"]) . "</td>
                <td> $ " .  $pedidoId . "</td>
                </tr>";

                // Sumar al subtotal
                $subtotal += $row["total"];
        } 

        // Mostrar las filas con los totales
        echo "<tr>
        <td colspan='4'><strong>Subtotal (sin impuestos):</strong></td>
        <td> $ " . number_format($subtotal - $totalImpuestos) . "</td>
        </tr>";

        echo "<tr>
        <td colspan='4'><strong>Total de Impuestos (8% solo en platos):</strong></td>
        <td> $ " . number_format($totalImpuestos) . "</td>
        </tr>";

        echo "<tr>
        <td colspan='4'><strong>Subtotal:</strong></td>
        <td> $ " . number_format($subtotal) . "</td>
        </tr>";
                    
        echo "<tr>
        <td colspan='4'><strong>Total propina (10% solo en platos):</strong></td>
        <td> $ " . number_format($totalPropina) . "</td>
        </tr>";

        $subtotal = $totalPropina+$subtotal;
        echo "<tr>
        <td colspan='4'><strong>Total General (con impuestos):</strong></td>
        <td> $ " . number_format($subtotal) . "</td>
        </tr>";

    } else {
        echo "No se encontraron resultados.";
    }

    // Manejo del cierre de cuenta
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrar_cuenta'])) {
        // 1. Actualiza el estado del pedido a 'pagado'
        $sqlUpdate = "UPDATE pedidos SET estado = 'pagado' WHERE pedido_id = $pedidoId";
        $result = $conn->query($sqlUpdate);
        if ($conn->query($sqlUpdate) === TRUE) {
            // 2. Realiza la eliminación de los registros relacionados
            $sqlDelete = "DELETE FROM DetallePedido WHERE pedido_id = $pedidoId;
                        DELETE FROM Facturas WHERE pedido_id = $pedidoId;
                        DELETE FROM Notificaciones WHERE pedido_id = $pedidoId;
                        DELETE FROM Pedidos WHERE pedido_id = $pedidoId;
                        DELETE FROM Mesas WHERE mesa_id = $mesa";
            
            if ($conn->multi_query($sqlDelete)) {
                // Redirigir a la página principal una vez que la cuenta ha sido cerrada
                header("Location: ../Views/home.php");
                exit();
            } else {
                echo "Error al eliminar los registros relacionados: " . $conn->error;
            }
        } else {
            echo "Error al actualizar el estado del pedido: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
?>