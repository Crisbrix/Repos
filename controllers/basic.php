<?php
session_start();

include("conexion.php");

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];  
} else {
    header("Location: ../index.php");
} 

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT nombre, rol FROM usuarios WHERE usuario_id = '$userId'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$name = ucfirst($row["nombre"]);
?>