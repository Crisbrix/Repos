<?php 
session_start();
if (isset($_SESSION['mesaid'])) {
    $mesa = $_SESSION['mesaid'];  
}
include("conexion.php");

// Consulta SQL
$sql = "SELECT 
            p.pedido_id,
            u.nombre AS mesero,
            m.numero_mesa,
            pr.producto_id,
            pr.nombre AS producto,
            dp.cantidad,
            p.fecha_hora,
            dp.comentario,
            dp.estado,
            p.tiempo_pedido
        FROM Pedidos p
        JOIN Usuarios u ON p.usuario_id = u.usuario_id
        JOIN Mesas m ON p.mesa_id = m.mesa_id
        JOIN DetallePedido dp ON p.pedido_id = dp.pedido_id
        JOIN Productos pr ON dp.producto_id = pr.producto_id
        WHERE pr.categoria = 'platos' AND dp.estado = 'pendiente'
        ORDER BY p.tiempo_pedido ASC"; // Ordenar por tiempo del pedido

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $mesa_actual = "";
    $producto_id = "";

    while ($row = $result->fetch_assoc()) {
        if ($mesa_actual != $row["numero_mesa"]) {
            if ($mesa_actual != "") {
                echo "<div class='status'>
                        <form method='POST' class='finalizar-pedido'>
                            <input type='hidden' name='producto_id' value='" . $producto_id . "'>
                            <button type='submit' class='btn finished'>FINALIZADO</button>
                        </form>
                      </div>
                      </div></div>"; // Cerrar mesa anterior
            }
            echo "<div class='mesa-container'>
                    <div class='mesa-header'>
                        <span class='mesa-numero'>Mesa " . $row["numero_mesa"] . "</span>
                        <span class='mesero-nombre'>" . $row["mesero"] . "</span>
                        <span class='cronometro' data-time='" . $row["tiempo_pedido"] . "'>00:00:00</span>
                    </div>
                    
                    <div class='mesa-content'>
                    <div class='mesa-header'>
                        <span class='titulo-producto'>Producto</span>
                        <span class='titulo-cantidad'>Cantidad</span>
                    </div>";
            $mesa_actual = $row["numero_mesa"];
        }

        echo "<div class='producto-item'> 
                <span class='producto-nombre'>" . $row["producto"] . "</span>
                <span class='producto-cantidad'>" . $row["cantidad"] . "</span>
              </div>";

        if (!empty($row["comentario"])) {
            echo "<span class='producto-comentario'>Comentario: " . $row["comentario"] . "</span>";
        }
        $producto_id = $row["producto_id"];
    }

    echo "<div class='status'>
    <form method='POST' class='finalizar-pedido'>
        <input type='hidden' name='producto_id' value='" . $producto_id . "'>
        <button type='submit' class='btn finished'>FINALIZADO</button>
    </form>
  </div>
  </div></div>";
} else {
    echo "No se encontraron pedidos.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['producto_id'])) {
    $producto_id = intval($_POST['producto_id']);
    $sql = "UPDATE DetallePedido
            SET estado = 'servido'
            WHERE producto_id = $producto_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('El pedido se ha actualizado correctamente');</script>";
        // Puedes redireccionar a la misma página o refrescar la página
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error al actualizar el estado del pedido: " . $conn->error;
    }
}
?>

