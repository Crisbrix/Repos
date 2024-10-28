<?php
include("../controllers/conexion.php");
// Consulta SQL
$sql = "SELECT 
            p.pedido_id,
            u.nombre AS mesero,
            m.numero_mesa,
            pr.nombre AS producto,
            dp.cantidad
        FROM Pedidos p
        JOIN Usuarios u ON p.usuario_id = u.usuario_id
        JOIN Mesas m ON p.mesa_id = m.mesa_id
        JOIN DetallePedido dp ON p.pedido_id = dp.pedido_id
        JOIN Productos pr ON dp.producto_id = pr.producto_id
        WHERE pr.categoria = 'platos' AND p.estado = 'pendiente'";

$result = $conn->query($sql);

// Organizar los pedidos por mesa
$mesas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mesas[$row['numero_mesa']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Cocina</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<div class="container">
    <?php
    $sql = "SELECT 
                Mesas.numero_mesa, 
                Usuarios.nombre AS mesero, 
                DetallePedido.pedido_id, 
                Productos.nombre AS producto, 
                DetallePedido.cantidad, 
                DetallePedido.comentario  -- Se incluye el comentario
            FROM Pedidos
            INNER JOIN Mesas ON Pedidos.mesa_id = Mesas.mesa_id
            INNER JOIN Usuarios ON Pedidos.usuario_id = Usuarios.usuario_id
            INNER JOIN DetallePedido ON Pedidos.pedido_id = DetallePedido.pedido_id
            INNER JOIN Productos ON DetallePedido.producto_id = Productos.producto_id
            WHERE Productos.categoria = 'platos'
            ORDER BY Mesas.numero_mesa, Pedidos.pedido_id";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Variables para seguimiento de la mesa actual
        $mesa_actual = "";
        
        while ($row = $result->fetch_assoc()) {
            if ($mesa_actual != $row["numero_mesa"]) {
                // Cerrar div de la mesa anterior (si existe)
                if ($mesa_actual != "") {
                    echo "</div></div>";
                }
                // Nueva mesa
                echo "<div class='mesa-container'>
                        <div class='mesa-header'>
                            <span class='mesa-numero'>Mesa " . $row["numero_mesa"] . "</span>
                            <span class='mesero-nombre'>" . $row["mesero"] . "</span>
                        </div>
                        <div class='mesa-content'>";
                $mesa_actual = $row["numero_mesa"];
            }

            // Mostrar el producto y la cantidad
            echo "<div class='producto-item'>
                    <span class='producto-nombre'>" . $row["producto"] . "</span>
                    <span class='producto-cantidad'>" . $row["cantidad"] . "</span>
                  </div>";

            // Mostrar el comentario si existe
            if (!empty($row["comentario"])) {
                echo "<div class='producto-comentario'>Comentario: " . $row["comentario"] . "</div>";
            }
        }
        // Cerrar el último div de la mesa
        echo "</div></div>";
    } else {
        echo "No se encontraron pedidos.";
    }

    $conn->close();
    ?>
</div>


    <a href="cocina.php" class="btn-refresh">Actualizar</a>

</body>
</html>