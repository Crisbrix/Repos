<?php   
session_start();

if (isset($_SESSION['mesaid'])) {
    $mesa = $_SESSION['mesaid'];  
}

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['detalle_ids'])) {
    $detalle_ids = $_POST['detalle_ids'];

    $ids = implode(',', array_map('intval', $detalle_ids)); // Convierte IDs a una lista segura de enteros
    $sql = "UPDATE DetallePedido
            SET estado = 'servido'
            WHERE detalle_id IN ($ids)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('El pedido se ha actualizado correctamente');</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error al actualizar el estado del pedido: " . $conn->error;
    }
}

$sql = "SELECT  
        p.pedido_id,
        u.nombre AS mesero,
        m.numero_mesa,
        pr.producto_id,
        pr.nombre AS producto,
        dp.detalle_id,
        dp.cantidad,
        p.fecha_hora,
        dp.comentario,      
        dp.estado
    FROM Pedidos p
    JOIN Usuarios u ON p.usuario_id = u.usuario_id
    JOIN Mesas m ON p.mesa_id = m.mesa_id
    JOIN DetallePedido dp ON p.pedido_id = dp.pedido_id
    JOIN Productos pr ON dp.producto_id = pr.producto_id
    WHERE pr.categoria = 'entradas' AND dp.estado = 'pendiente'
    ORDER BY p.fecha_hora ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mesa_actual = ""; 
    $detalle_ids = []; 

    while ($row = $result->fetch_assoc()) {
        $mesa_id = $row["numero_mesa"]; 

        if ($mesa_actual != $mesa_id) {
            if ($mesa_actual != "") {
                echo "<div class='status'>
                        <form method='POST' class='finalizar-pedido' onsubmit='finalizarProductos(event, [" . implode(',', $detalle_ids) . "])'>
                            <input type='hidden' name='detalle_ids[]' value='" . implode("' /><input type='hidden' name='detalle_ids[]' value='", $detalle_ids) . "'>
                            <button type='submit' class='btn finished'>FINALIZADO</button>
                        </form>
                      </div>
                      </div></div>";
                $detalle_ids = [];
            }
            echo "<div class='mesa-container' id='mesa-$mesa_id'>
                    <div class='mesa-header'>
                        <span class='mesa-numero'>Mesa " . $mesa_id . "</span>
                        <span class='mesero-nombre'>" . $row["mesero"] . "</span>
                        <span class='cronometro' data-time='" . $row["fecha_hora"] . "'>00:00:00</span>
                    </div>
                    <div class='mesa-content'>
                        <div class='mesa-header'>
                            <span class='titulo-producto'>Producto</span>
                            <span class='titulo-cantidad'>Cantidad</span>
                        </div>";
            $mesa_actual = $mesa_id;
        }

        echo "<div class='producto-item' id='producto-{$row["detalle_id"]}'> 
                <span class='producto-nombre'>" . $row["producto"] . "</span>
                <span class='producto-cantidad'>" . $row["cantidad"] . "</span>
              </div>";

        if (!empty($row["comentario"])) {
            echo "<span class='producto-comentario'>Comentario: " . $row["comentario"] . "</span>";
        }

        $detalle_ids[] = $row["detalle_id"];
    }

    echo "<div class='status'>
        <form method='POST' class='finalizar-pedido' onsubmit='finalizarProductos(event, [" . implode(',', $detalle_ids) . "])'>
            <input type='hidden' name='detalle_ids[]' value='" . implode("' /><input type='hidden' name='detalle_ids[]' value='", $detalle_ids) . "'>
            <button type='submit' class='btn finished'>FINALIZADO</button>
        </form>
      </div>
      </div></div>";
} else {
    echo "No se encontraron pedidos.";
}
?>
