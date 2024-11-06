<?php
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
?>
