<?php

include("conexion.php"); // Conectar con la base de datos

session_start();

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];  
} else {
    header("Location: ../index.php");
}  

if (isset($_SESSION['mesaId'])) {
    $mesaId = $_SESSION['mesaId'];  
} else {
    header("Location: ../index.php");
}
?>