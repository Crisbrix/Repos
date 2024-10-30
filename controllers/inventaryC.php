<?php
session_start();

include("conexion.php");

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];  
} else {
    header("Location: ../index.php");
}
?>