<?php
session_start();
include("conexion.php");
$userId = $_SESSION['userid'];  

$sql = "SELECT d.fecha, p.nombre AS producto, d.cantidad, p.precio, d.razon
        FROM Devoluciones d
        JOIN Productos p ON d.producto_id = p.producto_id
        ORDER BY d.fecha ASC"; // Asegúrate de que 'nombre' y 'precio' son columnas de la tabla Productos
$result = $conn->query($sql);
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
$result1 = $conn->query($sql);

$row = $result1->fetch_assoc();
$name = ucfirst($row["nombre"]);


$conn->close();