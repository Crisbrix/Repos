<?php
include("conexion.php");

$sql = "SELECT 
            U.nombre AS mesero,
            DATE(P.fecha_hora) AS fecha,
            50000 AS total_sueldo
        FROM 
            Pedidos P
        JOIN 
            Usuarios U ON P.usuario_id = U.usuario_id
        WHERE 
            U.rol = 'mesero'
        GROUP BY 
            U.nombre, DATE(P.fecha_hora)";

$result = $conn->query($sql); 
$total_sueldo = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
         $formatted_sueldo = number_format($row['total_sueldo'], 2, ',','.');
        echo "<tr>
                <td>{$row['mesero']}</td>
                <td>{$formatted_sueldo}</td>
              </tr>";
        $total_sueldo += $row['total_sueldo'];
    }
} else {
    echo "<tr><td colspan='2'>No se encontraron sueldos.</td></tr>";
}

$total_sueldo = number_format($total_sueldo, 2, ',', '.');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalizar'])) {
    $deleteSql = "DELETE FROM Facturas WHERE sueldo IS NOT NULL";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Sueldos eliminados correctamente');</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error al eliminar los sueldos: " . $conn->error;
    }
}

$conn->close();
?>

