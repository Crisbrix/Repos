<?php
include("conexion.php");

$sql = "DELETE FROM Facturas WHERE DATE(fecha_hora) < CURDATE()";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Sueldos eliminados correctamente');</script>";
} else {
    echo "<script>alert('Error al eliminar los sueldos: " . $conn->error . "');</script>";
}

$conn->close();

header("Location: ../views/Staff.php");
exit;
?>
