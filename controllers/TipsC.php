<?php
include("conexion.php");

// Consulta para obtener el nombre del mesero y la suma de propinas
$sql = "SELECT 
            U.nombre AS mesero,
            SUM(F.propina) AS total_propina
        FROM Facturas F
        JOIN Pedidos P ON F.pedido_id = P.pedido_id
        JOIN Usuarios U ON P.usuario_id = U.usuario_id
        WHERE U.rol = 'mesero'
        GROUP BY U.nombre"; // Agrupar por nombre del mesero

$result = $conn->query($sql);
$totalPropinas = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['mesero']}</td>
                <td>{$row['total_propina']}</td> <!-- Mostrar total de propina -->
              </tr>";
        $totalPropinas += $row['total_propina'];
    }
} else {
    echo "<tr><td colspan='2'>No se encontraron propinas.</td></tr>";
}

$totalPropinas = number_format($totalPropinas, 2, ',', '.');

// Eliminar las propinas al presionar el botón "Finalizar"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalizar'])) {
    $deleteSql = "DELETE FROM Facturas WHERE propina IS NOT NULL";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('Propinas eliminadas correctamente');</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error al eliminar las propinas: " . $conn->error;
    }
}

$conn->close();
?>
