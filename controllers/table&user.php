<?php
include ("../controllers/conexion.php");


$mesa_id = 1; 
$usuario_id = 1; 

$numeroMesa = '';
$nombreUsuario = '';

// Consulta para obtener el número de mesa
$queryMesa = "SELECT numero_mesa FROM mesas WHERE mesa_id = $mesa_id";
$resultMesa = mysqli_query($conn, $queryMesa);

if ($resultMesa && mysqli_num_rows($resultMesa) > 0) {
    $rowMesa = mysqli_fetch_assoc($resultMesa);
    $numeroMesa = $rowMesa['numero_mesa'];
}

// Consulta para obtener el nombre del usuario
$queryUsuario = "SELECT nombre FROM usuarios WHERE usuario_id = $usuario_id";
$resultUsuario = mysqli_query($conn, $queryUsuario);
if ($resultUsuario && mysqli_num_rows($resultUsuario) > 0) {
    $rowUsuario = mysqli_fetch_assoc($resultUsuario);
    $nombreUsuario = $rowUsuario['nombre'];
}
?>
