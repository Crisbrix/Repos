<?php
session_start();
include ("conexion.php");

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];  
} else {
    header("Location: ../index.php");
}

$sql = "SELECT nombre, rol
        from usuarios 
        where id_usuario = $userId;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$nombre = $row['nombre'];
?>