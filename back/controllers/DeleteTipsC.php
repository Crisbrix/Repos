<?php
include("conexion.php");

// Consulta para eliminar las propinas
$sql = "DELETE FROM Facturas WHERE DATE(fecha_hora) < CURDATE()";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Propinas eliminadas correctamente');</script>";
} else {
    echo "<script>alert('Error al eliminar las propinas: " . $conn->error . "');</script>";
}

$conn->close();

// Redirigir de vuelta a la página de propinas
header("Location: ../views/Tips.php");
exit;
?>
