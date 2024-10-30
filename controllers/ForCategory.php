<?php
include ('Conexion.php');

function obtenerProductosPorCategoria($categoria) {
    global $conn;
    $sql = "SELECT producto_id, nombre, precio FROM productos WHERE categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $productos = [];
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    return $productos;
}
?>
